<?php namespace Congresso\ModuloInscricao\Participante;

use Congresso\ModuloInscricao\Participante\Repositorios\RepositorioParticipante;
use Congresso\ModuloInscricao\Participante\Validacao\ValidacaoParticipante;
use Congresso\System\Negocio\NegocioInterface;
use Congresso\ModuloInscricao\Participante\Models\Participante as ModelParticipante;
use Illuminate\Support\Facades\Redirect;
use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Environments\Sandbox;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Requests\Checkout\CheckoutService;

class Participante implements NegocioInterface
{
    protected $repositorioParticipante;

    protected $validacaoParticipante;

    protected $errors;

    public function __construct()
    {
        $participante = new ModelParticipante();

        $this->repositorioParticipante = new RepositorioParticipante($participante);

        $validacao = \App::make('validator');

        $this->validacaoParticipante = new ValidacaoParticipante($validacao);
    }

    public function all($input = null)
    {
        // TODO: Implement all() method.
    }

    public function find($id)
    {
        // TODO: Implement find() method.
    }

    public function save(array $input)
    {
        // TODO: Implement save() method.
        try
        {

            return \DB::connection()->transaction(function() use ($input){

                $validaCpf = self::validaCPF($input['cpf']);

                if(!$validaCpf){
                    throw new \AppException('O CPF passado é inválido');
                }

                $this->validacaoParticipante->with($input);

                if(!$this->validacaoParticipante->passes()){
                    return $this->validacaoParticipante->errors();
                }



                $existeCpf = self::buscarCPF(self::removeCaracter($input['cpf'], ['.', '-'], ['','']));

                if($existeCpf){
                    throw new \AppException('O CPF passado já está cadastrado no sistema');
                }

                $data = \DateTime::createFromFormat('d/m/Y', $input['dataNascimento']);



                $dados['part_nome_completo']                = $input['nomeCompleto'];
                $dados['part_nome_cracha']                  = $input['nomeCracha'];
                $dados['part_cpf']                          = self::removeCaracter($input['cpf'], ['.', '-'], ['','']);
                $dados['part_rg']                           = $input['rg'];
                $dados['part_data_nascimento']              = $data->format('Y-m-d');//date('Y-m-d', strtotime($input['dataNascimento']));
                $dados['part_endereco']                     = $input['endereco'];
                $dados['cod_municipios']                    = $input['municipio'];
                $dados['part_telefone_residencial']         = $input['telefoneResidencial'];
                $dados['part_telefone_celular']             = $input['telefoneCelular'];
                $dados['part_email']                        = $input['email'];
                $dados['cod_instituicao']                   = $input['instituicao'];
                $dados['cod_sexo']                          = $input['sexo'];
                $dados['part_tipo_deficiencia']             = $input['necessidadeEspecial'];
                $dados['part_motivacao']                    = $input['motivacao'];

                $salvar = $this->repositorioParticipante->save($dados);

                if(!$salvar){
                    throw new \AppException('Não foi possivel salvar os dados');
                }

                return true;
            });

        }catch (\AppException $e)
        {
            $this->errors = $e->getMensagem();

            return false;
        }
    }

    public function update(array $input, $id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function getErrors()
    {
        // TODO: Implement getErrors() method.
        return $this->errors;
    }

    protected function removeCaracter($valor, $procurar, $substituir)
    {
        $input = str_replace($procurar, $substituir, $valor);

        return $input;
    }

    protected function buscarCPF($cpf)
    {
        return ModelParticipante::where('part_cpf', '=', $cpf)->first();
    }

    protected function validaCPF($cpf)
    {
        if(empty($cpf)){
            return false;
        }

        $cpf = self::removeCaracter($cpf, ['.', '-'], ['', '']);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        if(strlen($cpf) != 11){
            return false;
        }elseif($cpf == '00000000000' ||
            $cpf == '11111111111' ||
            $cpf == '22222222222' ||
            $cpf == '33333333333' ||
            $cpf == '44444444444' ||
            $cpf == '55555555555' ||
            $cpf == '66666666666' ||
            $cpf == '77777777777' ||
            $cpf == '88888888888' ||
            $cpf == '99999999999'){
            return false;
        }else{

            for ($t = 9; $t < 11; $t++) {

                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }

                $d = ((10 * $d) % 11) % 10;

                if ($cpf{$c} != $d) {
                    return false;
                }
            }

            return true;
        }


    }
}
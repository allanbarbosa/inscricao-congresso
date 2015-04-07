<?php namespace Congresso\ModuloInscricao\Participante;

use Congresso\ModuloInscricao\Participante\Repositorios\RepositorioParticipante;
use Congresso\ModuloInscricao\Participante\Validacao\ValidacaoParticipante;
use Congresso\System\Negocio\NegocioInterface;
use Congresso\ModuloInscricao\Participante\Models\Participante as ModelParticipante;
use Illuminate\Support\Facades\App;

class ParticipantePago implements NegocioInterface
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
        try {

            $input['part_pago'] = true;

            $participantes = $this->repositorioParticipante->getWhere($input);

            return $participantes;

        }catch (\AppException $e){
            $this->errors = $e->getMensagem();
            return false;
        }
    }

    public function find($id)
    {
        // TODO: Implement find() method.
        try {

            $participante = $this->repositorioParticipante->find($id);

            if(!$participante){
                throw new \AppException('Não foi possivel encontrar o registro');
            }

            $dadosParticipante = [
                'nomeCompleto'      => $participante->part_nome_completo,
                'nomeCracha'        => $participante->part_nome_cracha,
                'cpf'               => $participante->part_cpf,
                'dataNascimento'    => date('d/m/Y', strtotime($participante->part_data_nascimento)),
                'telefoneContato'   => $participante->part_telefone_celular,
                'email'             => $participante->part_email,
                'endereco'          => $participante->part_endereco,
                'municipio'         => $participante->muni_descricao,
                'sexo'              => $participante->sexo_descricao,
                'instituicao'       => $participante->inst_nome,
                'status'            => $participante->part_pago,
                'id'                => $participante->part_id,
                'apresentador'      => $participante->part_apresentador
            ];

            return $dadosParticipante;

        }catch (\AppException $e){
            $this->errors = $e->getMensagem();
            return false;
        }

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
                $dados['part_data_nascimento']              = $data->format('Y-m-d');//date('Y-m-d', strtotime($input['dataNascimento']));
                $dados['cod_municipios']                    = $input['municipio'];
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
        try {

            $participante = $this->repositorioParticipante->find($id);

            if(!$participante){
                throw new \AppException('Participante solicitado não foi encontrado');
            }

            $input['id']    = $id;
            $input['deleted_by'] = \Auth::user()->usua_id;

            $deletar = $this->repositorioParticipante->delete($input);

            if(!$deletar){
                throw new \AppException('Não foi possivel excluir o participante');
            }

            return true;

        }catch (\AppException $e){
            $this->errors = $e->getMensagem();
            return false;
        }
    }

    public function getErrors()
    {
        // TODO: Implement getErrors() method.
        return $this->errors;
    }

    public function atualizarPago($id)
    {
        try {

            $participante = ModelParticipante::find($id);

            if(!$participante){
                throw new \AppException('Não foi possivel encontrar o registro');
            }

            $dados['part_nome_completo']                = $participante->part_nome_completo;
            $dados['part_nome_cracha']                  = $participante->part_nome_cracha;
            $dados['part_cpf']                          = $participante->part_cpf;
            $dados['part_rg']                           = $participante->part_rg;
            $dados['part_data_nascimento']              = $participante->part_data_nascimento;//date('Y-m-d', strtotime($input['dataNascimento']));
            $dados['part_endereco']                     = $participante->part_endereco;
            $dados['cod_municipios']                    = $participante->cod_municipios;
            $dados['part_telefone_residencial']         = $participante->part_telefone_residencial;
            $dados['part_telefone_celular']             = $participante->part_telefone_celular;
            $dados['part_email']                        = $participante->part_email;
            $dados['cod_instituicao']                   = $participante->cod_instituicao;
            $dados['cod_sexo']                          = $participante->cod_sexo;
            $dados['part_tipo_deficiencia']             = $participante->part_tipo_deficiencia;
            $dados['part_motivacao']                    = $participante->part_motivacao;
            $dados['part_pago']                         = true;
            $dados['updated_by']                        = \Auth::user()->usua_id;
            $dados['part_id']                           = $id;

            $participante = $this->repositorioParticipante->update($dados);

            if(!$participante){
                throw new \AppException('Não foi possivel atualizar o registro');
            }

            return true;

        }catch(\AppException $e){
            $this->errors = $e->getMensagem();
            return false;
        }
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
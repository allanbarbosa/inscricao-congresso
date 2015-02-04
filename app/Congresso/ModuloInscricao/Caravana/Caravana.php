<?php namespace Congresso\ModuloInscricao\Caravana;

use Congresso\ModuloInscricao\Caravana\Repositorios\RepositorioCaravana;
use Congresso\ModuloInscricao\Caravana\Validacao\ValidacaoCaravana;
use Congresso\ModuloInscricao\Participante\Models\Participante;
use Congresso\System\Negocio\NegocioInterface;
use Congresso\ModuloInscricao\Caravana\Models\Caravana as ModelCaravana;

class Caravana implements NegocioInterface
{
    protected $repositorioCaravana;

    protected $errors;

    protected $validacaoCaravana;

    public function __construct()
    {
        $caravana = new ModelCaravana();

        $this->repositorioCaravana = new RepositorioCaravana($caravana);

        $validacao = \App::make('validator');

        $this->validacaoCaravana = new ValidacaoCaravana($validacao);
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
        try {

            return \DB::connection($this->repositorioCaravana->connection)->transaction(function() use ($input){

                $this->validacaoCaravana->with($input);

                if(!$this->validacaoCaravana->passes()){
                    return $this->validacaoCaravana->errors();
                }

                if($input['municipio'] == 537){
                    throw new \AppException('Só é permitido Caravanas do Interior do Estado ou de outro municipio');
                }

                if(count($input['nomeCompleto']) < 4){
                    throw new \AppException('O número de participantes deve conter no mínimo 4 pessoas');
                }

                for($i=0; $i<count($input['cpf']); $i++){

                    $existeParticipante = self::buscarParticipante($input['cpf'][$i]);

                    if($existeParticipante){
                        throw new \AppException('O participante de cpf: ' . $input['cpf'][$i] . 'já está cadastrado no sistema');
                    }
                }

                $dados['cara_nome']                 = $input['nomeCaravana'];
                $dados['cara_responsavel']          = $input['responsavelCaravana'];
                $dados['cod_municipio']             = $input['municipio'];
                $dados['cara_telefone_responsavel'] = $input['telefoneResponsavel'];

                $caravana = $this->repositorioCaravana->save($dados);

                if(!$caravana){
                    throw new \AppException('Não foi possivel inserir a caravana');
                }

                for($i=0; $i<count($input['nomeCompleto']); $i++){

                    $participantes = new Participante();

                    $data = \DateTime::createFromFormat('d/m/Y', $input['dataNascimento'][$i]);

                    $participantes->part_nome_completo       = $input['nomeCompleto'][$i];
                    $participantes->part_nome_cracha         = $input['nomeCracha'][$i];
                    $participantes->part_cpf                 = self::removeCaracter($input['cpf'][$i], ['.', '-'], ['','']);
                    $participantes->part_data_nascimento     = $data->format('Y-m-d');//date('Y-m-d', strtotime($input['dataNascimento'][$i]));
                    $participantes->cod_municipios           = $input['municipio'];
                    $participantes->part_telefone_celular    = $input['telefone'][$i];
                    $participantes->part_email               = $input['email'][$i];
                    $participantes->cod_instituicao          = $input['instituicao'][$i];
                    $participantes->cod_sexo                 = $input['sexo'][$i];
                    $participantes->part_tipo_deficiencia    = $input['necessidadeEspecial'][$i];

                    $participantes->save();

                    $dadosParticipantes[$i] = $participantes->part_id;

                }

                $caravana->participante()->attach($dadosParticipantes);

                return $caravana;
            });


        }catch(\AppException $e){
            $this->errors = $e->getMensagem();
            return false;
        }
        // TODO: Implement save() method.
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

    protected function buscarParticipante($cpf)
    {
        $cpf = self::removeCaracter($cpf, ['.','-'], ['','']);

        $participante = Participante::where('part_cpf', '=', $cpf)->first();

        return $participante;
    }

    protected function removeCaracter($valor, $procurar, $substituir)
    {
        $input = str_replace($procurar, $substituir, $valor);

        return $input;
    }

}
<?php namespace Congresso\ModuloInscricao\Participante;

use Congresso\ModuloInscricao\Participante\Repositorios\RepositorioParticipante;
use Congresso\ModuloInscricao\Participante\Validacao\ValidacaoParticipante;
use Congresso\System\Negocio\NegocioInterface;
use Congresso\ModuloInscricao\Participante\Models\Participante as ModelParticipante;

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

                $this->validacaoParticipante->with($input);

                if(!$this->validacaoParticipante->passes()){
                    return $this->validacaoParticipante->errors();
                }

                $dados['part_nome_completo']                = $input['nomeCompleto'];
                $dados['part_nome_cracha']                  = $input['nomeCracha'];
                $dados['part_cpf']                          = $input['cpf'];
                $dados['part_rg']                           = $input['rg'];
                $dados['part_data_nascimento']              = $input['dataNascimento'];
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

}
<?php namespace Congresso\ModuloInscricao\Participante;

use Congresso\ModuloInscricao\Participante\Models\Participante;
use Congresso\ModuloInscricao\Participante\Repositorios\RepositorioApresentador;
use Congresso\System\Negocio\NegocioInterface;

class Apresentador implements NegocioInterface
{
    protected $repositorioApresentador;

    protected $errors;

    public function __construct()
    {
        $participante = new Participante();

        $this->repositorioApresentador = new RepositorioApresentador($participante);
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
    }

    public function update(array $input, $id)
    {
        // TODO: Implement update() method.
        try {
            return \DB::connection()->transaction(function() use ($input, $id){

                $participante = $this->repositorioApresentador->find($id);

                if(!$participante){
                    throw new \AppException('Não foi possivel encontrar o participante solicitado');
                }

                $dados['id']     = $id;
                $dados['part_apresentador'] = $input['apresentador'];

                $apresentador = $this->repositorioApresentador->update($dados);

                if(!$apresentador){
                    throw new \AppException('Não foi possivel salvar o registro');
                }

                return true;
            });
        }catch(\AppException $e){
            $this->errors = $e->getMensagem();

            return false;
        }

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
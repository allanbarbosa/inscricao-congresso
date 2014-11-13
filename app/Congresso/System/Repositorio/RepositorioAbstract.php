<?php namespace Congresso\System\Repositorio;

abstract class RepositorioAbstract implements RepositorioInterface
{
    protected $model;

    protected $fields = array();

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function all()
    {
        // TODO: Implement all() method.
        $itens = $this->model->all();

        return (count($itens)) ? $itens : false;
    }

    public function find($id)
    {
        // TODO: Implement find() method.
        $itens = $this->model->find($id);

        return ($itens == null) ? false : $itens;
    }

    public function findOrFail($id)
    {
        // TODO: Implement findOrFail() method.
        return $this->model->findOrFail($id);
    }

    public function save(array $input)
    {
        // TODO: Implement save() method.
        for($i = 0; $i < count($this->fields); $i++) {

            $dados = $this->fields[$i];

            if(isset($input[$this->fields[$i]])){
                $this->model->$dados = $input[$this->fields[$i]];
            }

        };

        return $this->model->save();
    }

    public function update(array $input)
    {
        // TODO: Implement update() method.
        $this->model = $this->model->find($input['id']);

        if($this->model == null) {
            throw new \Exception('Registro não foi encontrado');
        }

        for($i = 0; $i < count($this->fields); $i++) {

            $dados = $this->fields[$i];

            if(isset($input[$this->fields[$i]])){

                $this->model->$dados = $input[$this->fields[$i]];

            }

        };

        return $this->model->save();
    }

    public function delete($input)
    {
        // TODO: Implement delete() method.
        if($input['id'] == null || empty($input['id']) || !isset($input['id']) ) {
            throw new \Exception('ID não encontrado');
        }

        $this->model = $this->model->find($input['id']);

        if($this->model == null) {
            throw new \Exception('Registro não encontrado para ser removido');
        };

        $this->model->deleted_by = $input['deleted_by'];

        $this->model->save();

        return $this->model->delete();
    }

    public abstract function getWhere(array $input);

}
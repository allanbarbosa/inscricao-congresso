<?php namespace Congresso\ModuloInscricao\Instituicao;

use Congresso\ModuloInscricao\Instituicao\Repositorios\RepositorioInstituicao;
use Congresso\ModuloInscricao\Instituicao\Validacao\ValidacaoInstituicao;
use Congresso\System\Negocio\NegocioInterface;
use Congresso\ModuloInscricao\Instituicao\Models\Instituicao as ModelInstituicao;

class Instituicao implements NegocioInterface
{
    protected $repositorioInstituicao;

    protected $validacaoInstituicao;

    protected $errors;

    public function __construct()
    {
        $instituicao = new ModelInstituicao();

        $this->repositorioInstituicao = new RepositorioInstituicao($instituicao);

        $validacao = \App::make('validator');

        $this->validacaoInstituicao = new ValidacaoInstituicao($validacao);
    }

    public function all()
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
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function getErrors()
    {
        // TODO: Implement getErrors() method.
    }

}
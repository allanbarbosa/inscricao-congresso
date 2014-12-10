<?php namespace Congresso\ModuloAdministrativo\Instituicao\Controllers;

use Congresso\ModuloAdministrativo\Instituicao\Instituicao;

class InstituicaoController extends \BaseController
{
    protected $instituicao;

    public function __construct(Instituicao $instituicao)
    {
        $this->instituicao = $instituicao;
    }

    public function getInstituicoes()
    {
        $input = \Input::all();

        $instituicoes = $this->instituicao->all($input);

        return \Response::json($instituicoes);
    }
}
<?php namespace Congresso\ModuloAdministrativo\Municipios\Controllers;

use Congresso\ModuloAdministrativo\Municipios\Municipio;

class MunicipiosController extends \BaseController
{
    protected $municipio;

    public function __construct(Municipio $municipio)
    {
        $this->municipio = $municipio;
    }

    public function getMunicipios()
    {
        $input = \Input::all();

        $municipio = $this->municipio->all($input);

        return \Response::json($municipio);
    }
}
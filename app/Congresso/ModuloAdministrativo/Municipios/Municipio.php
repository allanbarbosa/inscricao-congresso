<?php namespace Congresso\ModuloAdministrativo\Municipios;

use Congresso\ModuloAdministrativo\Municipios\Models\Municipios;
use Congresso\ModuloAdministrativo\Municipios\Repositorios\RepositorioMunicipios;
use Congresso\System\Negocio\NegocioInterface;

class Municipio implements NegocioInterface
{
    protected $repositorioMunicipio;

    protected $errors;

    public function __construct()
    {
        $municipio = new Municipios();

        $this->repositorioMunicipio = new RepositorioMunicipios($municipio);
    }

    public function all($input = null)
    {
        // TODO: Implement all() method.
        try
        {

            if(!is_null($input)){

                $municipios = $this->repositorioMunicipio->getWhere($input);

            }else{

                $municipios = $this->repositorioMunicipio->all();
            }

            if(count($municipios) == 0){
                return null;
            }

            $dadosMunicipios = [];

            foreach($municipios as $key => $m){

                $dadosMunicipios[$key] = new \stdClass();

                $dadosMunicipios[$key]->municipio   = $m->muni_descricao;
                $dadosMunicipios[$key]->id          = $m->muni_id;
            }

            return $dadosMunicipios;

        }catch(\AppException $e)
        {
            $this->errors = $e->getMensagem();

            return false;
        }
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
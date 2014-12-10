<?php namespace Congresso\ModuloAdministrativo\Municipios\Repositorios;

use Congresso\ModuloAdministrativo\Municipios\Models\Municipios;
use Congresso\System\Repositorio\RepositorioAbstract;

class RepositorioMunicipios extends RepositorioAbstract
{
    protected $municipio;

    public function __construct(Municipios $municipio)
    {
        $this->municipio = $municipio;

        parent::__construct($this->municipio);

    }

    public function save(array $input)
    {
        // TODO: Change the autogenerated stub

        $this->municipio->muni_descricao        = $input['muni_descricao'];
        $this->municipio->cod_estado            = $input['cod_estado'];
        $this->municipio->created_by            = $input['created_by'];

        $this->municipio->save();

        if(!$this->municipio->muni_id){
            throw new \AppException('Não foi possivel salvar o registro');
        }

        return $this->municipio;
    }

    public function update(array $input)
    {
        // TODO: Change the autogenerated stub

        $this->municipio = $this->municipio->find($input['muni_id']);

        $this->municipio->muni_descricao        = $input['muni_descricao'];
        $this->municipio->cod_estado            = $input['cod_estado'];
        $this->municipio->updated_by            = $input['updated_by'];

        $this->municipio->save();

        if(!$this->municipio->muni_id){
            throw new \AppException('Não foi possivel atualizar o registro');
        }

        return $this->municipio;
    }

    public function getWhere(array $input)
    {
        // TODO: Implement getWhere() method.

        if(!isset($input['cod_estado'])){
            throw new \AppException('Necessita da informação de estado para a consulta');
        }

        $municipio = $this->municipio->where('cod_estado', '=', $input['cod_estado'])
                                     ->orderBy('muni_descricao', 'ASC')
                                     ->get();

        return $municipio;
    }


}
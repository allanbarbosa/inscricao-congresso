<?php namespace Congresso\ModuloAdministrativo\Instituicao\Repositorios;

use Congresso\ModuloAdministrativo\Instituicao\Models\Instituicao;
use Congresso\System\Repositorio\RepositorioAbstract;

class RepositorioInstituicao extends RepositorioAbstract
{

    protected $instituicao;

    public function __construct(Instituicao $instituicao)
    {
        $this->instituicao = $instituicao;
    }

    public function save(array $input)
    {
        $this->instituicao->inst_nome               = $input['inst_nome'];
        $this->instituicao->inst_juventude          = $input['inst_juventude'];
        $this->instituicao->inst_sigla_juventude    = $input['inst_sigla_juventude'];
        $this->instituicao->cod_municipio           = $input['cod_municipio'];
        $this->instituicao->created_by              = $input['created_by'];

        $this->instituicao->save();

        if(!$this->instituicao->inst_id)
            throw new \AppException('Não foi possivel salvar a instituição');

        return $this->instituicao;
    }

    public function update(array $input)
    {
        $this->instituicao = $this->instituicao->find($input['inst_id']);

        if(!$this->instituicao)
            throw new \AppException('A instituição solicitada não foi encontrada');

        $this->instituicao->inst_nome               = $input['inst_nome'];
        $this->instituicao->inst_juventude          = $input['inst_juventude'];
        $this->instituicao->inst_sigla_juventude    = $input['inst_sigla_juventude'];
        $this->instituicao->cod_municipio           = $input['cod_municipio'];
        $this->instituicao->updated_by              = $input['updated_by'];

        $this->instituicao->save();

        if(!$this->instituicao->inst_id)
            throw new \AppException('Não foi possível atualizar a instituição');

        return $this->instituicao;
    }

    public function getWhere(array $input)
    {
        // TODO: Implement getWhere() method.
        $instituicao = $this->instituicao->where('cod_municipios', '=', $input['cod_municipio'])
                                         ->orderBy('inst_nome', 'ASC')
                                         ->get();

        return $instituicao;
    }


}
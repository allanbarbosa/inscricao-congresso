<?php namespace Congresso\ModuloAdministrativo\Instituicao;

use Congresso\ModuloAdministrativo\Instituicao\Repositorios\RepositorioInstituicao;
use Congresso\ModuloAdministrativo\Instituicao\Validacao\ValidacaoInstituicao;
use Congresso\System\Negocio\NegocioInterface;
use Congresso\ModuloAdministrativo\Instituicao\Models\Instituicao as ModelInstituicao;
use Illuminate\Support\Facades\Auth;

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

    public function all($input = null)
    {
        // TODO: Implement all() method.
        try
        {
            if(!is_null($input)){
                $instituicoes = $this->repositorioInstituicao->getWhere($input);
            }else{
                $instituicoes = $this->repositorioInstituicao->all();
            }

            if(count($instituicoes) == 0){
                return null;
            }

            $dadosInstituicao = [];

            foreach($instituicoes as $key => $i)
            {
                $dadosInstituicao[$key]     = new \stdClass();

                $dadosInstituicao[$key]->id     = $i->inst_id;
                $dadosInstituicao[$key]->nome   = $i->inst_nome;

            }

            return $dadosInstituicao;

        }catch(\AppException $e)
        {
            $this->errors = $e->getMensagem();

            return false;
        }
    }

    public function find($id)
    {
        // TODO: Implement find() method.
        try
        {

            $instituicao = $this->repositorioInstituicao->find($id);

            if(!$instituicao)
                throw new \AppException('Não foi encontrado a Instituição solicitada');

            $dadosInstituicao = [
                'nomeInstituicao'   => $instituicao->inst_nome,
                'juventude'         => $instituicao->inst_juventude,
                'siglaJuventude'    => $instituicao->inst_sigla_juventude,
                'idInstituicao'     => $instituicao->inst_id,
                'codMunicipio'      => $instituicao->cod_municipios
            ];

            return $dadosInstituicao;

        }catch(\AppException $e)
        {
            $this->errors = $e->getMensagem();

            return false;
        }
    }

    public function save(array $input)
    {
        // TODO: Implement save() method.
        try
        {

            return \DB::transaction(function() use ($input){

                $this->validacaoInstituicao->with($input);

                if(!$this->validacaoInstituicao->passes())
                    return $this->validacaoInstituicao->errors();

                $dados['inst_nome']             = $input['nomeInstituicao'];
                $dados['inst_juventude']        = $input['nomeJuventude'];
                $dados['inst_sigla_juventude']  = $input['siglaJuventude'];
                $dados['cod_municipios']        = $input['municipio'];
                $dados['created_by']            = Auth::user()->usua_id;

                $salvar = $this->repositorioInstituicao->save($dados);

                if(!$salvar)
                    throw new \AppException('Não foi possivel salvar o registro');

                return $salvar;

            });
        }catch(\AppException $e)
        {
            $this->errors = $e->getMensagem();

            return false;
        }
    }

    public function update(array $input, $id)
    {
        // TODO: Implement update() method.
        try
        {

            return \DB::transaction(function() use ($input, $id){

                $instituicao = $this->repositorioInstituicao->find($id);

                if(!$instituicao)
                    throw new \AppException('Instituição solicitada não encontrada');

                $this->validacaoInstituicao->with($input);

                if(!$this->validacaoInstituicao->passes())
                    return $this->validacaoInstituicao->errors();

                $dados['inst_id']               = $id;
                $dados['inst_nome']             = $input['nomeInstituicao'];
                $dados['inst_juventude']        = $input['nomeJuventude'];
                $dados['inst_sigla_juventude']  = $input['siglaJuventude'];
                $dados['cod_municipios']        = $input['municipio'];
                $dados['updated_by']            = Auth::user()->usua_id;

                $salvar = $this->repositorioInstituicao->update($dados);

                if(!$salvar)
                    throw new \AppException('O registro não pode ser atualizado');

                return $salvar;
            });

        }catch(\AppException $e)
        {
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
<?php namespace Congresso\ModuloInscricao\Instituicao\Validacao;

use Congresso\System\Validacao\ValidatorAbstract;

class ValidacaoInstituicao extends ValidatorAbstract
{
    protected $rules = [];

    protected $message = [];

    protected $connection = 'pgsql';
}
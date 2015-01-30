<?php namespace Congresso\ModuloInscricao\Caravana\Validacao;

use Congresso\System\Validacao\ValidatorAbstract;

class ValidacaoCaravana extends ValidatorAbstract
{
    protected $rules = [];

    protected $message = [];

    protected $coonnection = 'pgsql';
}
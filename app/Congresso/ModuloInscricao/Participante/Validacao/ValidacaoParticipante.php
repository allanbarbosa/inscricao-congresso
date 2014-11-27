<?php namespace Congresso\ModuloInscricao\Participante\Validacao;

use Congresso\System\Validacao\ValidatorAbstract;

class ValidacaoParticipante extends ValidatorAbstract
{
    protected $rules = [
        'nomeCompleto'          => ['required'],
        'nomeCracha'            => ['required'],
        'cpf'                   => ['required'],
        'rg'                    => ['required'],
        'dataNascimento'        => ['required'],
        'endereco'              => ['required'],
        'municipio'             => ['required', 'not_in:0'],
        'telefoneResidencial'   => ['required'],
        'telefoneCelular'       => ['required'],
        'email'                 => ['required', 'email'],
        'instituicao'           => ['required', 'not_in:0'],
        'sexo'                  => ['required', 'not_in:0'],
        'necessidadeEspecial'   => ['required'],
        'motivacao'             => ['required']
    ];

    protected $message = [
        'required'              => 'O campo é obrigatório',
        'not_in'                => 'O campo é obrigatório',
        'email'                 => 'O e-mail informado está incorreto'
    ];

    protected $connection = "pgsql";
}
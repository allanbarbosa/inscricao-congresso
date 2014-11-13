<?php namespace Congresso\System\Validacao;

interface ValidatorInterface
{

    public function with(array $input);

    public function passes();

    public function errors();
}
<?php namespace Congresso\System\Negocio;

interface NegocioInterface
{
    public function all($input = null);

    public function find($id);

    public function save(array $input);

    public function update(array $input, $id);

    public function delete($id);

    public function getErrors();
}
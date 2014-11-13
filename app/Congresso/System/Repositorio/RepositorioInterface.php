<?php namespace Congresso\System\Repositorio;

interface RepositorioInterface
{
    public function all();

    public function find($id);

    public function findOrFail($id);

    public function save(array $input);

    public function update(array $input);

    public function delete($id);

    public function getWhere(array $input);
}
<?php namespace Congresso\ModuloAdministrativo\Municipios\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Municipios extends Model
{
    protected $table = 'municipios';

    protected $primaryKey = 'muni_id';

    use SoftDeletingTrait;
}
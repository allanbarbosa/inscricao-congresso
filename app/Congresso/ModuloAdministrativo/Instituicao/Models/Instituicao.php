<?php namespace Congresso\ModuloAdministrativo\Instituicao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Instituicao extends Model
{
    protected $table = 'instituicao';

    protected $primaryKey = 'inst_id';

    use SoftDeletingTrait;
}
<?php namespace Congresso\ModuloInscricao\Caravana\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Caravana extends Model
{
    protected $table = 'caravana';

    protected $primaryKey = 'cara_id';

    public $connection = 'pgsql';

    use SoftDeletingTrait;

    public function participante()
    {
        return $this->belongsToMany('Congresso\ModuloInscricao\Participante\Models\Participante', 'caravana_participante', 'cod_caravana', 'cod_participante');
    }
}
<?php namespace Congresso\ModuloInscricao\Participante\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Participante extends Model
{
    protected $table = 'participante';

    protected $primaryKey = 'part_id';

    use SoftDeletingTrait;

    public function instituicao()
    {
        return $this->belongsTo('Congresso\ModuloAdministrativo\Instituicao\Models\Instituicao', 'cod_instituicao');
    }
}
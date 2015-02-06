<?php

class Videos extends \Illuminate\Database\Eloquent\Model
{

    protected $table = 'videos';

    protected $primaryKey = 'vide_id';

    use \Illuminate\Database\Eloquent\SoftDeletingTrait;
}
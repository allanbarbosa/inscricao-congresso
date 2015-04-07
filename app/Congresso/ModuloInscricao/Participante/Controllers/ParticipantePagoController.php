<?php namespace Congresso\ModuloInscricao\Participante\Controllers;


use Congresso\ModuloInscricao\Participante\ParticipantePago;
use Illuminate\Support\MessageBag;

class ParticipantePagoController extends \BaseController
{
    protected $participantePago;

    public function __construct(ParticipantePago $participante)
    {
        $this->participantePago = $participante;
    }

    public function getIndex()
    {
        $dadosParticipantes = $this->participantePago->all();

        return \View::make('admin.participantePago.home')->with(compact('dadosParticipantes', 'participantes'));
    }

}
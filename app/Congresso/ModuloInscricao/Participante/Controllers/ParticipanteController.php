<?php namespace Congresso\ModuloInscricao\Participante\Controllers;


use Congresso\ModuloInscricao\Participante\Participante;
use Illuminate\Support\MessageBag;

class ParticipanteController extends \BaseController
{
    protected $participante;

    public function __construct(Participante $participante)
    {
        $this->participante = $participante;
    }

    public function getIndex()
    {
        return \View::make('Inscricao.form');
    }

    public function postIndex()
    {
        $input = \Input::all();

        $salvar = $this->participante->save($input);

        if($salvar instanceof MessageBag){
            return \Redirect::back()->withErrors($salvar)->withInput();
        }

        if(!$salvar){
            return \Redirect::back()->withErrors($this->participante->getErrors())->withInput();
        }

        return \Redirect::to($salvar);
    }
}
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
        return \View::make('Inscricao.participante.form');
    }

    public function postIndex()
    {
        $input = \Input::all();

        $salvar = $this->participante->save($input);

        if($salvar instanceof MessageBag){
            return \Redirect::back()->withErrors($salvar)->withInput();
        }

        if(!$salvar){
            \Session::flash('erro', $this->participante->getErrors());
            return \Redirect::back()->withInput();
        }

        \Session::flash('sucesso', 'Seu cadastro foi salvo com sucesso');
        return \Redirect::to('/inscricao');
    }
}
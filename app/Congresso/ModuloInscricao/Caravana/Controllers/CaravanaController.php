<?php namespace Congresso\ModuloInscricao\Caravana\Controllers;

use Congresso\ModuloInscricao\Caravana\Caravana;
use Illuminate\Support\MessageBag;

class CaravanaController extends \BaseController
{
    protected $caravana;

    public function __construct(Caravana $caravana)
    {
        $this->caravana = $caravana;
    }

    public function getIndex()
    {

    }

    public function getForm()
    {
        return \View::make('Inscricao.caravana.form');
    }

    public function postForm()
    {
        $input = \Input::all();

        $salvar = $this->caravana->save($input);

        if($salvar instanceof MessageBag){
            return \Redirect::back()->withErrors($salvar)->withInput();
        }

        if(!$salvar){
            \Session::flash('erro', $this->caravana->getErrors());
            return \Redirect::back()->withInput();
        }

        \Session::flash('sucesso', 'Seu cadastro foi salvo com sucesso');
        return \Redirect::to('/caravana');
    }
}
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
        $dadosCaravanas = $this->caravana->all();

        return \View::make('admin.caravana.home')->with(compact('dadosCaravanas'));
    }

    public function getForm()
    {
        if(\Request::segment(1) != 'admin'){

            return \View::make('Inscricao.caravana.form');

        }else{

            return \View::make('admin.caravana.form');
        }

    }

    public function getVisualizar($id)
    {
        $dadosCaravana = $this->caravana->find($id);

        if(!$dadosCaravana){
            \Session::flash('erro', $this->caravana->getErrors());
            return \Redirect::to('admin/caravanas');
        }

        return \View::make('admin.caravana.index')->with(compact('dadosCaravana'));
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

        if(\Request::segment(1) != 'admin'){
            return \Redirect::to('/caravana/form');
        }else{
            return \Redirect::to('admin/caravanas');
        }

    }
}
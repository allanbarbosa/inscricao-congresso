<?php namespace Congresso\ModuloAdministrativo\Usuario\Controllers;

use Congresso\ModuloAdministrativo\Usuario\Usuario;

class LoginController extends \BaseController
{

    protected $usuario;

    public function __construct(Usuario $usuario)
    {
        $this->usuario = $usuario;
    }

    public function getIndex()
    {
        return \View::make('login');
    }

    public function postIndex()
    {
        $input = \Input::all();

        $logar = $this->usuario->logar($input);

        if(!$logar){
            \Session::flash('erro', $this->usuario->getErrors());
            return \Redirect::to('login');
        }

        return \Redirect::to('admin');
    }


    public function getLogout()
    {
        \Auth::logout();

        return \Redirect::to('login');
    }
}
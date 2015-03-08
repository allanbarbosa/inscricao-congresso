<?php namespace Congresso\ModuloInscricao\Participante\Controllers;

use Congresso\ModuloInscricao\Participante\Apresentador;

class ApresentadorController extends \BaseController
{

    protected $apresentador;

    public function __construct(Apresentador $apresentador)
    {
        $this->apresentador = $apresentador;
    }

    public function getNaoApresentar($id)
    {
        $input['apresentador'] = true;

        $apresentador = $this->apresentador->update($input, $id);

        if(!$apresentador){
            \Session::flash('erro', $this->participante->getErrors());
            return \Redirect::to('admin/participantes/visualizar/' . $id);
        }

        \Session::flash('sucesso', 'Registro atualizado com sucesso');
        return \Redirect::to('admin/participantes/visualizar/' . $id);
    }

    public function getApresentar($id)
    {
        $input['apresentador'] = false;

        $apresentador = $this->apresentador->update($input, $id);

        if(!$apresentador){
            \Session::flash('erro', $this->participante->getErrors());
            return \Redirect::to('admin/participantes/visualizar/' . $id);
        }

        \Session::flash('sucesso', 'Registro atualizado com sucesso');
        return \Redirect::to('admin/participantes/visualizar/' . $id);
    }
}
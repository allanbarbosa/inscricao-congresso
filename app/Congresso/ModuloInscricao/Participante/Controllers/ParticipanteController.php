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
        $dadosParticipantes = $this->participante->all();

        return \View::make('admin.participante.home')->with(compact('dadosParticipantes', 'participantes'));
    }

    public function getVisualizar($id)
    {
        $dadosParticipante = $this->participante->find($id);

        if(!$dadosParticipante){
            \Session::flash('erro', $this->participante->getErrors());
            return \Redirect::to('admin/participantes');
        }

        return \View::make('admin.participante.index')->with(compact('dadosParticipante'));
    }

    public function getForm($id = null)
    {
        return \View::make('Inscricao.participante.form');
    }

    public function postForm($id = null)
    {
        $input = \Input::all();

        if(is_null($id)){
            $salvar = $this->participante->save($input);
        }else{
            $salvar = $this->participante->update($input, $id);
        }


        if($salvar instanceof MessageBag){
            return \Redirect::back()->withErrors($salvar)->withInput();
        }

        if(!$salvar){
            \Session::flash('erro', $this->participante->getErrors());
            return \Redirect::back()->withInput();
        }

        if(is_null($id)){
            \Session::flash('sucesso', 'Seu cadastro foi salvo com sucesso');
            return \Redirect::to('/inscricao');
        }else{
            \Session::flash('sucesso', 'Registro atualizado com sucesso');
            return \Redirect::to('admin/participantes');
        }

    }

    public function getDeletar($id)
    {
        $deletar = $this->participante->delete($id);

        if(!$deletar){
            \Session::flash('erro', $this->participante->getErrors());
            return \Redirect::to('admin/participantes');
        }

        \Session::flash('sucesso', 'Registro deletado com sucesso');
        return \Redirect::to('admin/participantes');
    }

    public function getPagar($id)
    {
        $participante = $this->participante->atualizarPago($id);

        if(!$participante){
            \Session::flash('erro', $this->participante->getErrors());
            return \Redirect::to('admin/participantes');
        }

        \Session::flash('sucesso', 'Registro atualizado com sucesso');
        return \Redirect::to('admin/participantes');
    }
}
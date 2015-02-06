<?php

class VideosController extends BaseController
{

    protected $video;

    public function __construct(Videos $video)
    {
        $this->video = $video;
    }

    public function getIndex()
    {
        $titulo = 'Cadastro de Vídeos';

        return \View::make('video.index')->with(compact('titulo'));
    }

    public function getDados()
    {
        $videos = $this->video->all();

        return Datatables::of($videos)
            ->add_column('Ações', '<a href="{{{ URL::to(\'videos/\' . $vide_id . \'/visualizar\') }}}" class="button tiny"><i class="fa fa-eye"></i> Visualizar</a>')
            ->add_column('Ações', '<a href="{{{ URL::to(\'videos/\' . $vide_id . \') }}}" class="button tiny"><i class="fa fa-eye"></i> Editar</a>')
            ->add_column('Ações', '<a href="{{{ URL::to(\'videos/deletar/\' . $vide_id . \') }}}" class="button tiny"><i class="fa fa-eye"></i> Excluir</a>')
            ->edit_column('created_at', '{{date("d/m/Y", strtotime($created_at))}}')
            ->remove_column('vide_id')
            ->remove_column('updated_at')
            ->remove_column('deleted_at')

            ->make();
    }

    public function getVisualizar($id)
    {
        $video = $this->video->find($id);

        if(!$video){
            \Session::flash('erro', 'O video selecionado não pode ser encontrado');
            return Redirect::to('videos');
        }

        $video->nomeVideo = $video->vide_nome;
        $video->linkVideo = 'https://www.youtube.com/watch?v=' . $video->vide_codigo;

        return \View::make('video.visualizar')->with(compact('video'));
    }

    public function getForm($id = null)
    {
        $video = '';

        if(!is_null($id)){
            $video = $this->video->find($id);

            if(!$video){
                \Session::flash('erro', 'O Vídeo solicitado não foi encontrado');
                Redirect::to('videos');
            }

            $video->nomeVideo = $video->vide_nome;
            $video->linkVideo = 'https://www.youtube.com/watch?v=' . $video->vide_codigo;
            $video->id = $video->vide_id;
        }

        return \View::make('video.form')->with(compact('video'));
    }

    public function postForm($id = null)
    {
        $rules = [
            'nomeVideo'     => ['required'],
            'linkVideo'     => ['required']
        ];

        $message = [
            'required'      => 'O Campo é obrigatório'
        ];

        $input = \Input::all();

        $validacao = \Validator::make($input, $rules, $message);

        if($validacao->fails()){
            return \Redirect::back()->withErrors($validacao)->withInput();
        }

        if(!is_null($id)){
            $this->video = $this->video->find($id);
        }

        $this->video->vide_nome = $input['nomeVideo'];
        $this->video->vide_codigo = self::tratarUrlVideo($input['linkVideo']);

        $this->video->save();

        if(!$this->video->vide_id){
            \Session::flash('erro', 'Não foi possivel salvar o registro');
            return \Redirect::back()->withInputs();
        }

        \Session::flash('sucesso', 'O registro foi inserido com sucesso');
        return \Redirect::to('videos');
    }

    public function getDeletar($id)
    {
        $video = $this->video->find($id);

        if(!$video){

            Session::flash('erro', 'O registro solicitado não foi encontrado');
            return Redirect::to('videos');
        }

        $deletar = $video->delete();

        if(!$deletar){
            Session::flash('erro', 'O registro não foi deletado');
            return Redirect::to('videos');
        }

        Session::flash('sucesso', 'Registro deletado com sucesso');
        return Redirect::to('videos');
    }

    protected function tratarUrlVideo($url)
    {
        $posicao = strpos($url, '=');

        $tamanhoString = strlen($url);

        return substr($url, $posicao+1, $tamanhoString);
    }
}
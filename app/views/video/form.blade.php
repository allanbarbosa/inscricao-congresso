@extends('layout.template')

@section('content')

    {{ Form::open() }}
        <h3>Cadastrar Vídeo</h3>
        <div class="form-group col-sm-6 {{ ($errors->first('nomeVideo')) ? 'has-error' : '' }}">
            <label for="nomeCaravana">Vídeo Nome</label>
            {{ Form::text('nomeVideo', (isset($video->nomeVideo)) ? $video->nomeVideo : '', ['class' => 'form-control']) }}
            {{ $errors->first('nomeVideo', '<div class="alert alert-danger">:message</div>') }}
        </div>
        <div class="form-group col-sm-6 {{ ($errors->first('responsavelCaravana')) ? 'has-error' : '' }}">
            <label for="linkVideo">Url do Video</label>
            {{ Form::text('linkVideo', (isset($video->linkVideo)) ? $video->linkVideo : '', ['class' => 'form-control']) }}
            {{ $errors->first('linkVideo', '<div class="alert alert-danger">:message</div>') }}
        </div>
        <div class="form-group col-sm-12">
            <button class="btn btn-default btn-lg" type="submit">Salvar</button>
        </div>
    {{ Form::close() }}
@endsection
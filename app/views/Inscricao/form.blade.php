@extends('layout.template')

@section('content')
{{ Form::open() }}
    <div class="form-group col-sm-12 {{ ($errors->first('nomeCompleto')) ? 'has-error' : '' }}">
        <label for="nomeCompleto">Nome Completo</label>
        {{ Form::text('nomeCompleto', '', ['class' => 'form-control']) }}
        {{ $errors->first('nomeCompleto', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group col-sm-6 {{ ($errors->first('nomeCracha')) ? 'has-error' : '' }}">
        <label for="nomeCracha">Nome no Crachá</label>
        {{ Form::text('nomeCracha', '', ['class' => 'form-control']) }}
        {{ $errors->first('nomeCracha', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group col-sm-6 {{ ($errors->first('dataNascimento')) ? 'has-error' : '' }}">
        <label for="dataNascimento">Data de Nascimento</label>
        {{ Form::text('dataNascimento', '', ['class' => 'form-control dataNascimento']) }}
        {{ $errors->first('dataNascimento', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group col-sm-4 {{ ($errors->first('cpf')) ? 'has-error' : '' }}">
        <label for="CPF" class="right">CPF</label>
        {{ Form::text('cpf', '', ['class' => 'form-control cpf']) }}
        {{ $errors->first('cpf', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group col-sm-4 {{ ($errors->first('rg')) ? 'has-error' : '' }}">
        <label for="rg" class="right">RG</label>
        {{ Form::text('rg', '', ['class' => 'form-control']) }}
        {{ $errors->first('rg', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group col-sm-4 {{ ($errors->first('sexo')) ? 'has-error' : '' }}">
         <label for="sexo">Sexo</label>
        {{ Form::select('sexo', ['masculino', 'feminino'],'', ['class'=>'form-control']) }}
        {{ $errors->first('sexo', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group col-sm-4 {{ ($errors->first('email')) ? 'has-error' : '' }}">
        <label for="email">E-mail</label>
        {{ Form::text('email', '', ['class' => 'form-control']) }}
        {{ $errors->first('email', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group col-sm-4 {{ ($errors->first('telefoneResidencial')) ? 'has-error' : '' }}">
        <label for="telefoneResidencial">Telefone Residencial</label>
        {{ Form::text('telefoneResidencial', '', ['class' => 'form-control telefone']) }}
        {{ $errors->first('telefoneResidencial', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group col-sm-4 {{ ($errors->first('telefoneCelular')) ? 'has-error' : '' }}">
        <label for="telefoneCelular">Telefone Celular</label>
        {{ Form::text('telefoneCelular', '', ['class' => 'form-control telefone']) }}
        {{ $errors->first('telefoneCelular', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group col-sm-6 {{ ($errors->first('nomeEmergencia')) ? 'has-error' : '' }}">
        <label for="nomeEmergencia">Nome em Caso de Emergência</label>
        {{ Form::text('nomeEmergencia', '', ['class' => 'form-control']) }}
        {{ $errors->first('nomeEmergencia', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group col-sm-6 {{ ($errors->first('telefoneEmergencia')) ? 'has-error' : '' }}">
        <label for="telefoneEmergencia">Telefone em Caso de Emergência</label>
        {{ Form::text('telefoneEmergencia', '', ['class' => 'form-control telefone']) }}
        {{ $errors->first('telefoneEmergencia', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group col-sm-12 {{ ($errors->first('endereco')) ? 'has-error' : '' }}">
        <label for="endereco">Endereço</label>
        {{ Form::text('endereco', '', ['class' => 'form-control']) }}
        {{ $errors->first('endereco', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group col-sm-6 {{ ($errors->first('estado')) ? 'has-error' : '' }}">
        <label for="estados">Estado</label>
        {{ Form::select('estado', ['Bahia'], '', ['class' => 'form-control']) }}
        {{ $errors->first('estado', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group col-sm-6 {{ ($errors->first('municipio')) ? 'has-error' : '' }}">
         <label for="municipio">Municipio</label>
        {{ Form::select('municipio', ['salvador', 'feira de santana'],'', ['class'=>'form-control']) }}
        {{ $errors->first('municipio', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group col-sm-12 {{ ($errors->first('instituicao')) ? 'has-error' : '' }}">
         <label for="instituicao">Instituição</label>
        {{ Form::select('instituicao', ['Amar' , 'Amado'], '',['class'=>'form-control']) }}
        {{ $errors->first('instituicao', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group col-sm-12 {{ ($errors->first('juventude')) ? 'has-error' : '' }}">
        <label for="juventude">Juventude</label>
        {{ Form::text('juventude', '', ['class' => 'form-control']) }}
        {{ $errors->first('juventude', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group col-sm-4 {{ ($errors->first('siglaJuventude')) ? 'has-error' : '' }}">
        <label for="siglaJuventude">Sigla da Juventude</label>
        {{ Form::text('siglaJuventude', '', ['class' => 'form-control']) }}
        {{ $errors->first('siglaJuventude', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group col-sm-4 {{ ($errors->first('coordenador')) ? 'has-error' : '' }}">
        <label for="coordenador">Coordenador da Juventude</label>
        {{ Form::text('coordenadorJuventude', '', ['class' => 'form-control']) }}
        {{ $errors->first('coordenadorJuventude', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group col-sm-4 {{ ($errors->first('telefoneCoordenador')) ? 'has-error' : '' }}">
        <label for="telefoneCoordenador">Telefone do Coordenador</label>
        {{ Form::text('telefoneCoordenador', '', ['class' => 'form-control telefone']) }}
        {{ $errors->first('telefoneCoordenador', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group col-sm-12 {{ ($errors->first('necessidadeEspecial')) ? 'has-error' : '' }}">
        <label for="necessidadeEspecial">Possui alguma necessidade especial?</label>
        {{ Form::text('necessidadeEspecial', '', ['class' => 'form-control']) }}
        {{ $errors->first('necessidadeEspecial', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group col-sm-12 {{ ($errors->first('motivacao')) ? 'has-error' : '' }}">
         <label for="motivacao">Motivação</label>
        {{ Form::textarea('motivacao', '',['class' => 'form-control']) }}
        {{ $errors->first('motivacao', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="col-sm-12">
    <hr/>
    </div>
    <div class="form-group col-sm-12">
        <button class="btn btn-default btn-lg" type="submit">Salvar</button>
    </div>
{{Form::close()}}
@endsection

@section('scripts')
    @parent
    <script src="{{ asset('bower_components/jquery.maskedinput/dist/jquery.maskedinput.min.js') }}"></script>
    <script>
        $(document).ready(function(){

            $('.dataNascimento').mask('99/99/9999');
            $('.cpf').mask('999.999.999-99');
            $('.telefone').mask('(99)9999-9999');
        });
    </script>
@endsection
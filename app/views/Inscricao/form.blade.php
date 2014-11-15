@extends('layout.template')

@section('content')
{{ Form::open() }}
    <div class="form-group col-sm-12">
        <label for="nomeCompleto">Nome Completo</label>
        {{ Form::text('nomeCompleto', '', ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-sm-12">
        <label for="CPF" class="right">CPF</label>
        {{ Form::text('cpf', '', ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-sm-12">
        <label for="dataNascimento">Data de Nascimento</label>
        {{ Form::text('dataNascimento', '', ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-sm-12">
        <label for="email">E-mail</label>
        {{ Form::text('email', '', ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-sm-12">
        <label for="telefoneResidencial">Telefone Residencial</label>
        {{ Form::text('telefoneResidencial', '', ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-sm-12">
        <label for="telefoneCelular">Telefone Celular</label>
        {{ Form::text('telefoneCelular', '', ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-sm-12">
        <label for="endereco">Endereço</label>
        {{ Form::text('endereco', '', ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-sm-12">
         <label for="motvacao">Motivação</label>
        {{ Form::textarea('motivacao', '',['class' => 'form-control']) }}
    </div>
    <div class="form-group col-sm-12">
         <label for="municipio">Municipios</label>
        {{ Form::select('municipio', ['salvador', 'feira de santana'],'', ['class'=>'form-control']) }}
    </div>
    <div class="form-group col-sm-12">
         <label for="sexo">Sexo</label>
        {{ Form::select('sexo', ['masculino', 'feminino'],'', ['class'=>'form-control']) }}
    </div>
    <div class="form-group col-sm-12">
         <label for="instituicao">Instituição</label>
        {{ Form::select('instituicao', ['Amar' , 'Amado'], '',['class'=>'form-control']) }}
    </div>
    <div class="col-sm-12">
    <hr/>
    </div>
    <div class="form-group col-sm-12">
        <button class="btn btn-default btn-lg" type="submit">Salvar</button>
    </div>
{{Form::close()}}
@endsection
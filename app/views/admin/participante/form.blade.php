@extends('layout.admin_template')

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
    <div class="form-group col-sm-4 {{ ($errors->first('sexo')) ? 'has-error' : '' }}">
         <label for="sexo">Sexo</label>
        {{--{{ Form::select('sexo', ['masculino', 'feminino'],'', ['class'=>'form-control']) }}--}}
        {{ Form::dropdownbox('sexo', 'sexo_id', 'sexo_descricao', 'sexo', ['class' => 'form-control']) }}
        {{ $errors->first('sexo', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group col-sm-4 {{ ($errors->first('email')) ? 'has-error' : '' }}">
        <label for="email">E-mail</label>
        {{ Form::text('email', '', ['class' => 'form-control']) }}
        {{ $errors->first('email', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group col-sm-4 {{ ($errors->first('telefoneCelular')) ? 'has-error' : '' }}">
        <label for="telefoneCelular">Telefone Celular</label>
        {{ Form::text('telefoneCelular', '', ['class' => 'form-control telefone']) }}
        {{ $errors->first('telefoneCelular', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group col-sm-6 {{ ($errors->first('estado')) ? 'has-error' : '' }}">
        <label for="estados">Estado</label>
        {{ Form::dropdownbox('estado', 'esta_id', 'esta_descricao', 'estado', ['class' => 'form-control']) }}
        {{ $errors->first('estado', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group col-sm-6 {{ ($errors->first('municipio')) ? 'has-error' : '' }}">
         <label for="municipio">Municipio</label>
        {{ Form::dropdownbox('municipios', 'muni_id', 'muni_descricao', 'municipio', ['class' => 'form-control']) }}
        {{ $errors->first('municipio', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group col-sm-12 {{ ($errors->first('instituicao')) ? 'has-error' : '' }}">
         <label for="instituicao">Instituição</label>
        {{ Form::dropdownbox('instituicao', 'inst_id', 'inst_nome', 'instituicao', ['class' => 'form-control']) }}
        {{ $errors->first('instituicao', '<div class="alert alert-danger">:message</div>') }}
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

        var estado;
        var municipio;

        $(document).ready(function(){

            $('.dataNascimento').mask('99/99/9999');
            $('.cpf').mask('999.999.999-99');
            $('.telefone').mask('(99)9999-9999');

            estado = $('select[name=estado] option:selected');
            municipio = $('select[name=municipio] option:selected');

            obterCidade(estado.val());
            obterInstituicao(municipio.val());
        });

        function obterCidade(valorEstado){

            $.ajax({

                url: '<?php echo URL::to('/municipios'); ?>',
                data: {cod_estado: valorEstado},
                type: 'GET',
                success: function(data){

                    $('select[name=municipio]').html('<option value="0"></option>');

                    if(data.length > 0){

                        data.forEach(function(v){
                            $('select[name=municipio]').append('<option value="' + v.id + '">' + v.municipio + '</option>');
                        });
                    }else{
                        $('select[name=municipio]').html('<option value="0">Altere o campo estado para buscar o municipio</option>');
                    }

                }
            });
        }

        function obterInstituicao(valorMunicipio)
        {

            $.ajax({

                 url: '<?php echo URL::to('/instituicoes');?>',
                 data: {cod_municipio: valorMunicipio},
                 type: 'GET',
                 success: function(data){

                    $('select[name=instituicao]').html('<option value="0"></option>');

                    if(data.length > 0){

                        data.forEach(function(v){
                            $('select[name=instituicao]').append('<option value="' + v.id + '">' + v.nome + '</option>');
                        });
                    }else{
                        $('select[name=instituicao]').html('<option value="0">Não tem instituição encontrada para o municipio selecionado</option>');
                    }
                 }
            });
        }

        $('select[name=estado]').change(function(){

            obterCidade(this.value);

        });

        $('select[name=municipio]').change(function(){
            obterInstituicao(this.value);
        })
    </script>
@endsection
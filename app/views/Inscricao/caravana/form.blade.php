@extends('layout.template')

@section('content')
{{ Form::open(array(null, null, 'onsubmit' => 'enviar(this); return false;')) }}
    <h3>Dados da Caravana</h3>
    <div class="form-group col-sm-6 {{ ($errors->first('nomeCaravana')) ? 'has-error' : '' }}">
        <label for="nomeCaravana">Nome da Caravana</label>
        {{ Form::text('nomeCaravana', '', ['class' => 'form-control']) }}
        {{ $errors->first('nomeCaravana', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group col-sm-6 {{ ($errors->first('responsavelCaravana')) ? 'has-error' : '' }}">
        <label for="responsavelCaravana">Nome do Responsável</label>
        {{ Form::text('responsavelCaravana', '', ['class' => 'form-control']) }}
        {{ $errors->first('responsavelCaravana', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group col-sm-4 {{ ($errors->first('telefoneResponsavel')) ? 'has-error' : '' }}">
        <label for="telefoneResponsavel">Telefone do Responsável</label>
        {{ Form::text('telefoneResponsavel', '', ['class' => 'form-control telefone']) }}
        {{ $errors->first('telefoneResponsavel', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group col-sm-4 {{ ($errors->first('estado')) ? 'has-error' : '' }}">
        <label for="estados">Estado</label>
        {{ Form::dropdownbox('estado', 'esta_id', 'esta_descricao', 'estado', ['class' => 'form-control']) }}
        {{ $errors->first('estado', '<div class="alert alert-danger">:message</div>') }}
    </div>
    <div class="form-group col-sm-4 {{ ($errors->first('municipio')) ? 'has-error' : '' }}">
        <label for="municipio">Municipio</label>
        {{ Form::dropdownbox('municipios', 'muni_id', 'muni_descricao', 'municipio', ['class' => 'form-control']) }}
        {{ $errors->first('municipio', '<div class="alert alert-danger">:message</div>') }}
    </div>

    <div class="col-sm-12">
        <hr/>
    </div>

    <h3>Integrantes da Caravana</h3>
    <div class="form-group col-sm-6">
        <label for="nomeCompleto">Nome Completo</label>
        {{ Form::text('nomeCompleto', '', ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-sm-6">
        <label for="nomeCracha">Nome no Crachá</label>
        {{ Form::text('nomeCracha', '', ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-sm-6">
        <label for="dataNascimento">Data de Nascimento</label>
        {{ Form::text('dataNascimento', '', ['class' => 'form-control dataNascimento']) }}
    </div>
    <div class="form-group col-sm-6">
        <label for="CPF" class="right">CPF</label>
        {{ Form::text('cpf', '', ['class' => 'form-control cpf']) }}
    </div>
    <div class="form-group col-sm-4">
         <label for="sexo">Sexo</label>
        {{ Form::dropdownbox('sexo', 'sexo_id', 'sexo_descricao', 'sexo', ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-sm-4">
        <label for="email">E-mail</label>
        {{ Form::text('email', '', ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-sm-4">
        <label for="telefoneCelular">Telefone Celular</label>
        {{ Form::text('telefoneCelular', '', ['class' => 'form-control telefone']) }}
    </div>
    <div class="form-group col-sm-12">
         <label for="instituicao">Instituição</label>
        {{ Form::dropdownbox('instituicao', 'inst_id', 'inst_nome', 'instituicao', ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-sm-12">
        <label for="necessidadeEspecial">Possui alguma necessidade especial?</label>
        {{ Form::text('necessidadeEspecial', '', ['class' => 'form-control']) }}
    </div>

    <p>
        <a class="btn btn-info text-right" id="incluir">Incluir</a>
    </p>

    <table id="tabela" style="display: none">
        <thead>
            <th>Nome</th>
            <th>Nome no Crachá</th>
            <th>Data de Nascimento</th>
            <th>CPF</th>
            <th>Sexo</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Instituição</th>
            <th>Necessidade Especial</th>
            <th>Ação</th>
        </thead>
        <tbody></tbody>
    </table>
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

        var elemento = [];
        var nome, nomeCracha, dataNascimento, cpf, sexo, email, telefone, instituicao, necessidadeEspecial;

        $('#incluir').click(function(){
            try{
                nome = $('input[name=nomeCompleto]');
                nomeCracha = $('input[name=nomeCracha]');
                dataNascimento = $('input[name=dataNascimento]');
                cpf = $('input[name=cpf]');
                sexo = $('select[name=sexo] option:selected');
                email = $('input[name=email]');
                telefone = $('input[name=telefoneCelular]');
                instituicao = $('select[name=instituicao] option:selected');
                necessidadeEspecial = $('input[name=necessidadeEspecial]');

                elemento.forEach(function(v){

                    if(v.cpf == cpf.val()){
                        throw new Error('CPF já inserido na listagem');
                    }
                });

                if((nome.val() != '') &&
                    (nomeCracha.val() != '') &&
                    (dataNascimento.val() != '') &&
                    (cpf.val() != '') &&
                    (sexo.val() != 0) &&
                    (email.val() != '') &&
                    (telefone.val() != '') &&
                    (instituicao.val() != 0) &&
                    (necessidadeEspecial.val() != '')){

                    elemento.push({
                        nome: nome.val(),
                        nomeCracha: nomeCracha.val(),
                        dataNascimento: dataNascimento.val(),
                        cpf: cpf.val(),
                        sexoVal: sexo.val(),
                        sexoText: sexo.text(),
                        email: email.val(),
                        telefone: telefone.val(),
                        instituicaoVal: instituicao.val(),
                        instituicaoText: instituicao.text(),
                        necessidadeEspecial: necessidadeEspecial.val()
                    });
                }else{
                    throw new Error('Por favor preencher todos os campos dos dados da Integrante');
                }


                criarTabela(elemento);

                limparCampos();
            }catch(e){
                alert(e.message);
            }
        });

        function criarTabela(elemento)
        {
            var tabela = $('#tabela tbody');

            var content;

            tabela.empty();

            if(elemento.length > 0){
                tabela.parent().show();
            }else{
                tabela.parent().hide();
            }

            elemento.forEach(function(v, q){

                content += "<tr>";
                content += "<td>" + v.nome + "<input type='hidden' name='nomeCompleto[]' value='" + v.nome + "'></td>";
                content += "<td>" + v.nomeCracha + "<input type='hidden' name='nomeCracha[]' value='" + v.nomeCracha + "'></td>";
                content += "<td>" + v.dataNascimento + "<input type='hidden' name='dataNascimento[]' value='" + v.dataNascimento + "'></td>";
                content += "<td>" + v.cpf + "<input type='hidden' name='cpf[]' value='" + v.cpf + "'></td>";
                content += "<td>" + v.sexoText + "<input type='hidden' name='sexo[]' value='" + v.sexoVal + "'></td>";
                content += "<td>" + v.email + "<input type='hidden' name='email[]' value='" + v.email + "'></td>";
                content += "<td>" + v.telefone + "<input type='hidden' name='telefone[]' value='" + v.telefone + "'></td>";
                content += "<td>" + v.instituicaoText + "<input type='hidden' name='instituicao[]' value='" + v.instituicaoVal + "'></td>";
                content += "<td>" + v.necessidadeEspecial + "<input type='hidden' name='necessidadeEspecial[]' value='" + v.necessidadeEspecial + "'></td>";
                content += "<td><a class='btn glyphicon glyphicon-remove btn-danger' onclick=excluir("+q+")></a></td>";
                content += "</tr>";
            });

            tabela.append(content);
        }

        function limparCampos()
        {
            nome.val('');
            nomeCracha.val('');
            dataNascimento.val('');
            cpf.val('');
            sexo.prop('selected', false);
            email.val('');
            telefone.val('');
            instituicao.prop('selected', false);
            necessidadeEspecial.val('');
        }

        function excluir(valor)
        {

            elemento.splice(valor, 1);

            criarTabela(elemento);
        }

        function enviar(form)
        {

            if(elemento.length < 5){
                alert('No mínimo precisa ter um total de 5 integrantes da Caravana');
                return false;
            }

            form.submit();
        }

    </script>
@endsection


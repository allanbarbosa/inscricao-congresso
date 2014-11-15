<html>
    <head>
        <title>Incrição Iº Congresso de Jovens Espíritas do Estado da Bahia</title>
        <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.css') }}"/>
    </head>
    <body>

        {{ Form::open() }}

            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="nomeCompleto" class="right">
                                Nome Completo
                            </label>
                        </div>
                        <div class="col-md-9">
                            {{ Form::text('nomeCompleto') }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="CPF" class="right">CPF</label>
                        </div>
                        <div class="col-md-9">
                            {{ Form::text('cpf') }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="dataNascimento">Data de Nascimento</label>
                        </div>
                        <div class="col-md-9">
                            {{ Form::text('dataNascimento') }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="email">E-mail</label>
                        </div>
                        <div class="col-md-9">
                            {{ Form::text('email') }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="telefoneResidencial">Telefone Residencial</label>
                        </div>
                        <div class="col-md-9">
                            {{ Form::text('telefoneResidencial') }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="telefoneCelular">Telefone Celular</label>
                        </div>
                        <div class="col-md-9">
                            {{ Form::text('telefoneCelular') }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="endereco">Endereço</label>
                        </div>
                        <div class="col-md-9">
                             {{ Form::textarea('endereco') }}
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="motvacao">Motivação</label>
                        </div>
                        <div class="col-md-9">
                            {{ Form::textarea('motivacao') }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="municipio">Municipios</label>
                        </div>
                        <div class="col-md-9">
                            {{ Form::select('municipio') }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="sexo">Sexo</label>
                        </div>
                        <div class="col-md-9">
                            {{ Form::select('sexo') }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="sexo">Instituição</label>
                        </div>
                        <div class="col-md-9">
                            {{ Form::select('instituicao') }}
                        </div>
                    </div>
                </div>
            </div>
        {{ Form::close() }}
    </body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Bootstrap 3 Control Panel</title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    {{--<link href="css/styles.css" rel="stylesheet">--}}
</head>
<body>
<!-- Header -->
<div id="top-nav" class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Área administradora</a>
        </div>
    </div><!-- /container -->
</div>
<div class="container">

    {{ Form::open() }}
        <div class="form-group col-sm-6 {{ ($errors->first('usuario')) ? 'has-error' : '' }}">
            <label for="usuario">Usuário</label>
            {{ Form::text('usuario', '', ['class' => 'form-control']) }}
            {{ $errors->first('usuario', '<div class="alert alert-danger">:message</div>') }}
        </div>
        <div class="form-group col-sm-6 {{ ($errors->first('senha')) ? 'has-error' : '' }}">
            <label for="senha">Senha</label>
            <input type="password" name="senha" class="form-control"/>
            {{ $errors->first('senha', '<div class="alert alert-danger">:message</div>') }}
        </div>
        <div class="form-group col-sm-12">
            <button class="btn btn-default btn-lg" type="submit">Logar</button>
        </div>
    {{ Form::close() }}
</div>
</body>
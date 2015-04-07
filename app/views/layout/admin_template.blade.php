<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Congresso da Juventude Espírita da Bahia</title>
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
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-toggle"></span>
            </button>
            <a class="navbar-brand" href="#">Painel de Controle - Inscrição 1º Congresso da Juventude Espírita da Bahia</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">

                <li role="button"><a href="{{ url('/logout') }}"><i class="glyphicon glyphicon-lock"></i> Sair</a></li>

            </ul>
        </div>
    </div><!-- /container -->
</div>
<!-- /Header -->

<!-- Main -->
<div class="container">

    <!-- upper section -->
    <div class="row">
        <div class="col-sm-3">
            <!-- left -->
            <h3><i class="glyphicon glyphicon-briefcase"></i> Menus</h3>
            <hr>

            <ul class="nav nav-stacked">
                <li><a href="{{ url('admin/participantes') }}"><i class="glyphicon glyphicon-flash"></i> Participantes</a></li>
                <li><a href="{{ url('admin/caravanas') }}"><i class="glyphicon glyphicon-link"></i> Caravanas</a></li>
                <li><a href="{{ url('admin/participantes-pagos') }}"><i class="glyphicon glyphicon-list-alt"></i> Participantes Pagos</a></li>
                <li><a href="javascript:;"><i class="glyphicon glyphicon-book"></i> Relatórios</a></li
            </ul>

            <hr>

        </div><!-- /span-3 -->

        @if(Session::get('sucesso') )
            <div data-alert class="alert alert-success">
                {{ Session::get('sucesso') }}
            </div>
        @endif

        @if(Session::get('erro') )
            <div data-alert class="alert alert-warning">
                {{ Session::get('erro') }}
            </div>
        @endif

        <div class="col-sm-9">
            @yield('content')
        </div>

    </div>
</div>
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
@yield('scripts')
</body>
</html>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Congresso da Juventude Espírita do Estado da Bahia</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="{{ asset('bower_components/thema/js/html5shiv.js')}}"></script>
		<![endif]-->
		<link href="{{ asset('bower_components/thema/css/styles.css')}}" rel="stylesheet">
	</head>
	<body>
<div class="wrapper">
    <div class="box">
        <div class="row">

            <!-- sidebar -->
            <div class="column col-sm-3" id="sidebar">
                <a class="logo" href="#">B</a>
                <ul class="nav">
                    <li class="active"><a href="/">Home</a>
                    </li>
                </ul>
                <ul class="nav hidden-xs" id="sidebar-footer">
                    <li>
                      <a href="http://lorempixel.com/1024/760/nature/3/"><h3>Inspiração do dia!</h3>Imagem por: <i class="glyphicon glyphicon-heart-empty"></i> Lorem Pixel</a>
                    </li>
                </ul>
            </div>
            <!-- /sidebar -->

            <!-- main -->
            <div class="column col-sm-9" id="main">
                <div class="full col-sm-9">
                        <div class="col-sm-12">
                          <div class="page-header text-muted">
                            <h3>Formulário de Inscrição<br></h3>
                            <small>Primeiro Congresso de Juventudes Espiritas do Estado da Bahia</small>
                              <br/>
                              <small>O Pagamento deverá ser feito através de:</small>
                              <br/>
                              <small>1 - Depósito Bancário na Conta da FEEB. Banco do Brasil, Agência: 2971-8 e Conta Corrente: 2010-9</small>
                              <br />
                              <small>2 - Na própria FEEB, Rua Coronel Jayme Rolemberg, 110 – Bela Vista de Brotas</small>
                              <br/>
                              <small>Ao finalizar o pagamento, favor encaminhar o comprovante para o email da CIJ: cij.feeb2011@gmail.com, com o nome do participante</small>
                          </div>
                        </div>

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

                        <!--/top story-->
                        <div class="row content">
                            @yield('content')
                        </div>

                        <div class="col-sm-12">
                          <div class="page-header text-muted divider">
                            Acesse nossas redes sociais
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-sm-6">
                            <a href="#">Twitter</a> <small class="text-muted">|</small> <a href="#">Facebook</a> <small class="text-muted">|</small> <a href="#">Google+</a>
                          </div>
                        </div>

                        <hr>

                        <div class="row" id="footer">
                          <div class="col-sm-6">

                          </div>
                          <div class="col-sm-6">
                            <p>
                            <a href="#" class="pull-right">©Copyright Inc.</a>
                            </p>
                          </div>
                        </div>

                    </div><!-- /col-9 -->
            </div>
            <!-- /main -->

        </div>
    </div>
</div>
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    @yield('scripts')
	</body>
</html>
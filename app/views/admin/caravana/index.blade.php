@extends('layout.admin_template')

@section('content')

    <h1>Dados do Caravana</h1>

    <hr/>

    <div class="row">
        <div class="col-md-6">
            <strong>Nome Caravana:</strong> {{ $dadosCaravana['nomeCaravana'] }}
        </div>
        <div class="col-md-6">
            <strong>Responsável Caravana:</strong> {{ $dadosCaravana['responsavelCaravana'] }}
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <strong>Telefone:</strong> {{ $dadosCaravana['telefoneResponsavel'] }}
        </div>
        <div class="col-md-6">
            <strong>Município:</strong> {{ $dadosCaravana['municipioCaravana'] }}
        </div>
    </div>

    <br/>
    <a class="btn btn-info right" href="{{ URL::previous() }}">Voltar</a>
@endsection
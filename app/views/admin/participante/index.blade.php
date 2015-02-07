@extends('layout.admin_template')

@section('content')

    <h1>Dados do Participante</h1>

    <hr/>

    <div class="row">
        <div class="col-md-4">
            <strong>Nome Completo:</strong> {{ $dadosParticipante['nomeCompleto'] }}
        </div>
        <div class="col-md-4">
            <strong>Nome Crachá:</strong> {{ $dadosParticipante['nomeCracha'] }}
        </div>
        <div class="col-md-4">
            <strong>Sexo:</strong> {{ $dadosParticipante['sexo'] }}
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <strong>CPF:</strong> {{ $dadosParticipante['cpf'] }}
        </div>
        <div class="col-md-4">
            <strong>Data de Nascimento:</strong> {{ $dadosParticipante['dataNascimento'] }}
        </div>
        <div class="col-md-4">
            <strong>Telefone:</strong> {{ $dadosParticipante['telefoneContato'] }}
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <strong>Endereço:</strong> {{ (!is_null($dadosParticipante['endereco'])) ? $dadosParticipante['endereco'] : 'Informação não incluida' }}
        </div>
        <div class="col-md-6">
            <strong>E-mail:</strong> {{ $dadosParticipante['email'] }}
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <strong>Instituição:</strong> {{ $dadosParticipante['instituicao'] }}
        </div>
        <div class="col-md-6">
            <strong>Município:</strong> {{ $dadosParticipante['municipio'] }}
        </div>
    </div>

    <div class="row">

        <div class="col-md-6">
            <strong>Status: </strong>
            @if($dadosParticipante['status'])
                <a class="btn btn-success" href="">Pago</a>
            @else
                <a href="" class="btn btn-danger">Não Pago</a>
            @endif
        </div>


    </div>

    <br/>
    <a class="btn btn-info right" href="{{ URL::previous() }}">Voltar</a>
@endsection
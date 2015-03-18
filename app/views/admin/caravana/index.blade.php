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

    <hr>

    <h3>Participantes</h3>

    <h1>Participantes</h1>
    <hr/>

    <div class="row">
        <table class="table">
            <thead>
            <th>#</th>
            <th>Nome Participante</th>
            <th>Instituicao</th>
            <th>Data de Nascimento</th>
            <th>E-mail</th>
            <th>Ação</th>
            </thead>
            <tbody>
            @foreach($dadosCaravana['participantes'] as $key => $p)
                <tr class="{{ ($p['pago']) ? 'success' : 'warning' }}">
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $p['nomeParticipante'] }}</td>
                    <td>{{ $p['instituicao'] }}</td>
                    <td>{{ date('d/m/Y', strtotime($p['dataNascimento'])) }}</td>
                    <td>{{ $p['emailParticipante'] }}</td>
                    <td>
                        <a title="Visualizar" class="btn btn-info" href="{{ url('admin/participantes/visualizar/' . $p['id']) }}"><i class="glyphicon glyphicon-zoom-in"></i></a>
                        @if(!$p['pago'])
                            <a title="Pagar" class="btn btn-success" href="{{ url('admin/participantes/pagar/' . $p['id']) }}"><i class="glyphicon glyphicon-ok"></i></a>
                        @endif
                        <a title="Excluir" class="btn btn-danger" href="{{ url('admin/participantes/deletar/' . $p['id']) }}"><i class="glyphicon glyphicon-remove"></i></a>
                    </td>
                </tr>
            @endforeach

            @if(count($dadosCaravana['participantes']) == 0)
                <tr><td colspan="6"><div class="alert alert-info" role="alert">Não existe Participantes cadastrados</div></td></tr>
            @endif
            </tbody>
        </table>
    </div>

    <br/>
    <a class="btn btn-info right" href="{{ URL::previous() }}">Voltar</a>
@endsection
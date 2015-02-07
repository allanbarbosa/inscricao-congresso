@extends('layout.admin_template')

@section('content')

    <h1>Participantes</h1>
    <hr/>

    <div class="row">
        <table class="table">
            <thead>
                <th>#</th>
                <th>Nome Participante</th>
                <th>CPF</th>
                <th>Data de Nascimento</th>
                <th>E-mail</th>
                <th>Ação</th>
            </thead>
            <tbody>
                @foreach($dadosParticipantes as $key => $p)
                    <tr class="{{ ($p->status) ? 'success' : 'warning' }}">
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $p->nomeParticipante }}</td>
                        <td>{{ $p->cpfParticipante }}</td>
                        <td>{{ date('d/m/Y', strtotime($p->dataNascimento)) }}</td>
                        <td>{{ $p->emailParticipante }}</td>
                        <td>
                            <a title="Visualizar" class="btn btn-info" href="{{ url('admin/participantes/visualizar/' . $p->id) }}"><i class="glyphicon glyphicon-zoom-in"></i></a>
                            @if(!$p->status)
                                <a title="Pagar" class="btn btn-success" href="{{ url('admin/participantes/pagar/' . $p->id) }}"><i class="glyphicon glyphicon-ok"></i></a>
                            @endif
                            <a title="Excluir" class="btn btn-danger" href="{{ url('admin/participantes/deletar/' . $p->id) }}"><i class="glyphicon glyphicon-remove"></i></a>
                        </td>
                    </tr>
                @endforeach

                @if(count($dadosParticipantes) == 0)
                    <tr><td colspan="6"><div class="alert alert-info" role="alert">Não existe Participantes cadastrados</div></td></tr>
                @endif
            </tbody>
        </table>
    </div>

    {{ $dadosParticipantes->links() }}
@endsection
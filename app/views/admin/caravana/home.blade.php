@extends('layout.admin_template')

@section('content')

    <h1>Caravanas</h1>
    <hr/>

    <div class="row">
        <a class="btn btn-info pull-right" href="{{ url('admin/caravanas/form') }}">Nova Caravana</a>
    </div>
    <div class="row">
        <table class="table">
            <thead>
                <th>#</th>
                <th>Nome da Caravana</th>
                <th>Coordenador</th>
                <th>Telefone</th>
                <th>Municipio</th>
                <th>Ação</th>
            </thead>
            <tbody>
                @foreach($dadosCaravanas as $key => $c)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $c->nomeCaravana }}</td>
                        <td>{{ $c->responsavelCaravana }}</td>
                        <td>{{ $c->telefoneResponsavel }}</td>
                        <td>{{ $c->municipio }}</td>
                        <td>
                            <a title="Visualizar" class="btn btn-info" href="{{ url('admin/caravanas/visualizar/' . $c->id) }}"><i class="glyphicon glyphicon-zoom-in"></i></a>
                            <a title="Excluir" class="btn btn-danger" href="{{ url('admin/caravanas/deletar/' . $c->id) }}"><i class="glyphicon glyphicon-remove"></i></a>
                        </td>
                    </tr>
                @endforeach

                @if(count($dadosCaravanas) == 0)
                    <tr><td colspan="6"><div class="alert alert-info" role="alert">Não existe Caravanas cadastradas</div></td></tr>
                @endif
            </tbody>
        </table>
    </div>

    {{ $dadosCaravanas->links() }}
@endsection
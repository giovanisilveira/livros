@extends('layouts.layout')

@section('title', 'Assuntos')

@section('content')
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="btn btn-success btn-md" href="/assuntos/formulario" role="button">Cadastro</a>
        </li>
    </ul>

    <h1 class="display-7">Assuntos</h1>
    <hr class="my-4">

    <div class="container mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="100px">Código</th>
                    <th>Descrição</th>
                    <th width="180px">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assuntos as $assunto)
                    <tr>
                        <td>{{$assunto['codigo']}}</td>
                        <td>{{ $assunto['descricao'] }}</td>
                        <td>
                            <a href="/assuntos/formulario/{{$assunto['codigo']}}" class="btn btn-primary btn-sm">Alterar</a>
                            <form action="{{ route('assuntodelete', $assunto['codigo']) }}" method="POST" style="display:inline;" id="delete-form-{{ $assunto['codigo'] }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $assunto['codigo'] }})">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function confirmDelete(id) {
            if (confirm("Tem certeza que deseja excluir este asunto?")) {
                return document.getElementById('delete-form-' + id).submit();
            }

            return false;
        }
    </script>
@endsection
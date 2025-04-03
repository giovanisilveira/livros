@extends('layouts.layout')

@section('title', 'Assuntos')

@section('content')
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
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
                            <a href="/assuntos/{{$assunto['codigo']}}/delete" class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
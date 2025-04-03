@extends('layouts.layout')

@section('title', 'Autores')

@section('content')
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="btn btn-success btn-md" href="/autores/formulario" role="button">Cadastro</a>
        </li>
    </ul>

    <h1 class="display-7">Autores</h1>
    <hr class="my-4">

    <div class="container mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="100px">Código</th>
                    <th>Nome</th>
                    <th width="180px">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($autores as $autor)
                    <tr>
                        <td>{{$autor['codigo']}}</td>
                        <td>{{ $autor['nome'] }}</td>
                        <td>
                            <a href="/autores/formulario/{{$autor['codigo']}}" class="btn btn-primary btn-sm">Alterar</a>
                            <a href="/autores/{{$autor['codigo']}}/delete" class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@extends('layouts.layout')

@section('title', 'Livros')

@section('content')
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="btn btn-success btn-md" href="/livros/formulario" role="button">Cadastro</a>
        </li>
    </ul>

    <div class="jumbotron">
        <h1 class="display-4">Livros</h1>
        <p class="lead">Esta é uma página inicial simples usando o Bootstrap no Laravel Blade.</p>
        <hr class="my-4">
        <p>Use o Bootstrap para criar interfaces bonitas rapidamente.</p>
    </div>

    <ul>
    @foreach($livros as $livro)

            <li>{{ $livro['titulo'] }} - {{ $livro['editora'] }} - {{ $livro['valor'] }}</li>
    @endforeach
    </ul>
@endsection
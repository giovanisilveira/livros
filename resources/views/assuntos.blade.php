@extends('layouts.layout')

@section('title', 'Assuntos')

@section('content')
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="btn btn-success btn-md" href="/assuntos/formulario" role="button">Cadastro</a>
        </li>
    </ul>

    <div class="jumbotron">
        <h1 class="display-4">Assuntos</h1>
        <p class="lead">Esta é uma página inicial simples usando o Bootstrap no Laravel Blade.</p>
        <hr class="my-4">
        <p>Use o Bootstrap para criar interfaces bonitas rapidamente.</p>
    </div>
@endsection
@extends('layouts.layout')

@section('title', 'Autores')

@section('content')
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="btn btn-primary btn-md" href="/autores" role="button">Voltar</a>
        </li>
    </ul>

    <hr class="my-4">

    <div class="container mt-5">
        <h2>Cadastrar Autor</h2>
        <form action="/autores" method="POST">
            @csrf <!-- Proteção contra CSRF -->

            <input type="hidden" name="codigo_autor" value="">

            <div class="mb-3">
                <label for="descricao" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required/>
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
@endsection
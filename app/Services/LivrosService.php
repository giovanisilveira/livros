<?php

namespace App\Services;

use App\DTO\LivroDTO;
use App\Models\Livro;

class LivrosService
{
    static public function init(): LivrosService
    {
        return new LivrosService();
    }

    public function create(LivroDTO $livroDTO)
    {
        return Livro::create($livroDTO->toArray());
    }

    public function list(int $page = 1, int $qtdItens = 10)
    {
        $livros = Livro::paginate(
            $qtdItens,
            ['*'],
            'page',
            $page
        );

        $result = $livros->map(function ($livro) {
            return [
                "titulo" => $livro->titulo,
                "editora" => $livro->editora,
                "valor" => $livro->valor,
            ];
        });

        return $result;
    }
}
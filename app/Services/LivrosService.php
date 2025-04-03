<?php

namespace App\Services;

use App\DTO\LivroDTO;
use App\Models\Livro;
use RuntimeException;

class LivrosService
{
    static public function init(): LivrosService
    {
        return new LivrosService();
    }

    public function save(LivroDTO $livroDTO)
    {
        if (empty($livroDTO->codigo)) {
            return Livro::create($livroDTO->toArray());
        }

        $livro = Livro::find($livroDTO->codigo);
        return $livro->update($livroDTO->toArray());
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
                "codigo" => $livro->codl,
                "titulo" => $livro->titulo,
                "editora" => $livro->editora,
                "valor" => $livro->valor,
            ];
        });

        return $result;
    }

    public function getById($id)
    {
        return Livro::find($id);
    }

    public function delete($id)
    {
        $livro = $this->getById($id);
        if (!$livro) {
            throw new RuntimeException("Não possível remover o livro #$id");
        }

        return $livro->delete();
    }
}
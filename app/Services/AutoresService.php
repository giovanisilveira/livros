<?php

namespace App\Services;

use App\DTO\AutorDTO;
use App\Models\Autor;
use App\Models\LivroAutor;
use RuntimeException;

class AutoresService
{
    static public function init(): AutoresService
    {
        return new AutoresService();
    }

    public function save(AutorDTO $autorDTO)
    {
        if (empty($autorDTO->codigo)) {
            return Autor::create($autorDTO->toArray());
        }

        $autor = Autor::find($autorDTO->codigo);
        return $autor->update($autorDTO->toArray());
    }

    public function list(int $page = 1, int $qtdItens = 10)
    {
        $autores = Autor::paginate(
            $qtdItens,
            ['*'],
            'page',
            $page
        );

        $result = $autores->map(function ($autor) {
            return [
                "codigo" => $autor->codau,
                "nome" => $autor->nome,
            ];
        });

        return $result;
    }

    public function getById($id)
    {
        return Autor::find($id);
    }

    public function delete($id)
    {
        $autor = $this->getById($id);
        if (!$autor) {
            throw new RuntimeException("Não possível remover o autor #$id");
        }

        if (LivroAutor::where('autor_codau', $id)->get()) {
            throw new RuntimeException("Não é possível remover o autor #$id, há um livro vinculado a ele.");
        }

        return $autor->delete();
    }

    public function listAll()
    {
        $autores = Autor::orderBy('nome', 'asc')->get();

        $result = $autores->map(function ($autor) {
            return [
                "codigo" => $autor->codau,
                "nome" => $autor->nome,
            ];
        });

        return $result;
    }
}

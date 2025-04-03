<?php

namespace App\Services;

use App\DTO\AutorDTO;
use App\DTO\AutorOutputDTO;
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

    public function list(int $page = 1, int $qtdItens = 50)
    {
        $autores = Autor::paginate(
            $qtdItens,
            ['*'],
            'page',
            $page
        );

        return AutorOutputDTO::fromArray($autores);
    }

    public function getById($id)
    {
        return AutorOutputDTO::fromObject($this->findById($id));
    }

    protected function findById($id)
    {
        if (empty($id)) {
            return;
        }

        $autor = Autor::find($id);

        if (!$autor) {
            throw new RuntimeException("O autor de código #$id não foi encontrado.");
        }

        return $autor;
    }

    public function delete($id)
    {
        $autor = $this->findById($id);

        if (!$autor) {
            throw new RuntimeException("Não possível remover o autor #$id");
        }

        if (!LivroAutor::where('autor_codau', $id)->get()->isEmpty()) {
            throw new RuntimeException("Não é possível remover o autor #$id, há um livro vinculado a ele.");
        }

        return $autor->delete();
    }

    public function listAll()
    {
        $autores = Autor::orderBy('nome', 'asc')->get();

        return AutorOutputDTO::fromArray($autores);
    }
}

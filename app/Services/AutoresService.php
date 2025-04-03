<?php

namespace App\Services;

use App\DTO\AutorDTO;
use App\Models\Autor;
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
        $assunto = $this->getById($id);
        if (!$assunto) {
            throw new RuntimeException("Não possível remover o autor #$id");
        }

        return $assunto->delete();
    }
}
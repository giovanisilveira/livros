<?php

namespace App\Services;

use App\DTO\AutorDTO;
use App\DTO\AutorOutputDTO;
use App\Models\Autor;
use App\Models\LivroAutor;
use RuntimeException;

class AutoresService
{
    /**
     * Inicializador do service
     */
    static public function init(): AutoresService
    {
        return new AutoresService();
    }

    /**
     * Método responsável por salvar os dados de um Autor
     */
    public function save(AutorDTO $autorDTO)
    {
        if (empty($autorDTO->codigo)) {
            return Autor::create($autorDTO->toArray());
        }

        $autor = Autor::find($autorDTO->codigo);
        return $autor->update($autorDTO->toArray());
    }

    /**
     * Método responsável por recuperar os dados dos autores
     */
    public function list(string $search, int $page = 1, int $qtdItens = 50)
    {
        $autoresQuery = Autor::query();
        $autoresQuery->orderBy('nome', 'asc');

        if (!empty($search)) {
            $autoresQuery->where('nome', 'like', "%$search%");
        }

        $autores = $autoresQuery->paginate(
            $qtdItens,
            ['*'],
            'page',
            $page
        );

        if ($autores->isEmpty()) {
            throw new RuntimeException("Não há itens na página #$page.");
        }

        return AutorOutputDTO::fromArray($autores);
    }

    /**
     * Método responsável por recuperar os dados de um autor pelo código informado
     */
    public function getById(int $id)
    {
        return AutorOutputDTO::fromObject($this->findById($id));
    }

    /**
     * Método interno para recuperar os dados de um autor por código sem formatação dos dados
     */
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

    /**
     * Método responsável por remover o registro de um autor
     */
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

    /**
     * Método responsável por listar todos os autores
     */
    public function listAll()
    {
        $autores = Autor::orderBy('nome', 'asc')->get();

        return AutorOutputDTO::fromArray($autores);
    }
}

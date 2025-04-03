<?php

namespace App\Services;

use App\DTO\LivroDTO;
use App\Models\Livro;
use Exception;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class LivrosService
{
    static public function init(): LivrosService
    {
        return new LivrosService();
    }

    public function save(LivroDTO $livroDTO)
    {
        DB::beginTransaction();
        try{
            if (empty($livroDTO->codigo)) {
                $livro = Livro::create($livroDTO->toArray());
            }

            if (!empty($livroDTO->codigo)) {
                $livro = Livro::find($livroDTO->codigo);
                $livro->update($livroDTO->toArray());
            }

            $livro->autores()->sync($livroDTO->autor);
            $livro->assuntos()->sync($livroDTO->assunto);

            DB::commit();
            return $livro;
        }catch(Exception $e){
            DB::rollBack();
            throw new RuntimeException($e);
        }
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

    public function getById($id, $with = [])
    {
        if (empty($with)) {
            return Livro::find($id);
        }

        return Livro::with($with)->find($id);
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
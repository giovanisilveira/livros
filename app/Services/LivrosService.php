<?php

namespace App\Services;

use App\DTO\LivroDTO;
use App\DTO\LivroOutputDTO;
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
        try {
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
        } catch (Exception $e) {
            DB::rollBack();
            throw new RuntimeException($e);
        }
    }

    public function list(int $page = 1, int $qtdItens = 10)
    {
        $livros = Livro::with(['assuntos'])->paginate(
            $qtdItens,
            ['*'],
            'page',
            $page
        );

        $result = LivroOutputDTO::fromArray($livros);

        return $result;
    }

    public function getById($id, $with = [])
    {
        if (empty($with)) {
            return LivroOutputDTO::fromObject($this->findById($id));
        }

        return LivroOutputDTO::fromObject($this->findById($id, $with));
    }

    private function findById($id, $with = [])
    {
        if (empty($id)) {
            return;
        }

        if (empty($with)) {
            $livro = Livro::find($id);
        }

        if (!empty($with)) {
            $livro = Livro::with($with)->find($id);
        }

        if (!$livro) {
            throw new RuntimeException("O livro de código #$id não foi encontrado.");
        }

        return $livro;
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $livro = $this->findById($id);
            if (!$livro) {
                throw new RuntimeException("Não possível remover o livro #$id");
            }

            $livro->autores()->detach();
            $livro->assuntos()->detach();
            $livro->delete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new RuntimeException($e);
        }
    }
}

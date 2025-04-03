<?php

namespace App\Services;

use App\DTO\AssuntoDTO;
use App\Models\Assunto;
use RuntimeException;

class AssuntosService
{
    static public function init(): AssuntosService
    {
        return new AssuntosService();
    }

    public function save(AssuntoDTO $assuntoDTO)
    {
        if (empty($assuntoDTO->codigo)) {
            return Assunto::create($assuntoDTO->toArray());
        }

        $assunto = Assunto::find($assuntoDTO->codigo);
        return $assunto->update($assuntoDTO->toArray());
    }

    public function list(int $page = 1, int $qtdItens = 10)
    {
        $assuntos = Assunto::paginate(
            $qtdItens,
            ['*'],
            'page',
            $page
        );

        $result = $assuntos->map(function ($assunto) {
            return [
                "codigo" => $assunto->codas,
                "descricao" => $assunto->descricao,
            ];
        });

        return $result;
    }

    public function getById($id)
    {
        return Assunto::find($id);
    }

    public function delete($id)
    {
        $assunto = $this->getById($id);
        if (!$assunto) {
            throw new RuntimeException("Não possível remover o assunto #$id");
        }

        return $assunto->delete();
    }

    public function listAll()
    {
        $assuntos = Assunto::all();

        $result = $assuntos->map(function ($assunto) {
            return [
                "codigo" => $assunto->codas,
                "descricao" => $assunto->descricao,
            ];
        });

        return $result;
    }
}
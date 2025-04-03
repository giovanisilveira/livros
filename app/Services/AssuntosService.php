<?php

namespace App\Services;

use App\DTO\AssuntoDTO;
use App\Models\Assunto;

class AssuntosService
{
    static public function init(): AssuntosService
    {
        return new AssuntosService();
    }

    public function create(AssuntoDTO $assuntoDTO)
    {
        return Assunto::create($assuntoDTO->toArray());
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
}
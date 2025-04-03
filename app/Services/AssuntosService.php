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
}
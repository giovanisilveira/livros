<?php

namespace App\Services;

use App\DTO\AutorDTO;
use App\Models\Autor;

class AutoresService
{
    static public function init(): AutoresService
    {
        return new AutoresService();
    }

    public function create(AutorDTO $autorDTO)
    {
        return Autor::create($autorDTO->toArray());
    }
}
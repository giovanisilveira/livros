<?php
namespace App\DTO;

use InvalidArgumentException;

abstract class DTO
{
    protected function normalizeValor($valor) : int
    {
        if (is_string($valor)) {
            if (strpos($valor, ',') !== false) {
                $valor = preg_replace(['/\./', '/,/',], ['', '.'], $valor);
            } else {
                $valor = preg_replace('/,/', '.', $valor);
            }
        }

        if (!is_numeric($valor)) {
            throw new InvalidArgumentException("O valor deve ser um número válido.");
        }

        return (int) ($valor * 100);
    }

    public function toArray(): array
    {
        return [];
    }
}
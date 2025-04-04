<?php

namespace App\Services;

use App\DTO\AssuntoDTO;
use App\DTO\AssuntoOutputDTO;
use App\Models\Assunto;
use App\Models\LivroAssunto;
use RuntimeException;

class AssuntosService
{
    /**
     * Inicializador do service
     */
    static public function init(): AssuntosService
    {
        return new AssuntosService();
    }

    /**
     * Método responsável por registrar um Assunto de livro
     */
    public function save(AssuntoDTO $assuntoDTO)
    {
        if (empty($assuntoDTO->codigo)) {
            return Assunto::create($assuntoDTO->toArray());
        }

        $assunto = Assunto::find($assuntoDTO->codigo);
        return $assunto->update($assuntoDTO->toArray());
    }

    /**
     * Método responsável por recuperar todos os assuntos
     */
    public function list(int $page = 1, int $qtdItens = 50)
    {
        $assuntos = Assunto::paginate(
            $qtdItens,
            ['*'],
            'page',
            $page
        );

        return AssuntoOutputDTO::fromArray($assuntos);
    }

    /**
     * Método responsável por recuperar um assunto pelo código
     */
    public function getById(int $id)
    {
        return AssuntoOutputDTO::fromObject($this->findById($id));
    }

    /**
     * Método responsável por recuperar um assunto sem formatação
     */
    private function findById($id)
    {
        if (empty($id)) {
            return;
        }

        $assunto = Assunto::find($id);

        if (!$assunto) {
            throw new RuntimeException("O assunto de código #$id não foi encontrado.");
        }

        return $assunto;
    }

    /**
     * Método responsável por remover um assunto
     */
    public function delete($id)
    {
        $assunto = $this->findById($id);
        if (!$assunto) {
            throw new RuntimeException("Não possível remover o assunto #$id");
        }

        if (!LivroAssunto::where('assunto_codas', $id)->get()->isEmpty()) {
            throw new RuntimeException("Não é possível remover o assunto #$id, há um livro vinculado a ele.");
        }

        return $assunto->delete();
    }

    /**
     * Método responsável por recuperar todos os assuntos
     */
    public function listAll()
    {
        $assuntos = Assunto::orderBy('descricao', 'asc')->get();

        $result = $assuntos->map(function ($assunto) {
            return [
                "codigo" => $assunto->codas,
                "descricao" => $assunto->descricao,
            ];
        });

        return $result;
    }
}

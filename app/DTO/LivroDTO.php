<?php

namespace App\DTO;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class LivroDTO extends DTO
{
    public $titulo;
    public $editora;
    public $edicao;
    public $anopublicacao;
    public $valor;

    public function __construct(array $data)
    {
        return $this->validate($data);
    }

    private function validate(array $data) : LivroDTO
    {
        if (isset($data['valor'])) {
            $data['valor'] = $this->normalizeValor($data['valor']);
        }

        $rules = [
            'titulo' => 'required|string|max:40',
            'editora' => 'required|string|max:40',
            'edicao' => 'required|integer|min:1',
            'anopublicacao' => 'required|digits:4',
            'valor' => 'required|integer',
        ];

        $messages = [
            'titulo.required' => 'O título é obrigatório.',
            'titulo.string' => 'O título deve ser uma string.',
            'titulo.max' => 'O título não pode ter mais de 40 caracteres.',

            'editora.required' => 'A editora é obrigatória.',
            'editora.string' => 'A editora deve ser uma string.',
            'editora.max' => 'A editora não pode ter mais de 40 caracteres.',

            'edicao.required' => 'A edição é obrigatória.',
            'edicao.integer' => 'A edição deve ser um número inteiro.',
            'edicao.min' => 'A edição deve ser maior que 0.',

            'anopublicacao.required' => 'O ano de publicação é obrigatório.',
            'anopublicacao.digits' => 'O ano de publicação deve ser um ano válido (ex: ' . Carbon::now()->year . ').',

            'valor.required' => 'O valor é obrigatório.',
            'valor.integer' => 'O valor deve ser um número.',
        ];

        $validator = Validator::make( $data, $rules, $messages);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $this->titulo = $data['titulo'];
        $this->editora = $data['editora'];
        $this->edicao = $data['edicao'];
        $this->anopublicacao = $data['anopublicacao'];
        $this->valor = $data['valor'];

        return $this;
    }

    public function toArray(): array
    {
        return [
            'titulo' => $this->titulo,
            'editora' => $this->editora,
            'edicao' => $this->edicao,
            'anopublicacao' => $this->anopublicacao,
            'valor' => $this->valor,
        ];
    }
}
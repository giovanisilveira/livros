<?php

namespace App\Http\Controllers;

use App\DTO\LivroDTO;
use App\Services\LivrosService;
use Exception;
use Illuminate\Http\Request;

class LivrosController extends Controller
{
    public function index()
    {
        $livros = LivrosService::init()->list(1);

        return view('livros', [ 'livros' => $livros ]);
    }

    public function formulario($id = null)
    {
        return view('livrosform');
    }

    public function salvar(Request $request)
    {
        return redirect()->route('livros')->with('success', 'Livro salvo com sucesso!');
    }

    public function teste()
    {
        $data = [
            'titulo' => 'Meu Livro',
            'editora' => 'Editora X',
            'edicao' => 2,
            'anopublicacao' => '2023',
            'valor' => '99.99',
        ];

        try {
            // Cria o DTO e valida os dados
            $livroDTO = (new LivroDTO($data));

            // $result = LivrosService::init()->create($livroDTO);

            // Agora o DTO contém os dados validados
            return response()->json([
                'message' => 'Livro criado com sucesso!',
                'data' => $livroDTO
            ], 201);

        } catch (Exception $e) {
            // Retorna uma resposta de erro em caso de dados inválidos
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }
}

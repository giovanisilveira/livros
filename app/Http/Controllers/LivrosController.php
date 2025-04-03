<?php

namespace App\Http\Controllers;

use App\DTO\LivroDTO;
use App\Services\AssuntosService;
use App\Services\AutoresService;
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
        $autores = AutoresService::init()->listAll();
        $assuntos = AssuntosService::init()->listAll();
        // $livro = [ 'assunto_id' => 2, 'autor_id' => 2];
        $livro = LivrosService::init()->getById($id);
        $livro['autores'] = [1 => ['nome' => 'teste'], 2 => ['nome' => 'teste 2']];
        $livro['assuntos'] = [1 => ['descricao' => 'teste'], 2 => ['descricao' => 'teste 2']];

        return view('livrosform', [
            'livro' => $livro,
            'autores' => $autores,
            'assuntos' => $assuntos
        ]);
    }

    public function salvar(Request $request)
    {
        dd($request->all());
        try {
            $livroDTO = (new LivroDTO($request->all()));

            LivrosService::init()->save($livroDTO);

            return redirect()
                    ->route('livros')
                    ->with('success', 'Livro salvo com sucesso!');
        } catch (Exception $e) {
            return redirect()
                    ->route('livrosform')
                    ->with('error', $e->getMessage())
                    ->with('errorData', $request->all());
        }
    }

    public function delete(int $id)
    {
        try {
            LivrosService::init()->delete($id);

            return redirect()
                    ->route('livros')
                    ->with('success', 'Livro removido!');
        } catch (Exception $e) {
            return redirect()
                    ->route('livros')
                    ->with('error', $e->getMessage());
        }
    }
}

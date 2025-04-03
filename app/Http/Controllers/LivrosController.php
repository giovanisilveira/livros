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

        return view('livros', ['livros' => $livros]);
    }

    public function formulario($id = null, Request $request)
    {
        try{
            $autores = AutoresService::init()->listAll();
            $assuntos = AssuntosService::init()->listAll();
            $livro = LivrosService::init()->getById($id, ['autores:codau,nome', 'assuntos:codas,descricao']);

            return view('livrosform', [
                'livro' => $livro,
                'autores' => $autores,
                'assuntos' => $assuntos
            ]);
        }catch(Exception $e){
            return redirect()
                ->route('livros')
                ->with('error', $e->getMessage())
                ->with('errorData', $request->all());
        }
    }

    public function salvar(Request $request)
    {
        try {
            $livroDTO = (new LivroDTO($request->all()));

            LivrosService::init()->save($livroDTO);

            return redirect()
                ->route('livros')
                ->with('success', 'Livro salvo com sucesso!');
        } catch (Exception $e) {
            // dd($request->all());
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

    public function relatorio()
    {
        $dadosRelatorio = LivrosService::init()->relatorio();

        return view('relatorio', compact('dadosRelatorio'));
    }
}

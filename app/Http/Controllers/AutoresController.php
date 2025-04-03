<?php

namespace App\Http\Controllers;

use App\DTO\AutorDTO;
use App\DTO\LivroDTO;
use App\Services\AutoresService;
use App\Services\LivrosService;
use Exception;
use Illuminate\Http\Request;

class AutoresController extends Controller
{
    public function index()
    {
        $autores = AutoresService::init()->list(1);

        return view('autores', ['autores' => $autores]);
    }

    public function formulario($id = null)
    {
        $autor = AutoresService::init()->getById($id);

        return view('autoresform', ['autor' => $autor]);
    }

    public function salvar(Request $request)
    {
        try {
            $autorDTO = (new AutorDTO($request->all()));

            AutoresService::init()->save($autorDTO);

            return redirect()
                ->route('autores')
                ->with('success', 'Autor salvo com sucesso!');
        } catch (Exception $e) {
            return redirect()
                ->route('autoresform')
                ->with('error', $e->getMessage())
                ->with('errorData', $request->all());
        }
    }

    public function delete(int $id)
    {
        try {
            AutoresService::init()->delete($id);

            return redirect()
                ->route('autores')
                ->with('success', 'Autor removido!');
        } catch (Exception $e) {
            return redirect()
                ->route('autores')
                ->with('error', $e->getMessage());
        }
    }
}

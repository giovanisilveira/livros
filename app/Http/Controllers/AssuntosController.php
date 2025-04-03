<?php

namespace App\Http\Controllers;

use App\DTO\AssuntoDTO;
use App\Services\AssuntosService;
use Exception;
use Illuminate\Http\Request;

class AssuntosController extends Controller
{
    public function index()
    {
        $assuntos = AssuntosService::init()->list(1);

        return view('assuntos', ['assuntos' => $assuntos]);
    }

    public function formulario($id = null)
    {
        $assunto = AssuntosService::init()->getById($id);

        return view('assuntosform', ['assunto' => $assunto]);
    }

    public function salvar(Request $request)
    {
        try {
            $data = $request->all();

            $assuntoDTO = (new AssuntoDTO($data));
            AssuntosService::init()->save($assuntoDTO);

            return redirect()
                ->route('assuntos')
                ->with('success', 'Assunto salvo com sucesso!');
        } catch (Exception $e) {
            return redirect()
                ->route('assuntosform')
                ->with('error', $e->getMessage())
                ->with('errorData', $data);
        }
    }

    public function delete(int $id)
    {
        try {
            AssuntosService::init()->delete($id);

            return redirect()
                ->route('assuntos')
                ->with('success', 'Assunto removido!');
        } catch (Exception $e) {
            return redirect()
                ->route('assuntos')
                ->with('error', $e->getMessage());
        }
    }
}

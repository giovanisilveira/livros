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

        return view('assuntos', [ 'assuntos' => $assuntos ]);
    }

    public function formulario($id = null)
    {
        return view('assuntosform');
    }

    public function salvar(Request $request)
    {
        try {
            $assuntoDTO = (new AssuntoDTO($request->all()));

            AssuntosService::init()->create($assuntoDTO);

            return redirect()
                    ->route('assuntos')
                    ->with('success', 'Assunto salvo com sucesso!');
        } catch (Exception $e) {
            return redirect()
                    ->route('assuntosform')
                    ->with('error', $e->getMessage())
                    ->with('errorData', $request->all());
        }

    }
}
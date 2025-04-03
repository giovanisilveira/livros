<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssuntosController extends Controller
{
    public function index()
    {
        return view('assuntos');
    }

    public function formulario($id = null)
    {
        return view('assuntosform');
    }

    public function salvar(Request $request)
    {
        return redirect()->route('assuntos')->with('success', 'Assunto salvo com sucesso!');
    }
}
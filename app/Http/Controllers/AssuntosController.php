<?php

namespace App\Http\Controllers;

use App\DTO\LivroDTO;
use App\Services\LivrosService;
use Exception;
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
}
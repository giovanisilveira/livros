<?php

namespace App\Http\Controllers;

use App\DTO\LivroDTO;
use App\Services\LivrosService;
use Exception;
use Illuminate\Http\Request;

class AutoresController extends Controller
{
    public function index()
    {
        return view('autores');
    }

    public function formulario($id = null)
    {
        return view('autoresform');
    }
}
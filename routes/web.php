<?php

use App\Http\Controllers\AssuntosController;
use App\Http\Controllers\AutoresController;
use App\Http\Controllers\LivrosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/livros');
});

Route::get('/assuntos/formulario/{id?}', [AssuntosController::class, 'formulario']);
Route::get('/assuntos', [AssuntosController::class, 'index'])->name('assuntos');
Route::post('/assuntos', [AssuntosController::class, 'salvar']);

Route::get('/autores/formulario/{id?}', [AutoresController::class, 'formulario']);
Route::get('/autores', [AutoresController::class, 'index'])->name('autores');
Route::post('/autores', [AutoresController::class, 'salvar']);

Route::get('/livros/formulario/{id?}', [LivrosController::class, 'formulario']);
Route::get('/livros', [LivrosController::class, 'index'])->name('livros');
Route::post('/livros', [LivrosController::class, 'salvar']);

Route::get('/teste', [LivrosController::class, 'teste']);
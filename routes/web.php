<?php

use Illuminate\Support\Facades\Auth;
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
/**
 * @author Fabrício Dias de Oliveira <fabricio858585@gmail.com>
 * @link http://www.phpdoc.org/docs/latest/index.html
 * @package helper
 */
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/**
     * @api {get} /notas Exibir todas as notas
     * @ Exibe todas as notas detalhadas na ordem fornecida pela outra API.
     */
Route::get('/notas', [App\Http\Controllers\NotasController::class, 'index'])->name('notas');
Route::get('/notas/agrupar', [App\Http\Controllers\NotasController::class, 'agrupar'])->name('notas.agrupar');
Route::get('/notas/totaisentregas', [App\Http\Controllers\NotasController::class, 'totaisEntregas'])->name('notas.totais');
Route::get('/notas/totaisconcluidos', [App\Http\Controllers\NotasController::class, 'totaisConcluidos'])->name('notas.totais.concluido');
Route::get('/notas/totaisnaoconcluidos', [App\Http\Controllers\NotasController::class, 'totaisNaoConcluidos'])->name('notas.totais.nao.concluido');
Route::get('/notas/vaireceber/{id}', [App\Http\Controllers\NotasController::class, 'vaiReceber'])->name('notas.vai.receber');
Route::get('/notas/deixoudereceber/{id}', [App\Http\Controllers\NotasController::class, 'deixouDeReceber'])->name('notas.deixou.de.receber');

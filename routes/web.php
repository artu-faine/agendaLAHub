<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContatosController;
use App\Http\Middleware\OnlyAdmin;

Route::get('/', [ContatosController::class, 'index'])->name('h');
Route::get('welcome', [ContatosController::class, 'index']);
Route::get('/create', [ContatosController::class, 'create'])->middleware('auth')->name('create');
Route::post('/create', [ContatosController::class, 'store']);
Route::get('/edit/{id}', [ContatosController::class, 'edit']);
Route::put('/edit/{id}', [ContatosController::class, 'update'])->middleware('can:verAcoes');
Route::delete('/delete/{id}', [ContatosController::class, 'delete'])->middleware('can:edit,contato');
Route::post('/aut', [ContatosController::class, 'aut']);
Route::get('/autLink', [ContatosController::class, 'autLink']);
Route::get('/meuDashboard', [ContatosController::class, 'dashboard'])->middleware('auth');
Route::get('/contatosInd', [ContatosController::class, 'Ind'])->middleware('auth');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect('/');
    })->name('dashboard');
});


Route::get('/teste', function(){
    echo "Apenas administradores!";
})->middleware([OnlyAdmin::class]);
<?php

use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//Após estiver logador poderá acessar
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', UsersController::class);

    //Envio WhatsApp
    Route::get('/avaliacoes/whatsapp/{id}', [AvaliacaoController::class, 'gerarLinkWhatsApp'])->name('avaliacoes.whatsapp');

    Route::resource('avaliacoes', AvaliacaoController::class);

});

Route::get('/avaliacoes/visualizar/{hash}', [AvaliacaoController::class, 'visualizarAvaliacao'])->name('avaliacoes.visualizar');



require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('contacts.index'));

// Rotas públicas (listar e visualizar contatos)
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');

// Grupo protegido por autenticação (CRUD restante)
Route::middleware('auth')->group(function () {
    Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
    Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
    Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
    Route::put('/contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
});

// Rotas de autenticação Breeze
require __DIR__ . '/auth.php';

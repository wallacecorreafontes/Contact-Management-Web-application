<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', fn() => redirect()->route('contacts.index'));

Route::resource('contacts', ContactController::class)->only(['index', 'show']);

Route::middleware(['auth'])->group(function () {
    Route::resource('contacts', ContactController::class)->except(['index', 'show']);
});

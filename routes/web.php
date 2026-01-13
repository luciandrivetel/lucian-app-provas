<?php

use App\Http\Controllers\ProofController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ProofController::class, 'index'])->name('proof.index');
Route::post('/provas', [ProofController::class, 'store'])->name('proof.store');
Route::get('/searckByDate', [ProofController::class, 'searchByDate'])->name('proof.searchByDate');

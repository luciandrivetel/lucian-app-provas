<?php

use App\Http\Controllers\ProofController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ProofController::class, 'index'])->name('proof.index');
Route::post('/proofs', [ProofController::class, 'store'])->name('proofs.store');
Route::get('/proofs/searchByRef', [ProofController::class, 'searchByRef'])->name('proofs.searchByRef');

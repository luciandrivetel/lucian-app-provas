<?php

use App\Http\Controllers\ProofController;
use Illuminate\Support\Facades\Route;


Route::delete('/proofs/{proof}/delete', [ProofController::class, 'delete'])->name('proofs.delete');
Route::put('/proofs/{proof}', [ProofController::class, 'update'])->name('proofs.update');
Route::get('/proofs/{proof}/edit', [ProofController::class, 'edit'])->name('proofs.edit');
Route::get('/', [ProofController::class, 'index'])->name('proof.index');
Route::post('/proofs', [ProofController::class, 'store'])->name('proofs.store');
Route::get('/proofs/searchByDate', [ProofController::class, 'searchByDate'])->name('proofs.searchByDate');
Route::get('/proofs/searchByRef', [ProofController::class, 'searchByRef'])->name('proofs.searchByRef');

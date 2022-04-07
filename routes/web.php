<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportingController;
use App\Http\Controllers\TransactionController;

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

Route::redirect('/', '/login');

Route::middleware('auth')->group(function () {
    Route::get('/bilan', [ReportingController::class, 'showBilan']);
    Route::get('/resultat', [ReportingController::class, 'showResultat']);
    Route::get('/grand-livre', [ReportingController::class, 'showGrandLivre']);
    Route::get('/partials/grand-livre/{account}', [ReportingController::class, 'showGrandLivreData']);

    Route::get('/transactions', [TransactionController::class, 'index']);
    Route::get('/partials/transactions/{transaction}', [TransactionController::class, 'show']);
});

Route::middleware('can:admin')->group(function () {
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transactions/{transaction}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');
    Route::put('/transactions/{transaction}/update', [TransactionController::class, 'update'])->name('transactions.update');
});

require __DIR__.'/auth.php';

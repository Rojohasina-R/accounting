<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
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

    Route::get('/accounts', [AccountController::class, 'index'])->name('accounts.index');
});

Route::middleware('can:admin')->group(function () {
    Route::resource('transactions', TransactionController::class)->except(['index', 'show']);

    Route::resource('accounts', AccountController::class)->except(['index', 'show']);
});

require __DIR__.'/auth.php';

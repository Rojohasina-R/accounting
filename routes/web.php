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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/transactions/create', [TransactionController::class, 'create']);
Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');

Route::get('/bilan', [ReportingController::class, 'showBilan']);
Route::get('/resultat', [ReportingController::class, 'showResultat']);
Route::get('/grand-livre', [ReportingController::class, 'showGrandLivre']);
Route::get('/partials/grand-livre/{account}', [ReportingController::class, 'showGrandLivreData']);

require __DIR__.'/auth.php';

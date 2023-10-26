<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExchangeRateController;
use App\Http\Controllers\DailyAverageRateController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/forex', [ExchangeRateController::class, 'index']);
Route::get('/forex-day', [DailyAverageRateController::class, 'index']);


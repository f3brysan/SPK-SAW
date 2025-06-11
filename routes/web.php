<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmartphoneController;

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

Route::get('/', [SmartphoneController::class, 'index'])->name('smartphones.index');
Route::get('/smartphones/{smartphone}', [SmartphoneController::class, 'show'])->name('smartphones.show');
Route::get('/calculation', [SmartphoneController::class, 'showCalculation'])->name('smartphones.calculation');
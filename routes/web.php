<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('makam/info', [App\Http\Controllers\MakamController::class, 'info'])->name('makam.info');
Route::get('makam/qr', [App\Http\Controllers\MakamController::class, 'qr'])->name('makam.qr');

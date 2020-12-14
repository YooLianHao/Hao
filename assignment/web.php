<?php

use Illuminate\Support\Facades\Route;

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



Route::get('/showClientProduct', [App\Http\Controllers\ClientProductController::class, 'show'])->name('showClientProduct');



Route::post('/searchClientProduct', [App\Http\Controllers\ClientProductController::class, 'search'])->name('search.product');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
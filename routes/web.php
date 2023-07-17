<?php

use App\Http\Controllers\MediaController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home',[MediaController::class,'index']);

Route::post('/home',[MediaController::class,'store'])->name('home.store');

Route::get('word-to-pdf',[MediaController::class,'wordtoPdfForm'])->name('wtp.form');

Route::post('word-to-pdf',[MediaController::class,'wordtoPdfConv'])->name('wtp.conv');

Route::get('pdf-to-word',[MediaController::class,'pdftoWordForm'])->name('ptw.form');

Route::post('pdf-to-word',[MediaController::class,'pdftoWordConv'])->name('ptw.conv');



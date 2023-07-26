<?php

use App\Http\Controllers\MediaController;
use App\Http\Controllers\MergeController;
use App\Http\Controllers\SplitController;
use App\Models\Smlprod;
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

Route::get('pdf-to-img',[MediaController::class, 'pdftoImgConv'])->name('pti');

Route::get('add-media-to-library', function(){

    $media =  Smlprod::create([
        'name' => 'Mufasa',
        'title' => 'take any title indeed',
        'body' => 'this is a text regarding the test of body'
    ])->addMedia(storage_path('app\public\uploads\Ryan.png'))->preservingOriginal()
    ->toMediaCollection('images');


    // F:\dc projects\media_library\media-lib\public\storage\uploads\Ryan.png
    // $media->addMediaConversion('pdf_to_image')
    // ->format('png')
    // ->performOnCollections('default');

    // F:\dc projects\media_library\media-lib\public\storage\uploads\ANUS-CV-BSCS web intern.pdf
    // F:\dc projects\media_library\media-lib\storage\app\public\uploads\images\beautiful_library.webp
    // F:\dc projects\media_library\media-lib\public\storage\uploads\images\beautiful_library.webp
});

Route::get('/compare-doc',[MediaController::class,'compareDocFiles']);

Route::get('/convert-to-jpg',[MediaController::class,'ConvertToJpg']);
// Route::get('/conv-word-to-pdf',[MediaController::class,'wordtopdfForm'])->name('wtp.conv');

// Route::post('/conv-word-to-pdf',[MediaController::class,'wordtopdfConv']);
Route::get('/convert-to-png',[MediaController::class,'ConvertToPng']);

Route::get('/merge-doc',[MergeController::class,'mergeDocumentDocx']);

Route::get('/merge-pdf',[MergeController::class,'mergePdf']);

Route::get('/split-doc',[SplitController::class,'SplitDocumentDocx'])->name('split');
// Route::post('/split-doc',[SplitController::class,'SplitDocumentDocx'])->name('split.res');
Route::get('/split-pdf',[SplitController::class,'SplitDocumentPdf']);
// Route::get('/')
// Route::get('/split-doc',[Sp])
Route::get('/get-watermark-on-pdf',[MediaController::class,'SetWatermarkOnPdf']);

Route::get('/view-tools',[MediaController::class,'ViewTools']);

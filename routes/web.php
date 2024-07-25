<?php

use App\Http\Controllers\AtributController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\PanduanController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PerangkatLunakController;
use App\Http\Controllers\FormReqController;
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
    return view('dashboard.layout.main');
})->name('home');

Route::get('/panduan', [PanduanController::class, 'index'])->name('panduan');

Route::get('/informasi', [InformasiController::class, 'informasi'])->name('informasi');

Route::get('/formreq', [FormReqController::class, 'formreq'])->name('formreq');

Route::get('/create', [PerangkatLunakController::class, 'create'])->name('create-data');
Route::post('/store', [PerangkatLunakController::class, 'store'])->name('store-data');

Route::get('/metode', [AtributController::class, 'index'])->name('metode');
Route::post('/update', [AtributController::class, 'update'])->name('metode-update');

Route::get('/upload', [FileUploadController::class, 'index'])->name('upload');
Route::post('/unggah', [FileUploadController::class, 'update'])->name('upload-update');

Route::get('/penilaian/{id}', [PenilaianController::class, 'index'])->name('penilaian');

Route::get('/download-pdf/{id}', [PenilaianController::class, 'downloadPdf'])->name('download.pdf');

Route::post('/save-chart', [PenilaianController::class, 'saveChart'])->name('save.chart');

Route::get('/download', [PerangkatLunakController::class, 'downloadCsv'])->name('download.csv');

// New routes
Route::get('/upload', [FileUploadController::class, 'index'])->name('file.upload');
Route::post('/upload', [FileUploadController::class, 'update'])->name('file.upload.update');

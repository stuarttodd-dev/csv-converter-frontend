<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CsvController;

Route::get('/', [CsvController::class, 'index'])->name('csv.index');
Route::post('/csv-upload', [CsvController::class, 'uploadCsv'])->name('csv.upload');
Route::post('/download-csv', [CsvController::class, 'downloadCSV'])->name('csv.download');
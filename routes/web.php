<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;


Route::get('/', [DocumentController::class, 'show'])->name('documents.show');
Route::get('/download/{file}', [DocumentController::class, 'download'])->name('documents.download');
Route::any('/documents/save', [DocumentController::class, 'save'])->name('documents.save');

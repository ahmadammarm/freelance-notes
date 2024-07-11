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

Route::get('/preview-invoice/{id}', [App\Http\Controllers\InvoiceController::class, 'preview'])->name('preview-invoice');
Route::get('/download-invoice/{id}', [App\Http\Controllers\InvoiceController::class, 'download'])->name('download-invoice');

<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CtemplateController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index']);

Route::get('/ctemplates', [CtemplateController::class, 'index'])->name('ctemplate.index');
Route::get('/ctemplates/create', [CtemplateController::class, 'create']);
Route::get('/ctemplates/edit/{id}', [CtemplateController::class, 'edit']);
Route::delete('/ctemplates/delete/{id}', [CtemplateController::class, 'delete']);

Route::get('/certificates', [CertificateController::class, 'index']);
Route::get('/certificates/create/{id}', [CertificateController::class, 'create']);
Route::post('/certificates/store', [CertificateController::class, 'store']);
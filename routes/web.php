<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CtemplateController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index']);

Route::get('/ctemplates', [CtemplateController::class, 'index']);
Route::get('/ctemplates/create', [CtemplateController::class, 'create']);

Route::get('/certificates', [CertificateController::class, 'index']);
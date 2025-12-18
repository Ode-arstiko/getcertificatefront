<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CtemplateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GetTokenController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login',[AuthController::class,'loginForm'])->name('login');
    Route::post('/login', [AuthController::class,'login']);
});

Route::middleware(['auth'])->group(function (){
    Route::get('/logout', [AuthController::class,'logout'])->name('logout');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/get-token', [GetTokenController::class, 'getToken']);

    Route::get('/ctemplates', [CtemplateController::class, 'index'])->name('ctemplate.index');
    Route::get('/ctemplates/create', [CtemplateController::class, 'create']);
    Route::get('/ctemplates/edit/{id}', [CtemplateController::class, 'edit']);
    Route::delete('/ctemplates/delete/{id}', [CtemplateController::class, 'delete']);

    Route::get('/certificates', [CertificateController::class, 'index']);
    Route::get('/certificates/create/{id}', [CertificateController::class, 'create']);
    Route::post('/certificates/store', [CertificateController::class, 'store']);
    Route::delete('/certificates/delete/{id}', [CertificateController::class, 'delete']);
    Route::get('/download-certificate-zip/{id}',[CertificateController::class, 'downloadZip'])->name('certificates.download.zip');
    Route::get('/certificates/detail/{id}', [CertificateController::class, 'zipDetails'])->name('certificates.detail');
    Route::get('/certificates/download/{id}', [CertificateController::class, 'downloadCertificate'])->name('certificates.download');
});
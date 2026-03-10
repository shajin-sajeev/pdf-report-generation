<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
Route::get('/', [ReportController::class, 'index'])->name('report.index');
Route::post('/generate', [ReportController::class, 'generate'])->name('report.generate');

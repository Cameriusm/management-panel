<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Panel\ReportController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RightController;
use App\Http\Controllers\VerifyController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\ListController;
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


Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Route::middleware(['role:worker|manager|admin'])->prefix('panel')->group(function () {
    Route::get('/', [App\Http\Controllers\Panel\HomeController::class, 'index']);
    Route::group(['middleware' => ['role:manager|admin']], function () {
        Route::get('reports/create/{id}',[ReportController::class, 'create'])->name('reports.create.user');
        Route::get('staff', [StaffController::class, 'index'])->name('staff');
        Route::get('staff/list/{id}', [ListController::class, 'index'])->name('staff.list');
        Route::resource('rights', RightController::class);
        Route::resource('verify', VerifyController::class);
        Route::get('pdfview',[DownloadController::class,'index'])->name('pdfview');
    });
    Route::resource('reports', ReportController::class);
});
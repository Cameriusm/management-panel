<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Panel\ReportController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RightController;
use App\Http\Controllers\VerifyController;
use App\Http\Controllers\StaffController;
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
    return view('home');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['role:worker|manager|admin'])->prefix('panel')->group(function () {
   
    
    Route::get('/', [App\Http\Controllers\Panel\HomeController::class, 'index']);
    Route::get('/report', [App\Http\Controllers\Panel\HomeController::class, 'report']);
    Route::resource('reports', ReportController::class);
    Route::resource('staff', StaffController::class);
    Route::resource('rights', RightController::class);
    Route::resource('verify', VerifyController::class);

});
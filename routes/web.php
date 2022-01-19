<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['role:worker|manager|admin'])->prefix('panel')->group(function () {
   
Route::get('/', [App\Http\Controllers\Panel\HomeController::class, 'index']);
Route::get('/create', [App\Http\Controllers\Panel\CreateController::class, 'index']);
Route::get('/list', [App\Http\Controllers\Panel\ListController::class, 'index']);
Route::get('/rights', [App\Http\Controllers\Panel\RightsController::class, 'index']);
Route::get('/verify', [App\Http\Controllers\Panel\VerifyController::class, 'index']);
Route::get('/reports', [App\Http\Controllers\Panel\ReportsController::class, 'index']);

});
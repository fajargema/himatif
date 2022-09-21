<?php

use Illuminate\Support\Facades\Auth;
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

Route::middleware(['auth:sanctum', 'verified'])->name('dashboard.')->prefix('dashboard')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('index');

    Route::resource('user', App\Http\Controllers\Admin\UserController::class);
    Route::resource('meet', App\Http\Controllers\Admin\MeetController::class);
    Route::get('scan/{id}', [App\Http\Controllers\Admin\MeetController::class, 'scan'])->name('meet.scan');
    Route::post('scan/result', [App\Http\Controllers\Admin\MeetController::class, 'scanResult'])->name('meet.scan-result');

    Route::resource('finance', App\Http\Controllers\Admin\FinanceController::class);
});

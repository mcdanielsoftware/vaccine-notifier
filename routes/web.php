<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeleteNotificationController;
use App\Http\Controllers\StoreNotificationController;
use App\Http\Controllers\UpdateNotificationController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middnvmleware group. Now create something great!
|
*/

Route::get('/', WelcomeController::class)->name('home')->middleware('guest');


Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::post('/notification', StoreNotificationController::class)->name('notification.store');
    Route::delete('/notification/{notification}', DeleteNotificationController::class)->name('notification.delete');
    Route::put('/notification/{notification}', UpdateNotificationController::class)->name('notification.update');
});


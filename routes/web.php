<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RollcallController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserrollcallController;
use App\Http\Controllers\Select2SearchController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::resource('profiles',ProfileController::class)->middleware(['auth']);
Route::resource('rollcalls',RollcallController::class)->middleware(['auth']);
Route::get('/rollcalls/get_data/{id}', [RollcallController::class, 'get_data']);
Route::resource('laporans',LaporanController::class)->middleware(['auth']);
Route::resource('users',UserController::class)->middleware(['auth']);
Route::resource('userrollcalls',UserrollcallController::class)->middleware(['auth']);

Route::resource('Select2Search',Select2SearchController::class)->middleware(['auth']);
Route::get('/ajax-autocomplete-search', [Select2SearchController::class, 'selectSearch']);
Route::get('/search', [Select2SearchController::class, 'index']);

Route::post('/users/kemaskini',[UserController::class,'kemaskini'])->middleware(['auth']);







require __DIR__.'/auth.php';

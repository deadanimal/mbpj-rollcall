<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RollcallController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserrollcallController;
use App\Http\Controllers\Select2SearchController;
use App\Http\Controllers\JadualController;


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
Route::resource('jaduals',JadualController::class)->middleware(['auth']);


Route::resource('Select2Search',Select2SearchController::class)->middleware(['auth']);
Route::get('/ajax-autocomplete-search', [Select2SearchController::class, 'selectSearch']);
Route::get('/search', [Select2SearchController::class, 'index']);

Route::post('/users/kemaskini',[UserController::class,'kemaskini'])->middleware(['auth']);


// permohonan custom ubah masa
Route::post('/ubah-masa_mula/{userrollcalls}', [RollcallController::class, 'masuk']);
Route::post('/ubah-masa_akhir/{userrollcalls}', [RollcallController::class, 'keluar']);

//Upload sebab
// Route::get('/upload-file', [FileUpload::class, 'createForm']);
// Route::post('/upload-file', [FileUpload::class, 'fileUpload'])->name('fileUpload');

Route::post('simpan_sebab/{id}',[UserrollcallController::class,'simpan_sebab']);

//sokong 
Route::get('/sokong/{id}',[RollcallController::class,'sokong']);
Route::post('/tolak_sokong',[RollcallController::class,'tolak_sokong']);

//lulus 
Route::get('/lulus/{id}',[RollcallController::class,'lulus']);
Route::post('/tolak_lulus',[RollcallController::class,'tolak_lulus']);




require __DIR__.'/auth.php';

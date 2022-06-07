<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadualController;
use App\Http\Controllers\KumpulanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QrcodeController;
use App\Http\Controllers\RekodController;
use App\Http\Controllers\RollcallController;
use App\Http\Controllers\SebabController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserKumpulanController;
use App\Http\Controllers\UserrollcallController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/test', [QrcodeController::class, 'test']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::resource('profiles', ProfileController::class)->middleware(['auth']);
Route::resource('rollcalls', RollcallController::class)->middleware(['auth']);
Route::get('/rollcalls/get_data/{id}', [RollcallController::class, 'get_data']);
Route::resource('laporans', LaporanController::class)->middleware(['auth']);
Route::resource('users', UserController::class)->middleware(['auth']);
Route::resource('userrollcalls', UserrollcallController::class)->middleware(['auth']);
Route::resource('jaduals', JadualController::class)->middleware(['auth']);
Route::resource('rekod', RekodController::class)->middleware(['auth']);
Route::resource('sebab', SebabController::class)->middleware(['auth']);
Route::resource('kumpulan', KumpulanController::class)->middleware(['auth']);
Route::resource('userkumpulan', UserKumpulanController::class)->middleware(['auth']);

// Route::resource('Select2Search',Select2SearchController::class)->middleware(['auth']);
// Route::get('/ajax-autocomplete-search', [Select2SearchController::class, 'selectSearch']);
// Route::get('/search', [Select2SearchController::class, 'index']);

Route::post('/users/kemaskini', [UserController::class, 'kemaskini'])->middleware(['auth']);

// permohonan custom ubah masa
Route::post('/ubah-masa_mula/{userrollcalls}', [RollcallController::class, 'masuk']);
Route::post('/ubah-masa_akhir/{userrollcalls}', [RollcallController::class, 'keluar']);

//Upload sebab
// Route::get('/upload-file', [FileUpload::class, 'createForm']);
// Route::post('/upload-file', [FileUpload::class, 'fileUpload'])->name('fileUpload');

Route::post('/simpan_sebab', [UserrollcallController::class, 'simpan_sebab']);

//sokong
Route::get('/sokong/{id}', [RollcallController::class, 'sokong']);
Route::post('/tolak_sokong', [RollcallController::class, 'tolak_sokong']);

//lulus
Route::get('/lulus/{id}', [RollcallController::class, 'lulus']);
Route::post('/tolak_lulus', [RollcallController::class, 'tolak_lulus']);

//Filter
Route::get('/filter_laporan_hadir/{id}', [LaporanController::class, 'filter_laporan_hadir']);
Route::get('/filter_laporan_hadir_bahagian/{id}', [LaporanController::class, 'filter_laporan_hadir_bahagian']);

//Change Password
Route::post('change-password', [ChangePasswordController::class, 'store'])->name('change.password');

Route::post('/simpanbahagian', [RollcallController::class, 'simpanbahagian']);

Route::get('/delete_pengguna_kumpulan/{id_user}/{id_kumpulan}', [UserKumpulanController::class, 'delete_pengguna_kumpulan']);

Route::delete('penguatkuasaDeleteAll', [RollcallController::class, 'deleteAll']);
Route::post('PegawaiSokongAll', [RollcallController::class, 'SokongAll']);
Route::post('TolakSokongAll', [RollcallController::class, 'TolakSokongAll']);

Route::post('PegawaiLulusAll', [RollcallController::class, 'LulusAll']);

Route::post('/scanQr', [QrcodeController::class, 'scanQr']);
Route::get('qrcode/{id}', [RollcallController::class, 'generate'])->name('generate');

require __DIR__ . '/auth.php';

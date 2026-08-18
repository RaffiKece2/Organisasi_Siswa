<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\JurusanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login_page', function () {

    return view('login');

});

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'register']);




Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {

    Route::get('/dashboard', [SiswaController::class, 'dashboard']);

    Route::get('/tambah_siswa', [SiswaController::class, 'tambahSiswa']);
    Route::post('/tambah_siswa', [SiswaController::class, 'tambahSiswa']);


    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/profile/{id}', [ProfileController::class, 'profile']);

    Route::get('/edit_profile', function () {

        return view('changeProfile');

    });

    Route::get('/edit', [ProfileController::class,'editProfile' ]);
    Route::patch('/edit', [ProfileController::class, 'editProfile' ]);

    Route::delete('/hapus_profile', [ProfileController::class, 'hapusProfile']);

    Route::get('/notification_page', function () {

        return view('notifikasi');

    });


    Route::get('/notifikasi', [NotifikasiController::class, 'notifikasi']);


    Route::get('/hapus_siswa/{id}', [SiswaController::class, 'hapusSiswa']);
    Route::delete('/hapus_siswa/{id}', [SiswaController::class, 'hapusSiswa']);

    Route::get('/search_page', [SiswaController::class, 'searchPage']);
    Route::get('/search_siswa', [SiswaController::class, 'cariSiswa']);

    Route::get('/tambah_jurusanPage', function () {

        return view('jurusan');

    });

    Route::post('/tambah_jurusan', [JurusanController::class, 'tambahJurusan']);
    Route::get('/tambah_jurusan', [JurusanController::class, 'tambahJurusan']);

    Route::get('/jurusan_page', [JurusanController::class, 'jurusan']);

    Route::get('/jurusan_siswa/{id}', [JurusanController::class, 'semuaJurusan']);

    Route::get('/editPage/{id}', [SiswaController::class, 'editPage']);

    Route::patch('/edit_siswa/{id}', [SiswaController::class, 'editSiswa']);
    
    

    



});




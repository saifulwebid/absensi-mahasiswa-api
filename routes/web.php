<?php

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

use App\Kelas;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kelas', 'KelasController@getAllKelas');
Route::get('/absensi/allabsensi/{nim}', 'AbsensiController@getAllAbsensiByNim');
Route::get('/kelas/{id_kelas}/mahasiswa', 'MahasiswaController@getMahasiswaByKelas');
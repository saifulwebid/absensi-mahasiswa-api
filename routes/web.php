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
Route::get('/absensi/rekapsemester/{id_kelas}/idsemester/{id_semester}', 'AbsensiController@getRekapSemester');
Route::get('/absensi/allabsensi/{nim}', 'AbsensiController@getAllAbsensiByNim');
Route::post('/absensi/allabsensi', 'AbsensiController@postAbsensi');
Route::get('/absensi/totaljam/{nim}/keterangan/{keterangan}', 'AbsensiController@getTotalJamPerKategori');
Route::get('/absensi/totaljamperkelas/{id_kelas}/tanggal/{tanggal}', 'AbsensiController@getAbsenPerkelasPertanggal');
Route::get('/absensi/totaljamkeseluruhan/{nim}', 'AbsensiController@getTotalJamKeseluruhan');
Route::get('/kelas/{id_kelas}/mahasiswa', 'MahasiswaController@getMahasiswaByKelas');
Route::post('/login', 'AuthController@login');
Route::get('/logout', 'AuthController@logout');
Route::get('/status', 'AuthController@me');
Route::get('/me/absensi', 'ProfileController@getMyAbsensi');

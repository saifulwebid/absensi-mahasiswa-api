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

Route::get('/kelas', function() {
    $list = Kelas::all();

    foreach ($list as $kelas)
    {
        $result[] = [
            "id" => $kelas->id_kelas,
            "nama" => $kelas->tingkat_kelas . $kelas->nama_kelas . "-" . $kelas->program_studi->nama_program_studi
        ];
    }

    return $result;
});
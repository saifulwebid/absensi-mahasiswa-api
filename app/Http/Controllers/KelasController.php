<?php

namespace App\Http\Controllers;

use App\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function getAllKelas()
    {
        $list = Kelas::all();

        foreach ($list as $kelas)
        {
            $result[] = [
                "id" => $kelas->id_kelas,
                "nama" => $kelas->tingkat_kelas . $kelas->nama_kelas . "-" . $kelas->program_studi->nama_program_studi
            ];
        }

        return $result;
    }
}

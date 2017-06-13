<?php

namespace App\Http\Controllers;

use App\Kelas;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function getMahasiswaByKelas($id_kelas)
    {
        $list = Kelas::find($id_kelas);

        foreach ($list->mahasiswa as $mhs)
        {
            $result[] = [
                "nim" => $mhs->nim,
                "nama" => $mhs->nama
            ];
        }

        return $result;
    }
}

<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Mahasiswa;
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

    public function getSingleMahasiswa($nim)
    {
        $mhs = Mahasiswa::find($nim);

        $id_kelas = 0;
        $kelas = null;
        foreach ($mhs->kelas as $row)
        {
            if ($row->id_kelas > $id_kelas)
            {
                $id_kelas = $row->id_kelas;
                $kelas = $row;
            }
        }

        return [
            "nim" => $mhs->nim,
            "nama" => $mhs->nama,
            "kelas" => $kelas->tingkat_kelas . $kelas->nama_kelas . "-" . $kelas->program_studi->nama_program_studi
        ];
    }
}

<?php

namespace App\Http\Controllers;

use App\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    //

    public function getAllAbsensiByNim($nim)
    {
        $list = Absensi::find($nim);

        foreach ($list as $absensi)
        {
            $result[] = [
                "id_absen" => $absensi->id_absen,
                "nim" => $absensi->nim,
                "tanggal" => $absensi->tanggal,
                "jam" => $absensi->jam,
                "keterangan" => $absensi->keterangan
            ];
        }

        return $result;
    }
}

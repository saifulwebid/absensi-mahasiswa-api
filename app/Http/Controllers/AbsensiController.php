<?php

namespace App\Http\Controllers;

use App\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    //

    public function getAllAbsensiByNim($nim)
    {
        $list = Absensi::where('nim', '=', $nim)->get();

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

    public function getTotalJamPerKategori($nim,$keterangan){

        $list = Absensi::where([
            ['nim', '=', $nim],
            ['keterangan', '=', $keterangan],
        ])->get();

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

        return  [
              "jam" =>  count($result)

        ];



    }
}

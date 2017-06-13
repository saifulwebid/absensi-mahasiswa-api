<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $absensiController;

    public function __construct()
    {
        $this->absensiController = new AbsensiController();
    }

    public function getMyAbsensi(Request $request)
    {
        $nim = $request->session()->get('nim');

        $sakit = $this->absensiController->getTotalJamPerKategori($nim, 'S')["jam"];
        $izin = $this->absensiController->getTotalJamPerKategori($nim, 'I')["jam"];
        $alpa = $this->absensiController->getTotalJamPerKategori($nim, 'A')["jam"];
        $absen = $this->absensiController->getAllAbsensiByNim($nim);

        return [
            "sakit" => $sakit,
            "izin" => $izin,
            "alpa" => $alpa,
            "absensi" => $absen
        ];
    }
}

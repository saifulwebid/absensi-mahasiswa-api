<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\Kelas;
use App\Mahasiswa;
use App\Semester;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    //

    public function getAllAbsensiByNim($nim)
    {
        $list = Absensi::where('nim', '=', $nim)->get();
        $result = array();
        foreach ($list as $absensi)
        {
            $result[] = [

                "tanggal" => $absensi->tanggal,
                "jam" => $absensi->jam,
                "keterangan" => $absensi->keterangan,

            ];
        }

        return $result;
    }

    public function getTotalJamPerKategori($nim,$keterangan){

        $list = Absensi::where([
            ['nim', '=', $nim],
            ['keterangan', '=', $keterangan],
        ])->get();

        $result = array();
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

    public function getTotalJamKeseluruhan($nim){

        $list = Absensi::where('nim', '=', $nim)->get();

        $result = array();
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

        return [
            "jam" =>  count($result)
        ];



    }

    public function getAbsenPerkelasPertanggal($id_kelas,$tanggal){

        $list = Kelas::find($id_kelas);
        $result = array();
        foreach ($list->mahasiswa as $mhs)
        {
            $listijin = Absensi::where([
                ['nim', '=', $mhs->nim],
                ['tanggal', '=', $tanggal],
                ['keterangan','=','I']

            ])->get();
            $listsakit = Absensi::where([
                ['nim', '=', $mhs->nim],
                ['tanggal', '=', $tanggal],
                ['keterangan','=','S']

            ])->get();
            $listalpha = Absensi::where([
                ['nim', '=', $mhs->nim],
                ['tanggal', '=', $tanggal],
                ['keterangan','=','A']

            ])->get();



            $result[] = [
                "nim" => $mhs->nim,
                "nama" => $mhs->nama,
                "kelas" => $list->tingkat_kelas . $list->nama_kelas,
                "totaljamsakit" => count($listsakit),
                "totaljamijin" => count($listijin),
                "totaljamalpha" => count($listalpha)
            ];
        }

        return $result;



    }


    public function getRekapSemester($id_kelas,$id_semester)
    {
        $list = Kelas::find($id_kelas);
        $idsemester = Semester::find($id_semester);

        $result = array();
        foreach ($list->mahasiswa as $mhs)
        {
            $listcount = Absensi::where('nim', '=', $mhs->nim)
                                ->whereBetween('tanggal',array($idsemester->tanggal_awal,$idsemester->tanggal_akhir))->get();
            $result[] = [
                "nim" => $mhs->nim,
                "nama" => $mhs->nama,
                "totaljam" => count($listcount)
            ];
        }

        return $result;
    }

     public function postAbsensi(Request $request) {
       //$nim = $request['nim'];
       //$tanggal = $request['tanggal'];
       //$jam = $request['jam'];
       //$keterangan=$request['keterangan'];

       $absensi = new Absensi;
       $absensi->nim = $request->input('nim');
       $absensi->tanggal = $request->input('tanggal');
       $absensi->jam = $request->input('jam');
       $absensi->keterangan = $request->input('keterangan');
       $absensi->save();


        return [
            "success" => "Post Successfully Created"
        ];
    }

}

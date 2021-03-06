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

                "id_absen" => $absensi->id_absen,
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
            $listijin = Absensi::where([
                ['nim', '=', $mhs->nim],
                ['keterangan','=','I']

            ])->whereBetween('tanggal',array($idsemester->tanggal_awal,$idsemester->tanggal_akhir))->get();
            $listsakit = Absensi::where([
                ['nim', '=', $mhs->nim],
                ['keterangan','=','S']

            ])->whereBetween('tanggal',array($idsemester->tanggal_awal,$idsemester->tanggal_akhir))->get();
            $listalpha = Absensi::where([
                ['nim', '=', $mhs->nim],
                ['keterangan','=','A']

            ])->whereBetween('tanggal',array($idsemester->tanggal_awal,$idsemester->tanggal_akhir))->get();
            $result[] = [
                "nim" => $mhs->nim,
                "nama" => $mhs->nama,
                "totaljam" => count($listcount),
                "keterangan" => "S:".count($listsakit).",I:".count($listijin).",A:".count($listalpha)
            ];
        }

        return $result;
    }

    public function postAbsensi(Request $request) {
        $nim = $request->input('nim');
        $tanggal = $request->input('tanggal');

        foreach ($request->input('absensi') as $abs)
        {
            $absensi = new Absensi;
            $absensi->nim = $nim;
            $absensi->tanggal = $tanggal;
            $absensi->jam = $abs['jam'];
            $absensi->keterangan = $abs['keterangan'];
            $absensi->save();
        }

        return [
            "success" => true,
            "message" => "Absensi berhasil dicatat."
        ];
    }

    public function patchAbsensi(Request $request, $id_absen)
    {
        $absensi = Absensi::find($id_absen);

        if ($request->input('keterangan') == 'H')
        {
            $absensi->delete();

            return [
                "success" => true,
                "message" => "Absensi berhasil diputihkan."
            ];
        }
        else
        {
            $absensi->keterangan = $request->input('keterangan');
            $absensi->save();

            return [
                "success" => true,
                "message" => "Keterangan absensi berhasil diubah."
            ];
        }
    }

    public function getAbsenByMahasiswaByTanggal($nim, $tanggal)
    {
        $mahasiswaController = new MahasiswaController();
        $mahasiswa = $mahasiswaController->getSingleMahasiswa($nim);

        $list = Absensi::where([
            ['nim', '=', $nim],
            ['tanggal', '=', $tanggal]
        ])->get();

        $absen = [];
        for ($i = 1; $i <= 12; $i++)
            $absen[$i] = 'H';

        foreach ($list as $row)
            $absen[$row->jam] = $row->keterangan;

        $result['absensi'] = [];
        for ($i = 1; $i <= 12; $i++)
        {
            $result['absensi'][] = [
                "jam" => $i,
                "keterangan" => $absen[$i]
            ];
        }
        $result = $mahasiswa + $result;
        return $result;
    }

}

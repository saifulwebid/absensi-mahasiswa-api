<?php

namespace App\Http\Controllers;

use App\Credential;
use App\Mahasiswa;
use App\TataUsaha;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = Credential::find($request->input('username'));

        if ($user && $user->password == $request->input('password'))
        {
            if ($user->mahasiswa)
            {
                $type = "mahasiswa";
                $nim = $user->mahasiswa->nim;
            }
            else if ($user->tata_usaha)
            {
                $type = "tu";
                $id_tata_usaha = $user->tata_usaha->id_tata_usaha;
            }
            else
                $type = null;

            if ($type)
            {
                $request->session()->put('logged_in', true);
                if ($type == "mahasiswa")
                    $request->session()->put('nim', $nim);
                else
                    $request->session()->put('id_tata_usaha', $id_tata_usaha);

                return [
                    "success" => true,
                    "type" => $type
                ];
            }
            else
            {
                return [
                    "success" => false,
                    "message" => "Unknown error"
                ];
            }
        }
        else
        {
            return [
                "success" => false,
                "message" => "Username dan/atau password tidak ditemukan"
            ];
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();

        return [
            "success" => false,
            "message" => "Berhasil log out."
        ];
    }

    public function me(Request $request)
    {
        if ($request->session()->has('logged_in'))
        {
            if ($request->session()->has('nim'))
            {
                $user = Mahasiswa::find($request->session()->get('nim'));

                return [
                    "logged_in" => true,
                    "type" => "mahasiswa",
                    "mahasiswa" => $user
                ];
            }
            else if ($request->session()->has('id_tata_usaha'))
            {
                $staff = TataUsaha::find($request->session()->get('id_tata_usaha'));

                return [
                    "logged_in" => true,
                    "type" => "tu",
                    "tu" => $staff
                ];
            }
        }
        else
        {
            return [
                "logged_in" => false
            ];
        }
    }
}

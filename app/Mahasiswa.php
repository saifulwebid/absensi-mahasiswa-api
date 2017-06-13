<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    public $incrementing = false;

    public function program_studi()
    {
        return $this->belongsTo('App\ProgramStudi', 'id_program_studi');
    }

    public function kelas()
    {
        return $this->belongsToMany('App\Kelas', 'kelas_mahasiswa', 'nim', 'id_kelas');
    }
}

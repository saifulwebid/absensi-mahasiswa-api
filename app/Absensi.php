<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';
    protected $primaryKey = 'id_absen';
    public $timestamps = false;

    public function nim()
    {
        return $this->belongsTo('App\Mahasiswa', 'nim');
    }


}

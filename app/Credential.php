<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    protected $table = 'credentials';
    protected $primaryKey = 'username';
    public $incrementing = false;

    public function mahasiswa()
    {
        return $this->hasOne('App\Mahasiswa', 'nim', 'nim');
    }

    public function tata_usaha()
    {
        return $this->hasOne('App\TataUsaha', 'id_tata_usaha', 'id_tata_usaha');
    }
}

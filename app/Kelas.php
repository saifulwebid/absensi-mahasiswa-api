<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';

    public function program_studi()
    {
        return $this->belongsTo('App\ProgramStudi', 'id_program_studi');
    }
}

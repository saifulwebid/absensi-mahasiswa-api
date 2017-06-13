<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $table = 'semester';
    protected  $primaryKey = 'id_semester';

    public function tahun_ajaran()
    {
        return $this->belongsTo('App\TahunAjaran', 'id_tahun_ajaran');
    }
}

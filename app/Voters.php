<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voters extends Model
{
    protected $table = 'voters';
    public $timestamps = false;

    public function pemilihan()
    {
        return $this->belongsTo('App\Pemilihan','pemilihan_id','id');
    }

    public function pengguna()
    {
        return $this->belongsTo('App\Pengguna','nik','nik');
    }

    function detailgroup(){
        return $this->belongsTo('App\Detailgroup','nik','nik');
    }
}

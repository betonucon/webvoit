<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quickcount extends Model
{
    protected $table = 'quickcount';
    public $timestamps = false;

    public function pemilihan()
    {
        return $this->belongsTo('App\Pemilihan','pemilihan_id','id');
    }

    public function pengguna()
    {
        return $this->belongsTo('App\Pengguna','nik','nik');
    }
    public function pemilih()
    {
        return $this->belongsTo('App\Pengguna','username','nik');
    }

    function detailpemilihan(){
        return $this->belongsTo('App\Detailpemilihan','detailpemilihan_id','id');
    }
}

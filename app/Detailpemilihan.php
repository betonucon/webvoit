<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detailpemilihan extends Model
{
    protected $table = 'detail_pemilihan';
    public $timestamps = false;

    public function pemilihan()
    {
        return $this->belongsTo('App\Pemilihan','pemilihan_id','id');
    }
}

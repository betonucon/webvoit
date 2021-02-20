<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $table = 'pengguna';
    public $timestamps = false;

    function detailgroup(){
		return $this->belongsTo('App\Detailgroup','nik','nik');
	}
}

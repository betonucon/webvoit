<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detailgroup extends Model
{
    protected $table = 'detail_group';
    public $timestamps = false;

    function groupnya(){
		  return $this->hasOne('App\Group','kode_group','kode_group');
	  }
    public function pengguna()
    {
        return $this->belongsTo('App\Pengguna','nik','nik');
    }
}

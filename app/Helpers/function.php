<?php

function link_html(){
    $data='';

    return $data;
}

function url_gambar_paslon(){
    $data='';

    return $data;
}

function kategori(){
    $data=App\Kategori::all();
    return $data;
}

function cek_detail_group($group,$unit){
    $data=App\Detailgroup::where('kode_group',$group)->where('kode_unit',$unit)->count();
    return $data;
}

function kode_group(){
    $data=App\Group::where('users_id',Auth::user()['id'])->count();
    $urutan=($data+1);
    $no=strtoupper(substr(Auth::user()['name'],0,2));
    $id=Auth::user()['id'];
    $nomor=$id.$no.sprintf("%05s", $urutan);
    return $nomor;
}

function cek_kategori($id){
    $data=App\Kategori::where('id',$id)->first();
    return $data['name'];
}

function cek_user($nik){
    $data=App\User::where('username',$nik)->first();

    return $data;
}

function cek_pengguna($nik){
    $data=App\Pengguna::where('nik',$nik)->first();

    return $data;
}
function kode_unit(){
    $data=App\Pengguna::where('nik',Auth::user()['username'])->first();

    return $data['kode_unit'];
}
function groupnya(){
    $dat=App\Detailgroup::where('nik',Auth::user()['username'])->first();
    
    return $data['kode_group'];
}

function title(){
    $data=App\Title::orderBy('id','desc')->firstOrFail();

    return $data;
}
function pemilihan_aktif(){
    $cek=App\Pemilihan::where('sts',1)->orderBy('id','desc')->firstOrFail();
    $data=App\Detailpemilihan::where('pemilihan_id',$cek['id'])->whereIn('kode_unit',groupnya())->get();

    return $data;
}
function cek_pemilihan_aktif(){
    $data=App\Pemilihan::where('sts',1)->count();

    return $data;
}
function foto_profil(){
    if(Auth::user()['role_id']==1){
        $data=App\Pengguna::where('nik',Auth::user()['username'])->first();
        $foto=$data['foto'];
    }else{
        $foto='admin.png';
    }
    

    return $foto;
}

function cek_unit($nik){
    $data=App\Unit::where('kode_unit',$nik)->first();
    $nama=cek_kategori($data['sts']).' '.$data['name'];
    return $nama;
}

function unit(){
    $data=App\Unit::orderBy('name','Asc')->get();
    return $data;
}
function cek_total($kode){
    $data=App\Pengguna::where('kode_unit',$kode)->count();
    return $data;
}
function cek_groupnya($kode_group){
    $data=App\Group::where('kode_group',$kode_group)->first();
    
    return $data['name'];
}





?>
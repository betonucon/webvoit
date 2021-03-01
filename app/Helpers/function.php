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
function group(){
    $data=App\Group::orderBy('name','Asc')->get();
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
function cek_kode_group(){
    if(Auth::user()['role_id']==3){
        $data=App\Pengguna::where('nik',Auth::user()['username'])->first();
        $kode=$data['detailgroup']['kode_group'];
    }
    
    if(Auth::user()['role_id']==2){
        $data=App\Pengguna::where('nik',Auth::user()['username'])->first();
        $kode=$data['detailgroup']['kode_group'];
    }
    
    if(Auth::user()['role_id']==1){
        $kode='Admin';
    }
    
    return $kode;
}
function enkripsi_akuh($id){
    $encrypted = Crypt::encryptString($id);
	$decrypted = Crypt::decryptString($encrypted);
    
    return $encrypted;

}
function deskripsi_akuh($id){
    $decrypted = Crypt::decryptString("'.$id.'");
    
    return $decrypted;

}
function sisa_waktu(){
    if(cek_pemilihan_aktif()>0){
        $cek=App\Pemilihan::where('sts',1)->orderBy('id','desc')->firstOrFail();
        if($cek['mulai']==1){
            if(date('Y-m-d H:i:s')>$cek['sampai']){
                $data='<p style="padding:1%;border:dotted 1px yellow">Waktu Telah Habis</p>';
            }else{
                $awal  = strtotime(date('Y-m-d H:i:s')); //waktu awal
                $akhir = strtotime($cek['sampai']); //waktu akhir
                $diff  = $akhir - $awal;
                $jam   = floor($diff / (60 * 60));
                $menit = $diff - $jam * (60 * 60);
                $data='<p style="padding:1%;border:dotted 1px yellow">Waktu Tersisa tinggal: ' . $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit</p>';
            }
        }else{
            $data='Vote Belum dimulai';
        }
    }else{
        $data='';
    }
    

    return $data;
}
function cek_pemilihan($id){
    $data=App\Quickcount::where('pemilihan_id',$id)->where('username',Auth::user()['username'])->count();
    return $data;
}
function cek_quickcount($id,$nik){
    $data=App\Quickcount::where('pemilihan_id',$id)->where('username',$nik)->count();
    return $data;
}
function total_pengguna($id){
    $data=App\Detailgroup::where('kode_group',$id)->count();
    return $data;
}
function semua_total_pengguna(){
    $data=App\Detailgroup::count();
    return $data;
}
function cek_hasil($nik,$pemilihan_id,$kode_group){
    $data=App\Quickcount::where('pemilihan_id',$pemilihan_id)->where('nik',$nik)->count();
    $jumlah_anggota=App\Quickcount::where('pemilihan_id',$pemilihan_id)->where('kode_group',$kode_group)->orWhere('kode_group',101)->count();
    $total=round(($data*100)/$jumlah_anggota);
    return $total.'%';
}
function cek_name_group(){
    
    if(Auth::user()['role_id']==3){
        $data=App\Group::where('kode_group',cek_kode_group())->first();
        $kode=$data['name'];
    }else{
        $kode='Admin';
    }
    return $kode;
}
function kode_unit(){
    $data=App\Pengguna::where('nik',Auth::user()['username'])->first();

    return $data['kode_unit'];
}
function cek_voters($id){
    $data=App\Voters::where('nik',Auth::user()['username'])->where('pemilihan_id',$id)->count();

    return $data;
}
function groupnya(){
    $dat=App\Detailgroup::where('nik',Auth::user()['username'])->first();
    
    return $data['kode_group'];
}

function title(){
    $data=App\Pemilihan::where('sts',1)->count();
    if($data>0){
        $cek=App\Pemilihan::where('sts',1)->orderBy('id','desc')->firstOrFail();
        $title=$cek['name'].'<br>Periode '.$cek['periode'];
    }else{
        $title='SKKS (Serikat Karyawan Krakatau Steel)';
    }
    

    return $title;
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
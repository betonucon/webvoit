<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Pemilihan;
use App\User;
use App\Unit;

use App\Detailpemilihan;
class PemilihanController extends Controller
{
    public function index(request $request){
        $menu='Pemilihan';

        return view('pemilihan.index',compact('menu'));
    }
    public function index_unit(request $request){
        $menu='Pemilihan';
        if(Auth::user()['role_id']==3){
            return view('pemilihan.index_unit',compact('menu'));
        }else{

        }
        
    }
    
    public function hapus(request $request){
        $hapus=Pemilihan::where('id',$request->id)->delete();
        $hapus2=Detailpemilihan::where('pemilihan_id',$request->id)->delete();
        
    }

    public function hapus_paslon(request $request){
        $hapus=Detailpemilihan::where('nik',$request->nik)->where('pemilihan_id',$request->pemilihan_id)->delete();
        echo $request->pemilihan_id;
    }
    public function aktif(request $request){
        $data      =Pemilihan::find($request->id);
        $data->sts  =1;
        $data->save();

        $det=Pemilihan::where('id','!=',$request->id)->update([
            'sts' => '0',
        ]);
        
    }
    public function hidupkan(request $request){
        $data      =Pemilihan::where('id',$request->id)->where('sts',1)->first();
        $data->mulai  =1;
        $data->save();

        $det=Pemilihan::where('id','!=',$request->id)->update([
            'mulai' => '0',
        ]);
        
    }

    public function view_data_vote(request $request){
        error_reporting(0);
       
        $cek=Pemilihan::where('sts',1)->orderBy('id','desc')->firstOrFail();
        if(Auth::user()['role_id']==3){
            $data=Detailpemilihan::with(['pemilihan'])->where('pemilihan_id',$cek['id'])->where('kode_group',cek_kode_group())->get();
        }
        if(Auth::user()['role_id']==2){
            $data=Detailpemilihan::with(['pemilihan'])->where('pemilihan_id',$cek['id'])->where('kode_group',cek_kode_group())->get();
        }
        if(Auth::user()['role_id']==1){
            $data=Detailpemilihan::with(['pemilihan'])->where('pemilihan_id',$cek['id'])->get();
        }
        
        foreach($data as $no=>$det){
            echo'
                <div class="colom-25">
                    <div class="nomor_user">
                      NO '.($no+1).' 
                    </div>
                    <div class="img_user">';
                        if($det->pemilihan['mulai']==1){
                            echo' <a href="#"><img src="'.url('profil/'.cek_pengguna($det['nik'])['foto']).'" onclick="pilih('.$no.')" class="imgnya" alt="User Image"></a>';
                        
                        }else{
                            echo'<img src="'.url('profil/'.cek_pengguna($det['nik'])['foto']).'"  class="imgnya" alt="User Image">';
                        
                        }
                        echo'
                        <div class="centered"><span class="btn btn-primary btn-sm">Klik Area Foto</span></div>
                    </div>
                    <div class="nama_user">
                      '.cek_pengguna($det['nik'])['name'].'<br>
                      '.$det['nik'].'
                    </div>
                </div>';
        }
    }
    public function view_data_vote_admin(request $request){
        error_reporting(0);
       
        $cek=Pemilihan::where('sts',1)->orderBy('id','desc')->firstOrFail();
        $data=Detailpemilihan::with(['pemilihan'])->where('pemilihan_id',$cek['id'])->get();
        foreach($data as $no=>$det){
            echo'
                <div class="colom-25">
                    <div class="nomor_user">
                      NO '.($no+1).' 
                    </div>
                    <div class="img_user">';
                        if($det->pemilihan['mulai']==1){
                            echo' <a href="#"><img src="'.url('profil/'.cek_pengguna($det['nik'])['foto']).'" onclick="pilih('.$no.')" class="imgnya" alt="User Image"></a>';
                            echo'<div class="centered"><span class="btn btn-primary btn-sm">Klik Area Foto</span></div>';
                        }else{
                            echo'<img src="'.url('profil/'.cek_pengguna($det['nik'])['foto']).'"  class="imgnya" alt="User Image">';
                        
                        }
                        echo'
                        
                    </div>
                    <div class="nama_user">
                      '.cek_pengguna($det['nik'])['name'].'<br>
                      '.$det['nik'].'
                    </div>
                </div>';
        }
    }
    public function non_aktif(request $request){
        $data      =Pemilihan::find($request->id);
        $data->sts  =0;
        $data->save();
        
        
    }
    public function matikan(request $request){
        $data      =Pemilihan::find($request->id);
        $data->mulai  =0;
        $data->save();
        
        
    }
    public function ubah(request $request){
        $data=Pemilihan::where('id',$request->id)->first();
        echo'
            <div class="form-group" style="margin-bottom: 0px;">
                <label>Nama Pemilihan</label>
                <input type="text" name="name" class="form-control" value="'.$data['name'].'">
                <input type="hidden" name="id" class="form-control" value="'.$data['id'].'">
                
            </div>
            <div class="form-group">
                <label>Periode:</label>
                <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="periode" class="form-control" value="'.$data['periode'].'" id="periode_ubah">
                </div>
            </div>
            <script>
                $(document).ready(function(){
                    $("#birth-date").mask("00/00/0000");
                    $("#periode_ubah").mask("0000-0000");
                });
            </script>
        ';
    }

    public function view_data_paslon(request $request){
        if(Auth::user()['role_id']=='1'){
            $data=Detailpemilihan::with(['pengguna'])->where('pemilihan_id',$request->id)->get();
        }
        if(Auth::user()['role_id']=='3'){
            $data=Detailpemilihan::with(['pengguna'])->where('pemilihan_id',$request->id)->where('kode_group',cek_kode_group())->get();
        }
        
        echo'
            <style>
                th{
                   background:#d1d1dc;
                   text-align:center;
                   padding:4px;
                   border:solid 1px #000;
                }
                td{
                   padding:4px;
                   border:solid 1px #000;
                }
            </style>
            <table width="100%" class="table-bordered table-hover dataTable">
                <tr>
                    <th width="5%">No</th>
                    <th width="10%">NIK</th>
                    <th>Nama</th>
                    <th>Area Kerja</th>
                    <th width="8%"></th>
                </tr>

        ';
        foreach($data as $no=>$o){
            echo'
                <tr>
                    <td>'.($no+1).'</td>
                    <td>'.$o['nik'].'</td>
                    <td>'.$o['pengguna']['name'].'</td>
                    <td>'.cek_unit($o->pengguna['kode_unit']).'</td>
                    <td>
                        <span class="btn btn-danger btn-xs" onclick="hapus_paslon(`'.$o['nik'].'`,'.$o['pemilihan_id'].')"><i class="fa fa-remove"></i></span>
                    </td>
                </tr>

            ';
        }
    }

    public function view_data(request $request){
        $data=Pemilihan::orderBy('name','Asc')->get();
        echo'
            <style>
                th{
                   background:#d1d1dc;
                   text-align:center;
                }
            </style>
            <table width="100%" class="table table-bordered table-hover dataTable">
                <tr>
                    <th width="5%">No</th>
                    <th width="27%">Nama Pemilihan</th>
                    <th width="10%">Periode</th>
                    <th>Calon</th>
                    <th width="6%">Tambah</th>
                    <th width="6%">Aktif</th>
                    <th width="6%">Status</th>
                    <th width="8%"></th>
                </tr>

        ';

        foreach($data as $no=>$o){
            $detail=Detailpemilihan::where('pemilihan_id',$o['id'])->get();
            echo'
                <tr>
                    <td>'.($no+1).'</td>
                    <td>'.$o['name'].'</td>
                    <td>'.$o['periode'].'</td>
                    <td>';
                        foreach($detail as $no=>$det){
                            if(($no+1)%2==0){$color='success';}else{$color='primary';}
                            echo'<span class="label label-'.$color.'" style="margin-right:1%;font-size:12px;">['.$det['nik'].'] '.cek_pengguna($det['nik'])['name'].'</span>';
                        }
                    echo'
                    </td>
                    <td><span class="btn btn-primary btn-xs" onclick="tambah_paslon('.$o['id'].')"><i class="fa fa-users"></i></span></td>
                    <td>';
                        if($o['sts']==0){
                            echo'<span class="btn btn-default btn-xs" onclick="aktif('.$o['id'].')"><i class="fa fa-remove"></i> Off</span>';
                        }else{
                            echo'<span class="btn btn-success btn-xs" onclick="non_aktif('.$o['id'].')"><i class="fa fa-check"></i> Aktif</span>';
                        }
                        echo'
                        
                    </td>
                    <td>';
                        if($o['mulai']==0){
                            echo'<span class="btn btn-default btn-xs" onclick="hidupkan('.$o['id'].')"><i class="fa fa-remove"></i> Stop</span>';
                        }else{
                            echo'<span class="btn btn-success btn-xs" onclick="matikan('.$o['id'].')"><i class="fa fa-check"></i> Running</span>';
                        }
                        echo'
                        
                    </td>
                    <td>
                        <span class="btn btn-success btn-xs" onclick="ubah('.$o['id'].')"><i class="fa fa-pencil"></i></span>_
                        <span class="btn btn-danger btn-xs" onclick="hapus('.$o['id'].')"><i class="fa fa-remove"></i></span>
                    </td>
                </tr>

            ';
        }

        echo'</table>';
    }
    public function view_data_perunit(request $request){
        $data=Pemilihan::orderBy('name','Asc')->get();
        echo'
            <style>
                th{
                   background:#d1d1dc;
                   text-align:center;
                }
            </style>
            <table width="100%" class="table table-bordered table-hover dataTable">
                <tr>
                    <th width="5%">No</th>
                    <th width="27%">Nama Pemilihan</th>
                    <th width="10%">Periode</th>
                    <th>Calon</th>
                    <th width="6%">Tambah</th>
                    <th width="6%">Aktif</th>
                    <th width="6%">Status</th>
                </tr>

        ';

        foreach($data as $no=>$o){
            if(Auth::user()['role_id']==1){
                $detail=Detailpemilihan::where('pemilihan_id',$o['id'])->get();
            }
            if(Auth::user()['role_id']==3){
                
                $detail=Detailpemilihan::where('pemilihan_id',$o['id'])->where('kode_group',cek_kode_group())->get();
            }
            
            echo'
                <tr>
                    <td>'.($no+1).'</td>
                    <td>'.$o['name'].'</td>
                    <td>'.$o['periode'].'</td>
                    <td>';
                        foreach($detail as $no=>$det){
                            if(($no+1)%2==0){$color='success';}else{$color='primary';}
                            echo'<span class="label label-'.$color.'" style="margin-right:1%;font-size:12px;">['.$det['nik'].'] '.cek_pengguna($det['nik'])['name'].'</span>';
                        }
                    echo'
                    </td>
                    <td><span class="btn btn-primary btn-xs" onclick="tambah_paslon('.$o['id'].')"><i class="fa fa-users"></i></span></td>
                    <td>';
                        if($o['sts']==0){
                            echo'<span class="btn btn-default btn-xs" ><i class="fa fa-remove"></i> Off</span>';
                        }else{
                            echo'<span class="btn btn-success btn-xs" ><i class="fa fa-check"></i> Aktif</span>';
                        }
                        echo'
                        
                    </td>
                    <td>';
                        if($o['mulai']==0){
                            echo'<span class="btn btn-default btn-xs" ><i class="fa fa-remove"></i> Stop</span>';
                        }else{
                            echo'<span class="btn btn-success btn-xs" ><i class="fa fa-check"></i> Running</span>';
                        }
                        echo'
                        
                    </td>
                    
                </tr>

            ';
        }

        echo'</table>';
    }

    public function view_data_unit(request $request){
        $cek=strlen($request->text);
        if($cek>0){
            $data=Unit::where('name','LIKE','%'.$request->text.'%')->orWhere('kode_unit','LIKE','%'.$request->text.'%')->orderBy('name','Asc')->paginate(50);
        }else{
            $data=Unit::orderBy('name','Asc')->paginate(50);
        }
        
        echo'
            <style>
                th{
                   background:#d1d1dc;
                   text-align:center;
                   padding-left:5px;
                   font-size:12px;
                   border:solid 1px aqua;
                }
                td{
                   padding:4px;
                   font-size:12px;
                   border:solid 1px aqua;
                }
            </style>
            <table width="100%" >
                <tr>
                    <th width="5%"></th>
                    <th width="10%">Kode Unit</th>
                    <th>Nama</th>
                </tr>

        ';

        foreach($data as $no=>$o){
            if(cek_detail_group($request->kode_group,$o['kode_unit'])>0){

            }else{
                echo'
                    <tr>
                        <td><span class="btn btn-success btn-xs" onclick="tambah_unit(`'.$o['kode_unit'].'`,`'.$request->kode_group.'`)"><i class="fa fa-plus"></i></span></td>
                        <td>'.$o['kode_unit'].' </td>
                        <td>'.cek_kategori($o['sts']).' '.$o['name'].'</td>
                        
                    </tr>

                ';
            }
        }

        echo'</table>';
    }

    public function tambah_unit(request $request){
        $data   = New Detailgroup;
        $data->kode_unit = $request->unit;
        $data->kode_group = $request->group;
        $data->save();
    }
    
    public function simpan(request $request){
        
        if (trim($request->name) == '') {$error[] = '-Isi Nama Pemilihan terlebih dahulu';}
        if (trim($request->periode) == '') {$error[] = '-Isi Periode terlebih dahulu';}
        if (isset($error)) {echo '<p style="padding:5px;background:#d1ffae;font-size:12px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            $cek=Pemilihan::where('name',$request->name)->where('periode',$request->periode)->count();
            if($cek>0){
                echo '<p style="padding:5px;background:#d1ffae;font-size:12px"><b>Error</b>: <br /> Nama pemilihan sudah terdaftar</p>';
            }else{
                $data           = New Pemilihan;
                $data->name     = $request->name;
                $data->periode     = $request->periode;
                $data->sts     = 0;
                $data->mulai     = 0;
                $data->save();

                if($data){
                   
                    echo'ok';
                }
            }
        }
    }

    public function simpan_paslon(request $request){
        
        if (trim($request->pemilihan_id) == '') {$error[] = '-Isi id terlebih dahulu';}
        if (trim($request->nik) == '') {$error[] = '-Isi NIK terlebih dahulu';}
        if (isset($error)) {echo '<p style="padding:5px;background:#d1ffae;font-size:12px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            
            $cek=Detailpemilihan::where('nik',$request->nik)->where('pemilihan_id',$request->pemilihan_id)->count();
            if($cek>0){
                echo '<p style="padding:5px;background:#d1ffae;font-size:12px"><b>Error</b>: <br /> NIK sudah terdaftar calon pemilihan ini</p>';
            }else{
                $data                   = New Detailpemilihan;
                $data->pemilihan_id     = $request->pemilihan_id;
                $data->nik              = $request->nik;
                $data->kode_group        = cek_pengguna($request->nik)->detailgroup['kode_group'];
                $data->save();

                if($data){
                   
                    echo'ok@'.$request->pemilihan_id;
                }
            }
        }
    }

    public function simpan_ubah(request $request){
        
        if (trim($request->name) == '') {$error[] = '-Isi Nama Group terlebih dahulu';}
        if (isset($error)) {echo '<p style="padding:5px;background:#d1ffae;font-size:12px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            
                $data           = Pemilihan::find($request->id);
                $data->name     = $request->name;
                $data->periode     = $request->periode;
                $data->mulai     = 0;
                $data->save();

                if($data){
                    echo'ok';
                }
           
        }
    }
}

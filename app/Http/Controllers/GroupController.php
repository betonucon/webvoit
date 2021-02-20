<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Group;
use App\User;
use App\Unit;
use App\Detailgroup;
class GroupController extends Controller
{
    public function index(request $request){
        $menu='Group';

        return view('group.index',compact('menu'));
    }
    public function pengguna(request $request){
        $menu='Pengguna Group';
        $kode_group=$request->kode_group;
        return view('group.pengguna',compact('menu','kode_group'));
    }
    
    public function hapus(request $request){
        $hapus=Group::where('id',$request->id)->delete();
        
    }
    public function hapus_pengguna(request $request){
        $hapus=Detailgroup::where('id',$request->id)->delete();
        
    }
    public function ubah(request $request){
        $data=Group::where('id',$request->id)->first();
        echo'
            <div class="form-group" style="margin-bottom: 0px;">
                <label>Nama Group</label>
                <input type="hidden" name="id" class="form-control" value="'.$data['id'].'">
                <input type="text" name="name" class="form-control" value="'.$data['name'].'">
            </div>
        ';
    }

    public function view_data_pengguna(request $request){
        $data=Detailgroup::where('kode_group',$request->kode_group)->get();
        echo'
            <style>
                th{
                   background:#d1d1dc;
                   text-align:center;
                   font-size:12px;
                   padding:0.3%;
                   border:solid 1px #dccdcd;
                }
                .ttd{
                   font-size:12px;
                   padding:0.3%;
                   border:solid 1px #dccdcd;
                }
            </style>
            <table width="100%" class="table-hover dataTable">
                <tr>
                    <th width="5%">No</th>
                    <th width="10%">NIK</th>
                    <th>Nama</th>
                    <th width="4%"></th>
                </tr>

        ';

        foreach($data as $no=>$o){
            
            echo'
                <tr>
                    <td class="ttd">'.($no+1).'</td>
                    <td class="ttd">'.$o['nik'].'</td>
                    <td class="ttd">'.cek_pengguna($o['nik'])['name'].' ['.cek_pengguna($o['nik'])['name'].']</td>
                    <td class="ttd">
                        <span class="btn btn-danger btn-xs" onclick="hapus('.$o['id'].')"><i class="fa fa-remove"></i></span>
                    </td>
                </tr>

            ';
        }

        echo'</table>';
    }

    public function view_data(request $request){
        $data=Group::orderBy('name','Asc')->get();
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
                    <th width="10%">Kode Group</th>
                    <th width="25%">Nama Group</th>
                    <th>Data Pengguna</th>
                    <th width="5%"></th>
                    <th width="8%"></th>
                </tr>

        ';

        foreach($data as $no=>$o){
            $detail=Detailgroup::where('kode_group',$o['kode_group'])->get();
            echo'
                <tr>
                    <td>'.($no+1).'</td>
                    <td>'.$o['kode_group'].'</td>
                    <td>'.$o['name'].'</td>
                    <td>';
                        foreach($detail as $no=>$det){
                            if(($no+1)%2==0){$color='success';}else{$color='primary';}
                            echo'<span class="label label-'.$color.'" style="margin-right:1%;font-size:12px;">['.$det['nik'].'] '.cek_pengguna($det['nik'])['name'].'</span>';
                        }
                    echo'
                    </td>
                    <td><span class="btn btn-primary btn-xs" onclick="tambah_pengguna(`'.$o['kode_group'].'`)"><i class="fa fa-users"></i></span></td>
                    <td>
                        <span class="btn btn-success btn-xs" onclick="ubah('.$o['id'].')"><i class="fa fa-pencil"></i></span>_
                        <span class="btn btn-danger btn-xs" onclick="hapus('.$o['id'].')"><i class="fa fa-remove"></i></span>
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
        $data->nik = $request->nik;
        $data->kode_group = $request->group;
        $data->save();
    }
    public function simpan_pengguna(request $request){
        if (trim($request->nik) == '') {$error[] = '- Pilih Pengguna terlebih dahulu';}
        if (isset($error)) {echo '<p style="padding:5px;background:#d1ffae;font-size:12px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            $cek=Detailgroup::where('nik',$request->nik)->count();
            if($cek>0){
                echo '<p style="padding:5px;background:#d1ffae;font-size:12px"><b>Error</b>: <br /> Data pengguna sudah terdaftar diunit SKKS</p>';
            }else{
                $data   = New Detailgroup;
                $data->nik = $request->nik;
                $data->kode_group = $request->kode_group;
                $data->save();

                echo'ok';
            }
        }
    }

    public function simpan(request $request){
        
        if (trim($request->kode_group) == '') {$error[] = '- Isi Kode Group terlebih dahulu';}
        if (trim($request->name) == '') {$error[] = '-Isi Nama terlebih dahulu';}
        if (isset($error)) {echo '<p style="padding:5px;background:#d1ffae;font-size:12px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            $cek=Group::where('name',$request->name)->orWhere('kode_group',$request->kode_group)->count();
            if($cek>0){
                echo '<p style="padding:5px;background:#d1ffae;font-size:12px"><b>Error</b>: <br /> Kode atau Nama Group sudah terdaftar</p>';
            }else{
                $data           = New Group;
                $data->name     = $request->name;
                $data->kode_group = kode_group();
                $data->users_id    = Auth::user()['id'];
                $data->save();

                if($data){
                   
                    echo'ok@'.$data->kode_group;
                }
            }
        }
    }

    public function simpan_ubah(request $request){
        
        if (trim($request->name) == '') {$error[] = '-Isi Nama Group terlebih dahulu';}
        if (isset($error)) {echo '<p style="padding:5px;background:#d1ffae;font-size:12px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            
                $data           = Group::find($request->id);
                $data->name     = $request->name;
                $data->save();

                if($data){
                    echo'ok';
                }
           
        }
    }
}

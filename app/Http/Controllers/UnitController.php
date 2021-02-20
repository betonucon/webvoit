<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Pengguna;
use App\User;
use App\Unit;
class UnitController extends Controller
{
    public function index(request $request){
        $menu='Unit SKKS';

        return view('unit.index',compact('menu'));
    }
    
    public function hapus(request $request){
        $hapus=Unit::where('id',$request->id)->delete();

    }
    public function cari_nik(request $request){
        $data=Pengguna::where('nik','LIKE','%'.$request->id.'%')->orWhere('name','LIKE','%'.$request->id.'%')->first();
        echo $data['nik'].'@['.$data['nik'].']'.$data['name'].' '.cek_unit($data['kode_unit']);

    }
    public function ubah(request $request){
        $data=Unit::where('id',$request->id)->first();
        echo'
            <div class="form-group" style="margin-bottom: 0px;">
                <label>Nama Unit</label>
                <input type="hidden" name="id" class="form-control" value="'.$data['id'].'">
                <input type="text" name="name" value="'.$data['name'].'" class="form-control">
            </div>
            <div class="form-group" style="margin-bottom: 0px;">
                <label>Kategori</label>
                <select name="sts" class="form-control">
                    <option value="">Pilih Kategori</option>';
                    foreach(kategori() as $kat){
                        if($kat['id']==$data['sts']){$cek='selected';}else{$cek='';}
                        echo'<option value="'.$kat['id'].'" '.$cek.'>'.$kat['name'].'</option>';
                    }
                echo'
                </select>
            </div>
        ';
    }
    
    public function view_data(request $request){
        $cek=strlen($request->text);
        if($cek>0){
            $data=Unit::where('kode_unit','LIKE','%'.$request->text.'%')->orWhere('name','LIKE','%'.$request->text.'%')->orderBy('name','Asc')->paginate(200);
        }else{
            $data=Unit::orderBy('name','Asc')->paginate(200);
        }
        
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
                    <th width="10%">Kode Unit</th>
                    <th>Nama</th>
                    <th width="16%">Tot Pegawai</th>
                    <th width="8%"></th>
                </tr>

        ';

        foreach($data as $no=>$o){
            echo'
                <tr>
                    <td>'.($no+1).'</td>
                    <td>'.$o['kode_unit'].'</td>
                    <td>'.cek_kategori($o['sts']).' '.$o['name'].'</td>
                    <td>'.cek_total($o['kode_unit']).'</td>
                    <td>
                        <span class="btn btn-success btn-xs" onclick="ubah('.$o['id'].')"><i class="fa fa-pencil"></i></span>_
                        <span class="btn btn-danger btn-xs" onclick="hapus('.$o['id'].')"><i class="fa fa-remove"></i></span>
                    </td>
                </tr>

            ';
        }

        echo'</table>';
    }

    public function simpan(request $request){
        
        if (trim($request->kode_unit) == '') {$error[] = '- Isi Kode Unit terlebih dahulu';}
        if (trim($request->name) == '') {$error[] = '-Isi Nama Unit terlebih dahulu';}
        if (trim($request->sts) == '') {$error[] = '- Isi Kategori terlebih dahulu';}
        if (isset($error)) {echo '<p style="padding:5px;background:#d1ffae;font-size:12px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            $cek=Unit::where('kode_unit',$request->nik)->orWhere('name',$request->name)->count();
            if($cek>0){
                echo '<p style="padding:5px;background:#d1ffae;font-size:12px"><b>Error</b>: <br /> Kode Unit atau Nama Unit sudah terdaftar</p>';
            }else{
                $data           = New Unit;
                $data->name     = $request->name;
                $data->kode_unit    = $request->kode_unit;
                $data->sts    = $request->sts;
                $data->save();

                if($data){
                    
                    echo'ok';
                }
            }
        }
    }

    public function simpan_ubah(request $request){
        
        if (trim($request->name) == '') {$error[] = '-Isi Nama Unit terlebih dahulu';}
        if (trim($request->sts) == '') {$error[] = '-Pilih Kategori terlebih dahulu';}
        if (isset($error)) {echo '<p style="padding:5px;background:#d1ffae;font-size:12px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            
                $data           = Unit::find($request->id);
                $data->name     = $request->name;
                $data->id       = $request->id;
                $data->save();

                if($data){
                   
                    echo'ok';
                }
           
        }
    }
}

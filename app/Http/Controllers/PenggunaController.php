<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Pengguna;
use App\Detailgroup;
use App\User;
use Illuminate\Support\Facades\Crypt;
class PenggunaController extends Controller
{
    public function enkripsi(request $request){
		$curl = curl_init();
        curl_setopt ($curl, CURLOPT_URL, "https://sso.krakatausteel.com/hci/pic/".deskripsi_akuh($request['text']).".jpg");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    
        $result = curl_exec ($curl);
        curl_close ($curl);
        print $result;
	}
    public function index(request $request){
        $menu='Pengguna';
        if(Auth::user()['role_id']==1){
            return view('pengguna.index',compact('menu'));
        }else{
            return view('404',compact('menu'));
        }
        
    }
    
    public function index_unit(request $request){
        $menu='Pengguna '.cek_name_group();
        if(Auth::user()['role_id']==3){
            return view('pengguna.index_unit',compact('menu'));
        }else{

        }
        
    }
    
    public function hapus(request $request){
        $data=Pengguna::where('id',$request->id)->first();
        $hapus=Pengguna::where('id',$request->id)->delete();
        $hapususer=User::where('username',$data['nik'])->delete();
        $detail=Detailgroup::where('nik',$data['nik'])->delete();

    }
    public function ubah(request $request){
        $data=Pengguna::where('id',$request->id)->first();
        echo'
            <div class="form-group" style="margin-bottom: 0px;">
                <label>Nama Pengguna</label>
                <input type="hidden" name="nik" class="form-control" value="'.$data['nik'].'">
                <input type="text" name="name" class="form-control" value="'.$data['name'].'">
            </div>
            <div class="form-group">
                <label>Foto Profil</label><br>';
                if($data['foto']==''){
                    echo'<input type="file" name="file" class="form-control"  placeholder="Isi disini">';
                }else{
                    echo'<img src="profil/'.$data['foto'].'" class="gambar-news"><br>
                    <span class="btn btn-danger btn-xs" onclick="hapus_gambar('.$data['id'].')"><i class="fa fa-remove"></i> Hapus</span>';
                }echo'
                
            </div>
            <div class="form-group" style="margin-bottom: 0px;">
                <label>Unit Kerja</label>
                <select name="kode_unit" class="form-control">
                    <option value="">Pilih Unit</option>';
                    foreach(unit() as $unit){
                        if($unit['kode_unit']==$data['kode_unit']){$cek='selected';}else{$cek='';}
                        echo'<option value="'.$unit['kode_unit'].'" '.$cek.'>'.cek_kategori($unit['sts']).' '.$unit['name'].'</option>';
                    }
                    echo'
                </select>
            </div>
            <div class="form-group" style="margin-bottom: 0px;">
                <label>Role</label>
                <select name="role_id" class="form-control">
                    <option value="">Pilih Role</option>
                    <option value="3" '; if(cek_user($data['nik'])['role_id']==3){echo'selected';} echo'>Admin Unit SKKS dan User Voting</option>
                    <option value="2" '; if(cek_user($data['nik'])['role_id']==2){echo'selected';} echo'>User Voting</option>
                    
                </select>
            </div>
        ';
    }
    public function view_data(request $request){
        $cek=strlen($request->text);
        if($cek>0){
            $data=Pengguna::with(['detailgroup'])->where('nik','LIKE','%'.$request->text.'%')->orWhere('name','LIKE','%'.$request->text.'%')->orderBy('name','Asc')->get();
        }else{
            $data=Pengguna::with(['detailgroup'])->orderBy('name','Asc')->paginate(100);
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
                    <th width="10%">NIK</th>
                    <th>Nama</th>
                    <th>Area Kerja</th>
                    <th>Unit SKKS</th>
                    <th width="8%"></th>
                </tr>

        ';

        foreach($data as $no=>$o){
            echo'
                <tr>
                    <td>'.($no+1).'</td>
                    <td>'.$o['nik'].'</td>
                    <td>'.$o['name'].'</td>
                    <td>'.cek_unit($o['kode_unit']).'</td>
                    <td>'.cek_groupnya($o->detailgroup['kode_group']).'</td>
                    
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
            $data=Detailgroup::with(['pengguna'])->where('kode_group',cek_kode_group())->where('nik','LIKE','%'.$request->text.'%')->orderBy('nik','Asc')->get();
        }else{
            $data=Detailgroup::with(['pengguna'])->where('kode_group',cek_kode_group())->orderBy('nik','Asc')->get();
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
                    <th width="10%">NIK</th>
                    <th>Nama</th>
                    <th>Area Kerja</th>
                    <th>Unit SKKS</th>
                    <th width="4%"></th>
                </tr>

        ';

        foreach($data as $no=>$o){
            echo'
                <tr>
                    <td>'.($no+1).'</td>
                    <td>'.$o['nik'].'</td>
                    <td>'.$o['pengguna']['name'].'</td>
                    <td>'.cek_unit($o['pengguna']['kode_unit']).'</td>
                    <td>'.cek_groupnya($o['kode_group']).'</td>';
                    if(Auth::user()['username']==$o['nik']){
                        echo'
                        <td>
                            <span class="btn btn-default btn-xs" ><i class="fa fa-remove"></i></span>
                        </td>
                        ';
                    }else{
                        echo'
                        <td>
                            <span class="btn btn-danger btn-xs" onclick="hapus('.$o['id'].')"><i class="fa fa-remove"></i></span>
                        </td>
                        ';
                    }
                    echo'
                    
                </tr>

            ';
            
        }

        echo'</table>';
    }

    public function simpan(request $request){
        
        if (trim($request->nik) == '') {$error[] = '- Isi NIK terlebih dahulu';}
        if (trim($request->name) == '') {$error[] = '-Isi Nama terlebih dahulu';}
        if (trim($request->kode_unit) == '') {$error[] = '- Pilih Unit Kerja terlebih dahulu';}
        if (trim($request->role_id) == '') {$error[] = '- Pilih role terlebih dahulu';}
        if (isset($error)) {echo '<p style="padding:5px;background:#d1ffae;font-size:12px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            $cek=User::where('username',$request->nik)->orWhere('email',$request->email)->count();
            if($cek>0){
                echo '<p style="padding:5px;background:#d1ffae;font-size:12px"><b>Error</b>: <br /> Nik atau Email sudah terdaftar</p>';
            }else{
                $patr='/\s+/';
                $email=preg_replace($patr,'.',$request->name);
                
                $data           = New User;
                $data->name     = $request->name;
                $data->username = $request->nik;
                $data->email    = $email;
                $data->role_id    = $request->role_id;
                $data->password = Hash::make($request->nik);
                $data->save();

                if($data){
                    $pengguna           = New Pengguna;
                    $pengguna->name     = $request->name;
                    $pengguna->kode_unit     = $request->kode_unit;
                    $pengguna->nik = $request->nik;
                    $pengguna->save();

                    echo'ok';
                }
                    
            }
        }
    }

    public function simpan_ubah(request $request){
        
        if (trim($request->name) == '') {$error[] = '-Isi Nama terlebih dahulu';}
        if (trim($request->kode_unit) == '') {$error[] = '- Pilih Unit Kerja terlebih dahulu';}
        if (trim($request->role_id) == '') {$error[] = '- Pilih role terlebih dahulu';}
        if (isset($error)) {echo '<p style="padding:5px;background:#d1ffae;font-size:12px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            
                $data           = User::where('username',$request->nik)->first();
                $data->name     = $request->name;
                $data->role_id     = $request->role_id;
                $data->save();

                if($data){
                    $pengguna           = Pengguna::where('nik',$request->nik)->first();
                    $pengguna->name     = $request->name;
                    $pengguna->kode_unit     = $request->kode_unit;
                    $pengguna->save();

                    echo'ok';
                }
            
           
        }
    }
}

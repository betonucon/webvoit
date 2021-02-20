<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Pengguna;
use App\Detailgroup;
use App\User;
class PenggunaController extends Controller
{
    public function index(request $request){
        $menu='Pengguna';

        return view('pengguna.index',compact('menu'));
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
        ';
    }
    public function view_data(request $request){
        $cek=strlen($request->text);
        if($cek>0){
            $data=Pengguna::with(['detailgroup'])->where('nik','LIKE','%'.$request->text.'%')->orWhere('name','LIKE','%'.$request->text.'%')->orderBy('name','Asc')->paginate(200);
        }else{
            $data=Pengguna::with(['detailgroup'])->orderBy('name','Asc')->paginate(200);
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

    public function simpan(request $request){
        
        if (trim($request->nik) == '') {$error[] = '- Isi NIK terlebih dahulu';}
        if (trim($request->name) == '') {$error[] = '-Isi Nama terlebih dahulu';}
        if (trim($request->kode_unit) == '') {$error[] = '- Pilih Unit Kerja terlebih dahulu';}
        if (trim($request->file) == '') {$error[] = '- Upload Foto Profil terlebih dahulu';}
        if (isset($error)) {echo '<p style="padding:5px;background:#d1ffae;font-size:12px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            $cek=User::where('username',$request->nik)->orWhere('email',$request->email)->count();
            if($cek>0){
                echo '<p style="padding:5px;background:#d1ffae;font-size:12px"><b>Error</b>: <br /> Nik atau Email sudah terdaftar</p>';
            }else{
                $patr='/\s+/';
                $file=$_FILES['file']['name'];
                $size=$_FILES['file']['size'];
                $asli=$_FILES['file']['tmp_name'];
                $ukuran=getimagesize($_FILES["file"]['tmp_name']);
                $tipe=explode('/',$_FILES['file']['type']);
                $filename=$request->nik.'.'.$tipe[1];
                $lokasi='profil/';
                $email=preg_replace($patr,'.',$request->name);
                if($tipe[0]=='image' && $size<=198640){
                    if(move_uploaded_file($asli, $lokasi.$filename)){
                        $data           = New User;
                        $data->name     = $request->name;
                        $data->username = $request->nik;
                        $data->email    = $email;
                        $data->role_id    = 2;
                        $data->password = Hash::make($request->nik);
                        $data->save();

                        if($data){
                            $pengguna           = New Pengguna;
                            $pengguna->name     = $request->name;
                            $pengguna->kode_unit     = $request->kode_unit;
                            $pengguna->nik = $request->nik;
                            $pengguna->foto = $filename;
                            $pengguna->save();

                            echo'ok';
                        }
                    }else{
                        echo '<p style="font-size:12px;padding:5px;background:#d1ffae"><b>Error</b>: <br />- Upload gagal</p>';
                    }
                }else{
                    echo '<p style="font-size:12px;padding:5px;background:#d1ffae"><b>Error</b>: <br />- Ukuran file max 200kb</br>- Type file harus gambar </br> - Dengan Lebar dan tinggi 1000X529</p>';
                }
                
            }
        }
    }

    public function simpan_ubah(request $request){
        
        if (trim($request->name) == '') {$error[] = '-Isi Nama terlebih dahulu';}
        if (trim($request->kode_unit) == '') {$error[] = '- Pilih Unit Kerja terlebih dahulu';}
        if (isset($error)) {echo '<p style="padding:5px;background:#d1ffae;font-size:12px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            if($request->file==''){
                $data           = User::where('username',$request->nik)->first();
                $data->name     = $request->name;
                $data->save();

                if($data){
                    $pengguna           = Pengguna::where('nik',$request->nik)->first();
                    $pengguna->name     = $request->name;
                    $pengguna->kode_unit     = $request->kode_unit;
                    $pengguna->save();

                    echo'ok';
                }
            }else{


                $file=$_FILES['file']['name'];
                $size=$_FILES['file']['size'];
                $asli=$_FILES['file']['tmp_name'];
                $ukuran=getimagesize($_FILES["file"]['tmp_name']);
                $tipe=explode('/',$_FILES['file']['type']);
                $filename=$request->nik.'.'.$tipe[1];
                $lokasi='profil/';
                if($tipe[0]=='image' && $size<=198640){
                    if(move_uploaded_file($asli, $lokasi.$filename)){
                        $data           = User::where('username',$request->nik)->first();
                        $data->name     = $request->name;
                        $data->save();

                        if($data){
                            $pengguna           = Pengguna::where('nik',$request->nik)->first();
                            $pengguna->name     = $request->name;
                            $pengguna->kode_unit     = $request->kode_unit;
                            $pengguna->foto     = $filename;
                            $pengguna->save();

                            echo'ok';
                        }   
                    }else{
                        echo '<p style="font-size:12px;padding:5px;background:#d1ffae"><b>Error</b>: <br />- Upload gagal</p>';
                    }
                }else{
                    echo '<p style="font-size:12px;padding:5px;background:#d1ffae"><b>Error</b>: <br />- Ukuran file max 200kb</br>- Type file harus gambar </br> - Dengan Lebar dan tinggi 1000X529</p>';
                }

            }
           
        }
    }
}

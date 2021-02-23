<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Pengguna;
use App\Detailgroup;
use App\Detailpemilihan;
use App\Pemilihan;
use App\User;
use App\Voters;
use App\Quickcount;
use Illuminate\Support\Facades\Crypt;

class QuickcountController extends Controller
{
    public function index(request $request){
        $menu='Quickcount';

        return view('quickcount.index',compact('menu'));
    }
    public function hapus(request $request){
        $hapus=Quickcount::where('id',$request->id)->delete();
        echo $request->id.'@'.$request->kode_group;
    }
    public function view_data_hasil(request $request){
        $data=Pemilihan::where('id',$request->pemilihan_id)->first();
        echo'
            <style>
                th{
                    background:#d1d1dc;
                    text-align:center;
                    padding:5px;
                    font-size:13px;
                    border:solid 1px aqua;
                }
                td{
                    padding:4px;
                    font-size:13px;
                    border:solid 1px aqua;
                }
            </style>
            <div class="box">
                
            
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box-header with-border">
                                <h3 class="box-title">Belum Melakukan Vote</h3>

                                <div class="box-tools pull-right">
                                
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <table width="100%" class="table-hover dataTable">
                                <tr> 
                                    <th width="15%">NIK</th>
                                    <th>NAMA</th>
                                </tr> ';
                            if($data['kat']==2){
                                $group=Voters::with(['pengguna'])->where('pemilihan_id',$request['pemilihan_id'])->get();
                                foreach($group as $no=>$gr){
                                    if(cek_quickcount($request['pemilihan_id'],$gr['nik'])>0){

                                    }else{
                                        echo'
                                        <tr>
                                            <td>'.$gr['nik'].'</td>
                                            <td>'.$gr['pengguna']['name'].'</td>
                                        </tr>
                                    ';
                                    }
                                    
                                }
                            }
                            
                            if($data['kat']==1){
                                $group=Detailgroup::with(['pengguna'])->where('kode_group',$request->kode_group)->get();
                                foreach($group as $no=>$gr){
                                    if(cek_quickcount($request['pemilihan_id'],$gr['nik'])>0){

                                    }else{
                                        echo'
                                        <tr>
                                            <td>'.$gr['nik'].'</td>
                                            <td>'.$gr['pengguna']['name'].'</td>
                                        </tr>
                                    ';
                                    }
                                }
                            }

                        echo'   
                            </table>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="box-header with-border">
                                <h3 class="box-title">Sudah Melakukan Vote</h3>

                                <div class="box-tools pull-right">
                                
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <table width="100%" class="table-hover dataTable">
                                <tr> 
                                    <th width="6%">NO</th>
                                    <th width="15%">NIK</th>
                                    <th>NAMA</th>
                                    <th width="6%"></th>
                                </tr> ';
                                if(Auth::user()['role_id']==1){
                                    if($data['kat']==1){
                                        $sudah=Quickcount::with(['pengguna'])->where('pemilihan_id',$request['pemilihan_id'])->where('kode_group',$request->kode_group)->get();
                                    }
                                    if($data['kat']==2){
                                        $sudah=Quickcount::with(['pengguna'])->where('pemilihan_id',$request['pemilihan_id'])->get();
                                    }
                                }
                                if(Auth::user()['role_id']==3){
                                    $sudah=Quickcount::with(['pengguna'])->where('pemilihan_id',$request['pemilihan_id'])->where('kode_group',cek_kode_group())->get();
                                }
                                
                                foreach($sudah as $no=>$sud){
                                    echo'
                                        <tr>
                                            <td>'.($no+1).'</td>
                                            <td>'.$sud['nik'].'</td>
                                            <td>'.$sud['pengguna']['name'].'</td>';
                                            if(Auth::user()['role_id']==1){
                                                echo'<td><span class="btn btn-danger btn-xs" onclick="hapus('.$sud['id'].',`'.$request->kode_group.'`)"><i class="fa fa-remove"></i></span></td>';
                                            }
                                            if(Auth::user()['role_id']==3){
                                                echo'<td><span class="btn btn-default btn-xs"><i class="fa fa-check"></i></span></td>';
                                            }
                                            echo'
                                        </tr>
                                    ';
                                }
                            echo'
                            </table>
                        </div>
                    
                    </div>
                    
                </div>
            
            
            </div>
       
        

        ';
    }
    public function simpan(request $request){
        $cek=Detailpemilihan::where('id',$request->id)->first();
        $cek_pilih=Quickcount::where('pemilihan_id',$request->id)->where('nik',$cek['nik'])->count();
        if($cek_pilih>0){
            
        }else{
            $data               = new Quickcount;
            $data->username     = Auth::user()['username'];
            $data->kode_group     = $cek['kode_group'];
            $data->pemilihan_id     = $cek['pemilihan_id'];
            $data->detailpemilihan_id     = $cek['id'];
            $data->nik     = $cek['nik'];
            $data->waktu     = date('Y-m-d H:i:s');
            $data->save();
        }
            
    }

    public function view_data(request $request){
        if(Auth::user()['role_id']==1){
            $data=Quickcount::select('pemilihan_id')->with(['pemilihan'])->groupBy('pemilihan_id')->get();
        }
        if(Auth::user()['role_id']==3){
            $data=Quickcount::select('pemilihan_id')->with(['pemilihan'])->groupBy('pemilihan_id')->get();
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
                    <th width="27%">Nama Pemilihan</th>
                    <th width="10%">Periode</th>
                    <th>Calon</th>
                    <th width="4%">Pas</th>
                </tr>

        ';

        foreach($data as $no=>$o){
            if(Auth::user()['role_id']==1){
                if($o['pemilihan']['kat']==1){
                    $detail=Detailpemilihan::where('pemilihan_id',$o['pemilihan_id'])->where('kode_group',$request->kode_group)->get();
                }
                if($o['pemilihan']['kat']==2){
                    $detail=Detailpemilihan::where('pemilihan_id',$o['pemilihan_id'])->get();
                }
                
            }
            if(Auth::user()['role_id']==3){
                $detail=Detailpemilihan::where('pemilihan_id',$o['pemilihan_id'])->where('kode_group',cek_kode_group())->get();
            }
            
            if($o['pemilihan']['kat']==2){$color="#f4f4f7";$evot='<span class="btn btn-default btn-xs"><i class="fa fa-users"></i></span>';}
            if($o['pemilihan']['kat']==1){$color="#fff";$evot='<span class="btn btn-xs btn-success" onclick="tambah_voters('.$o['id'].')"><i class="fa fa-users"></i></span>';}
            if(Auth::user()['role_id']==3){  
                if($o['pemilihan']['kat']==1){      
                    echo'
                        <tr bgcolor="'.$color.'">
                            <td></td>
                            <td>'.$o['pemilihan']['name'].' </td>
                            <td>'.$o['pemilihan']['periode'].'</td>
                            <td>';
                                foreach($detail as $no=>$det){
                                    if(($no+1)%2==0){$color='success';}else{$color='primary';}
                                    echo'<span class="label label-'.$color.'" style="margin-right:1%;font-size:12px;">['.$det['nik'].'] '.cek_pengguna($det['nik'])['name'].' <span class="label label-warning">'.cek_hasil($det['nik'],$o['pemilihan_id'],$det['kode_group']).'</span></span>';
                                }
                            echo'
                            </td>';
                            if(Auth::user()['role_id']==1){ 
                                echo'<td><span class="btn btn-primary btn-xs" onclick="tambah_paslon('.$o['pemilihan_id'].',`'.$request->kode_group.'`)"><i class="fa fa-users"></i></span></td>';
                            }
                            if(Auth::user()['role_id']==3){ 
                                echo'<td><span class="btn btn-primary btn-xs" onclick="tambah_paslon('.$o['pemilihan_id'].',`'.cek_kode_group().'`)"><i class="fa fa-users"></i></span></td>';
                            }
                            
                            
                            echo'
                        </tr>

                    ';
                }else{

                }
            }else{
                    echo'
                        <tr bgcolor="'.$color.'">
                            <td></td>
                            <td>'.$o['pemilihan']['name'].'</td>
                            <td>'.$o['pemilihan']['periode'].'</td>
                            <td>';
                                foreach($detail as $no=>$det){
                                    if(($no+1)%2==0){$color='success';}else{$color='primary';}
                                    echo'<span class="label label-'.$color.'" style="margin-right:1%;font-size:12px;">['.$det['nik'].'] '.cek_pengguna($det['nik'])['name'].' <span class="label label-warning">'.cek_hasil($det['nik'],$o['pemilihan_id'],$det['kode_group']).'</span></span>';
                                }
                            echo'
                            </td>
                            <td><span class="btn btn-primary btn-xs" onclick="tambah_paslon('.$o['pemilihan_id'].',`'.$request->kode_group.'`)"><i class="fa fa-clone"></i></span></td>
                            
                        </tr>

                    ';
            }
        }

        echo'</table>';
    }
}

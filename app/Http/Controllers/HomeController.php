<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Pemilihan;
use App\Detailpemilihan;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $menu='Home';
        $cek=Pemilihan::where('sts',1)->orderBy('id','desc')->firstOrFail();
        
        $namaevote=$cek['name'];
        if(Auth::user()['role_id']==1){
            $menu='Home';
            return view('home_admin',compact('menu'));
        }
        if(Auth::user()['role_id']==3){
            $menu='Home';
            return view('home_admin',compact('menu'));
        }
        if(Auth::user()['role_id']==2){
            $cekaktif=Pemilihan::where('sts',1)->orderBy('id','desc')->count();
            if($cekaktif>0){
                $menu='E-vote';
                return view('home',compact('menu','namaevote'));
            }else{
                return view('blank');
            }
        }
        
    }
    public function pilih_load()
    {   for($x=1;$x<10;$x++){
            echo'
                <div class="colom-25">
                    <div class="nomor_user">
                    NO 
                    </div>
                    <div class="img_user">
                        <img src="'.url('img/pilih.png').'"  class="imgnya" alt="User Image">
                    </div>
                    <div class="nama_user">
                        &nbsp;<br>
                        &nbsp;
                    </div>
                    <div class="nama_user_no">
                        
                    &nbsp;
                    </div>
                </div>
            ';
        }
    }
    public function pilih()
    {
        $cekaktif=Pemilihan::where('sts',1)->orderBy('id','desc')->count();
        if($cekaktif>0){
            $cek=Pemilihan::where('sts',1)->orderBy('id','desc')->firstOrFail();
            $menu='E-vote';
            $namaevote=$cek['name'];
            if(Auth::user()['role_id']==1){
                return view('home',compact('menu','namaevote'));
            }
            if(Auth::user()['role_id']==3){
                return view('home',compact('menu','namaevote'));
            }
            if(Auth::user()['role_id']==2){
               
            }
        }else{
            return view('blank');
        }
        
        
    }

    
}

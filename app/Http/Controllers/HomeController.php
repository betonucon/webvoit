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
            $menu='E-vote';
            return view('home',compact('menu','namaevote'));
        }
        
    }
    public function pilih()
    {
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
        
    }

    
}

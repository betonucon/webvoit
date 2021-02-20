<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
        if(Auth::user()['role_id']==1){
            return view('home_admin',compact('menu'));
        }
        if(Auth::user()['role_id']==2){
            return view('home',compact('menu'));
        }
        
    }

    
}

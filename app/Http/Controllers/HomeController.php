<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
    public function redirect(){
//        $d ="admin";
//        $usertype=Auth::user()->user_type_id;
//    dd($usertype);die;
//        if($usertype==1){
             // return view('home')->with(compact('d'));
           return view('admin.ltr.index');
//        }else{
//            $d ="user";
//            return view('home')->with(compact('d'));
//
//        }
    }
//    public function showUsers(){
//        $users = User::all();
//        return view('admin.ltr.includes.users')->with(compact('users'));
//    }

    public function index()
    {
        return view('home');
    }
}

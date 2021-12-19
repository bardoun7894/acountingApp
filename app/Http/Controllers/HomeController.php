<?php

namespace App\Http\Controllers;
use App\Models\Translation;
use  \Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Auth ;
use Illuminate\Http\Request;
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

        $lang =Translation::getLang();
       $local_full_name=User::getFullName($lang);
      return view('admin.ltr.index')->with(compact(['local_full_name','lang']));
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

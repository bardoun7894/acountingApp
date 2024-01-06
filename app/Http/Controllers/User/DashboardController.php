<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;


class DashboardController extends Controller
{
    public function index(){
        $d="user";
        return view('layouts.dashboard')->with(compact('d'));
    }
}

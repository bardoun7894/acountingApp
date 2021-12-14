<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.ltr.includes.users.users')->with(compact('users'));

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.ltr.includes.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_type_id' => 'required',
            'full_name' => 'required',
            'username' => 'required|unique',
            'contact_number' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
          $user =new User();
          $user->user_type_id =(int)$request->user_type_id;
          $user->full_name = $request->full_name;
          $user->username = $request->username;
          $user->contact_number = $request->contact_number;
          $user->email = $request->email;
          $user->password = bcrypt($request->password);
          $user->save();

          $session =Session::flash('message','User added Successfully');
          return redirect('users')->with(compact('session'));

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $user = User::find($id);
        return view('admin.ltr.includes.users.update')->with(compact('user'));
          }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_type_id' => 'required',
            'full_name' => 'required',
            'username' => 'required',
            'contact_number' => 'required',
            'email' => 'required|email|',
            'password' => 'required|min:6',
        ]);
        $user=User::find($id);
        $user->user_type_id =(int) $request->input('user_type_id');
        $user->full_name = $request->input('full_name');
        $user->username = $request->input('username');
        $user->contact_number = $request->input('contact_number');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        $user->update();

      $session =Session::flash('message','User Updated Successfully');
        return redirect('users')->with(compact('session'));
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $user=User::find($id);
       $user->delete();
       $session =Session::flash('message','User Deleted Successfully');
         return redirect('users')->with(compact('session'));


    }
}

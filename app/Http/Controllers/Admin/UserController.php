<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Translation;
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
    private $full_name ;
    function __construct()
    {
        $this->full_name=User::getFullnameLang();
    }

    public function index()
    {
        $users = User::all();
        return view('admin.includes.users.users')->with(compact('users'));

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.includes.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $full_name =$this->full_name;
        $validated = $request->validate([
            'user_type_id' => 'required',
            $full_name => 'required',
            'username' => 'required|unique',
            'contact_number' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
          $user =new User();
          $user->user_type_id =(int)$request->user_type_id;
          $user->$full_name = $request->$full_name;
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
    {

        $full_name=$this->full_name;
        $user = User::find($id);
        return view('admin.includes.users.update')->with(compact(['user','full_name']));
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
        $full_name=$this->full_name;
        $validated = $request->validate([
            'user_type_id' => 'required',
            $full_name => 'required',
            'username' => 'required',
            'contact_number' => 'required',
            'email' => 'required|email|',
            'password' => 'required|min:6',
        ]);
        $user=User::find($id);
        $user->user_type_id =(int) $request->input('user_type_id');
        $user->$full_name = $request->input($full_name);
        $user->username = $request->input('username');
        $user->contact_number = $request->input('contact_number');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        $user->update();

      $session =Session::flash('message','User Updated Successfully');
        return redirect('users')->with(compact(['session','full_name']));
        //
    }

    public function deleteSupplier($id)
    {
        $user=User::find($id);
        $user->delete();
        $session =Session::flash('message','User Deleted Successfully');
        return redirect('users')->with(compact('session'));

    }
    public function searchUserFunction(Request $request){
        $full_name=$this->full_name;
        $search_text =$request->get('searchQuery');
        $users= User::where($full_name,'like','%'.$search_text.'%')->get();
        return  $users;
    }

    public function getUserInvoice(){
        $full_name=$this->full_name;
        $users = User::all();
        return view('admin.includes.users.user_invoice')->with(compact(['users','full_name']));

    }
}

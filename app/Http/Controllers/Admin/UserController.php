<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Store;
use App\Models\Translation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $full_name ;
    private $branch_name;
    private $store_name;
    private $lang;

    function __construct()
    {
        $this->full_name=User::getFullnameLang();
        $this->branch_name=Branch::getBranchNameLang();
        $this->store_name=Store::getStoreNameLang();
        $this->lang=Translation::getLang();
    }

    public function index()
    {
        $users = User::where('id','!=',Auth::user()->getAuthIdentifier())->get();

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
        $lang=$this->lang;
        $full_name = $this->full_name;
        $branch_name=$this->branch_name;
        $branches =Branch::all();
        $store_name=$this->store_name;
        $stores=Store::all();
         return view('admin.includes.users.create')->with(compact(['branches','lang','full_name','stores','branch_name','store_name']));
    }
    public function getSelectedBranchStore(Request $request){
        if($request->ajax()){
            $data=$request->all();
            $stores=Store::where('branch_id',$data['branch_id'])->get();
            $store_name=$this->store_name;
            return view('admin.includes.stores.select_store')->with(compact(['stores','store_name',]));
        }
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
            'username' => 'required|unique',
            $full_name => 'required',
            'contact_number' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => ['required','min:6'],
            'user_type_id' => ['required']
        ]);
          $user =new User();
          $user->user_type_id =(int) $request->user_type_id;
          $user->$full_name = $request->$full_name;
          $user->username = $request->username;
          $user->contact_number = $request->contact_number;
          $user->email = $request->email;
          $user->password = Hash::make($request->password);
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
        $lang=$this->lang;

        $full_name=$this->full_name;
        $user = User::find($id);
        $lang=$this->lang;
        return view('admin.includes.users.update')->with(compact(['user','lang','full_name']));
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
//        'password' => 'required|min:6',
        ]);
        $user=User::find($id);
        $user->user_type_id =(int) $request->user_type_id;
        $user->$full_name = $request->$full_name;
        $user->username = $request->username;
        $user->contact_number = $request->contact_number;
        $user->email = $request->email;
        if($request->password !=""){
            $user->password = bcrypt($request->password);
         }
        $user->save();

      $session =Session::flash('message','User Updated Successfully');
        return redirect('users')->with(compact(['session','full_name']));
    }

    public function deleteUser($id)
    {
        $user=User::find($id);
        $user->delete();
        $session =Session::flash('message','User Deleted Successfully');
        return redirect('users')->with(compact('session'));

    }


    public function getUserInvoice(){
        $full_name=$this->full_name;
        $users = User::all();
        return view('admin.includes.users.user_invoice')->with(compact(['users','full_name']));

    }
}

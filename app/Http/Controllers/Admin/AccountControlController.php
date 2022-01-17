<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountControl;
use App\Models\AccountHead;
use App\Models\Translation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use function PHPUnit\Framework\isEmpty;

class AccountControlController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     private $account_control_name;

     function __construct()
     {
         $this->account_control_name =AccountControl::getAccountControlNameLang();
     }

    public function index()
    {
        $account_head_name=AccountHead::getAccounHeadNameLang();

        $account_control_name=$this->account_control_name;
//        $accountHeads= AccountHead::with('accountControls')->get();
     $accountControls= AccountControl::with('accountHead')->get();

//return $accountControls;
        return view('admin.includes.accountControls.accountControls')->with(compact(['accountControls','account_control_name','account_head_name']));

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lang=Translation::getLang();
        $account_control_name=$this->account_control_name;
        $account_head_name=AccountHead::getAccounHeadNameLang();
        $accountHeads=AccountHead::with('accountControls')->get();
//        return $accountHead->get();
        return view('admin.includes.accountControls.create')->with(compact(['accountHeads','lang','account_control_name','account_head_name']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        $account_control_name=$this->account_control_name;
        $validated = $request->validate([
            'account_head_id' => 'required',
            $account_control_name => 'required',
        ]);
        $accountControl =new AccountControl();
        $accountControl->user_id = Auth::user()->getAuthIdentifier();
        $accountControl->$account_control_name =$request->$account_control_name ;
        $accountControl->account_head_id =$request->account_head_id ;
        $lastAccountControl =AccountControl::where('account_head_id','=',$accountControl->account_head_id)->latest()->first();
        $accountHead=AccountHead::where('id',$request->account_head_id)->first();

        if(  $lastAccountControl==null ){
          $accountControl->account_code = $accountHead->account_code . 1;
        }else {
          $accountControl->account_code = $lastAccountControl->account_code +1;
        }



        $accountControl->save();
        $session =Session::flash('message','AccountControl added Successfully');
        return redirect('accountControls')->with(compact(['session', 'account_control_name']));

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
        $account_head_name=AccountHead::getAccounHeadNameLang();

        $lang=Translation::getLang();
        $account_control_name=$this->account_control_name;
        $accountControl = AccountControl::find($id);
//        $category = Category::find($id);
        $accountHeade =AccountHead::where('id',$accountControl->account_head_id)->first();
        $accountHead_list=AccountHead::all();


        return view('admin.includes.accountControls.update')->with(compact(['accountControl','accountHeade','account_control_name','account_head_name','lang','accountHead_list']));
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

        $account_control_name=$this->account_control_name;


        $validated = $request->validate([
            $account_control_name => 'required',
            'account_head_id' => 'required',
        ]);

        $accountControl=AccountControl::find($id);
        $accountControl->$account_control_name = $request->input($account_control_name);
        $accountControl->account_head_id = $request->input('account_head_id');
        $accountControl->user_id = Auth::user()->getAuthIdentifier();
        $accountControl->update();

        $session =Session::flash('message','AccountControl Updated Successfully');
        return redirect('accountControls')->with(compact('session'));
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
        $accountControl=AccountControl::find($id);
        $accountControl->delete();
        $session =Session::flash('message','AccountControl Deleted Successfully');
        return redirect('accountControls')->with(compact('session'));
    }
    public function deleteAccountControl($id){
        $accountControl=AccountControl::find($id);
        $accountControl->delete();
        $session =Session::flash('message','AccountControl Deleted Successfully');
        return redirect('accountControls')->with(compact('session'));
    }

    public function searchAccountControlFunction(Request $request){
        $account_head_name=AccountHead::getAccounHeadNameLang();
        $account_control_name=$this->account_control_name;
        $search_text =$request->get('searchQuery');
    $accountControls= AccountControl::with('accountHead')->where($account_control_name,'like','%'.$search_text.'%')->get();
      return  $accountControls;
//      return view('admin.includes.accountSubControls')->with(compact('accountSubControls'));
//        return view('admin.includes.accountControls.accountControls')->with(compact(['accountControls','account_control_name','account_head_name']));

    }
}

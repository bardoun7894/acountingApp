<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountControl;
use App\Models\AccountSubControl;
use App\Models\AccountHead;
use App\Models\Translation;
use App\Rules\ValidRangeAccountNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Input\Input;

class AccountSubControlController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $account_sub_control_name;
    private $account_control_name;
    private $account_head_name;

    function __construct()
    {
        $this->account_sub_control_name =AccountSubControl::getAccountSubControlNameLang();
        $this->account_control_name =AccountControl::getAccountControlNameLang();
        $this->account_head_name =AccountHead::getAccounHeadNameLang();
    }

    public function index()
    {
        $lang=Translation::getLang();
        $account_head_name=AccountHead::getAccounHeadNameLang();
        $account_control_name=$this->account_control_name;
        $account_sub_control_name=$this->account_sub_control_name ;
//      $accountHeads= AccountHead::with('accountSubControls')->get();
        $accountSubControls= AccountSubControl::with('accountHead','accountControl','user')->get();
//        return $accountSubControl;die;
        return view('admin.includes.accountSubControls.accountSubControls')->with(compact(['accountSubControls','account_sub_control_name','account_control_name','account_head_name','lang']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lang=Translation::getLang();
        $account_sub_control_name=$this->account_sub_control_name;
        $account_control_name=$this->account_control_name;
        $account_head_name=$this->account_head_name;
//        $accountSubControls=AccountSubControl::with(['accountControl','accountHead','user'])->get();
        $accountHeads=AccountHead::with('accountControls')->get();

        return view('admin.includes.accountSubControls.create')->with(compact(['lang','account_sub_control_name','account_head_name','account_control_name','accountHeads']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $account_sub_control_name=$this->account_sub_control_name;

        $validated = $request->validate([
            'account_head_id' => 'required',
            $account_sub_control_name => 'required',
            'account_control_id'=> 'required',
//            $account_head_name => 'required',
        ]);
        $accountSubControl =new AccountSubControl();
        $accountSubControl->user_id = Auth::user()->getAuthIdentifier();
        $accountSubControl->$account_sub_control_name =$request->$account_sub_control_name;
        $accountSubControl->account_head_id =$request->account_head_id;
        $accountSubControl->account_control_id =$request->account_control_id;

        //make the relation ship between accounts

        $lastAccountSubControl =AccountSubControl::where('account_control_id','=',$accountSubControl->account_control_id)->latest()->first();
        $accountControl=AccountControl::where('id',$accountSubControl->account_control_id)->first();
        if(  $lastAccountSubControl==null ){
            $accountSubControl->account_code = $accountControl->account_code . 1;
        }else {
            $accountSubControl->account_code = $lastAccountSubControl->account_code +1;
        }



        $accountSubControl->save();

        $session =Session::flash('message','AccountSubControl added Successfully');
        return redirect('accountSubControls')->with(compact(['session', 'account_sub_control_name']));

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
        $lang=Translation::getLang();
        $account_sub_control_name=$this->account_sub_control_name;
        $account_control_name=$this->account_control_name;
        $account_head_name=$this->account_head_name;

//      $accountSubControls=AccountSubControl::with(['accountControl','accountHead','user'])->get();
//      $accountHeads=AccountHead::with('accountControls')->get();

        $accountSubControl = AccountSubControl::find($id);
        ######################## using this for get the Head Account and Control Account by id ########################
        $accountHeade =AccountHead::where('id',$accountSubControl->account_head_id)->first();
        $accountControle =AccountControl::where('id',$accountSubControl->account_control_id)->first();
        ######################## using this for get all the Head Account and Control Account ########################

        $accountHead_list=AccountHead::all();
        $accountControl_list=AccountControl::all();

        return view('admin.includes.accountSubControls.update')->with(compact(['accountSubControl','accountHeade','accountControle','account_sub_control_name','account_control_name','account_head_name','lang','accountHead_list','accountControl_list']));
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
        $account_sub_control_name=$this->account_sub_control_name;

        $validated = $request->validate([
            $account_sub_control_name => 'required',
            'account_head_id' => 'required',
            'account_control_id' => 'required',
        ]);
        $accountSubControl=AccountSubControl::find($id);
        $accountSubControl->$account_sub_control_name = $request->input($account_sub_control_name);
        $accountSubControl->account_head_id = $request->input('account_head_id');
        $accountSubControl->account_control_id = $request->input('account_control_id');
        $accountSubControl->user_id = Auth::user()->getAuthIdentifier();
        $accountSubControl->update();

        $session =Session::flash('message','AccountSubControl Updated Successfully');
        return redirect('accountSubControls')->with(compact('session'));
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getSelectedAccountControl(Request $request){
        if($request->ajax()){
           $data=$request->all();
           #################this for update page ################
            if($data['account_sub_control_id']!=null){
                 $accountSubControl = AccountSubControl::find($data['account_sub_control_id']);
                 $accountControle =AccountControl::where('id',$accountSubControl->account_control_id)->first();
                 $accountControl=AccountControl::where('account_head_id',$data['account_head_id'])->get();
                 return response()->json([$accountControl,$accountControle]);
             }else{
                 #################this for create page ################
                 $accountControl=AccountControl::where('account_head_id',$data['account_head_id'])->get();
                 return response()->json([ $accountControl]);
               }
            ######################## using this for get the Head Account and Control Account by id ########################
        }
    }

    public function deleteAccountSubControl($id){
        $accountSubControl=AccountSubControl::find($id);
        $accountSubControl->delete();
        $session =Session::flash('message','AccountSubControl Deleted Successfully');
        return redirect('accountSubControls')->with(compact('session'));
    }

}

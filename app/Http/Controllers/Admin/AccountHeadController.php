<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountHead;
use App\Models\Translation;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AccountHeadController extends Controller
{


    private $account_head_name;
private $user_type;
    function __construct(){
        $this->account_head_name=AccountHead::getAccounHeadNameLang();
        $this->user_type=UserType::getUserTypeLang();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_head_name=$this->account_head_name;
        $user_type=$this->user_type;

        $users= User::with('accountHeads','user_type')->get();

        return view('admin.includes.accountHeads.accountHeads')->with(compact(['users','account_head_name','user_type']));

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $account_head_name = $this->account_head_name;

        $lang=Translation::getLang();
        return view('admin.includes.accountHeads.create')->with(compact(['lang','account_head_name']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $account_head_name=$this->account_head_name;
        $validated = $request->validate([
            $account_head_name => 'required',
        ]);
        $accountHead =new AccountHead();
        $accountHead->user_id = Auth::user()->getAuthIdentifier();
        $accountHead->$account_head_name =$request->$account_head_name;
        $accountHead->save();

        $session =Session::flash('message',__('messages.accountHead'));
        return redirect('accountHeads')->with(compact(['session','account_head_name']));

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

        $accountHead = AccountHead::find($id);
        $account_head_name =$this->account_head_name;
        $lang=Translation::getLang();
        return view('admin.includes.accountHeads.update')->with(compact(['accountHead','account_head_name','lang']));
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
        $account_head_name =$this->account_head_name;

        $validated = $request->validate([
            $account_head_name => 'required',
        ]);
        $accountHead=AccountHead::find($id);
        $accountHead->$account_head_name = $request->input($account_head_name);
        $accountHead->update();

        $session =Session::flash('message',__('messages.accountHead_updated'));
        return redirect('accountHeads')->with(compact(['session','account_head_name']));
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
        $accountHead=AccountHead::find($id);
        $accountHead->delete();
        $session =Session::flash('message',__('messages.accountHead_deleted'));
//return  __('messages.accountHead_deleted');
        return redirect('accountHeads')->with(compact('session'));

    }
}

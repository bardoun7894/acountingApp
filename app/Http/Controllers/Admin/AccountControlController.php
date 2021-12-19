<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountControl;
use App\Models\AccountHead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AccountControlController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accountHeads= AccountHead::with('accountControls')->get();
//return $accountHeads;
        return view('admin.ltr.includes.accountControls.accountControls')->with(compact('accountHeads'));

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accountHeads=AccountHead::with('accountControls')->get();
//        return $accountHead->get();
        return view('admin.ltr.includes.accountControls.create')->with(compact('accountHeads'));
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
            'account_head_id' => 'required',
            'account_control_name' => 'required',
        ]);
        $accountControl =new AccountControl();
        $accountControl->user_id = Auth::user()->getAuthIdentifier();
        $accountControl->account_control_name =$request->account_control_name;
        $accountControl->account_head_id =$request->account_head_id;
        $accountControl->save();

        $session =Session::flash('message','AccountControl added Successfully');
        return redirect('accountControls')->with(compact('session'));

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
    {   $accountControl = AccountControl::find($id);
//        $category = Category::find($id);
        $accountHeade =AccountHead::where('id',$accountControl->account_head_id)->first();
        $accountHead_list=AccountHead::all();

        return view('admin.ltr.includes.accountControls.update')->with(compact(['accountControl','accountHeade','accountHead_list']));
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
            'account_control_name' => 'required',
            'account_head_id' => 'required',
        ]);

        $accountControl=AccountControl::find($id);
        $accountControl->account_control_name = $request->input('account_control_name');
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
}

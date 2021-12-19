<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountHead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AccountHeadController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users= User::with('accountHeads','user_type')->get();
//return $users;
        return view('admin.ltr.includes.accountHeads.accountHeads')->with(compact('users'));

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ltr.includes.accountHeads.create');
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
            'account_head_name' => 'required',
        ]);
        $accountHead =new AccountHead();
        $accountHead->user_id = Auth::user()->getAuthIdentifier();
        $accountHead->account_head_name =$request->account_head_name;
        $accountHead->save();

        $session =Session::flash('message','AccountHead added Successfully');
        return redirect('accountHeads')->with(compact('session'));

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
    {   $accountHead = AccountHead::find($id);
        return view('admin.ltr.includes.accountHeads.update')->with(compact('accountHead'));
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
            'account_head_name' => 'required',
        ]);
        $accountHead=AccountHead::find($id);
        $accountHead->account_head_name = $request->input('account_head_name');
        $accountHead->update();

        $session =Session::flash('message','AccountHead Updated Successfully');
        return redirect('accountHeads')->with(compact('session'));
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
        $session =Session::flash('message','AccountHead Deleted Successfully');
        return redirect('accountHeads')->with(compact('session'));

    }
}

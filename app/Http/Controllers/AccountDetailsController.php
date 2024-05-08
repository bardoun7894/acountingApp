<?php

namespace App\Http\Controllers;

use App\Models\AccountDetail;
use Illuminate\Http\Request;

class AccountDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accountDetails = AccountDetail::with("accountSubControl")
        ->get();
    return view(
        "admin.includes.accountDetails.accountDetails"
    )->with(
        compact([
            "accountDetails",
            // "account_sub_control_name",
            // "account_control_name",
            // "account_head_name",
            // "lang",
        ])
    );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccountDetail  $accountDetails
     * @return \Illuminate\Http\Response
     */
    public function show(AccountDetail $accountDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccountDetail  $accountDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountDetail $accountDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccountDetail  $accountDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccountDetail $accountDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccountDetail  $accountDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountDetail $accountDetails)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\AccountActivity;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AccountActivityController extends Controller
{
    private $account_activity_name;

    function __construct()
    {
        $this->account_activity_name = AccountActivity::getAccountActivityNameLang(); //get account activity name by language
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_activity_name = $this->account_activity_name;

        $accountActivities = AccountActivity::all(); //get all account activities

        return view("admin.includes.accountActivities.accountActivities")->with(
            compact(["accountActivities", "account_activity_name"])
        );

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $account_activity_name = $this->account_activity_name;

        $lang = Translation::getLang(); //get current language
        return view("admin.includes.accountActivities.create")->with(
            compact(["lang", "account_activity_name"])
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $account_activity_name = $this->account_activity_name;
        $validated = $request->validate([
            $account_activity_name => "required",
        ]);
        $accountActivity = new accountActivity(); //create new account activity
        $accountActivity->$account_activity_name =
            $request->$account_activity_name;

        $accountActivity->save();

        $session = Session::flash("message", __("messages.data_added"));
        return redirect("accountActivities")->with(
            compact(["session", "account_activity_name"])
        );
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
        $accountActivity = accountActivity::find($id);
        $account_activity_name = $this->account_activity_name;
        $lang = Translation::getLang();
        return view("admin.includes.accountActivities.update")->with(
            compact(["accountActivity", "account_activity_name", "lang"])
        );
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
        $account_activity_name = $this->account_activity_name;

        $validated = $request->validate([
            $account_activity_name => "required",
        ]);
        $accountActivity = accountActivity::find($id);
        $accountActivity->$account_activity_name = $request->input(
            $account_activity_name
        );
        $accountActivity->update();
        $session = Session::flash("message", __("messages.data_updated"));
        return redirect("accountActivities")->with(
            compact(["session", "account_activity_name"])
        );
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
        $accountActivity = accountActivity::find($id);
        $accountActivity->delete();
        $session = Session::flash("message", __("messages.data_removed"));
        //return  __('messages.accountActivity_deleted');
        return redirect("accountActivities")->with(compact("session"));
    }
    public function deleteAccountActivity($id)
    {
        $accountActivity = accountActivity::find($id);
        $accountActivity->delete();
        $session = Session::flash("message", __("messages.data_removed"));
        return redirect("accountActivities")->with(compact("session"));
    }
}

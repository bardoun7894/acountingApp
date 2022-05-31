<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountHead;
use App\Models\Translation;
use App\Models\User;
use App\Models\UserType;
use App\Rules\NameIsExistRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AccountHeadController extends Controller
{
    private $account_head_name;
    private $user_type;
    function __construct()
    {
        $this->account_head_name = AccountHead::getAccountHeadNameLang();
        $this->user_type = UserType::getUserTypeLang();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_head_name = $this->account_head_name;
        $user_type = $this->user_type;
        $accountHeads = AccountHead::with("user")
            ->where([
                "company_id" => Auth::user()->company_id,
                "branch_id" => Auth::user()->branch_id,
            ])
            ->get();

        return view("admin.includes.accountHeads.accountHeads")->with(
            compact(["accountHeads", "account_head_name", "user_type"])
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
        $account_head_name = $this->account_head_name;

        $lang = Translation::getLang();
        return view("admin.includes.accountHeads.create")->with(
            compact(["lang", "account_head_name"])
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
        $account_head_name = $this->account_head_name;
        $validated = $request->validate([
            $account_head_name => [
                new NameIsExistRule(
                    $request->$account_head_name,
                    $account_head_name
                ),
                "required",
            ],
        ]);
        $accountHead = new AccountHead();
        $accountHead->$account_head_name = $request->$account_head_name;
        $accountHead->user_id = Auth::user()->getAuthIdentifier();
        $accountHead->company_id = Auth::user()->company_id;
        $accountHead->branch_id = Auth::user()->branch_id;
        $last = AccountHead::latest("id", "desc")->first();
        $accountHead->id = $last->id + 1;
        $accountHead->account_code = $last->account_code + 1;

        $accountHead->save();
        $session = Session::flash("message", __("messages.data_added"));
        return redirect("accountHeads")->with(
            compact(["session", "account_head_name"])
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
        $accountHead = AccountHead::find($id);
        $account_head_name = $this->account_head_name;
        $lang = Translation::getLang();
        return view("admin.includes.accountHeads.update")->with(
            compact(["accountHead", "account_head_name", "lang"])
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
        $account_head_name = $this->account_head_name;

        $validated = $request->validate([
            $account_head_name => "required",
        ]);
        $accountHead = AccountHead::find($id);
        $accountHead->$account_head_name = $request->input($account_head_name);
        $accountHead->update();

        $session = Session::flash("message", __("messages.data_updated"));
        return redirect("accountHeads")->with(
            compact(["session", "account_head_name"])
        );
        //
    }

    public function deleteAccountHead($id)
    {
        $accountHead = AccountHead::find($id);
        $accountHead->delete();
        $session = Session::flash("message", __("messages.data_removed"));
        return redirect("accountHeads")->with(compact("session"));
    }
}

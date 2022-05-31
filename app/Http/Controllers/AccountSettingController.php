<?php

namespace App\Http\Controllers;
use App\Models\AccountActivity;
use App\Models\AccountControl;
use App\Models\AccountHead;
use App\Models\AccountSetting;
use App\Models\AccountSubControl;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AccountSettingController extends Controller
{
    private $account_setting_name;
    private $account_control_name;
    private $account_head_name;
    /**
     * @var string
     */
    private $account_sub_control_name;

    private $account_activity_name;

    function __construct()
    {
        $this->account_sub_control_name = AccountSubControl::getAccountSubControlNameLang();
        $this->account_control_name = AccountControl::getAccountControlNameLang();
        $this->account_head_name = AccountHead::getAccountHeadNameLang();
        $this->account_activity_name = AccountActivity::getAccountActivityNameLang();
    }

    public function index()
    {
        $lang = Translation::getLang();
        $account_setting_name = $this->account_setting_name;

        $lang = Translation::getLang();
        $account_sub_control_name = $this->account_sub_control_name;
        $account_control_name = $this->account_control_name;
        $account_head_name = $this->account_head_name;
        $account_activity_name = $this->account_activity_name;

        $accountSettings = AccountSetting::with(
            "accountHead",
            "accountControl",
            "accountSubControl",
            "accountActivity"
        )->get();
        return view("admin.includes.accountSettings.accountSettings")->with(
            compact([
                "accountSettings",
                "account_head_name",
                "account_activity_name",
                "account_control_name",
                "account_sub_control_name",
                "lang",
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
        $lang = Translation::getLang();
        $account_sub_control_name = $this->account_sub_control_name;
        $account_control_name = $this->account_control_name;
        $account_head_name = $this->account_head_name;
        $account_activity_name = $this->account_activity_name;
        //      $accountSettings=AccountSetting::with(['accountControl','accountHead','user'])->get();

        $accountHeads = AccountHead::all();
        $accountControls = AccountControl::all();
        $accountSubControls = AccountSubControl::all();
        $accountActivities = AccountActivity::all();

        return view("admin.includes.accountSettings.create")->with(
            compact([
                "lang",
                "account_head_name",
                "account_activity_name",
                "account_control_name",
                "account_sub_control_name",
                "accountHeads",
                "accountControls",
                "accountSubControls",
                "accountActivities",
            ])
        );
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
            "account_head_id" => "required",
            "account_sub_control_id" => "required",
            "account_control_id" => "required",
            "account_activity_id" => "required",
        ]);
        $accountSetting = new AccountSetting();
        $accountSetting->branch_id = Auth::user()->branch_id;
        $accountSetting->account_head_id = $request->account_head_id;
        $accountSetting->account_control_id = $request->account_control_id;
        $accountSetting->account_sub_control_id =
            $request->account_sub_control_id;
        $accountSetting->account_activity_id = $request->account_activity_id;

        $accountSetting->save();

        $session = Session::flash("message", "data_added");
        return redirect("accountSettings")->with(compact(["session"]));
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
        $lang = Translation::getLang();
        $account_setting_name = $this->account_setting_name;

        //      $accountSettings=AccountSetting::with(['accountControl','accountHead','user'])->get();
        $lang = Translation::getLang();
        $account_sub_control_name = $this->account_sub_control_name;
        $account_control_name = $this->account_control_name;
        $account_head_name = $this->account_head_name;
        $account_activity_name = $this->account_activity_name;

        $accountSetting = AccountSetting::find($id);
        $accountControle = AccountControl::where(
            "id",
            $accountSetting->account_control_id
        )->first();
        $accountSubControle = AccountSubControl::where(
            "id",
            $accountSetting->account_sub_control_id
        )->first();
        $accountHeade = AccountHead::where(
            "id",
            $accountSetting->account_head_id
        )->first();
        $accountActivite = AccountActivity::where(
            "id",
            $accountSetting->account_activity_id
        )->first();

        $accountHeads = AccountHead::all();
        $accountControls = AccountControl::all();
        $accountSubControls = AccountSubControl::all();
        $accountActivities = AccountActivity::all();

        return view("admin.includes.accountSettings.update")->with(
            compact([
                "accountSetting",
                "accountSubControls",
                "accountControls",
                "accountHeads",
                "accountActivities",
                "accountControle",
                "accountSubControle",
                "accountHeade",
                "accountActivite",
                "lang",
                "account_head_name",
                "account_activity_name",
                "account_sub_control_name",
                "account_control_name",
            ])
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
        $account_setting_name = $this->account_setting_name;
        $validated = $request->validate([
            "account_head_id" => "required",
            "account_sub_control_id" => "required",
            "account_control_id" => "required",
            "account_activity_id" => "required",
        ]);
        $accountSetting = AccountSetting::find($id);

        $accountSetting->branch_id = Auth::user()->branch_id;
        $accountSetting->account_head_id = $request->account_head_id;
        $accountSetting->account_control_id = $request->account_control_id;
        $accountSetting->account_sub_control_id =
            $request->account_sub_control_id;
        $accountSetting->account_activity_id = $request->account_activity_id;
        $accountSetting->save();

        $session = Session::flash("message", "data_updated");
        return redirect("accountSettings")->with(compact("session"));
        //
    }

    public function deleteAccountSetting($id)
    {
        $accountSetting = AccountSetting::find($id);
        $accountSetting->delete();
        $session = Session::flash("message", __("messages.data_removed"));
        return redirect("accountSettings")->with(compact("session"));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Translation;
use App\Rules\NameIsExistRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BranchController extends Controller
{
    private $branch_name;
    private $lang;
    function __construct()
    {
        $this->lang = Translation::getLang();
        $this->branch_name = Branch::getBranchNameLang();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branch_name = $this->branch_name;
        $branches = Branch::where(
            "company_id",
            Auth::user()->company_id
        )->get();
        return view("admin.includes.branches.branches")->with(
            compact(["branches", "branch_name"])
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
        $branch_name = $this->branch_name;
        $lang = $this->lang;
        return view("admin.includes.branches.create")->with(
            compact(["branch_name", "lang"])
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
        $branch_name = $this->branch_name;
        $validated = $request->validate([
            $branch_name => [
                new NameIsExistRule($request->$branch_name, $branch_name),
                "required",
            ],
        ]);
        $branch = new Branch();
        $branch->$branch_name = $request->$branch_name;
        $branch->company_id = Auth::user()->company_id;
        $branch->save();
        $session = Session::flash("message", __("messages.data_added"));
        return redirect("branches")->with(compact(["session", "branch_name"]));
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
        $branch_name = $this->branch_name;
        $lang = $this->lang;
        $branch = Branch::find($id);
        return view("admin.includes.branches.update")->with(
            compact(["branch", "branch_name", "lang"])
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
        $branch_name = $this->branch_name;
        $validated = $request->validate([
            $branch_name => "required",
        ]);
        $branch = Branch::find($id);
        $branch->$branch_name = $request->input($branch_name);
        $branch->update();
        $session = Session::flash("message", __("messages.data_updated"));
        return redirect("branches")->with(compact("session"));
        //
    }

    public function deleteBranch($id)
    {
        $branch = Branch::find($id);
        $branch->delete();
        $session = Session::flash("message", __("messages.data_removed"));
        return redirect("branches")->with(compact("session"));
    }
}

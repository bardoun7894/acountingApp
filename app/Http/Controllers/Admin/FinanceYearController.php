<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FinanceYear;
use App\Models\Translation;
use App\Rules\FinanceYearExistRule;
use App\Rules\NameIsExistRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Session;

class FinanceYearController extends Controller
{
    private $lang;
    function __construct()
    {
        $this->lang = Translation::getLang();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $financeYears = FinanceYear::all();
        return view("admin.includes.financeYears.financeYears")->with(
            compact(["financeYears"])
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lang = $this->lang;
        return view("admin.includes.financeYears.create")->with(
            compact(["lang"])
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
            "financial_year" => [
                new FinanceYearExistRule($request->financial_year),
                "required",
            ],
            "startDate" => "required",
            "endDate" => "required",
        ]);
        $financeYear = new FinanceYear();
        $financeYear->financial_year = $request->financial_year;
        if ($request->isActive == "1") {
            $financeYear->isActive = 1;
        } else {
            $financeYear->isActive = 0;
        }
        $financeYear->startDate = $request->startDate;
        $financeYear->endDate = $request->endDate;
        $financeYear->save();
        $session = Session::flash("message", "FinanceYear added Successfully");
        return redirect("financeYears")->with(
            compact(["session", "financeYear"])
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
        $lang = $this->lang;
        $financeYear = FinanceYear::find($id);
        return view("admin.includes.financeYears.update")->with(
            compact(["financeYear", "lang"])
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
        $validated = $request->validate([
            "financial_year" => "required",
            "startDate" => "required",
            "endDate" => "required",
        ]);
        $financeYear = FinanceYear::find($id);

        $financeYear->financial_year = $request->financial_year;
        if ($request->isActive == "1") {
            $financeYear->isActive = 1;
        } else {
            $financeYear->isActive = 0;
        }
        $financeYear->startDate = $request->startDate;
        $financeYear->endDate = $request->endDate;
        $financeYear->update();
        $session = Session::flash(
            "message",
            "FinanceYear Updated Successfully"
        );
        return redirect("financeYears")->with(compact("session"));
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //

    public function deleteFinanceYear($id)
    {
        $financeYear = FinanceYear::find($id);
        $financeYear->delete();
        $session = Session::flash(
            "message",
            "FinanceYear Deleted Successfully"
        );
        return redirect("financeYears")->with(compact("session"));
    }
}

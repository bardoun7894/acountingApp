<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Database\Seeders\AccountActivitySeeder;
use Database\Seeders\AccountControlSeeder;
use Database\Seeders\AccountHeadSeeder;
use Database\Seeders\AccountSettingSeeder;
use Database\Seeders\AccountSubControlSeeder;
use Database\Seeders\CurrencySeeder;
use Database\Seeders\FinanceSeeder;
use Database\Seeders\PaymentTypeSeeder;
use Database\Seeders\UnitSeeder;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $company_name;
    private $employee_name;

    //constructor
    public function __construct()
    {
        $this->company_name = Company::getCompanyNameLang();
        $this->employee_name = Employee::getEmployeeNameAttribute();
    }
    public function index()
    {
        $companies = Company::with("employees")
            ->where("id", "!=", auth()->user()->company_id)
            ->get();

        $company_name = $this->company_name;
        $employee_name = $this->employee_name;
        return view("admin.includes.companies.companies")->with(
            compact(["companies", "company_name", "employee_name"])
        );
    }
    public function approveUser(Request $request)
    {
        if ($request->ajax()) {
            $user = User::find($request->user_approve_id);
            if ($user->isActive == 0) {
                $user->isActive = 1;
                $user->save();
                return response()->json([
                    "action" => __("messages.reject"),
                    "status" => __("messages.active"),
                    "approve" => true,
                ]);
            } else {
                $user->isActive = 0;
                $user->save();
                return response()->json([
                    "action" => __("messages.approve"),
                    "status" => __("messages.inactive"),
                    "approve" => false,
                ]);
            }
        }
    }
    //end approve user

    //seed data and active user

    private function seedDataToDatabase($user_id, $branch_id, $company_id)
    {
        //seed financial year
        $financeYearSeeder = new FinanceSeeder();
        $financeYearSeeder->run($user_id);
        //seed account heads
        $accountHeadSeeder = new AccountHeadSeeder();
        $accountHeadSeeder->run($user_id);
        //seed account control
        $accountControlSeeder = new AccountControlSeeder();
        $accountControlSeeder->run($user_id, $branch_id, $company_id);

        //seed account sub control
        $accountSubControlSeeder = new AccountSubControlSeeder();
        $accountSubControlSeeder->run($user_id, $branch_id, $company_id);

        //seed account settings
        $accountSettingsSeeder = new AccountSettingSeeder();
        $accountSettingsSeeder->run($branch_id, $company_id);

        //seed account activities
        $accountActivitySeeder = new AccountActivitySeeder();
        $accountActivitySeeder->run();
        //seed units
        $unitSeeder = new UnitSeeder();
        $unitSeeder->run();

        //seed payment types
        $paymentTypeSeeder = new PaymentTypeSeeder();
        $paymentTypeSeeder->run();
        //seed currency
        $currencySeeder = new CurrencySeeder();
        $currencySeeder->run();
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
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}

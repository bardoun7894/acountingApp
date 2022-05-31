<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Store;
use App\Models\Translation;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $branch_name;
    private $employee_name;
    private $company_name;
    private $lang;

    function __construct()
    {
        $this->employee_name = Employee::getEmployeeNameAttribute();
        $this->company_name = Company::getCompanyNameLang();
        $this->branch_name = Branch::getBranchNameLang();
        $this->lang = Translation::getLang();
    }

    public function index()
    {
        $employees = Employee::with(["branch", "company"])->get();
        $employee_name = $this->employee_name;
        $company_name = $this->company_name;
        $branch_name = $this->branch_name;

        return view("admin.includes.employees.employees")->with(
            compact([
                "employees",
                "branch_name",
                "employee_name",
                "company_name",
            ])
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
        $lang = $this->lang;
        $employee_name = $this->employee_name;
        $branch_name = $this->branch_name;
        $branches = Branch::where(
            "company_id",
            Auth::user()->company_id
        )->get();
        return view("admin.includes.employees.create")->with(
            compact(["lang", "employee_name", "branches", "branch_name"])
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
        $employee_name = $this->employee_name;

        $validated = $request->validate([
            $employee_name => [
                "required",
                "string",
                "max:255",
                "unique:employees",
            ],
            "address" => "required|string|max:255",
            "employee_contact_number" => "required|string|max:255",
            "designation" => ["required", "string", "max:255"],
            "monthly_salary" => "required|numeric",
            "cnic" => ["required", "string", "max:255"],
            "employee_email" => "required|email|unique:employees",
        ]);
        $employee = new Employee();
        $employee->$employee_name = $request->$employee_name;
        $employee->employee_contact_number = $request->employee_contact_number;
        $employee->address = $request->address;
        $employee->designation = $request->designation;
        $employee->monthly_salary = $request->monthly_salary;
        $employee->cnic = $request->cnic;
        $employee->employee_email = $request->employee_email;
        $employee->branch_id = $request->branch_id;
        $employee->company_id = Auth::user()->company_id;
        $employee->user_id = Auth::user()->id;
        $employee->save();

        $session = Session::flash("message", "data_added");
        return redirect("employees")->with(compact("session"));
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
        $branch_name = $this->branch_name;
        $employee_name = $this->employee_name;
        $employee = Employee::find($id);
        $branches = Branch::where(
            "company_id",
            Auth::user()->company_id
        )->get();
        $branch = Branch::find($employee->branch_id);
        $lang = $this->lang;
        return view("admin.includes.employees.update")->with(
            compact([
                "employee",
                "lang",
                "employee_name",
                "branch",
                "branches",
                "branch_name",
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
        $employee_name = $this->employee_name;
        $validated = $request->validate([
            $employee_name => [
                "required",
                "string",
                "max:255",
                "unique:employees,$employee_name,$id",
            ],
            "address" => "required|string|max:255",
            "employee_contact_number" => "required|string|max:255",
            "designation" => ["required", "string", "max:255"],
            "monthly_salary" => "required|numeric",
            "cnic" => ["required", "string", "max:255"],
            "employee_email" => "required|email|unique:employees,employee_email,$id",
        ]);
        $employee = Employee::find($id);

        $employee->$employee_name = $request->$employee_name;
        $employee->employee_contact_number = $request->employee_contact_number;
        $employee->address = $request->address;
        $employee->designation = $request->designation;
        $employee->monthly_salary = $request->monthly_salary;
        $employee->cnic = $request->cnic;
        $employee->employee_email = $request->employee_email;
        $employee->branch_id = $request->branch_id;
        $employee->company_id = Auth::user()->company_id;
        $employee->user_id = Auth::user()->id;

        $employee->save();

        $session = Session::flash("message", __("messages.data_updated"));

        return redirect("employees")->with(
            compact(["session", "employee_name"])
        );
    }

    public function deleteEmployee($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        $session = Session::flash("message", "Employee Deleted Successfully");
        return redirect("employees")->with(compact("session"));
    }

    public function getEmployeeInvoice()
    {
        $full_name = $this->full_name;
        $employees = Employee::all();
        return view("admin.includes.employees.employee_invoice")->with(
            compact(["employees", "full_name"])
        );
    }
}

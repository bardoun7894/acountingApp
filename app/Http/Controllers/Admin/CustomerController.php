<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountSubControl;
use App\Models\Customer;
use App\Models\Translation;
use App\Rules\NameIsExistRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    private $description;
    private $address;
    private $customer_name;

    function __construct()
    {
        $this->description = Customer::getDescriptionLang();
        $this->address = Customer::getAddressLang();
        $this->customer_name = Customer::getCustomerNameLang();
    }

    public function index()
    {
        $customer_name = $this->customer_name;
        $address = $this->address;
        $description = $this->description;
        $customers = Customer::where([
            "user_id" => Auth::user()->id,
            "company_id" => Auth::user()->company_id,
            "branch_id" => Auth::user()->branch_id,
        ])->get();
        return view("admin.includes.customers.customers")->with(
            compact(["customers", "customer_name", "address", "description"])
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
        $customer_name = $this->customer_name;
        $address = $this->address;
        $description = $this->description;
        $accountSubControl = AccountSubControl::where(
            "account_code",
            "=",
            "118"
        )
            ->latest()
            ->first();

        return view("admin.includes.customers.create")->with(
            compact(["lang", "customer_name", "address", "description"])
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
        $customer_name = $this->customer_name;
        $address = $this->address;
        $description = $this->description;
        $validated = $request->validate([
            $customer_name => [
                new NameIsExistRule($request->$customer_name, $customer_name),
                "required",
            ],
            $address => "required",
            $description => "required",
            "contact_number" => "required",
            "area" => "required",
        ]);
        $customer = new Customer();
        $customer->company_id = Auth::user()->company_id;
        $customer->branch_id = Auth::user()->branch_id;
        $customer->user_id = Auth::user()->id;
        $customer->$customer_name = $request->$customer_name;
        $customer->$address = $request->$address;
        $customer->$description = $request->$description;
        $customer->contact_number = $request->contact_number;
        $customer->area = $request->area;
        $customer->branch_id = Auth::user()->branch_id;

        //make relation ship with accountcode
        $account_sub_control_name = AccountSubControl::getAccountSubControlNameLang();
        $lastAccountSubControl = AccountSubControl::where(
            "account_code",
            "=",
            "118"
        )
            ->latest()
            ->first();
        //create a sub control that have relation ship with supplier

        $lastCus = Customer::latest()->first();
        if (isset($lastCus)) {
            $customer->account_code = $lastCus->account_code + 1;
        } else {
            $customer->account_code =
                $lastAccountSubControl->account_code . "0001";
        }

        $customer->save();
        $session = Session::flash("message", "Customer added Successfully");
        return redirect("customers")->with(compact("session"));
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
        $customer_name = $this->customer_name;
        $address = $this->address;
        $description = $this->description;
        $customer = Customer::find($id);

        return view("admin.includes.customers.update")->with(
            compact([
                "customer",
                "customer_name",
                "lang",
                "address",
                "description",
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
        $customer_name = $this->customer_name;
        $address = $this->address;
        $description = $this->description;
        $validated = $request->validate([
            $customer_name => "required",

            $address => "required",
            $description => "required",
            "contact_number" => "required",
        ]);
        $customer = Customer::find($id);
        $customer->company_id = Auth::user()->company_id;
        $customer->branch_id = Auth::user()->branch_id;
        $customer->user_id = Auth::user()->id;
        $customer->$customer_name = $request->$customer_name;
        $customer->$address = $request->$address;
        $customer->$description = $request->$description;
        $customer->contact_number = $request->contact_number;
        $customer->update();
        $session = Session::flash("message", "Customer Updated Successfully");
        return redirect("customers")->with(compact("session"));
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        $session = Session::flash("message", "Customer Deleted Successfully");
        return redirect("customers")->with(compact("session"));
    }
    public function deleteCustomer($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        $session = Session::flash("message", "Customer Deleted Successfully");
        return redirect("customers")->with(compact("session"));
    }

    public function getCustomerInvoice()
    {
        $customer_name = $this->customer_name;
        $address = $this->address;
        $description = $this->description;
        $customers = Customer::all();
        return view("admin.includes.customers.customer_invoice")->with(
            compact(["customers", "customer_name", "address", "description"])
        );
    }

    public function getCustomerSelect2(Request $request)
    {
        $search = $request->search;
        $customers = Customer::where([
            "branch_id" => Auth::user()->branch_id,
        ])
            ->where(
                Customer::getCustomerNameLang(),
                "like",
                "%" . $search . "%"
            )
            ->get();
        return $customers;
    }
}

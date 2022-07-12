<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountControl;
use App\Models\AccountSubControl;
use App\Models\Supplier;
use App\Models\Translation;
use App\Rules\NameIsExistRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $supplier_name;
    private $description;
    private $address;

    function __construct()
    {
        $this->supplier_name = Supplier::getSupplierNameLang();
        $this->description = Supplier::getdescriptionLang();
        $this->address = Supplier::getaddressLang();
    }

    public function index()
    {
        $supplier_name = $this->supplier_name;
        $address = $this->address;
        $description = $this->description;
        $suppliers = Supplier::where([
            "user_id" => Auth::user()->id,
            "company_id" => Auth::user()->company_id,
            "branch_id" => Auth::user()->branch_id,
        ])->get();
        return view("admin.includes.suppliers.suppliers")->with(
            compact(["suppliers", "supplier_name", "address", "description"])
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
        $lang = Translation::getLang();
        $supplier_name = $this->supplier_name;
        $address = $this->address;
        $description = $this->description;

        $accountSubControl = AccountSubControl::where(
            "account_sub_control_name_en",
            "=",
            "Suppliers"
        )
            ->latest()
            ->first();

        return view("admin.includes.suppliers.create")->with(
            compact(["lang", "supplier_name", "address", "description"])
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
        $supplier_name = $this->supplier_name;
        $address = $this->address;
        $description = $this->description;
        $validated = $request->validate([
            $supplier_name => [
                new NameIsExistRule($request->$supplier_name, $supplier_name),
                "required",
            ],
            $address => "required",
            $description => "required",
            "phone" => "required",
            "email" => "required|email|unique:suppliers,email",
        ]);
        $supplier = new Supplier();
        $supplier->$supplier_name = $request->$supplier_name;
        $supplier->$address = $request->$address;
        $supplier->$description = $request->$description;
        $supplier->phone = $request->phone;
        $supplier->email = $request->email;
        $supplier->branch_id = Auth::user()->branch_id;
        $supplier->company_id = Auth::user()->company_id;
        $supplier->user_id = Auth::user()->id;

        $account_sub_control_name = AccountSubControl::getAccountSubControlNameLang();
        $lastAccountSubControl = AccountSubControl::where(
            "account_code",
            "=",
            "215"
        )
            ->latest()
            ->first();
        //create a sub control that have relation ship with supplier
        if (!isset($lastAccountSubControl->account_sub_control_name_en)) {
            $accountSubControl = new AccountSubControl();
            $accountSubControl->user_id = Auth::user()->getAuthIdentifier();
            $accountSubControl->$account_sub_control_name =
                Translation::getLang() == "en" ? "Suppliers" : "الموردون";
            $accountControl = AccountControl::with("accountHead")
                ->where("account_control_name_en", "Creditors")
                ->first();
            $accountSubControl->account_head_id =
                $accountControl->account_head_id;
            $accountSubControl->account_control_id = $accountControl->id;
            $accountSubControl->account_code =
                $accountControl->account_code . 1;
            $accountSubControl->save();
        }

        $lastSup = Supplier::latest()->first();
        if (isset($lastSup)) {
            $supplier->account_code = $lastSup->account_code + 1;
        } else {
            $supplier->account_code =
                $lastAccountSubControl->account_code . "0001";
        }
        $supplier->save();

        $session = Session::flash("message", "Supplier added Successfully");
        return redirect("suppliers")->with(compact("session"));
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
        $supplier_name = $this->supplier_name;
        $address = $this->address;
        $description = $this->description;
        $supplier = Supplier::find($id);
        return view("admin.includes.suppliers.update")->with(
            compact([
                "supplier",
                "supplier_name",
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
        $supplier_name = $this->supplier_name;
        $address = $this->address;
        $description = $this->description;
        $validated = $request->validate([
            $supplier_name => "required",
            $address => "required",
            $description => "required",
            "phone" => "required",
        ]);
        $supplier = Supplier::find($id);
        $supplier->$supplier_name = $request->$supplier_name;
        $supplier->$address = $request->$address;
        $supplier->$description = $request->$description;
        $supplier->phone = $request->phone;
        $supplier->update();
        $session = Session::flash("message", "Supplier Updated Successfully");
        return redirect("suppliers")->with(compact("session"));
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        $session = Session::flash("message", "Supplier Deleted Successfully");
        return redirect("suppliers")->with(compact("session"));
    }
    public function deleteSupplier($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        $session = Session::flash("message", "Supplier Deleted Successfully");
        return redirect("suppliers")->with(compact("session"));
    }

    public function getSupplierInvoice()
    {
        $supplier_name = $this->supplier_name;
        $address = $this->address;
        $description = $this->description;
        $suppliers = Supplier::all();
        return view("admin.includes.suppliers.supplier_invoice")->with(
            compact(["suppliers", "supplier_name", "address", "description"])
        );
    }
    public function getSupplierSelect2(Request $request)
    {
        $search = $request->search;
        $suppliers = Supplier::where([
            "branch_id" => Auth::user()->branch_id,
        ])
            ->where(
                Supplier::getSupplierNameLang(),
                "like",
                "%" . $search . "%"
            )
            ->get();
        return $suppliers;
    }
}

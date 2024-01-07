<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Currency;
use App\Models\FinanceYear;
use App\Models\PaymentType;
//   SaleCart
use App\Models\SaleCart;
use App\Models\SellType;
use App\Models\Stock;
use App\Models\Store;
use App\Models\Customer;
use App\Models\CustomerInvoice;
use App\Models\CustomerInvoiceDetail;
use App\Models\CustomerPayment;
use App\Models\Sale;
use App\Models\Translation;
use App\Models\User;
use App\Models\UserType;
use App\Rules\FinanceYearRule;
use App\Models\Unit;
use App\Rules\SaleCartRule;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use SalesEntries;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $description;
    private $product_name;
    private $category_name;
    private $unit_name;
    private $customer_name;
    private $branch_name;
    private $store_name;
    private $title;
    private $payment_type_name;
    private $sell_type_name;
    private $address;
    private $currency_name;
    private $full_name;
    private $salePaymentAr = "تم الدفع ";
    private $entries;

    function __construct()
    {
        $this->product_name = Stock::getProductNameLang();
        // $this->entries = new SalesEntries();
        $this->full_name = User::getFullnameLang();
        $this->currency_name = Currency::getCurrencyName();
        $this->sell_type_name = SellType::getSellTypeNameLang();
        $this->payment_type_name = PaymentType::getPaymentTypeNameLang();
        $this->title = CustomerInvoice::getTitleLang();
        $this->branch_name = Branch::getBranchNameLang();
        $this->store_name = Store::getStoreNameLang();
        $this->customer_name = Customer::getCustomerNameLang();
        $this->address = Customer::getaddressLang();
        $this->unit_name = Unit::getUnitNameLang();
        $this->description = Stock::getDescriptionLang();
        $this->category_name = Category::getCategoryNameLang(
            Translation::getLang()
        );
    }
    public function index()
    {
        $product_name = $this->product_name;
        $payment_type_name = $this->payment_type_name;
        $sell_type_name = $this->sell_type_name;
        // $branch_name = $this->branch_name;
        $store_name = $this->store_name;
        $unit_name = $this->unit_name;
        $description = $this->description;
        //      $stocks = Stock::with(['category','user'])->get();
        $customer_name = $this->customer_name;
        $units = Unit::all();
        $customers = Customer::where([
            "branch_id" => Auth::user()->branch_id,
            "company_id" => Auth::user()->company_id,
        ])->get();
        $payment_types = PaymentType::where("status", 1)->get();
        $currency = Currency::where("status", 1)->first();
        $currency_name = $this->currency_name;
        $sell_types = SellType::where("status", 1)->get();
        $stores = Store::where([
            "branch_id" => Auth::user()->branch_id,
            "company_id" => Auth::user()->company_id,
            "status" => 1,
        ])->get();
        $sales = Sale::with("stock")
            ->where([
                "branch_id" => Auth::user()->branch_id,
                "company_id" => Auth::user()->company_id,
            ])
            ->get();

        return view("admin.includes.sales.sales")->with(
            compact([
                "customers",
                "currency",
                "currency_name",
                "units",
                "payment_types",
                "sell_types",
                "stores",
                "store_name",
                "unit_name",
                "customer_name",
                "payment_type_name",
                "sell_type_name",
                "sales",
                "product_name",
                "description",
            ])
        );
    }

    public function allSales()
    {
        $customer_name = $this->customer_name;
        $customerInvoices = CustomerInvoice::with([
            "customer",
            "customer_payments",
        ])   ->where([
                // "store_id" => Auth::user()->store_id,
                "branch_id" => Auth::user()->branch_id,
                "company_id" => Auth::user()->company_id,
            ])
            ->get();
        return view("admin.includes.sales.all_sales.allSales")->with(
            compact(["customerInvoices", "customer_name"])
        );
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userType = UserType::where("id", Auth::user()->user_type_id)->first();
        if (isset($userType) && $userType->user_type_en === "admin") {
            $branches = Branch::with("categories")->get();
        } else {
            $branches = Branch::with("categories")
                ->where([
                    "id" => Auth::user()->branch_id,
                    "company_id" => Auth::user()->company_id,
                ])
                ->get();
        }

        $category_name = $this->category_name;
        $branch_name = $this->branch_name;
        $product_name = $this->product_name;
        $unit_name = $this->unit_name;
        $description = $this->description;
        $getProducts = Stock::where([
            "branch_id" => Auth::user()->branch_id,
            "company_id" => Auth::user()->company_id,
        ])->get();
        $units = Unit::where("status", 1)->get();
        $customer_name = $this->customer_name;
        $customers = Customer::where([
            "branch_id" => Auth::user()->branch_id,
            "company_id" => Auth::user()->company_id,
        ])->get();

        return view("admin.includes.sales.create")->with(
            compact([
                "customers",
                "getProducts",
                "branches",
                "branch_name",
                "units",
                "product_name",
                "customer_name",
                "unit_name",
                "category_name",
                "description",
                "userType",
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
        $product_name = $this->product_name;
        $description = $this->description;
        $validated = $request->validate([
            "branch_id" => "required",
            "category_id" => "required",
            "stock_id" => [new SaleCartRule($request->stock_id)],
            "unit_id" => "required",
            //           $product_name=>'required',
            $description => "required",
            "quantity" => "required",
            "sale_unit_price" => "required",
            "current_sale_unit_price" => "required",
            "expiry_date" => "required",
        ]);

        $saleCart = new Sale();
        $saleCart->branch_id = $request->branch_id;
        $saleCart->unit_id = $request->unit_id;
        $saleCart->category_id = $request->category_id;
        $saleCart->stock_id = $request->stock_id;
        $saleCart->$description = $request->$description;
        $saleCart->sale_qty = $request->quantity;
        $saleCart->sale_unit_price = $request->current_sale_unit_price;
        $saleCart->sale_unit_price = $request->sale_unit_price;
        $saleCart->user_id = Auth::user()->id;
        // $saleCart->expiry_date = $request->expiry_date;

        $saleCart->save();

        $session = Session::flash("message", __("messages.data_added"));
        return redirect("sales")->with(
            compact(["session", "product_name", "description"])
        );
    }

    public function addDataToSaleCart(Request $request)
    {
        if ($request->ajax()) {
            $product_name = $this->product_name;
            $description = $this->description;
            $validated = $request->validate([
                "branch_id" => "required",
                "category_id" => "required",
                "stock_id" => [new SaleCartRule($request->stock_id)],
                "unit_id"  => "required",
                //           $product_name=>'required',
                $description => "required",
                "quantity" => "required",
                "sale_unit_price" => "required",
                "current_sale_unit_price" => "required",
                "expiry_date" => "required",
            ]);

            $saleCart = new Sale();
            $saleCart->branch_id = $request->branch_id;
            $saleCart->unit_id = $request->unit_id;
            $saleCart->category_id = $request->category_id;
            $saleCart->stock_id = $request->stock_id;
            $saleCart->$description = $request->$description;
            $saleCart->sale_qty = $request->quantity;
            $saleCart->sale_unit_price = $request->current_sale_unit_price;
            $saleCart->sale_unit_price = $request->sale_unit_price;
            $saleCart->user_id = Auth::user()->id;
            // $saleCart->expiry_date = $request->expiry_date;

            $saleCart->save();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branches = Branch::with("categories")
            ->where("company_id", Auth::user()->company_id)
            ->get();
        $sale = Sale::find($id);
        $category_name = $this->category_name;
        $branch_name = $this->branch_name;
        $product_name = $this->product_name;
        $unit_name = $this->unit_name;
        $description = $this->description;
        $categories = Category::all();
        $getProducts = Stock::all();

        $units = Unit::where("status", 1)->get();

        return view("admin.includes.sales.update")->with(
            compact([
                "getProducts",
                "sale",
                "units",
                "unit_name",

                "categories",
                "category_name",
                "product_name",
                "description",
            ])
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product_name = $this->product_name;
        $description = $this->description;
        $validated = $request->validate([
            "branch_id" => "required",
            "category_id" => "required",
            "stock_id" => "required",
            "unit_id" => "required",
            //          $product_name=>'required',
            $description => "required",
            "quantity" => "required",
            "sale_unit_price" => "required",
            "current_sale_unit_price" => "required",
            "expiry_date" => "required",
        ]);
        $saleCart = Sale::find($id);
        $saleCart->branch_id = $request->branch_id;
        $saleCart->unit_id = $request->unit_id;
        $saleCart->category_id = $request->category_id;
        $saleCart->stock_id = $request->stock_id;
        $saleCart->$description = $request->$description;
        //      $saleCart->$product_name =$request->$product_name;
        $saleCart->sale_qty = $request->quantity;
        $saleCart->sale_unit_price = $request->current_sale_unit_price;
        $saleCart->sale_unit_price = $request->sale_unit_price;
        $saleCart->user_id = Auth::user()->id;
        $saleCart->expiry_date = $request->expiry_date;
        $saleCart->update();
        $session = Session::flash("message", __("messages.data_updated"));
        return redirect("sales")->with(
            compact(["session", "description", "product_name"])
        );
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getSelectedSaleBranch(Request $request)
    {
        $category_name = $this->category_name;
        if ($request->ajax()) {
            $data = $request->all();

            if (is_numeric($data["tableid"])) {
                $categoryData = Category::find($data["input_category_id"]);
            } else {
                $categoryData = "";
            }

            $getCategories = Category::with("subCategories")
                ->where([
                    "branch_id" => $data["branch_id"],
                    "company_id" => Auth::user()->company_id,
                    "parent_id" => 0,
                ])
                ->get();
            return view(
                "admin.includes.sales.append_sale_category_level",
                compact(["categoryData", "getCategories", "category_name"])
            );
        }
    }
    public function getSelectedSaleCategory(Request $request)
    {
        $product_name = $this->product_name;
        if ($request->ajax()) {
            $data = $request->all();
            if (is_numeric($data["tableid"])) {
                $productData = Stock::find($data["input_stock_id"]);
                $getProducts = Stock::where([
                    "category_id" => $data["input_category_id"],
                    "company_id" => Auth::user()->company_id,
                    "branch_id" => Auth::user()->branch_id,
                ])->get();
            } else {
                $productData = "";
                $getProducts = Stock::where([
                    "category_id" => $data["category_id"],
                    "company_id" => Auth::user()->company_id,
                    "branch_id" => Auth::user()->branch_id,
                ])->get();
            }

            return view("admin.includes.sales.append_sale_product_level")->with(
                compact(["productData", "getProducts", "product_name"])
            );
        }
    }

    public function getProductItembyId(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->stock_id;
            $productData = Stock::find($data);
            return $productData;
        }
    }
    public function getCustomerItembyId(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data["customer_id"] == "null") {
                return 0;
            }
            $customerData = Customer::find($data["customer_id"]);
            return $customerData;
        }
    }

    public function getSelectedBranchStore(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $stores = Store::where("branch_id", Auth::user()->branch_id)->get();
            $store_name = $this->store_name;
            return view("admin.includes.stores.select_store")->with(
                compact(["stores", "store_name"])
            );
        }
    }

    public function getSelectedBranchCustomer(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $customers = Customer::where(
                "branch_id",
                $data["branch_id"]
            )->get();
            $customer_name = $this->customer_name;
            return view("admin.includes.customers.select_customer")->with(
                compact(["customers", "customer_name"])
            );
        }
    }




}


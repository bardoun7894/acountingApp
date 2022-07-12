<?php

namespace App\Http\Controllers;

use App\Models\AccountSetting;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Currency;
use App\Models\FinanceYear;
use App\Models\PaymentType;
use App\Models\SellType;
use App\Models\Stock;
use App\Models\Store;
use App\Models\Customer;
use App\Models\CustomerInvoice;
use App\Models\CustomerInvoiceDetail;
use App\Models\CustomerPayment;
use App\Models\Sale;
use App\Models\Transaction;
use App\Models\Translation;
use App\Models\User;
use App\Models\UserType;
use App\Rules\FinanceYearRule;
use App\Rules\PayAmountRule;
use App\Models\Unit;
use App\Rules\SaleCartRule;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
        $this->entries = new SalesEntries();
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
        ])
            ->where([
                "store_id" => Auth::user()->store_id,
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
        }
    }
    public function salePayment(
        $customer_id,
        $customer_invoice_id,
        $branch_id,
        $invoice_no,
        $invoice_date,
        $total_amount,
        $payment_amount,
        $user_id,
        $remaining_balance
    ) {
        $financial_year = FinanceYear::where("isActive", 1)->first(); // get current financial year
        $success_message = "Sale Success";

        ############################## is payment PAID ################################################
        $customer = Customer::find($customer_id);
        $invoice_customer_payment = new CustomerPayment();
        $invoice_customer_payment->customer_id = $customer_id;
        $invoice_customer_payment->customer_invoice_id = $customer_invoice_id;
        $invoice_customer_payment->branch_id = $branch_id;
        $invoice_customer_payment->invoice_number = $invoice_no;
        $invoice_customer_payment->invoice_date = $invoice_date;
        $invoice_customer_payment->total_amount = $total_amount;
        $invoice_customer_payment->payment_amount = $payment_amount;
        $invoice_customer_payment->remaining_balance = $remaining_balance;

        $invoice_customer_payment->user_id = $user_id;
        $invoice_customer_payment->save();
        ##3############################  debit  entry  ################################################

        //sale Payment Pending

        //account_activity= 8 =>sale Payment Pending
        //account_head =2 liabilities
        //  $account_control_id=4 Current Liabilities 21
        // $account_sub_control_id= 18 ; Notes Payable 212

        $saleAccount = $this->entries->getAccountSetting(2, 21, 212, 8);
        $this->entries->setEntries(
            // set debit entry
            $financial_year->id,
            $saleAccount->account_head_id,
            $saleAccount->account_control_id,
            $saleAccount->account_sub_control_id,
            $invoice_no,
            $invoice_date,
            Auth::user()->getAuthIdentifier(),
            $branch_id,
            $remaining_balance,
            $total_amount,
            "  Sale Payment Paid to" . $customer->customer_name_en,
            isset($customer->customer_name_ar)
                ? $customer->customer_name_ar . "تم الترحيل "
                : $customer->customer_name_en . "تم الترحيل"
        );

        ##4############################  credit entry ################################################

        //sale Payment PAID
        //account_activity=9 =>sale Payment PAID // DEBIT ENTRY TRANSACTION

        //account_head = 1 Assets
        // $account_control_id = 1 Current Assets
        // $account_sub_control_id=2; Cash and Cash Equivalent "Cash On Bank" 111, "Cash in Hand" 112

        // if atm payment cash on bank
        //else cash in hand
        $saleAccount = $this->entries->getAccountSetting(1, 11, 112, 9);

        $this->entries->setEntries(
            // set credit entry
            $financial_year->id,
            $saleAccount->account_head_id,
            $saleAccount->account_control_id,
            $saleAccount->account_sub_control_id,
            $invoice_no,
            $invoice_date,
            Auth::user()->getAuthIdentifier(),
            $branch_id,
            $total_amount,
            $remaining_balance,
            " Sale Payment Succeed" . $customer->customer_name_en,
            isset($customer->customer_name_ar)
                ? $customer->customer_name_ar . $this->salePaymentAr
                : $customer->customer_name_en . $this->salePaymentAr
        );
    }

    public function paid_amount($id)
    {
        $d = new DateTime();
        $invoice_no = "Pay" . $d->format("YmdHisv");
        $sale_invoice = CustomerInvoice::find($id);
        $user = User::find($sale_invoice->user_id);
        $full_name = $this->full_name;
        $customer = Customer::find($sale_invoice->customer_id);
        $sale_payment_details = CustomerPayment::where([
            "customer_invoice_id" => $id,
            "branch_id" => Auth::user()->branch_id,
            "company_id" => Auth::user()->company_id,
        ])->get();

        $remaining_amount = 0;

        $list = $this->salePaymentHistory($sale_invoice->id, "", "");

        foreach ($list as $rem) {
            $remaining_amount = $rem->remaining_balance;
        }

        return view("admin.includes.sales.paid_sales.paid_amount")->with(
            compact([
                "sale_payment_details",
                "sale_invoice",
                "remaining_amount",
                "customer",
                "user",
                "full_name",
            ])
        );
    }
    //,$previous_remaining_amount,$payment_amount
    public function pay_sale_amount($id, Request $request)
    {
        $validated = $request->validate([
            "payment_amount" => [new PayAmountRule($request->total_amount)],
            "total_amount" => "required",
        ]);
        $d = new DateTime();
        $pay_invoice_no = "Pay" . $d->format("YmdHisv");
        $invoice_date = $d->format("YmdHisv");
        $sale_invoice = CustomerInvoice::find($id);

        $full_name = $this->full_name;
        $customer = Customer::find($sale_invoice->customer_id);
        $sale_payment_details = CustomerPayment::where([
            "customer_invoice_id" => $id,
            "branch_id" => Auth::user()->branch_id,
            "company_id" => Auth::user()->company_id,
        ])->get();
        $this->salePayment(
            $sale_invoice->customer_id,
            $sale_invoice->id,
            Auth::user()->branch_id,
            $pay_invoice_no,
            $invoice_date,
            $request->total_amount,
            $request->payment_amount,
            Auth::user()->getAuthIdentifier(),
            $request->total_amount - $request->payment_amount
        );
        if ($request->total_amount - $request->payment_amount == 0) {
            $session = Session::flash(
                "message",
                __(
                    "invoice payment : " .
                        $sale_invoice->invoice_no .
                        " has paid successfully"
                )
            );
            return redirect("salePaymentPending")->with("session");
        } else {
            $session = Session::flash(
                "message",
                __(
                    "you have paid " .
                        $request->payment_amount .
                        '$' .
                        "and  Remaining Amount is " .
                        ($request->total_amount - $request->payment_amount) .
                        ' $'
                )
            );
            return redirect()
                ->back()
                ->with("session");
        }
    }

    public function salePaymentPending()
    {
        $customer_name = Customer::getCustomerNameLang();
        $branch_name = Branch::getBranchNameLang();
        $salePaymentPendings = DB::table("customer_invoices")
            ->join(
                "customers",
                "customer_invoices.customer_id",
                "=",
                "customers.id"
            )
            ->join(
                "customer_payments",
                "customer_invoices.id",
                "=",
                "customer_payments.customer_invoice_id"
            )
            ->join(
                "branches",
                "customer_invoices.branch_id",
                "=",
                "branches.id"
            )
            ->select(
                "customer_invoices.id as id",
                "branches.branch_name_en as branch_name_en",
                "branches.branch_name_ar as branch_name_ar",
                "customers.customer_name_en as customer_name_en",
                "customers.customer_name_ar as customer_name_ar",
                "customers.contact_number as contact_number",
                "customer_invoices.invoice_date",
                "customer_invoices.invoice_number",
                "customer_invoices.total_amount",
                DB::raw("sum(customer_payments.payment_amount) as payment"),
                DB::raw(
                    "customer_invoices.total_amount - sum(customer_payments.payment_amount) as `remaining_payment`"
                )
            )
            ->groupBy("customer_payments.customer_invoice_id")
            ->where(
                "customer_invoices.total_amount",
                ">",
                "customer_payments.payment"
            )
            ->where([
                "customer_invoices.branch_id" => Auth::user()->branch_id,
                "customer_invoices.company_id" => Auth::user()->company_id,
            ])
            ->get();
        return view(
            "admin.includes.sales.pending_payments.pending_sales"
        )->with(
            compact(["salePaymentPendings", "customer_name", "branch_name"])
        );
    }
    public function salePaymentHistoryView($customer_invoice_id)
    {
        $customer_name = Customer::getCustomerNameLang();
        $branch_name = Branch::getBranchNameLang();
        $customer_id = CustomerInvoice::find($customer_invoice_id)->customer_id;
        $customer = Customer::find($customer_id);

        $salePaymentHistories = $this->salePaymentHistory(
            $customer_invoice_id,
            "",
            ""
        );
        return view(
            "admin.includes.sales.customer_payments_history.history_payments"
        )->with(
            compact([
                "salePaymentHistories",
                "customer",
                "customer_name",
                "branch_name",
            ])
        );
    }
    public function salePaymentHistoryViewByDate(Request $request)
    {
        if ($request->ajax()) {
            $customer_name = Customer::getCustomerNameLang();
            $branch_name = Branch::getBranchNameLang();
            $customer_id = CustomerInvoice::find($request->id)->customer_id;
            $customer = Customer::find($customer_id);
            $salePaymentHistories = $this->salePaymentHistory(
                $request->id,
                $request->start_date,
                $request->end_date
            );
            return view(
                "admin.includes.sales.customer_payments_history.history_payments_table"
            )->with(
                compact([
                    "salePaymentHistories",
                    "customer",
                    "customer_name",
                    "branch_name",
                ])
            );
        }
    }

    public function salePaymentHistory(
        $customer_invoice_id,
        $start_date,
        $end_date
    ) {
        if ($start_date == "" && ($end_date = "")) {
            $salePaymentHistories = DB::table("customer_invoices")
                ->join(
                    "customer_payments",
                    "customer_invoices.id",
                    "=",
                    "customer_payments.customer_invoice_id"
                )
                ->join(
                    "customers",
                    "customer_invoices.customer_id",
                    "=",
                    "customers.id"
                )
                ->select(
                    "customer_invoices.id",
                    "customers.customer_name_en as customer_name_en",
                    "customers.customer_name_ar as customer_name_ar",
                    "customers.contact_number as contact_number",
                    "customer_invoices.branch_id",
                    "customer_invoices.invoice_date",
                    "customer_invoices.customer_id",
                    "customer_invoices.invoice_number",
                    "customer_invoices.total_amount",
                    "customer_payments.payment_amount",
                    "customer_payments.remaining_balance",
                    "customer_payments.user_id"
                )
                ->groupBy("customer_payments.id")
                ->where(
                    "customer_invoices.total_amount",
                    ">",
                    "customer_payments.payment"
                )
                ->where([
                    "customer_invoices.id" => $customer_invoice_id,
                    "customer_invoices.company_id" => Auth::user()->company_id,
                    "customer_invoices.branch_id" => Auth::user()->branch_id,
                ])
                ->get();
        } else {
            $salePaymentHistories = DB::table("customer_invoices")
                ->join(
                    "customer_payments",
                    "customer_invoices.id",
                    "=",
                    "customer_payments.customer_invoice_id"
                )
                ->join(
                    "customers",
                    "customer_invoices.customer_id",
                    "=",
                    "customers.id"
                )
                ->select(
                    "customer_invoices.id",
                    "customers.customer_name_en as customer_name_en",
                    "customers.customer_name_ar as customer_name_ar",
                    "customers.contact_number as contact_number",
                    "customer_invoices.branch_id",
                    "customer_invoices.invoice_date",
                    "customer_invoices.customer_id",
                    "customer_invoices.invoice_number",
                    "customer_invoices.total_amount",
                    "customer_payments.payment_amount",
                    "customer_payments.remaining_balance",
                    "customer_payments.user_id"
                )
                ->groupBy("customer_payments.id")
                ->where(
                    "customer_invoices.total_amount",
                    ">",
                    "customer_payments.payment"
                )
                ->whereBetween("customer_invoices.invoice_date", [
                    $start_date,
                    $end_date,
                ])
                ->where([
                    "customer_invoices.id" => $customer_invoice_id,
                    "customer_invoices.company_id" => Auth::user()->company_id,
                    "customer_invoices.branch_id" => Auth::user()->branch_id,
                ])
                ->get();
        }
        return $salePaymentHistories;
    }

    public function addCustomerInvoiceFunction(Request $request)
    {
        $title = $this->title;
        $financial_year = FinanceYear::where("isActive", 1)->first();
        //sale Product debit transaction
        //sale  id 3
        $data = [
            "financial_year" => $financial_year,
        ];
        $validated = $request->merge($data);
        $validated = $request->validate([
            "financial_year" => new FinanceYearRule(),
            "store_id" => Auth::user()->user_type_id == 1 ? "required" : "",
            "customer_id" => "required",
            "payment_type_id" => "required",
            "sell_type_id" => "required",
            "sub_total_amount" => "required",
            "total_amount" => "required",
            "discount" => "required",
            "tax" => "required",
        ]);
        $customer = Customer::find($request->customer_id);
        $invoice_date = date("Y-m-d H:i");
        //get total allow tax
        $salesStocks = Sale::where([
            "company_id" => Auth::user()->company_id,
            "branch_id" => Auth::user()->branch_id,
        ])->get();
        //get total allow tax
        $totalallowtax = DB::table("stocks")
            ->join("sales", "stocks.id", "=", "sales.stock_id")
            ->where("allowtax", 1)
            ->where([
                "sales.company_id" => Auth::user()->company_id,
                "sales.branch_id" => Auth::user()->branch_id,
                "store_id" => Auth::user()->store_id,
            ])
            ->selectRaw("sum( sales.sale_qty * sales.sale_unit_price ) as sum")
            ->first()->sum;

        ##############################  customer invoice  ################################################

        $customer_invoice = new CustomerInvoice();
        $customer_invoice->customer_id = $request->customer_id;

        $customer_invoice->store_id = $request->store_id;
        $customer_invoice->branch_id = Auth::user()->branch_id;
        $customer_invoice->company_id = Auth::user()->company_id;
        $customer_invoice->user_id = Auth::user()->getAuthIdentifier();
        $invoice_number = "INP" . date("YmdHis") . $customer_invoice->user_id;
        $customer_invoice->invoice_number = $invoice_number;
        $customer_invoice->invoice_date = $invoice_date;
        $customer_invoice->discount = $request->discount;
        $customer_invoice->tax = $request->tax;
        $paymentId = $request->payment_type_id;
        $customer_invoice->sub_total_amount = $request->sub_total_amount;
        $customer_invoice->total_amount = $request->total_amount;
        // return $totalallowtax;
        $customer_invoice->total_tax_allowed =
            $totalallowtax != "" ? $totalallowtax : 0;

        $customer_invoice->save();
        ##############################  stock effect  ################################################

        foreach ($salesStocks as $saleStock) {
            //make customer detail
            $customer_invoice_detail = new CustomerInvoiceDetail();
            $customer_invoice_detail->customer_invoice_id =
                $customer_invoice->id;
            $customer_invoice_detail->stock_id = $saleStock->stock_id;
            $customer_invoice_detail->sale_quantity = $saleStock->sale_qty;
            $customer_invoice_detail->sale_unit_price =
                $saleStock->sale_unit_price;
            $customer_invoice_detail->save();
            //update stock
            $stockProduct = Stock::find($saleStock->stock_id);

            $stockProduct->quantity -= $saleStock->sale_qty;
            $stockProduct->current_sale_unit_price =
                $saleStock->sale_unit_price;
            $stockProduct->current_sale_unit_price =
                $saleStock->sale_unit_price;
            $stockProduct->save();
        }

        ##1############################  debit  entry  ################################################
        //sale Product debit transaction sale Activity
        //account_activity=1 => sale product

        //account_head =3 Revenue
        // $account_control_id=8   Sales Revenues 31
        // $account_sub_control_id=29  311 Sales

        $saleAccount = $this->entries->getAccountSetting(3, 31, 311, 1);
        $this->entries->setEntries(
            $financial_year->id,
            $saleAccount->account_head_id,
            $saleAccount->account_control_id,
            $saleAccount->account_sub_control_id,
            $invoice_number,
            $invoice_date,
            Auth::user()->getAuthIdentifier(),
            Auth::user()->branch_id,
            0,
            $request->total_amount,
            " Sale From " . $customer->customer_name_en,
            isset($customer->customer_name_ar)
                ? $customer->customer_name_ar . "البيع الى"
                : $customer->customer_name_en . "البيع الى"
        );

        ##2############################  credit   entry  ################################################

        //sale Payment Pending

        //account_activity= 10  => sale Payment Pending
        //account_head =2   liabilities 2
        // $account_control_id=4  Current Liabilities 21
        // $account_sub_control_id=18 Notes Payable  212

        $saleAccount = $this->entries->getAccountSetting(2, 21, 212, 10);

        $this->entries->setEntries(
            $financial_year->id,
            $saleAccount->account_head_id,
            $saleAccount->account_control_id,
            $saleAccount->account_sub_control_id,
            $invoice_number,
            $invoice_date,
            Auth::user()->getAuthIdentifier(),
            Auth::user()->branch_id,
            $request->total_amount,
            0,
            " Sale Payment Pending " . $customer->customer_name_en,
            isset($customer->customer_name_ar)
                ? $customer->customer_name_ar . "في انتظار الدفع  "
                : $customer->customer_name_en . "في انتظار الدفع  "
        );
        ############################## is payment PAID ################################################

        if ($request->sell_type_id == 1) {
            $d = new DateTime();
            $invoice_no = "Pay" . $d->format("YmdHisv");

            $invoice_customer_payment = new CustomerPayment();
            $invoice_customer_payment->customer_id =
                $customer_invoice->customer_id;
            $invoice_customer_payment->customer_invoice_id =
                $customer_invoice->id;
            $invoice_customer_payment->branch_id = $customer_invoice->branch_id;
            $invoice_customer_payment->invoice_number = $invoice_no;
            $invoice_customer_payment->invoice_date =
                $customer_invoice->invoice_date;
            $invoice_customer_payment->total_amount =
                $customer_invoice->total_amount;
            $invoice_customer_payment->payment_amount =
                $customer_invoice->total_amount;
            $invoice_customer_payment->remaining_balance = 0;
            $invoice_customer_payment->payment_id = $paymentId;
            $invoice_customer_payment->user_id = Auth::user()->getAuthIdentifier();
            $invoice_customer_payment->save();
            ##3############################  debit  entry  ################################################

            //sale Payment Pending
            //account_activity= 10 =>sale Payment Pending
            //account_head =2   liabilities
            // $account_control_id=4  Current Liabilities
            // $account_sub_control_id=18 Notes Payable
            $saleAccount = $this->entries->getAccountSetting(2, 21, 212, 10);
            $this->entries->setEntries(
                $financial_year->id,
                $saleAccount->account_head_id,
                $saleAccount->account_control_id,
                $saleAccount->account_sub_control_id,
                $invoice_number,
                $invoice_date,
                Auth::user()->getAuthIdentifier(),
                Auth::user()->branch_id,
                0,
                $request->total_amount,
                "  Sale Payment Paid to" . $customer->customer_name_en,
                isset($customer->customer_name_ar)
                    ? $customer->customer_name_ar . "تم الترحيل "
                    : $customer->customer_name_en . "تم الترحيل"
            );
            ##4############################  credit entry ################################################

            //sale Payment PAID
            //account_activity=9 =>sale Payment PAID // DEBIT ENTRY TRANSACTION

            if ($request->payment_type_id == 2) {
                //account_head =1   assets
                // $account_control_id=1   Current Assets
                // $account_sub_control_id=2   Cash on bank

                $saleAccount = $this->entries->getAccountSetting(
                    1,
                    11,
                    112,
                    11
                );
            } else {
                //account_head =1   assets
                // $account_control_id=1   Current Assets
                // $account_sub_control_id=1  cash on hands

                $saleAccount = $this->entries->getAccountSetting(
                    1,
                    11,
                    111,
                    11
                );
            }
            $this->entries->setEntries(
                $financial_year->id,
                $saleAccount->account_head_id,
                $saleAccount->account_control_id,
                $saleAccount->account_sub_control_id,
                $invoice_number,
                $invoice_date,
                Auth::user()->getAuthIdentifier(),
                Auth::user()->branch_id,
                $request->total_amount,
                0,
                " Sale Payment Succeed" . $customer->customer_name_en,
                isset($customer->customer_name_ar)
                    ? $customer->customer_name_ar . $this->salePaymentAr
                    : $customer->customer_name_en . $this->salePaymentAr
            );
        } else {
            $d = new DateTime();
            $invoice_no = "Pay" . $d->format("YmdHisv");

            $invoice_customer_payment = new CustomerPayment();
            $invoice_customer_payment->customer_id =
                $customer_invoice->customer_id;
            $invoice_customer_payment->customer_invoice_id =
                $customer_invoice->id;
            $invoice_customer_payment->branch_id = $customer_invoice->branch_id;
            $invoice_customer_payment->company_id = Auth::user()->company_id;
            $invoice_customer_payment->invoice_number = $invoice_no;
            $invoice_customer_payment->invoice_date =
                $customer_invoice->invoice_date;
            $invoice_customer_payment->total_amount =
                $customer_invoice->total_amount;
            $invoice_customer_payment->payment_amount = 0;
            $invoice_customer_payment->remaining_balance =
                $customer_invoice->total_amount;
            $invoice_customer_payment->payment_id = $paymentId;
            $invoice_customer_payment->user_id = Auth::user()->getAuthIdentifier();

            $invoice_customer_payment->save();
        }
        ##############################  delete table sale data  ################################################

        Sale::query()->truncate();
        ##############################  return sale invoice  ################################################

        return $this->saleCustomerInvoice($customer_invoice->id);
    }

    public function saleCustomerInvoice($customerInvoiceId)
    {
        $customer_name = $this->customer_name;
        $product_name = Stock::getProductNameLang();
        $address = $this->address;
        $customer_invoice = CustomerInvoice::find($customerInvoiceId);
        $customer_invoice_details = CustomerInvoiceDetail::with("stock")
            ->where([
                "customer_invoice_id" => $customerInvoiceId,
            ])
            ->get();
        $customer = Customer::where([
            "id" => $customer_invoice->customer_id,
            "company_id" => Auth::user()->company_id,
            "branch_id" => Auth::user()->branch_id,
        ])->first();
        return view("admin.includes.sales.sale_invoice")->with(
            compact([
                "customer_name",
                "product_name",
                "address",
                "customer",
                "customer_invoice",
                "customer_invoice_details",
            ])
        );
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
    public function getSumTotalItem(Request $request)
    {
        if ($request->ajax()) {
            //get total of item (quantity * sale);
            $sales = Sale::where([
                "company_id" => Auth::user()->company_id,
                "branch_id" => Auth::user()->branch_id,
            ])
                ->selectRaw(
                    "if(count(id)>0,sum(sale_qty * sale_unit_price),0) as sub_total"
                )
                ->first();
            return $sales;
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

    public function deleteSale($id)
    {
        $sale = Sale::find($id);
        $sale->delete();

        $session = Session::flash("message", __("messages.data_removed"));
        return redirect("sales")->with(compact("session"));
    }
    public function fetchSaleData(Request $request)
    {
        if ($request->ajax()) {
            if (\Illuminate\Support\Facades\Auth::user()->user_type_id == 1) {
                $sales = Sale::with("stock")
                    ->where([
                        "stock_id" => $request->stock_id,
                        "branch_id" => Auth::user()->branch_id,
                        "company_id" => Auth::user()->company_id,
                    ])
                    ->get();
            } else {
                $sales = Sale::with("stock")
                    ->where(
                        "branch_id",
                        \Illuminate\Support\Facades\Auth::user()->branch_id
                    )
                    ->get();
            }

            return json_encode($sales);
        }
    }
    public function fetchproductsToSaleCart(Request $request)
    {
        $description = Stock::getDescriptionLang();
        if ($request->ajax()) {
            $product = Stock::where("id", $request->stock_id)->first();
            $sales = Sale::where([
                "stock_id" => $request->stock_id,
                "branch_id" => Auth::user()->branch_id,
                "company_id" => Auth::user()->company_id,
            ])->get();

            if ($sales->count() > 0) {
                return "";
            } else {
                $salesCart = new Sale();
                $salesCart->branch_id = Auth::user()->branch_id;
                $salesCart->unit_id = $product->unit_id;
                $salesCart->category_id = $product->category_id;
                $salesCart->stock_id = $product->id;
                $salesCart->$description = $product->$description;
                $salesCart->sale_qty = 0;
                $salesCart->sale_unit_price = $product->current_sale_unit_price;
                $salesCart->sale_unit_price = $product->current_sale_unit_price;
                $salesCart->user_id = Auth::user()->id;
                $salesCart->company_id = Auth::user()->company_id;
                $salesCart->save();
                return $product;
            }
        }
    }
    public function postProductOnQtyChangeToSaleCart(Request $request)
    {
        if ($request->ajax()) {
            $saleCart = Sale::find($request->id);
            $saleCart->sale_qty = $request->sale_qty;
            $saleCart->save();
            return $saleCart;
        }
    }
}

class SalesEntries
{
    public static function setEntries(
        $financial_year_id,
        $account_head_id,
        $account_control_id,
        $account_sub_control_id,
        $invoice_number,
        $invoice_date,
        $user_id,
        $branch_id,
        $credit,
        $debit,
        $transaction_title_en,
        $transaction_title_ar
    ) {
        $setdebitEntry = new Transaction();
        $setdebitEntry->financial_year_id = $financial_year_id;
        $setdebitEntry->account_head_id = $account_head_id; //these form Account Setting $debitEntry
        $setdebitEntry->account_control_id = $account_control_id; //these form Account Setting $debitEntry
        $setdebitEntry->account_sub_control_id = $account_sub_control_id; //these form Account Setting $debitEntry
        $setdebitEntry->invoice_number = $invoice_number;
        $setdebitEntry->transaction_date = $invoice_date;
        $setdebitEntry->user_id = $user_id;
        $setdebitEntry->branch_id = $branch_id;
        $setdebitEntry->credit = $credit;
        $setdebitEntry->debit = $debit;
        $setdebitEntry->transaction_title_en = $transaction_title_en;
        $setdebitEntry->transaction_title_ar = $transaction_title_ar;
        $setdebitEntry->save();
    }

    public static function getAccountSetting(
        $account_head_code,
        $account_control_code,
        $account_sub_control_code,
        $account_activity_id
    ) {
        $entry = AccountSetting::where(
            "account_activity_id",
            $account_activity_id
        )->first();
        if (!isset($entry)) {
            $entry = new AccountSetting(); // create new account setting
            $entry->account_head_id = $account_head_code;
            $entry->account_control_id = $account_control_code;
            $entry->account_sub_control_id = $account_sub_control_code;
            $entry->account_activity_id = $account_activity_id;
            $entry->branch_id = Auth::user()->branch_id;
            $entry->company_id = Auth::user()->company_id;
            $entry->save();
        }
        return $entry;
    }
}

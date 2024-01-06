<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerInvoice;
use App\Models\CustomerInvoiceDetail;
use App\Models\CustomerPayment;
use App\Models\FinanceYear;
use App\Models\Sale;
use App\Models\SaleCart;
use App\Models\Stock;
use App\Rules\FinanceYearRule;
use App\Services\SalesEntries;
use Auth;
use DateTime;
use DB;
use Illuminate\Http\Request;

class CustomerInvoiceController extends Controller
{
    // title
    private $title;
    private $entries;
    private $salePaymentAr = "تم الدفع ";
    //customer_name
    private $customer_name;
    private $address;
    public function __construct(){
        $this->entries = new SalesEntries();
        $this->title = CustomerInvoice::getTitleLang();
        $this->customer_name = Customer::getCustomerNameLang();
        $this->address = Customer::getaddressLang();
    }

    public function addCustomerInvoiceFunction(Request $request)
    {
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
        $salesStocks = SaleCart::where([
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
        $customer_invoice->total_tax_allowed =   $totalallowtax != "" ? $totalallowtax : 0;

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
            0,  $request->total_amount,
            " Sale From " . $customer->customer_name_en,
            isset($customer->customer_name_ar)  ? $customer->customer_name_ar . "البيع الى"
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
            0,  " Sale Payment Pending " . $customer->customer_name_en,
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
            $invoice_customer_payment->customer_id =  $customer_invoice->customer_id;
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
            ])->get();
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


}

<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Customer;
use App\Models\CustomerInvoice;
use App\Models\CustomerPayment;
use App\Models\FinanceYear;
use App\Models\User;
// use App\Models\User;
use App\Rules\PayAmountRule;
use App\Services\SalesEntries as ServicesSalesEntries;
use Auth;
use DateTime;
use DB;
use Illuminate\Http\Request;
use App\Services\SalesEntries;


use Session;

class SalePaymentController extends Controller
{
    private $entries;


  private $salePaymentAr = "تم الدفع ";
//construcor
public function __construct(){
    $this->middleware('auth');
    $this->entries = new  SalesEntries();
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
                $request->id ,
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

    // public function salePaymentHistory(
    //     $customer_invoice_id,
    //     $start_date,
    //     $end_date
    // ) {
    //     if ($start_date == "" && ($end_date = "")) {
    //         $salePaymentHistories = DB::table("customer_invoices")
    //             ->join(
    //                 "customer_payments",
    //                 "customer_invoices.id",
    //                 "=",
    //                 "customer_payments.customer_invoice_id"
    //             )
    //             ->join(
    //                 "customers",
    //                 "customer_invoices.customer_id",
    //                 "=",
    //                 "customers.id"
    //             )
    //             ->select(
    //                 "customer_invoices.id",
    //                 "customers.customer_name_en as customer_name_en",
    //                 "customers.customer_name_ar as customer_name_ar",
    //                 "customers.contact_number as contact_number",
    //                 "customer_invoices.branch_id",
    //                 "customer_invoices.invoice_date",
    //                 "customer_invoices.customer_id",
    //                 "customer_invoices.invoice_number",
    //                 "customer_invoices.total_amount",
    //                 "customer_payments.payment_amount",
    //                 "customer_payments.remaining_balance",
    //                 "customer_payments.user_id"
    //             )
    //             ->groupBy("customer_payments.id")
    //             ->where(
    //                 "customer_invoices.total_amount",
    //                 ">",
    //                 "customer_payments.payment"
    //             )
    //             ->where([
    //                 "customer_invoices.id" => $customer_invoice_id,
    //                 "customer_invoices.company_id" => Auth::user()->company_id,
    //                 "customer_invoices.branch_id" => Auth::user()->branch_id,
    //             ])
    //             ->get();
    //     } else {
    //         $salePaymentHistories = DB::table("customer_invoices")
    //             ->join(
    //                 "customer_payments",
    //                 "customer_invoices.id",
    //                 "=",
    //                 "customer_payments.customer_invoice_id"
    //             )
    //             ->join(
    //                 "customers",
    //                 "customer_invoices.customer_id",
    //                 "=",
    //                 "customers.id"
    //             )
    //             ->select(
    //                 "customer_invoices.id",
    //                 "customers.customer_name_en as customer_name_en",
    //                 "customers.customer_name_ar as customer_name_ar",
    //                 "customers.contact_number as contact_number",
    //                 "customer_invoices.branch_id",
    //                 "customer_invoices.invoice_date",
    //                 "customer_invoices.customer_id",
    //                 "customer_invoices.invoice_number",
    //                 "customer_invoices.total_amount",
    //                 "customer_payments.payment_amount",
    //                 "customer_payments.remaining_balance",
    //                 "customer_payments.user_id"
    //             )
    //             ->groupBy("customer_payments.id")
    //             ->where(
    //                 "customer_invoices.total_amount",
    //                 ">",
    //                 "customer_payments.payment"
    //             )
    //             ->whereBetween("customer_invoices.invoice_date", [
    //                 $start_date,
    //                 $end_date,
    //             ])
    //             ->where([
    //                 "customer_invoices.id" => $customer_invoice_id,
    //                 "customer_invoices.company_id" => Auth::user()->company_id,
    //                 "customer_invoices.branch_id" => Auth::user()->branch_id,
    //             ])
    //             ->get();
    //     }
    //     return $salePaymentHistories;
    // }
    public function salePaymentHistory($customerInvoiceId, $startDate = null, $endDate = null)
{
    return $this->buildSalePaymentHistoryQuery($customerInvoiceId, $startDate, $endDate)->get();
}

private function buildSalePaymentHistoryQuery($customerInvoiceId, $startDate, $endDate)
{
    $query = CustomerInvoice::query()
        ->join('customer_payments', 'customer_invoices.id', '=', 'customer_payments.customer_invoice_id')
        ->join('customers', 'customer_invoices.customer_id', '=', 'customers.id')
        ->select([
            'customer_invoices.id',
            'customers.customer_name_en',
            'customers.customer_name_ar',
            'customers.contact_number',
            'customer_invoices.branch_id',
            'customer_invoices.invoice_date',
            'customer_invoices.customer_id',
            'customer_invoices.invoice_number',
            'customer_invoices.total_amount',
            'customer_payments.payment_amount',
            'customer_payments.remaining_balance',
            'customer_payments.user_id'
        ])
        ->where('customer_invoices.id', $customerInvoiceId)
        ->where('customer_invoices.total_amount', '>', 'customer_payments.payment')
        ->where('customer_invoices.company_id', Auth::user()->company_id)
        ->where('customer_invoices.branch_id', Auth::user()->branch_id);

    if ($startDate && $endDate) {
        $query->whereBetween('customer_invoices.invoice_date', [$startDate, $endDate]);
    }

    return $query->groupBy('customer_payments.id');
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
                    "invoice payment : " .    $sale_invoice->invoice_no .  " has paid successfully"
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

    public function paid_amount($id)
    {
        $d = new DateTime();
        $invoice_no = "Pay" . $d->format("YmdHisv");
        $sale_invoice = CustomerInvoice::find($id);
        $user = User::find($sale_invoice->user_id);
        $full_name =User::getFullnameLang();
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















}

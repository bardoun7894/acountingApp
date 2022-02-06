<?php

namespace App\Http\Controllers;

use App\Models\AccountSetting;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\CustomerInvoiceDetail;
use App\Models\FinanceYear;
use App\Models\PaymentType;
use App\Models\Sale;
use App\Models\SellType;
use App\Models\Stock;
use App\Models\Store;
use App\Models\CustomerInvoice;
use App\Models\Transaction;
use App\Models\Translation;
use App\Models\Unit;
use App\Models\UserType;
use App\Rules\FinanceYearRule;
use App\Rules\PurchaseCartRule;
use App\Rules\SaleCartRule;
use App\Rules\ValidSalePrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SaleController extends Controller
{


    private $product_name;
    private $description;
    private $category_name;
    private $unit_name;
    private $branch_name;
    private $store_name;
    private $title;
    private $payment_type_name;
    private $sell_type_name;
    private $address;
    private $s_name;
    private $customer_name;

    function __construct()
    {
        $this->product_name=Stock::getProductNameLang();
        $this->s_name=Currency::getSNameLang();
        $this->sell_type_name=SellType::getSellTypeNameLang();
        $this->payment_type_name=PaymentType::getPaymentTypeNameLang();
        $this->title=CustomerInvoice::getTitleLang();
        $this->branch_name=Branch::getBranchNameLang();
        $this->store_name=Store::getStoreNameLang();
        $this->customer_name=Customer::getCustomerNameLang();
        $this->address=Customer::getaddressLang();
        $this->unit_name=Unit::getUnitNameLang();
        $this->description=Stock::getDescriptionLang();
        $this->category_name=Category::getCategoryNameLang(Translation::getLang());


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_name=$this->product_name;
        $payment_type_name=$this->payment_type_name;
        $sell_type_name=  $this->sell_type_name;
        $branch_name=$this->branch_name;
        $store_name=$this->store_name;
        $description=$this->description;
//      $stocks = Stock::with(['category','user'])->get();
        $customer_name=$this->customer_name;
        $customers=Customer::all();
        $payment_types=PaymentType::where('status',1)->get();
        $currency=Currency::where('status',1)->first();
        $s_name=$this->s_name;
        $sell_types=SellType::where('status',1)->get();
        $stores=Store::all();
        if(\Illuminate\Support\Facades\Auth::user()->user_type_id==1){
            $sales=Sale::with('stock')->get();
        }else{
            $sales=Sale::with('stock')->where('branch_id',\Illuminate\Support\Facades\Auth::user()->branch_id)->get();
        }
        $branches=Branch::all();

        return view('admin.includes.sales.sales')->with(compact([ 'customers', 'currency','s_name','payment_types','sell_types','stores','store_name','branches','customer_name','payment_type_name','sell_type_name','sales','product_name','branch_name','description']));
        //
    }
    public function getSelectedBranchCustomer(Request $request){
        if($request->ajax()){
            $data=$request->all();
            $customers=Customer::where('branch_id',$data['branch_id'])->get();
            $customer_name=$this->customer_name ;
            return view('admin.includes.customers.select_customer')->with(compact(['customers','customer_name',]));

        }
    }
    public function getCustomerItembyId(Request $request){
        if($request->ajax()){
            $data=$request->all();
            if($data['customer_id']=="null"){
                return 0;
            }

            $customerData =  Customer::find($data['customer_id']);
            return $customerData;
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userType=  UserType::where('id',Auth::user()->user_type_id )->first();
        if( isset($userType) &&  $userType->user_type_en==='admin'){
            $branches =Branch::with('categories')->get();
        }else{
            $branches=Branch::with('categories')->where('id',\Illuminate\Support\Facades\Auth::user()->branch_id)->get();
        }

        $category_name=$this->category_name;
        $branch_name=$this->branch_name;
        $product_name=$this->product_name;
        $unit_name=$this->unit_name;
        $description=$this->description;
        $getProducts = Stock::all();
        $units=Unit::where('status',1)->get();

        $customer_name=$this->customer_name;
        $customers=Customer::all();


        return view('admin.includes.sales.create')->with(compact([ 'customers','getProducts','branches','branch_name','units','product_name','customer_name','unit_name','category_name','description','userType']));

    }
    public function getSumTotalItem(Request $request){
        if($request->ajax()){
            //get total of item (quantity * sale);
            $sales =  Sale::selectRaw('if(count(id)>0,sum(sale_qty * sale_unit_price),0) as sub_total')->first();
            return $sales;
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $product_name=$this->product_name;
        $description=$this->description;
        $validated = $request->validate([
            'branch_id' => 'required',
            'category_id' => 'required',
            'stock_id' =>  [new SaleCartRule($request->stock_id)],
            'unit_id' => 'required',
            $description=>'required',
            'quantity'=>'required',
            'sale_unit_price'=>new ValidSalePrice($request->stock_id),
        ]);

        $saleCart =new Sale();
        $saleCart->branch_id =$request->branch_id;
        $saleCart->unit_id =$request->unit_id;
        $saleCart->category_id =$request->category_id;
        $saleCart->stock_id =$request->stock_id;
        $saleCart->$description =$request->$description;
        $saleCart->sale_qty = $request->quantity;
        $saleCart->sale_unit_price = $request->sale_unit_price;
        $saleCart->user_id =Auth::user()->id;
        $saleCart->save();

        $session =Session::flash('message',__('messages.data_added'));
        return redirect('sales')->with(compact(['session','product_name','description']));


    }

    public function addCustomerInvoiceFunction(Request $request)
    {
        $title=$this->title;
        $financial_year = FinanceYear::where('isActive',1)->first();
        //sale Product debit transaction


        //sale  id 3

        $data = [
            'financial_year' => $financial_year,
        ];
        $validated = $request->merge($data);

        $validated = $request->validate([
            'financial_year' =>new FinanceYearRule(),
            'branch_id' => Auth::user()->user_type_id==1?'required':"",
            'store_id' => Auth::user()->user_type_id==1?'required':"" ,
            'customer_id' =>'required',
            'payment_type_id' =>'required',
            'sell_type_id' =>'required',
            'sub_total_amount' => 'required',
            'total_amount' => 'required',
            'discount' => 'required',
            'tax' => 'required',
        ]);


        $customer=Customer::find($request->customer_id);

        $invoice_date= date('Y-m-d H:i');

        $stocks =Stock::with('sales')->where('store_id', Auth::user()->store_id)->get();
        //get total allow tax

        $totalallowtax = DB::table('stocks')
            ->join('sales', 'stocks.id', '=', 'sales.stock_id')
            ->where('allowtax',1)->where('store_id', Auth::user()->store_id)
            ->selectRaw('sum(sales.sale_qty * sales.sale_unit_price) as total')->first();
 //insert into customer invoice
        $customer_invoice =new CustomerInvoice();
        $customer_invoice->customer_id = $request->customer_id;

        if(Auth::user()->getAuthIdentifier()==1){
            $customer_invoice->store_id =$request->store_id  ;
            $customer_invoice->branch_id =$request->branch_id;
        }else{
            $customer_invoice->store_id =Auth::user()->store_id;
            $customer_invoice->branch_id =Auth::user()->branch_id;
        }
        $customer_invoice->user_id =Auth::user()->getAuthIdentifier();
        $invoice_number = "PUR".date('YmdHis'). $customer_invoice->user_id;
        $customer_invoice->invoice_number=$invoice_number;
        $customer_invoice->invoice_date =$invoice_date;
        $customer_invoice->discount = $request->discount;
        $customer_invoice->tax = $request->tax;
        $paymentId=$request->payment_type_id;
        $customer_invoice->sub_total_amount = $request->sub_total_amount;
        $customer_invoice->total_amount = $request->total_amount;
        $customer_invoice-> total_tax_allowed = $totalallowtax->total;
        $customer_invoice->save();

        foreach ($stocks as $stock){
            foreach($stock->sales as $saleStock){
                //make customer detail
                $customer_invoice_detail = new CustomerInvoiceDetail();
                $customer_invoice_detail->customer_invoice_id = $customer_invoice->id;
                $customer_invoice_detail->stock_id = $saleStock->stock_id;
                $customer_invoice_detail->sale_quantity = $saleStock->sale_qty;
                $customer_invoice_detail->sale_unit_price = $saleStock->sale_unit_price;
                $customer_invoice_detail->save() ;

                //update stock
                $stockProduct= Stock::find($saleStock->stock_id) ;
                $stockProduct->expiry_date= $saleStock->expiry_date ;
                $stockProduct->quantity  =  $stockProduct->quantity - $saleStock->sale_qty ;
                $stockProduct->current_sale_unit_price= $saleStock->sale_unit_price ;
                $stockProduct->sale_unit_price= $saleStock->sale_unit_price ;
                $stockProduct->save();
            }

        }
        //sale Product debit transaction sale Activity
        //account_activity=3 =>sale

        $debitEntry = $this->getAccountSetting(3,6,4,3);

        $setdebitEntry=new Transaction();
        $setdebitEntry->financial_year_id=$financial_year->id;
        $setdebitEntry->account_head_id= $debitEntry->account_head_id;   //these form Account Setting $debitEntry
        $setdebitEntry->account_control_id= $debitEntry->account_control_id; //these form Account Setting $debitEntry
        $setdebitEntry->account_sub_control_id=$debitEntry->account_sub_control_id; //these form Account Setting $debitEntry
        $setdebitEntry->invoice_number=$invoice_number;
        $setdebitEntry->transaction_date=$invoice_date;
        $setdebitEntry->user_id=Auth::user()->getAuthIdentifier();
        $setdebitEntry->branch_id=Auth::user()->branch_id;
        $setdebitEntry->credit=0;
        $setdebitEntry->debit=$request->total_amount;
        $setdebitEntry->transaction_title_en=" Purchase From ".$customer-> customer_name_en;
        $setdebitEntry->transaction_title_ar= isset($customer-> customer_name_ar)? $customer-> customer_name_ar ."الشراء من ": $customer-> customer_name_en ."الشراء من ";
        $setdebitEntry->save();

        //sale Payment Pending

        //account_activity=5 =>sale Payment Pending // DEBIT ENTRY TRANSACTION

        $creditEntry = $this->getAccountSetting(1,5,3,5);

        $setcreditEntry=new Transaction();
        $setcreditEntry->financial_year_id=$financial_year->id;
        $setcreditEntry->account_head_id= $creditEntry->account_head_id;   //these form Account Setting $debitEntry
        $setcreditEntry->account_control_id= $creditEntry->account_control_id; //these form Account Setting $debitEntry
        $setcreditEntry->account_sub_control_id=$creditEntry->account_sub_control_id; //these form Account Setting $debitEntry
        $setcreditEntry->invoice_number=$invoice_number;
        $setcreditEntry->transaction_date=$invoice_date;
        $setcreditEntry->user_id=Auth::user()->getAuthIdentifier();
        $setcreditEntry->branch_id=Auth::user()->branch_id;
        $setcreditEntry->credit=$request->total_amount;
        $setcreditEntry->debit=0;
        $setcreditEntry->transaction_title_en=" Purchase Payment Pending ( ".$customer-> customer_name_en.")";
        $setcreditEntry->transaction_title_ar= isset($customer-> customer_name_ar)?"(".$customer-> customer_name_ar ."في انتظار الدفع (":"(". $customer-> customer_name_en ."في انتظار الدفع (";
        $setcreditEntry->save();
        //is payment PAID
        if($request->sell_type_id==1){
            $invoice_no="PPP".date('ymdhis') . $customer_invoice->user_id;
            $invoice_customer_payment = new CustomerPayment();
            $invoice_customer_payment->customer_id =  $customer_invoice->customer_id;
            $invoice_customer_payment->customer_invoice_id = $customer_invoice->id;
            $invoice_customer_payment->branch_id =   $customer_invoice->branch_id ;
            $invoice_customer_payment->invoice_no =   $invoice_no;
            $invoice_customer_payment->invoice_date =  $customer_invoice->invoice_date;
            $invoice_customer_payment->total_amount =   $customer_invoice->total_amount;;
            $invoice_customer_payment->payment_amount =  $customer_invoice->total_amount;;
            $invoice_customer_payment->remaining_balance =  0 ;
            $invoice_customer_payment->payment_id = $paymentId ;
            $invoice_customer_payment->user_id = Auth::user()->getAuthIdentifier();
            $invoice_customer_payment->save();
            //sale Payment Pending
            //account_activity=5 =>sale Payment Pending // DEBIT ENTRY TRANSACTION

            $debitEntry = $this->getAccountSetting(1,5,3,5);

            $setdebitEntry = new Transaction();
            $setdebitEntry->financial_year_id=$financial_year->id;
            $setdebitEntry->account_head_id= $debitEntry->account_head_id;   //these form Account Setting $debitEntry
            $setdebitEntry->account_control_id= $debitEntry->account_control_id; //these form Account Setting $debitEntry
            $setdebitEntry->account_sub_control_id=$debitEntry->account_sub_control_id; //these form Account Setting $debitEntry
            $setdebitEntry->invoice_number=$invoice_number;
            $setdebitEntry->transaction_date=$invoice_date;
            $setdebitEntry->user_id=Auth::user()->getAuthIdentifier();
            $setdebitEntry->branch_id=Auth::user()->branch_id;
            $setdebitEntry->credit=0;
            $setdebitEntry->debit=$request->total_amount;
            $setdebitEntry->transaction_title_en=" Purchase Payment Transfer ( ".$customer-> customer_name_en." )";
            $setdebitEntry->transaction_title_ar= isset($customer-> customer_name_ar)?" ( ".$customer-> customer_name_ar ."تم الترحيل ( ":" ( ". $customer-> customer_name_en ."تم الترحيل ( ";
            $setdebitEntry->save();
            //sale Payment PAID
            //account_activity=5 =>sale Payment PAID // DEBIT ENTRY TRANSACTION


            $creditEntry = $this->getAccountSetting(1,7,5,6);

            $setcreditEntry = new Transaction();
            $setcreditEntry->financial_year_id=$financial_year->id;
            $setcreditEntry->account_head_id= $creditEntry->account_head_id;   //these form Account Setting $debitEntry
            $setcreditEntry->account_control_id= $creditEntry->account_control_id; //these form Account Setting $debitEntry
            $setcreditEntry->account_sub_control_id=$creditEntry->account_sub_control_id; //these form Account Setting $debitEntry
            $setcreditEntry->invoice_number=$invoice_number;
            $setcreditEntry->transaction_date=$invoice_date;
            $setcreditEntry->user_id=Auth::user()->getAuthIdentifier();
            $setcreditEntry->branch_id=Auth::user()->branch_id;
            $setcreditEntry->credit= $request->total_amount;
            $setcreditEntry->debit=0 ;
            $setcreditEntry->transaction_title_en=" Purchase Payment Paid ( ".$customer-> customer_name_en." )";
            $setcreditEntry->transaction_title_ar= isset($customer-> customer_name_ar)?" ( ".$customer-> customer_name_ar ."تم الدفع ( ":" ( ". $customer-> customer_name_en ."تم الدفع ( ";
            $setcreditEntry->save();
        }
        //delete table sale data
        Sale::query()->truncate();
        return   $this->saleCustomerInvoice($customer_invoice->id);
    }

    public function getAccountSetting($account_head_id,$account_control_id,$account_sub_control_id,$account_activity_id){
        $debitEntry = AccountSetting::where('account_activity_id' , $account_activity_id)->first();
        if(!isset($debitEntry)){
            $debitEntry = new AccountSetting();
            $debitEntry->account_head_id = $account_head_id; //1
            $debitEntry->account_control_id = $account_control_id; //2
            $debitEntry->account_sub_control_id = $account_sub_control_id;//1
            $debitEntry->account_activity_id = $account_activity_id;//3
            $debitEntry->branch_id=Auth::user()->branch_id;
            $debitEntry->save();
        }
        return $debitEntry;
    }
    public function saleCustomerInvoice($customerInvoiceId){
        $customer_name=$this->customer_name;
        $product_name=Stock::getProductNameLang();
        $address=$this->address;
        $customer_invoice = CustomerInvoice::find($customerInvoiceId);
        $customer_invoice_details = CustomerInvoiceDetail::with('stock')->where('customer_invoice_id',$customerInvoiceId)->get();
        $customer=Customer::where('id',$customer_invoice->customer_id)->first();
        return view('admin.includes.sales.sale_invoice')->with(compact(['customer_name','product_name','address','customer','customer_invoice','customer_invoice_details']));
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }


    public function getSelectedSaleBranch(Request $request)
    {
        $category_name = $this->category_name;
        if ($request->ajax()) {
            $data = $request->all();

            if (is_numeric($data['tableid'])) {

                $categoryData = Category::find($data['input_category_id']);

            }
            else
            {
                $categoryData = "";
            }

            $getCategories = Category::with('subCategories')->where(['branch_id' => $data['branch_id'], 'parent_id' => 0])->get();
            return view('admin.includes.sales.append_sale_category_level',compact(['categoryData', 'getCategories', 'category_name']));

        }

    }
    public function getSelectedSaleCategory(Request $request){
        $product_name=$this->product_name;
        if($request->ajax()){
            $data=$request->all();
            if(is_numeric($data['tableid']))  {
                $productData =  Stock::find($data['input_stock_id']);
                $getProducts = Stock::where(['category_id' => $data['input_category_id']])->get();
            } else{
                $productData =  "";
                $getProducts = Stock::where(['category_id' => $data['category_id']])->get();
            }

            return view('admin.includes.sales.append_sale_product_level')->with(compact(['productData','getProducts','product_name']));
        }
    }

}

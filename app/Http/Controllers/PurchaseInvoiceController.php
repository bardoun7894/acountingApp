<?php

namespace App\Http\Controllers;

use App\Models\AccountSetting;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Currency;
use App\Models\FinanceYear;
use App\Models\PaymentType;
use App\Models\Product;
use App\Models\PurchaseCartDetail;
use App\Models\SellType;
use App\Models\Stock;
use App\Models\Store;
use App\Models\Supplier;
use App\Models\SupplierInvoice;
use App\Models\SupplierInvoiceDetail;
use App\Models\SupplierPayment;
use App\Models\Transaction;
use App\Models\Translation;
use App\Models\Unit;
use App\Models\User;
use App\Models\UserType;
use App\Rules\AccountSettingYearRule;
use App\Rules\FinanceYearRule;
use App\Rules\PurchaseCartRule;
use Carbon\Traits\Date;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\returnArgument;

class PurchaseInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $product_name;
    private $description;
    private $category_name;
    private $unit_name;
    private $supplier_name;
    private $branch_name;
    private $store_name;
    private $title;
    private $payment_type_name;
    private $sell_type_name;
    private $address;
    private $s_name;

    function __construct()
    {
        $this->product_name=Stock::getProductNameLang();
        $this->s_name=Currency::getSNameLang();
        $this->sell_type_name=SellType::getSellTypeNameLang();
        $this->payment_type_name=PaymentType::getPaymentTypeNameLang();
        $this->title=SupplierInvoice::getTitleLang();
        $this->branch_name=Branch::getBranchNameLang();
        $this->store_name=Store::getStoreNameLang();
        $this->supplier_name=Supplier::getSupplierNameLang();
        $this->address=Supplier::getaddressLang();
        $this->unit_name=Unit::getUnitNameLang();
        $this->description=Stock::getDescriptionLang();
        $this->category_name=Category::getCategoryNameLang(Translation::getLang());


    }
    public function index()
    {
        $product_name=$this->product_name;
        $payment_type_name=$this->payment_type_name;
        $sell_type_name=  $this->sell_type_name;
        $branch_name=$this->branch_name;
        $store_name=$this->store_name;
        $description=$this->description;
//      $stocks = Stock::with(['category','user'])->get();
        $supplier_name=$this->supplier_name;
        $suppliers=Supplier::all();
        $payment_types=PaymentType::where('status',1)->get();
        $currency=Currency::where('status',1)->first();
        $s_name=$this->s_name;
        $sell_types=SellType::where('status',1)->get();
        $stores=Store::all();
        if(\Illuminate\Support\Facades\Auth::user()->user_type_id==1){
            $purchases=PurchaseCartDetail::with('stock')->get();
        }else{
            $purchases=PurchaseCartDetail::with('stock')->where('branch_id',\Illuminate\Support\Facades\Auth::user()->branch_id)->get();
        }
        $branches=Branch::all();

        return view('admin.includes.purchases.purchases')->with(compact([ 'suppliers', 'currency','s_name','payment_types','sell_types','stores','store_name','branches','supplier_name','payment_type_name','sell_type_name','purchases','product_name','branch_name','description']));
        //
    }




    public function allPurchases(){

        $supplierInvoices = SupplierInvoice::with( ['supplier','supplier_payments'] )->where('store_id',Auth::user()->store_id)->get();

//        $paidAmount =DB::table('supplier_payments')->join('supplier_invoice s', 'supplier_payments.supplier_invoice_id', '=', 'supplier_invoices.id')->sum('supplier_payments.payment_amount');

        return view('admin.includes.purchases.all_purchases.allPurchases')->with(compact([ 'supplierInvoices']));
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

        $category_name=$this->category_name ;
        $branch_name=$this->branch_name ;
        $product_name=$this->product_name ;
        $unit_name=$this->unit_name ;
        $description=$this->description ;
        $getProducts = Stock::all();
        $units=Unit::where('status',1)->get();
        $supplier_name=$this->supplier_name;
        $suppliers=Supplier::all();

        return view('admin.includes.purchases.create')->with(compact([ 'suppliers','getProducts','branches','branch_name','units','product_name','supplier_name','unit_name','category_name','description','userType']));

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
            'stock_id' =>  [new PurchaseCartRule($request->stock_id)],
            'unit_id' => 'required',
//           $product_name=>'required',
             $description=>'required',
            'quantity'=>'required',
            'sale_unit_price'=>'required',
            'current_purchase_unit_price'=>'required',
            'expiry_date'=>'required',
          ]);

            $purchaseCart =new PurchaseCartDetail();
            $purchaseCart->branch_id =$request->branch_id;
            $purchaseCart->unit_id =$request->unit_id;
            $purchaseCart->category_id =$request->category_id;
            $purchaseCart->stock_id =$request->stock_id;
            $purchaseCart->$description =$request->$description;
            $purchaseCart->purchase_qty = $request->quantity;
            $purchaseCart->purchase_unit_price = $request->current_purchase_unit_price;
            $purchaseCart->sale_unit_price = $request->sale_unit_price;
            $purchaseCart->user_id =Auth::user()->id;
            $purchaseCart->expiry_date = $request->expiry_date;

            $purchaseCart->save();

           $session =Session::flash('message',__('messages.data_added'));
            return redirect('purchases')->with(compact(['session','product_name','description']));



    }

    public function getAccountSetting($id,$account_head_id,$account_control_id,$account_sub_control_id,$account_activity_id){
        $debitEntry = AccountSetting::where('account_activity_id',$account_activity_id)->first();
        if(!isset($debitEntry)){
            $debitEntry = new AccountSetting();
            $debitEntry->id = $id;
            $debitEntry->account_head_id = $account_head_id;
            $debitEntry->account_control_id = $account_control_id;
            $debitEntry->account_sub_control_id = $account_sub_control_id;
            $debitEntry->account_activity_id=$account_activity_id;
            $debitEntry->branch_id=Auth::user()->branch_id;
            $debitEntry->save();
        }
        return $debitEntry;
    }

    public  function   PurchasePayment($supplier_id,$supplier_invoice_id,$branch_id,$invoice_no,$invoice_date,$total_amount,$paymentId,$user_id,$remaining_balance){
       $financial_year = FinanceYear::where('isActive',1)->first() ;
       $success_message="Purchase Success" ;
        $d = new DateTime();
        $payInvoiceno ="Pay".$d->format("YmdHisv");
        ############################## is payment PAID ################################################
            $supplier=Supplier::find($supplier_id);
            $invoice_supplier_payment = new SupplierPayment();
            $invoice_supplier_payment->supplier_id =  $supplier_id;
            $invoice_supplier_payment->supplier_invoice_id = $supplier_invoice_id;
            $invoice_supplier_payment->branch_id =   $branch_id ;
            $invoice_supplier_payment-> invoice_no =   $invoice_no;
            $invoice_supplier_payment-> invoice_date =  $invoice_date;
            $invoice_supplier_payment-> total_amount =   $total_amount;
            $invoice_supplier_payment->payment_amount =  $total_amount;
            $invoice_supplier_payment->remaining_balance =  $remaining_balance ;
            $invoice_supplier_payment->payment_id = $paymentId ;
            $invoice_supplier_payment->user_id =$user_id;
            $invoice_supplier_payment->save();
            ##3############################  debit  entry  ################################################

            //purchase Payment Pending
            //account_activity= 8 =>purchase Payment Pending
            $purchaseAccount = $this->getAccountSetting(8,2,4,18,8);

                $this->setEntries($financial_year->id,$purchaseAccount->account_head_id,
                $purchaseAccount->account_control_id,  $purchaseAccount->account_sub_control_id,$invoice_no,$invoice_date
                ,Auth::user()->getAuthIdentifier(),$branch_id,
                $remaining_balance,$total_amount,"  Purchase Payment Paid to".$supplier->supplier_name_en,isset($supplier-> supplier_name_ar)? $supplier-> supplier_name_ar ."تم الترحيل ": $supplier-> supplier_name_en ."تم الترحيل");

            ##4############################  credit entry ################################################

            //purchase Payment PAID
             //account_activity=9 =>purchase Payment PAID // DEBIT ENTRY TRANSACTION

              $purchaseAccount = $this->getAccountSetting(9,1,1,2,9);

            $this->setEntries($financial_year->id,$purchaseAccount->account_head_id,
           $purchaseAccount->account_control_id,  $purchaseAccount->account_sub_control_id,$invoice_no,$invoice_date
                ,Auth::user()->getAuthIdentifier(),$branch_id,
                $total_amount,$remaining_balance," Purchase Payment Succeed".$supplier-> supplier_name_en,isset($supplier-> supplier_name_ar)? $supplier-> supplier_name_ar ."تم الدفع ": $supplier-> supplier_name_en ."تم الدفع ");

    }


    public function paid_amount($id){
     $d = new DateTime();
     $branch_id = Auth::user()->branch_id;
     $user_id = Auth::user()->getAuthIdentifier();
     $invoice_no = "Pay".$d->format("YmdHisv");
     $purchase_invoice = SupplierInvoice::find($id) ;
     $supplier= Supplier::find($purchase_invoice->supplier_id);
     $purchase_payment_details = SupplierPayment::where('supplier_invoice_id',$id)->get();

    return view('admin.includes.purchases.paid_purchases.paid_amount')->with(compact(['purchase_payment_details','supplier']));
    }

   public function purchasePaymentPending(){
            $supplier_name=Supplier::getSupplierNameLang();
            $branch_name=Branch::getBranchNameLang();
            $purchasePaymentPendings = DB::table('supplier_invoices')

             ->join('supplier_payments','supplier_invoices.id','=','supplier_payments.supplier_invoice_id')
             ->select('supplier_invoices.id as id','supplier_invoices.branch_id','supplier_invoices.invoice_date',
              'supplier_invoices.supplier_id' , 'supplier_invoices.invoice_no','supplier_invoices.total_amount',
              DB::raw( 'sum(supplier_payments.payment_amount) as payment'),
              DB::raw('supplier_invoices.total_amount - sum(supplier_payments.payment_amount) as `remaining_payment`')

             )->groupBy('supplier_payments.supplier_invoice_id')->where('supplier_invoices.total_amount','>','supplier_payments.payment')
             ->get();


        return view('admin.includes.purchases.pending_payments.pending_purchases')->with(compact([ 'purchasePaymentPendings','supplier_name','branch_name']));

        }
  public function  purchasePaymentHistory($supplier_invoice_id){
            $supplier_name=Supplier::getSupplierNameLang();
            $branch_name=Branch::getBranchNameLang();

            $supplier_id=SupplierInvoice::find($supplier_invoice_id)->supplier_id;
            $supplier=Supplier::find($supplier_id);

      $purchasePaymentHistories = DB::table('supplier_invoices')
             ->join('supplier_payments','supplier_invoices.id','=','supplier_payments.supplier_invoice_id')
              ->select( 'supplier_invoices.id','supplier_invoices.branch_id','supplier_invoices.invoice_date',
                'supplier_invoices.supplier_id','supplier_invoices.invoice_no','supplier_invoices.total_amount',
                'supplier_payments.payment_amount','supplier_payments.remaining_balance','supplier_payments.user_id',
            )->groupBy('supplier_payments.id')->where('supplier_invoices.total_amount','>','supplier_payments.payment')
                ->where('supplier_invoices.id',$supplier_invoice_id)->get();

            return view('admin.includes.purchases.supplier_payments_history.history_payments')->with(compact([ 'purchasePaymentHistories','supplier','supplier_name','branch_name']));


        }



  public function addSupplierInvoiceFunction(Request $request)
    {
        $title=$this->title;
      $financial_year = FinanceYear::where('isActive',1)->first();
      //purchase Product debit transaction
        //purchase  id 3
      $data = [
          'financial_year' => $financial_year,
          ];
            $validated = $request->merge($data);
            $validated = $request->validate([
            'financial_year' =>new FinanceYearRule(),
            'branch_id' => Auth::user()->user_type_id==1?'required':"",
            'store_id' => Auth::user()->user_type_id==1?'required':"" ,
            'supplier_id' =>'required',
            'payment_type_id' =>'required',
            'sell_type_id' =>'required',
            'sub_total_amount' => 'required',
            'total_amount' => 'required',
            'discount' => 'required',
            'tax' => 'required',
           ]);
      $supplier=Supplier::find($request->supplier_id);
      $invoice_date= date('Y-m-d H:i');
        //get total allow tax
        $purchasesStocks =PurchaseCartDetail::where('branch_id', Auth::user()->branch_id)->get();
        //get total allow tax
        $totalallowtax = DB::table('stocks')
            ->join('purchase_cart_details', 'stocks.id', '=', 'purchase_cart_details.stock_id')
            ->where('allowtax',1)->where('store_id', Auth::user()->store_id)
            ->selectRaw('sum( purchase_cart_details.purchase_qty * purchase_cart_details.purchase_unit_price ) as sum')->first()->sum;
##############################  supplier invoice  ################################################

      $supplier_invoice =new SupplierInvoice();
      $supplier_invoice->supplier_id = $request->supplier_id;
      if(Auth::user()->getAuthIdentifier()==1){
            $supplier_invoice->store_id =$request->store_id  ;
            $supplier_invoice->branch_id =$request->branch_id;
        }else{
            $supplier_invoice->store_id =Auth::user()->store_id;
            $supplier_invoice->branch_id =Auth::user()->branch_id;
        }
       $supplier_invoice->user_id =Auth::user()->getAuthIdentifier();
       $invoice_number = "PUR".date('YmdHis'). $supplier_invoice->user_id;
       $supplier_invoice->invoice_no = $invoice_number;
       $supplier_invoice->invoice_date = $invoice_date;
       $supplier_invoice-> discount = $request->discount;
       $supplier_invoice-> tax = $request->tax;
       $paymentId = $request->payment_type_id;
       $supplier_invoice->sub_total_amount = $request->sub_total_amount;
       $supplier_invoice->total_amount = $request->total_amount;
       $supplier_invoice-> total_tax_allowed = $totalallowtax==1?$totalallowtax:0;
       $supplier_invoice->save();
      ##############################  stock effect  ################################################

      foreach($purchasesStocks as $purchaseStock){
              //make supplier detail
              $supplier_invoice_detail = new SupplierInvoiceDetail();
              $supplier_invoice_detail->supplier_invoice_id = $supplier_invoice->id;
              $supplier_invoice_detail->stock_id = $purchaseStock->stock_id;
              $supplier_invoice_detail->purchase_quantity = $purchaseStock->purchase_qty;
              $supplier_invoice_detail-> purchase_unit_price = $purchaseStock->purchase_unit_price;
              $supplier_invoice_detail->save();
              //update stock
              $stockProduct=Stock::find($purchaseStock->stock_id);
              $stockProduct->expiry_date=$purchaseStock->expiry_date;
              $stockProduct->quantity +=$purchaseStock->purchase_qty;
              $stockProduct->current_purchase_unit_price=$purchaseStock->purchase_unit_price;
              $stockProduct->sale_unit_price=$purchaseStock->sale_unit_price;
              $stockProduct->save();

          }

       ##1############################  debit  entry  ################################################
      //purchase Product debit transaction purchase Activity
      //account_activity=3 => purchase product

    $purchaseAccount= $this->getAccountSetting(6,4,8,   29,3);
    $this->setEntries($financial_year->id,$purchaseAccount->account_head_id,
       $purchaseAccount->account_control_id,  $purchaseAccount->account_sub_control_id,$invoice_number,$invoice_date
        ,Auth::user()->getAuthIdentifier(),Auth::user()->branch_id,
         0,$request->total_amount," Purchase From ".$supplier-> supplier_name_en,isset($supplier-> supplier_name_ar)? $supplier-> supplier_name_ar ."الشراء من ": $supplier-> supplier_name_en ."الشراء من ");


      ##2############################  credit   entry  ################################################

                          //purchase Payment Pending

                                  //account_activity=5 =>purchase Payment Pending
            $purchaseAccount = $this->getAccountSetting(8,2,4,18,8);

            $this->setEntries($financial_year->id,$purchaseAccount->account_head_id,
            $purchaseAccount->account_control_id,  $purchaseAccount->account_sub_control_id,$invoice_number,$invoice_date
            ,Auth::user()->getAuthIdentifier(),Auth::user()->branch_id,
            $request->total_amount,0," Purchase Payment Pending ".$supplier-> supplier_name_en,isset($supplier-> supplier_name_ar)? $supplier-> supplier_name_ar ."في انتظار الدفع  ": $supplier-> supplier_name_en ."في انتظار الدفع  ");
      ############################## is payment PAID ################################################

                 if($request->sell_type_id==1){
                     $d = new DateTime();
                     $invoice_no ="Pay".$d->format("YmdHisv");

                     $invoice_supplier_payment = new SupplierPayment();
                     $invoice_supplier_payment->supplier_id =  $supplier_invoice->supplier_id;
                     $invoice_supplier_payment->supplier_invoice_id = $supplier_invoice->id;
                     $invoice_supplier_payment->branch_id =   $supplier_invoice->branch_id ;
                     $invoice_supplier_payment-> invoice_no =   $invoice_no;
                     $invoice_supplier_payment-> invoice_date =  $supplier_invoice->invoice_date;
                     $invoice_supplier_payment-> total_amount =  $supplier_invoice->total_amount;
                     $invoice_supplier_payment->payment_amount =  $supplier_invoice->total_amount;
                     $invoice_supplier_payment->remaining_balance =  0 ;
                     $invoice_supplier_payment->payment_id = $paymentId ;
                     $invoice_supplier_payment->user_id = Auth::user()->getAuthIdentifier();
                     $invoice_supplier_payment->save();
      ##3############################  debit  entry  ################################################

                         //purchase Payment Pending
                           //account_activity= 8 =>purchase Payment Pending

         $purchaseAccount = $this->getAccountSetting(8,2,4,18,8);

         $this->setEntries($financial_year->id,$purchaseAccount->account_head_id,
             $purchaseAccount->account_control_id,  $purchaseAccount->account_sub_control_id,$invoice_number,$invoice_date
             ,Auth::user()->getAuthIdentifier(),Auth::user()->branch_id,
             0,$request->total_amount,"  Purchase Payment Paid to".$supplier-> supplier_name_en,isset($supplier-> supplier_name_ar)? $supplier-> supplier_name_ar ."تم الترحيل ": $supplier-> supplier_name_en ."تم الترحيل");
         ##4############################  credit entry ################################################

           //purchase Payment PAID
          //account_activity=9 =>purchase Payment PAID // DEBIT ENTRY TRANSACTION

         if($request->payment_type_id==1){
             $purchaseAccount = $this->getAccountSetting(9,1,1,2,9);
                }else{
             $purchaseAccount = $this->getAccountSetting(9,1,1,1,9);
                }
       $this->setEntries($financial_year->id,$purchaseAccount->account_head_id,
             $purchaseAccount->account_control_id,  $purchaseAccount->account_sub_control_id,$invoice_number,$invoice_date
             ,Auth::user()->getAuthIdentifier(),Auth::user()->branch_id,
             $request->total_amount,0," Purchase Payment Succeed".$supplier-> supplier_name_en,isset($supplier-> supplier_name_ar)? $supplier-> supplier_name_ar ."تم الدفع ": $supplier-> supplier_name_en ."تم الدفع ");

            }else{
                     $d = new DateTime();
                     $invoice_no ="Pay".$d->format("YmdHisv");

                     $invoice_supplier_payment = new SupplierPayment();
                     $invoice_supplier_payment->supplier_id =  $supplier_invoice->supplier_id;
                     $invoice_supplier_payment->supplier_invoice_id = $supplier_invoice->id;
                     $invoice_supplier_payment->branch_id =   $supplier_invoice->branch_id ;
                     $invoice_supplier_payment-> invoice_no =   $invoice_no;
                     $invoice_supplier_payment-> invoice_date =  $supplier_invoice->invoice_date;
                     $invoice_supplier_payment-> total_amount =  $supplier_invoice->total_amount;
                     $invoice_supplier_payment->payment_amount = 0 ;
                     $invoice_supplier_payment->remaining_balance =   $supplier_invoice->total_amount ;
                     $invoice_supplier_payment->payment_id = $paymentId ;
                     $invoice_supplier_payment->user_id = Auth::user()->getAuthIdentifier();
                     $invoice_supplier_payment->save();
                 }
      ##############################  delete table purchase data  ################################################

        PurchaseCartDetail::query()->truncate();
      ##############################  return purchase invoice  ################################################

      return   $this->purchaseSupplierInvoice($supplier_invoice->id);
    }



   private function  setEntries($financial_year_id,$account_head_id,$account_control_id,$account_sub_control_id,$invoice_number,$invoice_date,$user_id,$branch_id,$credit,$debit,$transaction_title_en,$transaction_title_ar){
       $setdebitEntry = new Transaction();
       $setdebitEntry->financial_year_id=$financial_year_id;
       $setdebitEntry->account_head_id= $account_head_id;   //these form Account Setting $debitEntry
       $setdebitEntry->account_control_id=$account_control_id; //these form Account Setting $debitEntry
       $setdebitEntry->account_sub_control_id=$account_sub_control_id; //these form Account Setting $debitEntry
       $setdebitEntry->invoice_number=$invoice_number;
       $setdebitEntry->transaction_date=$invoice_date;
       $setdebitEntry->user_id=$user_id;
       $setdebitEntry->branch_id=$branch_id;
       $setdebitEntry->credit=$credit;
       $setdebitEntry->debit=$debit;
       $setdebitEntry->transaction_title_en= $transaction_title_en;
       $setdebitEntry->transaction_title_ar=  $transaction_title_ar ;
       $setdebitEntry->save();
   }
  public function purchaseSupplierInvoice($supplierInvoiceId){
        $supplier_name=$this->supplier_name;
        $product_name= Stock::getProductNameLang();
        $address=$this->address;
        $supplier_invoice = SupplierInvoice::find($supplierInvoiceId);
        $supplier_invoice_details = SupplierInvoiceDetail::with('stock')->where('supplier_invoice_id',$supplierInvoiceId)->get();
      $supplier=Supplier::where('id',$supplier_invoice->supplier_id)->first();
        return view('admin.includes.purchases.purchase_invoice')->with(compact(['supplier_name','product_name','address','supplier','supplier_invoice','supplier_invoice_details']));
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
        $userType=  UserType::where('id',Auth::user()->user_type_id )->first();
        if( isset($userType) &&  $userType->user_type_en==='admin'){
            $branches =Branch::with('categories')->get();
        }else{
            $branches=Branch::with('categories')->where('id',\Illuminate\Support\Facades\Auth::user()->branch_id)->get();
        }

        $purchase = PurchaseCartDetail::find($id);

        $category_name=$this->category_name;
        $branch_name=$this->branch_name;

        $product_name=$this->product_name;
        $unit_name=$this->unit_name;
        $description=$this->description;
        $categories =Category::all();
        $getProducts = Stock::all();


        $units=Unit::where('status',1)->get();


        return view('admin.includes.purchases.update')->with(compact(['getProducts','userType','purchase','branches','units','unit_name','branch_name','categories','category_name','product_name','description']));
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

        $product_name=$this->product_name;
        $description=$this->description;
        $validated = $request->validate([
            'branch_id' => 'required',
            'category_id' => 'required',
            'stock_id' => 'required',
            'unit_id' => 'required',
//          $product_name=>'required',
            $description=>'required',
            'quantity'=>'required',
            'sale_unit_price'=>'required',
            'current_purchase_unit_price'=>'required',
            'expiry_date'=>'required',
        ]);
        $purchaseCart = PurchaseCartDetail::find($id);

        $purchaseCart->branch_id =$request->branch_id;
        $purchaseCart->unit_id =$request->unit_id;
        $purchaseCart->category_id =$request->category_id;
        $purchaseCart->stock_id =$request->stock_id;
        $purchaseCart->$description =$request->$description;
//      $purchaseCart->$product_name =$request->$product_name;
        $purchaseCart->purchase_qty = $request->quantity;
        $purchaseCart->purchase_unit_price = $request->current_purchase_unit_price;
        $purchaseCart->sale_unit_price = $request->sale_unit_price;
        $purchaseCart->user_id =Auth::user()->id;
        $purchaseCart->expiry_date = $request->expiry_date;
        $purchaseCart->update();
        $session =Session::flash('message',__('messages.data_updated'));
        return redirect('purchases')->with(compact(['session','description','product_name']));
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getSelectedPurchaseBranch(Request $request)
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
            return view('admin.includes.purchases.append_purchase_category_level',compact(['categoryData', 'getCategories', 'category_name']));


        }

    }
    public function getSelectedPurchaseCategory(Request $request){
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

            return view('admin.includes.purchases.append_purchase_product_level')->with(compact(['productData','getProducts','product_name']));
        }
    }
    public function getProductItembyId(Request $request){
        if($request->ajax()){
            $data=$request->stock_id;
            $productData =  Stock::where('id',$data)->first();
            return $productData;
          }
    }
    public function getSupplierItembyId(Request $request){
        if($request->ajax()){
            $data=$request->all();
            if($data['supplier_id']=="null"){
                return 0;
            }

            $supplierData =  Supplier::find($data['supplier_id']);
            return $supplierData;
          }
    }
    public function getSumTotalItem(Request $request){
        if($request->ajax()){
            //get total of item (quantity * purchase);
            $purchases =  PurchaseCartDetail::selectRaw('if(count(id)>0,sum(purchase_qty * purchase_unit_price),0) as sub_total')->first();
            return $purchases;
          }
    }
    public function getSelectedBranchStore(Request $request){
        if($request->ajax()){
            $data=$request->all();
            $stores=Store::where('branch_id',$data['branch_id'])->get();
            $store_name=$this->store_name;
            return view('admin.includes.stores.select_store')->with(compact(['stores','store_name',]));
        }
    }
  public function getSelectedBranchSupplier(Request $request){
        if($request->ajax()){
            $data=$request->all();
            $suppliers=Supplier::where('branch_id',$data['branch_id'])->get();
            $supplier_name=$this->supplier_name;
            return view('admin.includes.suppliers.select_supplier')->with(compact(['suppliers','supplier_name',]));

        }
    }

    public function deletePurchase($id){
        $purchase=PurchaseCartDetail::find($id);
        $purchase->delete();

        $session =Session::flash('message',__('messages.data_removed'));
        return redirect('purchases')->with(compact('session'));

    }



}

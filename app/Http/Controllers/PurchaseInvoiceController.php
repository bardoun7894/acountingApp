<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Product;
use App\Models\PurchaseCartDetail;
use App\Models\Stock;
use App\Models\Store;
use App\Models\Supplier;
use App\Models\SupplierInvoice;
use App\Models\Translation;
use App\Models\Unit;
use App\Models\UserType;
use App\Rules\PurchaseCartRule;
use Carbon\Traits\Date;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

    function __construct()
    {
        $this->product_name=Stock::getProductNameLang();
        $this->title=SupplierInvoice::getTitleLang();
        $this->branch_name=Branch::getBranchNameLang();
        $this->store_name=Store::getStoreNameLang();
        $this->supplier_name=Supplier::getSupplierNameLang();
        $this->unit_name=Unit::getUnitNameLang();
        $this->description=Stock::getDescriptionLang();
        $this->category_name=Category::getCategoryNameLang(Translation::getLang());


    }
    public function index()
    {
        $product_name=$this->product_name;
        $branch_name=$this->branch_name;
        $store_name=$this->store_name;
        $description=$this->description;
//      $stocks = Stock::with(['category','user'])->get();
        $supplier_name=$this->supplier_name;
        $suppliers=Supplier::all();
        $stores=Store::all();
        if(\Illuminate\Support\Facades\Auth::user()->user_type_id==1){
            $purchases=PurchaseCartDetail::with('stock')->get();

        }else{
            $purchases=PurchaseCartDetail::with('stock')->where('branch_id',\Illuminate\Support\Facades\Auth::user()->branch_id)->get();
        }
        $branches=Branch::all();
        return view('admin.includes.purchases.purchases')->with(compact([ 'suppliers','stores','store_name','branches','supplier_name','purchases','product_name','branch_name','description']));

        //
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
            'manufacture_date'=>'required',
        ]);


           $purchaseCart =new PurchaseCartDetail();

            $purchaseCart->branch_id =$request->branch_id;
            $purchaseCart->unit_id =$request->unit_id;
            $purchaseCart->category_id =$request->category_id;
            $purchaseCart->stock_id =$request->stock_id;
            $purchaseCart->$description =$request->$description;
//        $purchaseCart->$product_name =$request->$product_name;
            $purchaseCart->purchase_qty = $request->quantity;
            $purchaseCart->purchase_unit_price = $request->current_purchase_unit_price;
            $purchaseCart->sale_unit_price = $request->sale_unit_price;
            $purchaseCart->user_id =Auth::user()->id;
            $purchaseCart->expiry_date = $request->expiry_date;
            $purchaseCart->manufacture_date = $request->manufacture_date;

            $purchaseCart->save();
            $session =Session::flash('message','Purchase added Successfully');
            return redirect('purchases')->with(compact(['session','product_name','description']));



    }
  public function addSupplierInvoiceFunction(Request $request)
    {

        $title=$this->title;
//        $description=$this->description;
//
        $validated = $request->validate([
            'branch_id' => 'required',
            'store_id' => 'required',
            'supplier_id' => 'required',
            'sub_total_amount' => 'required',
            'total_amount' => 'required',
            'discount' => 'required',
            'tax' => 'required',
        ]);
       $purchases=PurchaseCartDetail::with('stock')->where('branch_id',\Illuminate\Support\Facades\Auth::user()->branch_id==1
       )->get();
       return $purchases;
        $supplier_invoice =new SupplierInvoice();
        $invoice_number="PUR".date('ymdhis');

        $supplier_invoice->branch_id =$request->branch_id;
        $supplier_invoice->invoice_no =$invoice_number;
//            $purchaseCart->unit_id =$request->unit_id;
        $supplier_invoice->user_id =Auth::user()->id;
        $supplier_invoice->invoice_date = date('Y-m-d H:i');

//            $purchaseCart->expiry_date = $request->expiry_date;
//            $purchaseCart->manufacture_date = $request->manufacture_date;
//
//            $purchaseCart->save();
//            $session =Session::flash('message','Purchase added Successfully');
            return redirect('purchases')->with(compact(['session','product_name','description']));



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
            'manufacture_date'=>'required',
        ]);
        $purchaseCart = PurchaseCartDetail::find($id);

        $purchaseCart->branch_id =$request->branch_id;
        $purchaseCart->unit_id =$request->unit_id;
        $purchaseCart->category_id =$request->category_id;
        $purchaseCart->stock_id =$request->stock_id;
        $purchaseCart->$description =$request->$description;
//        $purchaseCart->$product_name =$request->$product_name;
        $purchaseCart->purchase_qty = $request->quantity;
        $purchaseCart->purchase_unit_price = $request->current_purchase_unit_price;
        $purchaseCart->sale_unit_price = $request->sale_unit_price;
        $purchaseCart->user_id =Auth::user()->id;
        $purchaseCart->expiry_date = $request->expiry_date;
        $purchaseCart->manufacture_date = $request->manufacture_date;
        $purchaseCart->update();
        $session =Session::flash('message','Purchase Cart Updated Successfully');
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
            $data=$request->all();
            $productData =  Stock::find($data['stock_id']);
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
        $session =Session::flash('message','Purchase cart item Deleted Successfully');
        return redirect('purchases')->with(compact('session'));

    }



}

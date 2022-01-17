<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Product;
use App\Models\PurchaseCartDetail;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\Translation;
use App\Models\Unit;
use App\Rules\PurchaseCartRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use mysql_xdevapi\Table;
use mysql_xdevapi\TableSelect;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isJson;
use function PHPUnit\Framework\isNan;

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

    function __construct()
    {
        $this->product_name=Stock::getProductNameLang();
        $this->supplier_name=Supplier::getSupplierNameLang();
        $this->unit_name=Unit::getUnitNameLang();
        $this->description=Stock::getDescriptionLang();
        $this->category_name=Category::getCategoryNameLang(Translation::getLang());

    }
    public function index()
    {
        $product_name=$this->product_name;
        $description=$this->description;
//        $stocks = Stock::with(['category','user'])->get();
        $supplier_name=$this->supplier_name;
        $suppliers=Supplier::all();

        $purchases=PurchaseCartDetail::with('stock')->get();

//        $stocks = Category::with(['stock','users'])->get();
//                return $stocks;
        return view('admin.includes.purchases.purchases')->with(compact([ 'suppliers','supplier_name','purchases','product_name','description']));

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches =Branch::with('categories')->get();

        $category_name=$this->category_name;
        $branch_name=Branch::getBranchNameLang();
        $product_name=$this->product_name;
        $unit_name=$this->unit_name;
        $description=$this->description;
        $getProducts = Stock::all();

        $units=Unit::where('status',1)->get();
        $supplier_name=$this->supplier_name;
        $suppliers=Supplier::all();


        return view('admin.includes.purchases.create')->with(compact([ 'suppliers','getProducts','branches','branch_name','units','product_name','supplier_name','unit_name','category_name','description']));

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
            'stock_trash_hold_qty'=>'required',
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
            $purchaseCart->stock_trash_hold_qty = $request->stock_trash_hold_qty;
            $purchaseCart->user_id =Auth::user()->id;
            $purchaseCart->expiry_date = $request->expiry_date;
            $purchaseCart->manufacture_date = $request->manufacture_date;

            $purchaseCart->save();
            $session =Session::flash('message','Purchase added Successfully');
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

        $purchase = PurchaseCartDetail::find($id);
        $branches =Branch::with('categories')->get();

        $category_name=$this->category_name;
        $branch_name=Branch::getBranchNameLang();
        $product_name=$this->product_name;
        $unit_name=$this->unit_name;
        $description=$this->description;
        $categories =Category::all();
        $getProducts = Stock::all();


        $units=Unit::where('status',1)->get();


        return view('admin.includes.purchases.update')->with(compact(['getProducts','purchase','branches','units','unit_name','branch_name','categories','category_name','product_name','description']));
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
            'stock_trash_hold_qty'=>'required',
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
        $purchaseCart->stock_trash_hold_qty = $request->stock_trash_hold_qty;
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
            return view('admin.includes.purchases.append_purchase_category_level')->with(compact(['categoryData', 'getCategories', 'category_name']));


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

    public function deletePurchase($id){
        $purchase=PurchaseCartDetail::find($id);
        $purchase->delete();
        $session =Session::flash('message','Purchase cart item Deleted Successfully');
        return redirect('purchases')->with(compact('session'));

    }



}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Stock;
use App\Models\Translation;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $product_name;
    private $unit_name;
    private $description;
    private $category_name;
    private $lang;

    function __construct()
    {
        $this->product_name=Stock::getProductNameLang();
        $this->lang=Translation::getLang();
        $this->unit_name=Unit::getUnitNameLang();
        $this->description=Stock::getDescriptionLang();
        $this->category_name=Category::getCategoryNameLang(Translation::getLang());

     }
    public function index()
    {
        $product_name=$this->product_name;
        $description=$this->description;
        $stocks = Stock::with(['category','user'])->get();
//        $stocks = Category::with(['stock','users'])->get();
//                return $stocks;
        return view('admin.includes.stocks.stocks')->with(compact(['stocks','product_name','description']));

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $category_name=$this->category_name;
        $product_name=$this->product_name;
        $unit_name=$this->unit_name;
        $lang=$this->lang;
        $description=$this->description;
        $categories =Category::all();
        $units=Unit::where('status',1)->get();
        return view('admin.includes.stocks.create')->with(compact(['categories','lang','units','product_name','unit_name','category_name','description']));
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
            'category_id' => 'required',
            'unit_id' => 'required',
            $product_name=>'required',
            $description=>'required',
            'quantity'=>'required',
            'sale_unit_price'=>'required',
            'current_purchase_unit_price'=>'required',
            'expiry_date'=>'required',


        ]);
        $stock =new Stock();
        $stock->category_id =$request->category_id;
        $stock->unit_id =$request->unit_id;
        $stock->$product_name =$request->$product_name;
        $stock->$description =$request->$description;
        $stock->quantity = $request->quantity;
        $stock->current_sale_unit_price = $request->sale_unit_price;
        $stock->current_purchase_unit_price = $request->current_purchase_unit_price;
        $stock->expiry_date = $request->expiry_date;
        $stock->user_id =Auth::user()->id;

        $stock->save();
        $session =Session::flash('message','Stock added Successfully');
        return redirect('stocks')->with(compact(['session','product_name','description']));

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
            $lang=$this->lang;
        $stock = Stock::find($id);
        $category_name=$this->category_name;
        $product_name=$this->product_name;
        $description=$this->description;
        $categories =Category::all();
        return view('admin.includes.stocks.update')->with(compact(['stock','lang','categories','category_name','product_name','description']));
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
            'category_id' => 'required',
            $product_name=>'required',
            $description=>'required',
            'quantity'=>'required',
            'sale_unit_price'=>'required',
            'current_purchase_unit_price'=>'required',
            'expiry_date'=>'required',
            'manufacture_date'=>'required',
        ]);
       $stock = Stock::find($id);

        $stock->category_id =$request->category_id;
        $stock->$product_name =$request->$product_name;
        $stock->$description =$request->$description;
        $stock->quantity = $request->quantity;
        $stock->sale_unit_price = $request->sale_unit_price;
        $stock->current_purchase_unit_price = $request->current_purchase_unit_price;
        $stock->expiry_date = $request->expiry_date;
        $stock->user_id =Auth::user()->id;
        $stock->update();
        $session =Session::flash('message','Stock Updated Successfully');
        return redirect('stocks')->with(compact(['session','description','product_name']));
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function deleteStock($id)
    {
        $stock=Stock::find($id);
        $stock->delete();
        $session =Session::flash('message','Stock Deleted Successfully');
        return redirect('stocks')->with(compact('session'));

    }

}

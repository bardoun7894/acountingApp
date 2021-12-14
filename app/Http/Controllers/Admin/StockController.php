<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Stock;
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
    public function index()
    {

        $stocks = Stock::all();
        return view('admin.ltr.includes.stocks.stocks')->with(compact('stocks'));

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories =Category::all();
        return view('admin.ltr.includes.stocks.create')->with(compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required',

            'product_name'=>'required',
            'description'=>'required',
            'quantity'=>'required',
            'sale_unit_price'=>'required',
            'current_purchase_unit_price'=>'required',
            'expiry_date'=>'required',
            'manufacture_date'=>'required',
            'stock_trash_hold_qty'=>'required',
        ]);
        $stock =new Stock();
        $stock->category_id =$request->category_id;
        $stock->product_name =$request->product_name;
        $stock->description =$request->description;
        $stock->quantity = $request->quantity;
        $stock->sale_unit_price = $request->sale_unit_price;
        $stock->current_purchase_unit_price = $request->current_purchase_unit_price;
        $stock->expiry_date = $request->expiry_date;
        $stock->manufacture_date = $request->manufacture_date;
        $stock->stock_trash_hold_qty = $request->stock_trash_hold_qty;
        $stock->user_id =Auth::user()->id;

        $stock->save();
        $session =Session::flash('message','Stock added Successfully');
        return redirect('stocks')->with(compact('session'));

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
    {   $stock = Stock::find($id);
        return view('admin.ltr.includes.stocks.update')->with(compact('Stock'));
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
        $validated = $request->validate([
            'category_name' => 'required',
        ]);
        $stock=Stock::find($id);
//        $stock->category_name = $request->input('category_name');
        $stock->update();


        $session =Session::flash('message','Stock Updated Successfully');
        return redirect('stocks')->with(compact('session'));
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stock=Stock::find($id);
        $stock->delete();
        $session =Session::flash('message','Stock Deleted Successfully');
        return redirect('stocks')->with(compact('session'));

    }

}
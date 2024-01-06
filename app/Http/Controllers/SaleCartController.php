<?php

namespace App\Http\Controllers;

use App\Models\SaleCart;
use App\Models\Stock ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//session
use Illuminate\Support\Facades\Session;

class SaleCartController extends Controller
{

    public function getSumTotalItem(Request $request)
    {
        if ($request->ajax()) {
            //get total of item (quantity * sale);
            $sales = SaleCart::where([
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





    public function fetchproductsToSaleCart(Request $request)
    {
        $description = Stock::getDescriptionLang();
        if ($request->ajax()) {
            $product = Stock::where("id", $request->stock_id)->first();
            $sales = SaleCart::where([
                "customer_id" => $request->customer_id,
                "stock_id" => $request->stock_id,
                "branch_id" => Auth::user()->branch_id,
                "company_id" => Auth::user()->company_id,
            ])->get();

            if ($sales->count() > 0) {
                return "";
            } else {
                $salesCart = new SaleCart();
                $salesCart->branch_id = Auth::user()->branch_id;
                $salesCart->unit_id = $product->unit_id;
                $salesCart->category_id = $product->category_id;
                $salesCart->stock_id = $product->id;
                $salesCart->customer_id = $request->customer_id;
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
    public function fetchSaleData(Request $request)
    {
        if ($request->ajax()) {
            if (\Illuminate\Support\Facades\Auth::user()->user_type_id == 1) {
                $sales = SaleCart::with("stock")->where('customer_id', $request->customer_id)->get();
            } else {
                $sales = SaleCart::with("stock")
                    ->where(
                        "branch_id",
                        \Illuminate\Support\Facades\Auth::user()->branch_id
                    )->where('customer_id', $request->customer_id)->get();
            }

            return json_encode($sales);
        }
    }
    public function postProductOnQtyChangeToSaleCart(Request $request)
    {
        if ($request->ajax()) {
            $saleCart = SaleCart::find($request->id);
            $saleCart->sale_qty = $request->sale_qty;
            $saleCart->save();
            return $saleCart;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaleCart  $saleCart
     * @return \Illuminate\Http\Response
     */
    public function show(SaleCart $saleCart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SaleCart  $saleCart
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleCart $saleCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SaleCart  $saleCart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleCart $saleCart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaleCart  $saleCart
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleCart $saleCart)
    {
        //
    }
    public function deleteSaleCart($id)
    {
        $sale = SaleCart::find($id);
        $sale->delete(); //delete the sale
        $session = Session::flash("message", __("messages.data_removed"));
        return redirect("sales")->with(compact("session"));
    }

}

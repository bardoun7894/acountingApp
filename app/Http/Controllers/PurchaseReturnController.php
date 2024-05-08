<?php

namespace App\Http\Controllers;

use App\Models\PurchaseReturn;
use App\Models\Supplier;
use App\Models\SupplierInvoice;
use App\Models\SupplierReturnInvoice;
use App\Models\SupplierReturnInvoiceDetail;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    //int $supplier_id =  Auth::user()->supplier_id ;
        return view('admin.includes.purchaseReturns.purchaseReturns') ;
    }
public function findInvoiceReturn(Request $request){
        // is not ajax
       if (!$request->ajax()) {
           return response()->json(['error' => 'Invalid request'], 400);
       }
    $invoiceNumber = $request->input('invoice_number');
     $supplierInvoice = SupplierInvoice::with([
        'supplierInvoiceDetails',
        'supplierReturnInvoiceDetails' => function ($query) {
            $query->select(
                '*',
                \DB::raw('purchase_return_quantity * purchase_return_unit_price AS total_price')
            );
        },
        'supplierReturnInvoice',
        'supplier',
        'user'
    ])->where('invoice_no', $invoiceNumber)->first();

//  return  count([0,1]);
    if (!$supplierInvoice) {
        return response()->json(['error' => 'Invoice not found'], 404);
    }else{
       if(!$supplierInvoice -> supplierReturnInvoice()->exists())
       {
        $supplierReturnInvoice = new SupplierReturnInvoice();
        $supplierReturnInvoice->supplier_id = $supplierInvoice->supplier_id;
        $supplierReturnInvoice->supplier_invoice_id = $supplierInvoice->id;
        $supplierReturnInvoice->user_id = Auth::user()->id;
        $supplierReturnInvoice->invoiceno = $supplierInvoice->invoice_no;
        $supplierReturnInvoice->company_id = Auth::user()->company_id;
        $supplierReturnInvoice->branch_id = Auth::user()->branch_id;
        $supplierReturnInvoice->invoice_date = $supplierInvoice->invoice_date;
        $supplierReturnInvoice->description = $supplierInvoice->description;
        $supplierReturnInvoice->total_amount = $supplierInvoice->total_amount;
        $supplierReturnInvoice->save();
        foreach($supplierInvoice->supplierInvoiceDetails as $supplierInvoiceDetail){
            $supplierReturnInvoiceDetails = new SupplierReturnInvoiceDetail();
            $supplierReturnInvoiceDetails->supplier_return_invoice_id =$supplierReturnInvoice->id;
            $supplierReturnInvoiceDetails->supplier_invoice_detail_id = $supplierInvoiceDetail->id;
            $supplierReturnInvoiceDetails->supplier_invoice_id = $supplierInvoice->id;
            // $supplierReturnInvoiceDetails->invoice_no = $supplierInvoice->invoice_no;
            $supplierReturnInvoiceDetails->purchase_return_quantity = 0;
            $supplierReturnInvoiceDetails->purchase_return_unit_price = $supplierInvoiceDetail->purchase_unit_price;
            $supplierReturnInvoiceDetails->stock_id =$supplierInvoiceDetail->stock_id;
            $supplierReturnInvoiceDetails->save();
        }
    }
    }

    return view('admin.includes.purchaseReturns.purchaseReturnsInvoice',
      ['supplierInvoice'=>$supplierInvoice ,
      'supplierReturnInvoiceDetails' => $supplierInvoice->supplierReturnInvoiceDetails,
      'supplierReturnInvoice' => $supplierInvoice->supplierReturnInvoice
      ,
       'supplier_name' => Supplier::getSupplierNameLang(),
       'descriptionName' => Supplier::getDescriptionLang(),
       'nameLang' => User::getFullnameLang(),
    ]);
}
public function returnPurchasesOnQtyChange(Request $request){

    if (!$request->ajax()) {
    return response()->json(['error' => 'Invoice not found'], 404);
    }


    $quantityReturn = $request->input('purchase_qty');

    $supplierInvoice = SupplierInvoice::with([
        'supplierInvoiceDetails',
        'supplierReturnInvoiceDetails',
        'supplierReturnInvoice',
        'supplier',
        'user'])->where('invoice_no', $request->invoice_number)
    ->whereHas('supplierReturnInvoiceDetails',  function ($query) use ($request) {
        $query->where('id', $request->idReturnDetails);
    })->first();
    if(count($supplierInvoice->supplierReturnInvoice)>0){
        if(count($supplierInvoice->supplierReturnInvoiceDetails)>0){
            // update return quantity
            $supplierReturnInvoiceDetails = SupplierReturnInvoiceDetail::find($request->idReturnDetails);
            $supplierReturnInvoiceDetails->purchase_return_quantity= $quantityReturn;
            $supplierReturnInvoiceDetails->save();

        return true;
        }else{
            $supplierReturnInvoiceDetails = new SupplierReturnInvoiceDetail();
            $supplierReturnInvoiceDetails->supplier_return_invoice_id = $supplierInvoice->supplierReturnInvoice[0]->id;
            $supplierReturnInvoiceDetails->supplier_invoice_detail_id = $supplierInvoice->supplierInvoiceDetails[0]->id;
            $supplierReturnInvoiceDetails->supplier_invoice_id = $supplierInvoice->id;
            // $supplierReturnInvoiceDetails->invoice_no = $supplierInvoice->invoice_no;
            $supplierReturnInvoiceDetails->purchase_return_quantity = $quantityReturn;
            $supplierReturnInvoiceDetails->purchase_return_unit_price = $supplierInvoice->supplierInvoiceDetails[0]->purchase_unit_price;
            $supplierReturnInvoiceDetails->stock_id = $supplierInvoice->supplierInvoiceDetails[0]->stock_id;
            $supplierReturnInvoiceDetails->save();
            return true;
        }
    }else{
        $supplierReturnInvoice = new SupplierReturnInvoice();
        $supplierReturnInvoice->supplier_id = $supplierInvoice->supplier_id;
        $supplierReturnInvoice->supplier_invoice_id = $supplierInvoice->id;
        $supplierReturnInvoice->user_id = Auth::user()->id;
        $supplierReturnInvoice->invoiceno = $supplierInvoice->invoice_no;
        $supplierReturnInvoice->company_id = Auth::user()->company_id;
        $supplierReturnInvoice->branch_id = Auth::user()->branch_id;
        $supplierReturnInvoice->invoice_date = $supplierInvoice->invoice_date;
        $supplierReturnInvoice->description = $supplierInvoice->description;
        $supplierReturnInvoice->total_amount = $supplierInvoice->total_amount;
        $supplierReturnInvoice->save();
    }

    return json_encode($supplierInvoice) ;

}
public function returnConfirm(){
    $supplierId = 0 ;
    $supplierInvoiceId = 0 ;
    $isPayment  = false ;
    return view('admin.includes.purchaseReturns.purchaseReturnsConfirm') ;

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
     * @param  \App\Models\PurchaseReturn  $purchaseReturn
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseReturn $purchaseReturn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseReturn  $purchaseReturn
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseReturn $purchaseReturn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseReturn  $purchaseReturn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseReturn $purchaseReturn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseReturn  $purchaseReturn
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseReturn $purchaseReturn)
    {
        //
    }
}

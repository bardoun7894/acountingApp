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
    public function index()
    {
        return view('admin.includes.purchaseReturns.purchaseReturns');
    }

    public function findInvoiceReturn(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['error' => 'Invalid request'], 400);
        }

        $invoiceNumber = $request->input('invoice_number');
        $supplierInvoice = SupplierInvoice::with([
            'supplierInvoiceDetails',
            'supplierReturnInvoiceDetails' => function ($query) {
                $query->select('*', DB::raw('purchase_return_quantity * purchase_return_unit_price AS total_price'));
            },
            'supplierReturnInvoice',
            'supplier',
            'user'
        ])->where('invoice_no', $invoiceNumber)->first();
        if (!$supplierInvoice) {
            // Return a view with an error message
            return view('components.searchInvoiceNotFound', [  'invoice_number' => $invoiceNumber, 'error' => 'Invoice not found'
            ]);
        }

        $subtotal =$supplierInvoice->sub_total_amount;
        //subtotal returned
        $subtotalReturned =  $this->calculateSubtotal($supplierInvoice->invoice_no);
        if (!$supplierInvoice->supplierReturnInvoice()->exists()) {
            $this->createReturnInvoiceAndDetails($supplierInvoice);
        }

        return view('admin.includes.purchaseReturns.purchaseReturnsInvoice', [
            'supplierInvoice' => $supplierInvoice,
            'subtotal' => $subtotal,
            'subtotalReturned' => $subtotalReturned,
            'supplierReturnInvoiceDetails' => $supplierInvoice->supplierReturnInvoiceDetails,
            'supplierReturnInvoice' => $supplierInvoice->supplierReturnInvoice,
            'supplier_name' => Supplier::getSupplierNameLang(),
            'descriptionName' => Supplier::getDescriptionLang(),
            'nameLang' => User::getFullnameLang(),
        ]);
    }

    public function returnPurchasesOnQtyChange(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['error' => 'Invalid request'], 400);
        }

        $validated = $request->validate([
            'purchase_qty' => 'required|integer|min:1',
            'idReturnDetails' => 'required|integer',
            'invoice_number' => 'required|string',
        ]);

        $supplierInvoice = $this->findSupplierInvoice($validated['invoice_number'], $validated['idReturnDetails']);

        if (!$supplierInvoice) {
            return response()->json(['error' => 'Invoice not found'], 404);
        }

        if ($this->hasReturnInvoices($supplierInvoice)) {
                   $this->updateOrCreateReturnInvoiceDetails($supplierInvoice, $validated['idReturnDetails'], $validated['purchase_qty']);
            } else {
            $this->createNewReturnInvoice($supplierInvoice, $validated['purchase_qty']);
        }
        return $this->calculateSubtotal($supplierInvoice->invoice_no);
    }

    public function returnConfirm()
    {

        return view('admin.includes.purchaseReturns.purchaseReturnsConfirm');

    }

    private function findSupplierInvoice($invoiceNumber, $idReturnDetails)
    {
        return SupplierInvoice::with([
            'supplierInvoiceDetails',
            'supplierReturnInvoiceDetails',
            'supplierReturnInvoice',
            'supplier',
            'user'
        ])->where('invoice_no', $invoiceNumber)
          ->whereHas('supplierReturnInvoiceDetails', function ($query) use ($idReturnDetails) {
              $query->where('id', $idReturnDetails);
          })->first();
    }

    private function hasReturnInvoices($supplierInvoice)
    {
        return $supplierInvoice->supplierReturnInvoice->count() > 0;
    }

    private function updateOrCreateReturnInvoiceDetails($supplierInvoice, $idReturnDetails, $quantityReturn)
    {
        $returnInvoiceDetail = SupplierReturnInvoiceDetail::find($idReturnDetails);

        if ($returnInvoiceDetail) {
            $returnInvoiceDetail->purchase_return_quantity = $quantityReturn;
            $returnInvoiceDetail->save();
        } else {
            $this->createNewReturnInvoiceDetail($supplierInvoice, $quantityReturn);
        }
    }

    // private function calculateSubtotal($returnInvoiceDetails)
    // {
    //   foreach ($returnInvoiceDetails as $key => $value) {
    //      $returnInvoiceDetails[$key]['total_price'] = $value['purchase_return_quantity'] * $value['purchase_return_unit_price'];
    //  }
    //   //  ->sum(DB::raw('purchase_return_quantity * purchase_return_unit_price'));
    //   //query
    //  return response()->json(['data1' => $returnInvoiceDetails[$key]['total_price'], 'status' => true]);
    // }
    private function calculateSubtotal($invoiceNumber)
    {
        $subtotal = SupplierReturnInvoiceDetail::with('supplierReturnInvoice')
            ->whereHas('supplierReturnInvoice', function ($query) use ($invoiceNumber) {
                $query->where('invoiceno', $invoiceNumber);
            })
            ->sum(DB::raw('purchase_return_quantity * purchase_return_unit_price'));

        return $subtotal;
    }
    private function createNewReturnInvoiceDetail($supplierInvoice, $quantityReturn)
    {
        $returnInvoiceDetail = new SupplierReturnInvoiceDetail();
        $returnInvoiceDetail->supplier_return_invoice_id = $supplierInvoice->supplierReturnInvoice[0]->id;
        $returnInvoiceDetail->supplier_invoice_detail_id = $supplierInvoice->supplierInvoiceDetails[0]->id;
        $returnInvoiceDetail->supplier_invoice_id = $supplierInvoice->id;
        $returnInvoiceDetail->purchase_return_quantity = $quantityReturn;
        $returnInvoiceDetail->purchase_return_unit_price = $supplierInvoice->supplierInvoiceDetails[0]->purchase_unit_price;
        $returnInvoiceDetail->stock_id = $supplierInvoice->supplierInvoiceDetails[0]->stock_id;
        $returnInvoiceDetail->save();
    }

    private function createNewReturnInvoice($supplierInvoice, $quantityReturn)
    {
        $returnInvoice = new SupplierReturnInvoice();
        $returnInvoice->supplier_id = $supplierInvoice->supplier_id;
        $returnInvoice->supplier_invoice_id = $supplierInvoice->id;
        $returnInvoice->user_id = Auth::user()->id;
        $returnInvoice->invoiceno = $supplierInvoice->invoice_no;
        $returnInvoice->company_id = Auth::user()->company_id;
        $returnInvoice->branch_id = Auth::user()->branch_id;
        $returnInvoice->invoice_date = $supplierInvoice->invoice_date;
        $returnInvoice->description = $supplierInvoice->description;
        $returnInvoice->total_amount = $supplierInvoice->total_amount;
        $returnInvoice->save();

        $this->createNewReturnInvoiceDetail($supplierInvoice, $quantityReturn);
    }

    private function createReturnInvoiceAndDetails($supplierInvoice)
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
        foreach ($supplierInvoice->supplierInvoiceDetails as $supplierInvoiceDetail) {
            $supplierReturnInvoiceDetails = new SupplierReturnInvoiceDetail();
            $supplierReturnInvoiceDetails->supplier_return_invoice_id = $supplierReturnInvoice->id;
            $supplierReturnInvoiceDetails->supplier_invoice_detail_id = $supplierInvoiceDetail->id;
            $supplierReturnInvoiceDetails->supplier_invoice_id = $supplierInvoice->id;
            $supplierReturnInvoiceDetails->purchase_return_quantity = 0;
            $supplierReturnInvoiceDetails->purchase_return_unit_price = $supplierInvoiceDetail->purchase_unit_price;
            $supplierReturnInvoiceDetails->stock_id = $supplierInvoiceDetail->stock_id;
            $supplierReturnInvoiceDetails->save();
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(PurchaseReturn $purchaseReturn)
    {
        //
    }

    public function edit(PurchaseReturn $purchaseReturn)
    {
        //
    }

    public function update(Request $request, PurchaseReturn $purchaseReturn)
    {
        //
    }

    public function destroy(PurchaseReturn $purchaseReturn)
    {
        //
    }
}

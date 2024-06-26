<?php
  namespace App\Http\Controllers;

  use App\Models\CustomerInvoice;
  use App\Models\Customer;
use App\Models\CustomerReturnInvoice;
use App\Models\CustomerReturnInvoiceDetail;
use App\Models\FinanceYear;
use App\Models\User;
  use Illuminate\Http\Request;

use App\Models\SaleReturn;
use App\Models\Stock;
use App\Services\SalesEntries;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class SaleReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.includes.saleReturns.saleReturns');
    }

    public function findInvoiceReturn(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['error' => 'Invalid request'], 400);
        }

        $invoiceNumber = $request->input('invoice_number');
        $customerInvoice  =  CustomerInvoice::with([
            'customerInvoiceDetails',
            'customerReturnInvoiceDetails' =>
             function ($query) {
                $query->select(
                    '*' ,
                 DB::raw('sale_return_quantity * sale_return_unit_price AS total_price'));
                },
            'customerReturnInvoice',
            'customer',
            'user'
        ])->where('invoice_number', $invoiceNumber)->first();
        if (!$customerInvoice) {
            // Return a view with an error message
            return view('components.searchInvoiceNotFound', [
                'invoice_number' => $invoiceNumber,
                'error' => 'Invoice not found'
            ]);
        }

        $subtotal =$customerInvoice->sub_total_amount;
        //subtotal returned
        $subtotalReturned =  $this->calculateSubtotal($customerInvoice->invoice_number);
        if (!$customerInvoice->customerReturnInvoice()->exists()) {
            $this->createReturnInvoiceAndDetails($customerInvoice);
        }

        return view('admin.includes.saleReturns.saleReturnsInvoice', [
            'customerInvoice' => $customerInvoice,
            'subtotal' => $subtotal,
            'subtotalReturned' => $subtotalReturned,
            'customerReturnInvoiceDetails' => $customerInvoice->customerReturnInvoiceDetails,
            'customerReturnInvoice' => $customerInvoice->customerReturnInvoice,
            'customer_name' => Customer::getCustomerNameLang(),
            'descriptionName' => Customer::getDescriptionLang(),
            'nameLang' => User::getFullnameLang(),
        ]);
    }


    public function returnSalesOnQtyChange(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['error' => 'Invalid request'], 400);
        }

        $validated = $request->validate([
            'sale_qty' => 'required|integer|min:1',
            'idReturnDetails' => 'required|integer',
            'invoice_number' => 'required|string',
        ]);

        $customerInvoice = $this->findCustomerInvoice($validated['invoice_number'], $validated['idReturnDetails']);

        if (!$customerInvoice) {
            return response()->json(['error' => 'Invoice not found'], 404);
        }
        if ($this->hasReturnInvoices($customerInvoice)) {
          
              $this->updateOrCreateReturnInvoiceDetails($customerInvoice, $validated['idReturnDetails'], $validated['sale_qty']);
            }else{
            $this->createNewReturnInvoice($customerInvoice, $validated['sale_qty']);
        }
        return $this->calculateSubtotal($customerInvoice->invoice_number);
    }


    private function updateOrCreateReturnInvoiceDetails($customerInvoice, $idReturnDetails, $quantityReturn)
    {
        $returnInvoiceDetail = CustomerReturnInvoiceDetail::find($idReturnDetails);

        if ($returnInvoiceDetail) {
            $returnInvoiceDetail->sale_return_quantity = $quantityReturn;
            $returnInvoiceDetail->save();
        } else {
            $this->createNewReturnInvoiceDetail($customerInvoice, $quantityReturn);
        }
    }


    private function calculateSubtotal($invoiceNumber)
    {
        $subtotal = CustomerReturnInvoiceDetail::with('customerReturnInvoice')
            ->whereHas('customerReturnInvoice', function ($query) use ($invoiceNumber) {
                $query->where('invoiceno', $invoiceNumber);
            })
            ->sum(DB::raw('sale_return_quantity * sale_return_unit_price'));
        return $subtotal;
    }


    private function hasReturnInvoices($customerInvoice)
    {
        return $customerInvoice->customerReturnInvoice->count() > 0;
    }


    private function findCustomerInvoice($invoiceNumber, $idReturnDetails)
    {
        return CustomerInvoice::with([
            'customerInvoiceDetails',
            'customerReturnInvoiceDetails',
            'customerReturnInvoice',
            'customer',
            'user'
        ])->where('invoice_number', $invoiceNumber)
          ->whereHas('customerReturnInvoiceDetails', function ($query) use ($idReturnDetails) {
              $query->where('id', $idReturnDetails);
          })->first();
    }

    private function createNewReturnInvoiceDetail($customerInvoice, $quantityReturn)
    {
        $returnInvoiceDetail = new CustomerReturnInvoiceDetail();
        $returnInvoiceDetail->customer_return_invoice_id = $customerInvoice->customerReturnInvoice[0]->id;
        $returnInvoiceDetail->customer_invoice_detail_id  = $customerInvoice->customerInvoiceDetails[0]->id;
        $returnInvoiceDetail->customer_invoice_id = $customerInvoice->id;
        $returnInvoiceDetail->sale_return_quantity = $quantityReturn;
        $returnInvoiceDetail->sale_return_unit_price = $customerInvoice->customerInvoiceDetails[0]->sale_unit_price;
        $returnInvoiceDetail->stock_id = $customerInvoice->customerInvoiceDetails[0]->stock_id;
        $returnInvoiceDetail->save();
    }

    private function createNewReturnInvoice($customerInvoice, $quantityReturn)
    {
        $returnInvoice = new CustomerReturnInvoice();
        $returnInvoice->customer_id = $customerInvoice->customer_id;
        $returnInvoice->customer_invoice_id = $customerInvoice->id;
        $returnInvoice->user_id = Auth::user()->id;
        $returnInvoice->invoiceno = $customerInvoice->invoice_number;
        $returnInvoice->company_id = Auth::user()->company_id;
        $returnInvoice->branch_id = Auth::user()->branch_id;
        $returnInvoice->invoice_date = $customerInvoice->invoice_date;
        $returnInvoice->description = $customerInvoice->description;
        $returnInvoice->total_amount = $customerInvoice->total_amount;
        $returnInvoice->save();

        $this->createNewReturnInvoiceDetail($customerInvoice, $quantityReturn);
    }

    private function createReturnInvoiceAndDetails($customerInvoice)
    {
        $customerReturnInvoice = new CustomerReturnInvoice();
        $customerReturnInvoice->customer_id = $customerInvoice->customer_id;
        $customerReturnInvoice->customer_invoice_id = $customerInvoice->id;
        $customerReturnInvoice->user_id = Auth::user()->id;
        $customerReturnInvoice->invoiceno = $customerInvoice->invoice_number;
        $customerReturnInvoice->company_id = Auth::user()->company_id;
        $customerReturnInvoice->branch_id = Auth::user()->branch_id;
        $customerReturnInvoice->invoice_date = $customerInvoice->invoice_date;
        $customerReturnInvoice->description = $customerInvoice->description;
        $customerReturnInvoice->total_amount = $customerInvoice->total_amount;
        $customerReturnInvoice->save();
        foreach ($customerInvoice->customerInvoiceDetails as $customerInvoiceDetail) {
            $customerReturnInvoiceDetails = new CustomerReturnInvoiceDetail();
            $customerReturnInvoiceDetails->customer_return_invoice_id = $customerReturnInvoice->id;
            $customerReturnInvoiceDetails->customer_invoice_detail_id = $customerInvoiceDetail->id;
            $customerReturnInvoiceDetails->customer_invoice_id = $customerInvoice->id;
            $customerReturnInvoiceDetails->sale_return_quantity = 0;
            $customerReturnInvoiceDetails->sale_return_unit_price = $customerInvoiceDetail->sale_unit_price;
            $customerReturnInvoiceDetails->stock_id = $customerInvoiceDetail->stock_id;
            $customerReturnInvoiceDetails->save();
        }
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
     * @param  \App\Models\SaleReturn  $saleReturn
     * @return \Illuminate\Http\Response
     */
    public function show(SaleReturn $saleReturn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SaleReturn  $saleReturn
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleReturn $saleReturn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SaleReturn  $saleReturn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleReturn $saleReturn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaleReturn  $saleReturn
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleReturn $saleReturn)
    {
        //
    }



    public function processReturn(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['error' => 'Invalid request'], 400);
        }

        $validated = $request->validate([
            'return_invoice_id' => 'required|integer|exists:customer_return_invoices,id',
        ]);

        DB::beginTransaction();

        try {
            $returnInvoice = CustomerReturnInvoice::with(['customerReturnInvoiceDetails', 'customerInvoice'])
                ->findOrFail($validated['return_invoice_id']);

            $this->updateInventory($returnInvoice);
            $this->adjustOriginalInvoice($returnInvoice);
            $this->createAccountingEntries($returnInvoice);

            $returnInvoice->status = 'processed';
            $returnInvoice->save();

            DB::commit();

            return response()->json(['message' => 'Return processed successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Failed to process return: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to process return. Please check the logs or contact support.'], 500);
        }
    }

    private function updateInventory(CustomerReturnInvoice $returnInvoice)
    {
        foreach ($returnInvoice->customerReturnInvoiceDetails as $detail) {
            $stock = Stock::find($detail->stock_id);
            $stock->quantity += $detail->sale_return_quantity;
            $stock->save();
        }
    }

    private function adjustOriginalInvoice(CustomerReturnInvoice $returnInvoice)
    {
        $originalInvoice = $returnInvoice->customerInvoice;
        $returnTotal = $returnInvoice->customerReturnInvoiceDetails->sum(function ($detail) {
            return $detail->sale_return_quantity * $detail->sale_return_unit_price;
        });
        $originalInvoice->total_amount -= $returnTotal;
        $originalInvoice->save();
    }

    private function createAccountingEntries(CustomerReturnInvoice $returnInvoice)
    {
        $financialYearId = $this->getCurrentFinancialYearId();
        $userId = Auth::id();
        $branchId = Auth::user()->branch_id;

        $returnTotal = $returnInvoice->customerReturnInvoiceDetails->sum(function ($detail) {
            return $detail->sale_return_quantity * $detail->sale_return_unit_price;
        });

        $costOfReturnedGoods = $this->calculateCostOfReturnedGoods($returnInvoice);

        // 1. Record the sales return
        $salesReturnSetting = SalesEntries
        ::getAccountSetting('3', '31', '312', '2');
        $this->createEntry($returnInvoice, $salesReturnSetting, $returnTotal, 0, 'Sales Returns', $financialYearId);

        // 2. Adjust Accounts Receivable
        $accountsReceivableSetting = SalesEntries::getAccountSetting('1', '11', '113', '11');
        $this->createEntry($returnInvoice, $accountsReceivableSetting, 0, $returnTotal, 'Accounts Receivable Adjustment', $financialYearId);

        // 3. Adjust inventory
        $inventorySetting = SalesEntries::getAccountSetting('1', '11', '115', '2');
        $this->createEntry($returnInvoice, $inventorySetting, $costOfReturnedGoods, 0, 'Inventory Adjustment', $financialYearId);

        // 4. Adjust Cost of Goods Sold
        $cogsSetting = SalesEntries::getAccountSetting('4', '41', '411', '7');
        $this->createEntry($returnInvoice, $cogsSetting, 0, $costOfReturnedGoods, 'Cost of Goods Sold Adjustment', $financialYearId);
    }

    private function createEntry(CustomerReturnInvoice $returnInvoice, $accountSetting, $debit, $credit, $description, $financialYearId)
    {
        SalesEntries::setEntries(
            $financialYearId,
            $accountSetting->account_head_id,
            $accountSetting->account_control_id,
            $accountSetting->account_sub_control_id,
            $returnInvoice->invoiceno,
            $returnInvoice->invoice_date,
            Auth::id(),
            Auth::user()->branch_id,
            $credit,
            $debit,
            $description,
            $this->translateDescription($description)
        );
    }

    private function calculateCostOfReturnedGoods(CustomerReturnInvoice $returnInvoice)
    {
        return $returnInvoice->customerReturnInvoiceDetails->sum(function ($detail) {
            $stock = Stock::find($detail->stock_id);
            return $detail->sale_return_quantity * $stock->cost_price;
        });
    }

    private function getCurrentFinancialYearId()
    {
        $today = Carbon::now();
        $currentFinanceYear = FinanceYear::where('startDate', '<=', $today)
            ->where('endDate', '>=', $today)
            ->where('isActive', 1)
            ->first();

        if (!$currentFinanceYear) {
            throw new \Exception('No active financial year found for the current date.');
        }

        return $currentFinanceYear->id;
    }

    private function translateDescription($description)
    {
        // Implement translation logic here
        // For now, we'll just return the English description
        return $description;
    }

}

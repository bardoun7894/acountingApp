<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User;
use App\Http\Controllers\Admin;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//
//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('home');
//})->name('dashboard');

//Route::get('/users',[HomeController::class,'showUsers'])->name('users');
//Route::get('/update/{id?}',[Admin\UserController::class,'updateUser']);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/user', [ User\DashboardController::class, 'index'])->name('user');
//Route::get('/admin', [ Admin\DashboardController::class, 'index'])->name('admin');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function() {
    Auth::routes();
});
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth' ]
    ], function(){

    Route::get('/redirect',[HomeController::class,'redirect'])->name('redirect');
    Route::get('/getSupplierInvoice',[Admin\SupplierController::class,'getSupplierInvoice'])->name('getSupplierInvoice');
    Route::get('/getUserInvoice',[Admin\UserController::class,'getUserInvoice'])->name('getUserInvoice');
    Route::get('/getCustomerInvoice',[Admin\CustomerController::class,'getCustomerInvoice'])->name('getCustomerInvoice');

####################################  delete Methods ####################################

    Route::get('/delete-AccountSubControl/{id}',[Admin\AccountSubControlController::class,'deleteAccountSubControl'])->name('delete-AccountSubControl');
    Route::get('/delete-AccountHead/{id}',[Admin\AccountHeadController::class,'deleteAccountHead']);
    Route::get('/delete-AccountControl/{id}',[Admin\AccountControlController::class,'deleteAccountControl']);
    Route::get('/delete-AccountActivity/{id}',[\App\Http\Controllers\AccountActivityController::class,'deleteAccountActivity']);
    Route::get('/delete-AccountSetting/{id}',[\App\Http\Controllers\AccountSettingController::class,'deleteAccountSetting']);
    Route::get('/delete-FinanceYear/{id}',[Admin\FinanceYearController::class,'deleteFinanceYear'])->name('delete-FinanceYear');
    Route::get('/delete-Supplier/{id}',[Admin\SupplierController::class,'deleteSupplier'])->name('delete-Supplier');
     Route::get('/delete-PaymentType/{id}',[\App\Http\Controllers\PaymentTypeController::class,'deletePaymentType']);
    Route::get('/delete-Unit/{id}',[\App\Http\Controllers\UnitController::class,'deleteUnit']);
    Route::get('/delete-User/{id}',[Admin\UserController::class,'deleteUser']) ;
    Route::get('/delete-Stock/{id}',[Admin\StockController::class,'deleteStock']) ;
    Route::get('/delete-Store/{id}',[\App\Http\Controllers\StoreController::class,'deleteStore']) ;
    Route::get('/delete-Branch/{id}',[Admin\BranchController::class,'deleteBranch']) ;
    Route::get('/delete-Category/{id}',[Admin\CategoryController::class,'deleteCategory']) ;
    Route::get('/delete-Customer/{id}',[Admin\CustomerController::class,'deleteCustomer'])->name('delete-Customer');
    Route::get('/delete-Purchase/{id}',[\App\Http\Controllers\PurchaseInvoiceController::class,'deletePurchase'])->name('delete-Purchase');
    Route::get('/allPurchases',[\App\Http\Controllers\PurchaseInvoiceController::class,'allPurchases']);
    Route::get('/purchasePaymentPending',[\App\Http\Controllers\PurchaseInvoiceController::class,'purchasePaymentPending']);
    Route::get('/purchase_payment_history/{id}',[\App\Http\Controllers\PurchaseInvoiceController::class,'purchasePaymentHistory']);
    Route::get('/purchase_invoice/{id}',[\App\Http\Controllers\PurchaseInvoiceController::class,'purchaseSupplierInvoice']);
    Route::get('/paid_amount/{id}',[\App\Http\Controllers\PurchaseInvoiceController::class,'paid_amount']);


    Route::get('/trm',function(){


      return DB::table('supplier_invoices')
          ->join('supplier_payments','supplier_invoices.id','=','supplier_payments.supplier_invoice_id')
          ->select('supplier_invoices.id','supplier_invoices.branch_id','supplier_invoices.invoice_date',
           'supplier_invoices.supplier_id','supplier_invoices.invoice_no','supplier_invoices.total_amount',
            DB::raw('supplier_invoices.total_amount - supplier_payments.payment_amount as `remaining payment` ' )
           ,DB::raw('sum(supplier_payments.payment_amount) as payment ' ))->groupBy('supplier_payments.id')->where('supplier_invoices.total_amount','>','supplier_payments.payment')
            ->get();




    });
    ####################################  select option  Methodes ####################################

    Route::post('/get_selected_account_head',[Admin\AccountSubControlController::class,'getSelectedAccountControl'])->name('getSelectedAccountControl');
    Route::post('/get_selected_account_control',[Admin\AccountSubControlController::class,'getSelectedAccountSubControl'])->name('getSelectedAccountControl');
    Route::post('/get_selected_branch',[Admin\CategoryController::class,'getSelectedBranch'])->name('getSelectedBranch');
 //purchases
    Route::post('/get_selected_purchase_store_based_branch',[\App\Http\Controllers\PurchaseInvoiceController::class,'getSelectedBranchStore'])->name('getSelectedBranchStore');
    Route::post('/get_selected_purchase_supplier_based_branch',[\App\Http\Controllers\PurchaseInvoiceController::class,'getSelectedBranchSupplier'])->name('getSelectedBranchSupplier');
    Route::post('/get_selected_sale_customer_based_branch',[\App\Http\Controllers\SaleController::class,'getSelectedBranchCustomer'])->name('getSelectedBranchSupplier');
    Route::post('/get_selected_purchase_branch',[\App\Http\Controllers\PurchaseInvoiceController::class,'getSelectedPurchaseBranch'])->name('getSelectedPurchaseBranch');
    Route::post('/get_selected_sale_branch',[\App\Http\Controllers\SaleController::class,'getSelectedSaleBranch']);
    Route::post('/get_selected_purchase_product',[\App\Http\Controllers\PurchaseInvoiceController::class,'getSelectedPurchaseCategory'])->name('getSelectedPurchaseCategory');
    Route::post('/get_selected_sale_product',[\App\Http\Controllers\SaleController::class,'getSelectedSaleCategory']);
    Route::post('/addSupplierInvoice',[ \App\Http\Controllers\PurchaseInvoiceController::class,'addSupplierInvoiceFunction'])->name('purchases.addSupplierInvoice');
    Route::post('/addCustomerInvoice',[ \App\Http\Controllers\SaleController::class,'addCustomerInvoiceFunction'])->name('sales.addCustomerInvoice');
    Route::post('/getProductItembyId',[\App\Http\Controllers\PurchaseInvoiceController::class,'getProductItembyId'])->name('getSelectedProduct');
    Route::post('/getSupplierItembyId',[\App\Http\Controllers\PurchaseInvoiceController::class,'getSupplierItembyId'])->name('getSelectedSupplier');
    Route::post('/getCustomerItembyId',[\App\Http\Controllers\SaleController::class,'getCustomerItembyId'])->name('getSelectedSupplier');
    Route::post('/getSumTotalItem',[\App\Http\Controllers\PurchaseInvoiceController::class,'getSumTotalItem'])->name('getSumTotalItem');
    Route::post('/getSumTotalSaleItem',[\App\Http\Controllers\SaleController::class,'getSumTotalItem']);
####################################  resources  ####################################

    Route::resources([
        'users'=>Admin\UserController::class,
        'suppliers'=>Admin\SupplierController::class,
        'customers'=>Admin\CustomerController::class,
        'categories'=>Admin\CategoryController::class,
        'financeYears'=>Admin\FinanceYearController::class,
        'branches'=>Admin\BranchController::class,
        'units'=>\App\Http\Controllers\UnitController::class,
        'payment_types'=>\App\Http\Controllers\PaymentTypeController::class,
        'stores'=>\App\Http\Controllers\StoreController::class,
        'stocks'=>Admin\StockController::class,
        'purchases'=>\App\Http\Controllers\PurchaseInvoiceController::class,
        'sales'=>\App\Http\Controllers\SaleController::class,
         'accountHeads'=>Admin\AccountHeadController::class,
         'accountActivities'=>\App\Http\Controllers\AccountActivityController::class,
        'accountSettings'=>\App\Http\Controllers\AccountSettingController::class,
        'accountControls'=>Admin\AccountControlController::class,
        'accountSubControls'=>Admin\AccountSubControlController::class,
    ]);

});



<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Models\AccountControl;
use App\Models\AccountHead;
use App\Models\AccountSubControl;
use App\Models\Product;
use App\Models\PurchaseCartDetail;
use App\Models\Stock;
use App\Models\Supplier;
use Illuminate\Http\Request;
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

Route::get("/", function () {
    return view("welcome");
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
        "prefix" => LaravelLocalization::setLocale(),
        "middleware" => [
            "localeSessionRedirect",
            "localizationRedirect",
            "localeViewPath",
        ],
    ],
    function () {
        Auth::routes();
    }
);
Route::group(
    [
        "prefix" => LaravelLocalization::setLocale(),
        "middleware" => [
            "localeSessionRedirect",
            "localizationRedirect",
            "localeViewPath",
            "auth",
        ],
    ],
    function () {
        Route::get("/redirect", [HomeController::class, "redirect"])->name(
            "redirect"
        );
        Route::get("/getSupplierInvoice", [
            Admin\SupplierController::class,
            "getSupplierInvoice",
        ])->name("getSupplierInvoice");
        Route::get("/getUserInvoice", [
            Admin\UserController::class,
            "getUserInvoice",
        ])->name("getUserInvoice");
        Route::get("/getCustomerInvoice", [
            Admin\CustomerController::class,
            "getCustomerInvoice",
        ])->name("getCustomerInvoice");

        Route::get("/addDataToPurchaseCart", [
            Admin\PurchaseCartController::class,
            "addDataToPurchaseCart",
        ])->name("addDataToPurchaseCart");

        ####################################  delete Methods ####################################

        Route::get("/delete-AccountSubControl/{id}", [
            Admin\AccountSubControlController::class,
            "deleteAccountSubControl",
        ])->name("delete-AccountSubControl");
        Route::get("/delete-AccountHead/{id}", [
            Admin\AccountHeadController::class,
            "deleteAccountHead",
        ]);
        Route::get("/delete-AccountControl/{id}", [
            Admin\AccountControlController::class,
            "deleteAccountControl",
        ]);
        Route::get("/delete-AccountActivity/{id}", [
            \App\Http\Controllers\AccountActivityController::class,
            "deleteAccountActivity",
        ]);
        Route::get("/delete-AccountSetting/{id}", [
            \App\Http\Controllers\AccountSettingController::class,
            "deleteAccountSetting",
        ]);
        Route::get("/delete-FinanceYear/{id}", [
            Admin\FinanceYearController::class,
            "deleteFinanceYear",
        ])->name("delete-FinanceYear");
        Route::get("/delete-Supplier/{id}", [
            Admin\SupplierController::class,
            "deleteSupplier",
        ])->name("delete-Supplier");
        Route::get("/delete-PaymentType/{id}", [
            \App\Http\Controllers\PaymentTypeController::class,
            "deletePaymentType",
        ]);
        Route::get("/delete-Unit/{id}", [
            \App\Http\Controllers\UnitController::class,
            "deleteUnit",
        ]);
        Route::get("/delete-User/{id}", [
            Admin\UserController::class,
            "deleteUser",
        ]);
        Route::get("/delete-Employee/{id}", [
            EmployeeController::class,
            "deleteEmployee",
        ]);
        Route::get("/delete-Stock/{id}", [
            Admin\StockController::class,
            "deleteStock",
        ]);
        Route::get("/delete-Store/{id}", [
            \App\Http\Controllers\StoreController::class,
            "deleteStore",
        ]);
        Route::get("/delete-Branch/{id}", [
            Admin\BranchController::class,
            "deleteBranch",
        ]);
        Route::get("/delete-Category/{id}", [
            Admin\CategoryController::class,
            "deleteCategory",
        ]);
        Route::get("/delete-Customer/{id}", [
            Admin\CustomerController::class,
            "deleteCustomer",
        ])->name("delete-Customer");
        Route::get("/delete-Purchase/{id}", [
            \App\Http\Controllers\PurchaseInvoiceController::class,
            "deletePurchase",
        ])->name("delete-Purchase");

        Route::get("/allPurchases", [
            \App\Http\Controllers\PurchaseInvoiceController::class,
            "allPurchases",
        ]);

        Route::get("/purchasePaymentPending", [
            \App\Http\Controllers\PurchaseInvoiceController::class,
            "purchasePaymentPending",
        ]);
        Route::get("/purchase_payment_history/{id}", [
            \App\Http\Controllers\PurchaseInvoiceController::class,
            "purchasePaymentHistoryView",
        ]);
        Route::get("/purchase_invoice/{id}", [
            \App\Http\Controllers\PurchaseInvoiceController::class,
            "purchaseSupplierInvoice",
        ]);
        Route::get("/paid_amount/{id}", [
            \App\Http\Controllers\PurchaseInvoiceController::class,
            "paid_amount",
        ]);
        Route::post("/pay_amount/{id}", [
            \App\Http\Controllers\PurchaseInvoiceController::class,
            "pay_amount",
        ]);
        Route::get("/allSales", [
            \App\Http\Controllers\SaleController::class,
            "allSales",
        ]);

        Route::get("/trm", function () {
            return DB::table("supplier_invoices")
                ->join(
                    "supplier_payments",
                    "supplier_invoices.id",
                    "=",
                    "supplier_payments.supplier_invoice_id"
                )
                ->select(
                    "supplier_invoices.id",
                    "supplier_invoices.branch_id",
                    "supplier_invoices.invoice_date",
                    "supplier_invoices.supplier_id",
                    "supplier_invoices.invoice_no",
                    "supplier_invoices.total_amount",
                    DB::raw(
                        "supplier_invoices.total_amount - supplier_payments.payment_amount as `remaining payment` "
                    ),
                    DB::raw("sum(supplier_payments.payment_amount) as payment ")
                )
                ->groupBy("supplier_payments.id")
                ->where(
                    "supplier_invoices.total_amount",
                    ">",
                    "supplier_payments.payment"
                )
                ->get();
        });

        Route::get("get_supplier_select2", function (Request $request) {
            $search = $request->search;
            $suppliers = Supplier::where([
                "branch_id" => Auth::user()->branch_id,
            ])
                ->where(
                    Supplier::getSupplierNameLang(),
                    "like",
                    "%" . $search . "%"
                )
                ->get();
            return $suppliers;
        });
        Route::get("product_select2", function (Request $request) {
            $search = $request->search;

            $product = Stock::where(
                Stock::getProductNameLang(),
                "like",
                "%" . $search . "%"
            )
                ->orwhere("barcode", "like", "%" . $search . "%")

                ->get();
            return $product;
        });

        Route::get("fetch_data", function (Request $request) {
            if ($request->ajax()) {
                if (
                    \Illuminate\Support\Facades\Auth::user()->user_type_id == 1
                ) {
                    $purchases = PurchaseCartDetail::with("stock")->get();
                } else {
                    $purchases = PurchaseCartDetail::with("stock")
                        ->where(
                            "branch_id",
                            \Illuminate\Support\Facades\Auth::user()->branch_id
                        )
                        ->get();
                }

                return json_encode($purchases);
            }
        });

        Route::get("/thisisme", function () {
            return AccountControl::with(["accountSubControls"])->get();
        });

        Route::post("fetch_products", function (Request $request) {
            $description = Stock::getDescriptionLang();
            if ($request->ajax()) {
                $product = Stock::where("id", $request->stock_id)->first();
                $purchases = PurchaseCartDetail::where(
                    "stock_id",
                    $request->stock_id
                )->get();
                if ($purchases->count() > 0) {
                    return "";
                } else {
                    $purchaseCart = new PurchaseCartDetail();
                    $purchaseCart->branch_id = Auth::user()->branch_id;
                    $purchaseCart->unit_id = $product->unit_id;
                    $purchaseCart->category_id = $product->category_id;
                    $purchaseCart->stock_id = $product->id;
                    $purchaseCart->$description = $product->$description;
                    $purchaseCart->purchase_qty = 0;
                    $purchaseCart->purchase_unit_price =
                        $product->current_purchase_unit_price;
                    $purchaseCart->sale_unit_price =
                        $product->current_sale_unit_price;
                    $purchaseCart->user_id = Auth::user()->id;
                    $purchaseCart->company_id = Auth::user()->company_id;
                    $purchaseCart->save();
                    return $product;
                }
            }
        });
        Route::post("post_products_on_qty_change", function (Request $request) {
            if ($request->ajax()) {
                $purchaseCart = PurchaseCartDetail::find($request->id);
                $purchaseCart->purchase_qty = $request->purchase_qty;
                $purchaseCart->save();
                return $purchaseCart;
            }
        });
        ####################################  select option  Methodes ####################################

        Route::post("/get_selected_account_head", [
            Admin\AccountSubControlController::class,
            "getSelectedAccountControl",
        ])->name("getSelectedAccountControl");
        Route::post("/get_selected_account_control", [
            Admin\AccountSubControlController::class,
            "getSelectedAccountSubControl",
        ])->name("getSelectedAccountControl");
        Route::post("/get_selected_branch", [
            Admin\CategoryController::class,
            "getSelectedBranch",
        ])->name("getSelectedBranch");
        //purchases
        Route::post("/get_selected_purchase_store_based_branch", [
            \App\Http\Controllers\PurchaseInvoiceController::class,
            "getSelectedBranchStore",
        ])->name("getSelectedBranchStore");
        // Route::post("/get_selected_purchase_supplier_based_branch", [
        //     \App\Http\Controllers\PurchaseInvoiceController::class,
        //     "getSelectedBranchSupplier",
        // ])->name("getSelectedBranchSupplier");
        Route::post("/get_selected_sale_customer_based_branch", [
            \App\Http\Controllers\SaleController::class,
            "getSelectedBranchCustomer",
        ])->name("getSelectedBranchSupplier");
        Route::post("/get_selected_purchase_branch", [
            \App\Http\Controllers\PurchaseInvoiceController::class,
            "getSelectedPurchaseBranch",
        ])->name("getSelectedPurchaseBranch");
        Route::post("/get_selected_sale_branch", [
            \App\Http\Controllers\SaleController::class,
            "getSelectedSaleBranch",
        ]);
        Route::post("/get_selected_purchase_product", [
            \App\Http\Controllers\PurchaseInvoiceController::class,
            "getSelectedPurchaseCategory",
        ])->name("getSelectedPurchaseCategory");
        Route::post("/get_selected_sale_product", [
            \App\Http\Controllers\SaleController::class,
            "getSelectedSaleCategory",
        ]);
        Route::post("/addSupplierInvoice", [
            \App\Http\Controllers\PurchaseInvoiceController::class,
            "addSupplierInvoiceFunction",
        ])->name("purchases.addSupplierInvoice");
        Route::post("/addCustomerInvoice", [
            \App\Http\Controllers\SaleController::class,
            "addCustomerInvoiceFunction",
        ])->name("sales.addCustomerInvoice");
        Route::post("/getProductItembyId", [
            \App\Http\Controllers\PurchaseInvoiceController::class,
            "getProductItembyId",
        ])->name("getSelectedProduct");
        Route::post("/getSupplierItembyId", [
            \App\Http\Controllers\PurchaseInvoiceController::class,
            "getSupplierItembyId",
        ])->name("getSelectedSupplier");
        Route::post("/getCustomerItembyId", [
            \App\Http\Controllers\SaleController::class,
            "getCustomerItembyId",
        ])->name("getSelectedSupplier");
        Route::post("/getSumTotalItem", [
            \App\Http\Controllers\PurchaseInvoiceController::class,
            "getSumTotalItem",
        ])->name("getSumTotalItem");
        Route::post("/getSumTotalSaleItem", [
            \App\Http\Controllers\SaleController::class,
            "getSumTotalItem",
        ]);
        Route::post("/companies/approve_user", [
            CompanyController::class,
            "approveUser",
        ]);
        ####################################  resources  ####################################

        Route::resources([
            "users" => Admin\UserController::class,
            "companies" => CompanyController::class,
            "employees" => EmployeeController::class,
            "suppliers" => Admin\SupplierController::class,
            "customers" => Admin\CustomerController::class,
            "categories" => Admin\CategoryController::class,
            "financeYears" => Admin\FinanceYearController::class,
            "branches" => Admin\BranchController::class,
            "units" => \App\Http\Controllers\UnitController::class,
            "payment_types" =>
                \App\Http\Controllers\PaymentTypeController::class,
            "stores" => \App\Http\Controllers\StoreController::class,
            "stocks" => Admin\StockController::class,
            "purchases" =>
                \App\Http\Controllers\PurchaseInvoiceController::class,
            // "sales" => \App\Http\Controllers\SaleController::class,
            "accountHeads" => Admin\AccountHeadController::class,
            "accountActivities" =>
                \App\Http\Controllers\AccountActivityController::class,
            "accountSettings" =>
                \App\Http\Controllers\AccountSettingController::class,
            "accountControls" => Admin\AccountControlController::class,
            "accountSubControls" => Admin\AccountSubControlController::class,
        ]);
    }
);

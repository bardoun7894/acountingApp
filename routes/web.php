<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PurchaseInvoiceController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StoreController;
use App\Models\Category;
use App\Models\Customer;
use App\Models\PurchaseCartDetail;
use App\Models\Sale;
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
            "isActive",
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
        Route::get("/delete-Sale/{id}", [
            \App\Http\Controllers\SaleController::class,
            "deleteSale",
        ])->name("delete-Sale");

        Route::get("/allPurchases", [
            \App\Http\Controllers\PurchaseInvoiceController::class,
            "allPurchases",
        ]);
        Route::get("/allSales", [
            \App\Http\Controllers\SaleController::class,
            "allSales",
        ]);

        Route::get("/purchasePaymentPending", [
            \App\Http\Controllers\PurchaseInvoiceController::class,
            "purchasePaymentPending",
        ]);
        Route::get("/salePaymentPending", [
            \App\Http\Controllers\SaleController::class,
            "salePaymentPending",
        ]);
        Route::get("/purchase_payment_history/{id}", [
            \App\Http\Controllers\PurchaseInvoiceController::class,
            "purchasePaymentHistoryView",
        ]);
        Route::get("/sale_payment_history/{id}", [
            \App\Http\Controllers\SaleController::class,
            "salePaymentHistoryView",
        ]);

        Route::post("/get_history_payments_by_date", [
            \App\Http\Controllers\SaleController::class,
            "salePaymentHistoryViewByDate",
        ]);

        Route::get("/purchase_invoice/{id}", [
            \App\Http\Controllers\PurchaseInvoiceController::class,
            "purchaseSupplierInvoice",
        ]);
        Route::get("/sale_invoice/{id}", [
            \App\Http\Controllers\SaleController::class,
            "saleCustomerInvoice",
        ]);
        Route::get("/paid_supplier_amount/{id}", [
            \App\Http\Controllers\PurchaseInvoiceController::class,
            "paid_amount",
        ]);
        Route::get("/paid_customer_amount/{id}", [
            \App\Http\Controllers\SaleController::class,
            "paid_amount",
        ]);
        Route::post("/pay_purchase_amount/{id}", [
            \App\Http\Controllers\PurchaseInvoiceController::class,
            "pay_amount",
        ]);

        Route::get("get_supplier_select2", [
            SupplierController::class,
            "getSupplierSelect2",
        ]);
        Route::get("get_customer_select2", [
            CustomerController::class,
            "getCustomerSelect2",
        ]);

        Route::get("product_select2", [
            StockController::class,
            "getProductSelect2",
        ]);

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
        ####################################  PurchaseCartDetail Cart   ####################################

        Route::post("fetch_products_to_purchase_cart", [
            PurchaseInvoiceController::class,
            "fetchProductsToPurchaseCart",
        ]);

        Route::post("post_products_on_qty_change_to_purchaseCart", [
            PurchaseInvoiceController::class,
            "postProductOnQtyChangeToProductCart",
        ]);

        ####################################  Sale Cart   ####################################
        Route::post("/pay_sale_amount/{id}", [
            \App\Http\Controllers\SaleController::class,
            "pay_sale_amount",
        ]);
        Route::get("/allSales", [SaleController::class, "allSales"]);

        Route::get("/test", function () {
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
        Route::get("fetch_sale_data", [SaleController::class, "fetchSaleData"]);

        Route::post("fetch_products_to_saleCart", [
            SaleController::class,
            "fetchproductsToSaleCart",
        ]);
        Route::post("post_products_on_qty_change_to_saleCart", [
            SaleController::class,
            "postProductOnQtyChangeToSaleCart",
        ]);
        ####################################  select option  Methodes ####################################

        Route::post("/get_selected_account_head", [
            Admin\AccountSubControlController::class,
            "getSelectedAccountControl",
        ])->name("getSelectedAccountControl");

        Route::post("/delete_account_if_has_account", [
            Admin\AccountControlController::class,
            "delete_account_if_has_account",
        ]);

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
        ])->middleware("isSuperAdmin");
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
            "sales" => \App\Http\Controllers\SaleController::class,
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
        Route::prefix("/front")
            ->namespace("Front")
            ->group(function () {
                Route::get("/", [
                    \App\Http\Controllers\Front\FrontController::class,
                    "front",
                ]);
                Route::match(["get", "post"], "/products", [
                    \App\Http\Controllers\Front\FrontController::class,
                    "get_all_products",
                ]);
                //       Route::match(['get','post'],'/get_category_id', [\App\Http\Controllers\Front\FrontController::class, 'countd']);
                Route::match(["get", "post"], "/{url?}", [
                    \App\Http\Controllers\Front\CategoryController::class,
                    "categoryDetail",
                ]);
                Route::get("/products", function () {
                    $categories = Category::all();
                    $products = Stock::get();
                    return view("layouts.front_layout.products")->with(
                        compact(["categories", "products"])
                    );
                });
                //    Route::post('/sort_products', [\App\Http\Controllers\Front\FrontController::class, 'get_sorting']);
            });
    }
);

<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PurchaseInvoiceController;
use App\Http\Controllers\PurchaseReturnController;
use App\Http\Controllers\SaleCartController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SalePaymentController;
use App\Http\Controllers\SaleReturnController;
use App\Http\Controllers\StoreController;
use App\Models\Category;
use App\Models\Customer;
use App\Models\PurchaseCartDetail;
use App\Models\Sale;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\User;
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
            // PurchaseCartController::class
            PurchaseInvoiceController::class, "addDataToPurchaseCart",
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
        Route::get("/delete-Purchase/{id}", [  PurchaseInvoiceController::class, "deletePurchase",   ])->name("delete-Purchase");
        Route::get("/delete-SaleCart/{id}", [
             SaleCartController::class,
            "deleteSaleCart",
        ])->name("delete-SaleCart");

        Route::get("/allPurchases", [
            PurchaseInvoiceController::class,
            "allPurchases",
        ]);
        Route::get("/allSales", [
            SaleController::class,
            "allSales",
        ]);


        Route::get("/purchasePaymentPending", [
          PurchaseInvoiceController::class,
            "purchasePaymentPending",
        ]);
        Route::get("/salePaymentPending", [
          SalePaymentController::class,
            "salePaymentPending",
        ]);
        Route::get("/purchase_payment_history/{id}", [
          PurchaseInvoiceController::class,
            "purchasePaymentHistoryView",
        ]);
        Route::get("/sale_payment_history/{id}", [
           SalePaymentController::class,
            "salePaymentHistoryView",
        ]);

        Route::post("/get_history_payments_by_date", [
           SalePaymentController::class,
            "salePaymentHistoryViewByDate",
        ]);

        Route::get("/purchase_invoice/{id}", [
             PurchaseInvoiceController::class,
            "purchaseSupplierInvoice",
        ]);
        Route::get("/sale_invoice/{id}", [
            \App\Http\Controllers\CustomerInvoiceController::class,
            "saleCustomerInvoice",
        ]);
        Route::get("/paid_supplier_amount/{id}", [
             PurchaseInvoiceController::class,
            "paid_amount",
        ]);
        Route::get("/paid_customer_amount/{id}", [
            \App\Http\Controllers\SalePaymentController::class,
            "paid_amount",
        ]);
        Route::post("/pay_purchase_amount/{id}", [
             PurchaseInvoiceController::class,
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
// fetch data from PurchaseCartDetail
        Route::get("fetch_data_purchase", [PurchaseInvoiceController::class,"fetch_data_purchase"]);


        // findInvoiceReturn purchases
        Route::post("find-invoice-purchase", [
            PurchaseReturnController::class,
            "findInvoiceReturn"
        ]);
         // findInvoiceReturn sales
        Route::post("find-invoice-sale", [
            SaleReturnController::class,
            "findInvoiceReturn"
        ]);
        // returnPurchasesOnQtyChange
        Route::post("return_purchases_on_qty_change", [
            PurchaseReturnController::class,
            "returnPurchasesOnQtyChange"
        ]);
        // returnSalesOnQtyChange
        Route::post("return_sales_on_qty_change", [
            SaleReturnController::class,
            "returnSalesOnQtyChange"
        ]);
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
            SalePaymentController::class,
            "pay_sale_amount",
        ]);
        Route::get("/allSales", [SaleController::class, "allSales"]);
        Route::get("/saleReturns", [SaleController::class, "saleReturns"]);

        Route::get("fetch_sale_data",[SaleCartController::class
        ,  "fetchSaleData"]);

        Route::post("fetch_products_to_saleCart", [
            SaleCartController::class,
            "fetchproductsToSaleCart",
        ]);

        Route::get('/get_sale_cart_data', function () {
           return Sale::with('Customer')->get();
        });
        Route::post( "post_products_on_qty_change_to_saleCart" ,
        [
             SaleCartController::class,
            "postProductOnQtyChangeToSaleCart",
        ]);
        ####################################  select option  Methodes ####################################

        Route::post("/get_selected_account_head", [
            Admin\AccountSubControlController::class,
            "getSelectedAccountControl",
        ]);

        Route::post("/delete_account_if_has_account", [
            Admin\AccountControlController::class,
            "delete_account_if_has_account",
        ]);

        Route::post("/get_selected_account_control", [
            Admin\AccountSubControlController::class,
            "getSelectedAccountSubControl",
        ]);
        Route::post("/get_selected_branch", [
            Admin\CategoryController::class,
            "getSelectedBranch",
        ])->name("getSelectedBranch");
        //purchases
        Route::post("/get_selected_purchase_store_based_branch", [
            PurchaseInvoiceController::class,
            "getSelectedBranchStore",
        ])->name("getSelectedBranchStore");
        Route::post("/get_selected_sale_customer_based_branch", [
             SaleController::class,
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
            \App\Http\Controllers\CustomerInvoiceController::class,
            "addCustomerInvoiceFunction",
        ])->name("sales.addCustomerInvoice");
        Route::post("/getProductItembyId", [
            \App\Http\Controllers\PurchaseInvoiceController::class,
            "getProductItembyId",
        ])->name("getSelectedProduct");
        Route::post("/getSupplierItembyId", [
            \App\Http\Controllers\PurchaseInvoiceController::class,
            "getSupplierItembyId",
        ]);
        Route::post("/changeStatusUser", [
          UserController::class,
            "changeStatusUser",
        ]);
        Route::post("/getCustomerItembyId", [
            \App\Http\Controllers\SaleController::class,
            "getCustomerItembyId",
        ]);

        Route::post("/getSumTotalItem", [
            \App\Http\Controllers\PurchaseInvoiceController::class,
            "getSumTotalItem",
        ])->name("getSumTotalItem");

        Route::post("/getSumTotalSaleItem", [
            \App\Http\Controllers\SaleCartController::class,
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
            //purchases return
            "purchaseReturns" => \App\Http\Controllers\PurchaseReturnController::class,
            //sales return
            "saleReturns" => \App\Http\Controllers\SaleReturnController::class,
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
                    CategoryController::class,
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

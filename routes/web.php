<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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
    Route::get('/getCustomerInvoice',[Admin\CustomerController::class,'getCustomerInvoice'])->name('getCustomerInvoice');

####################################  Search Methodes ####################################
    Route::post('/searchAccountSubControl',[Admin\AccountSubControlController::class,'searchAccountSubControlFunction'])->name('searchAccountSubControl');
    Route::post('/searchAccountControl',[Admin\AccountControlController::class,'searchAccountControlFunction'])->name('searchAccountControl');
    Route::post('/searchAccountHead',[Admin\AccountHeadController::class,'searchAccountHeadFunction'])->name('searchHeadControl');
    Route::post('/searchFinanceYear',[Admin\FinanceYearController::class,'searchFinanceYearFunction'])->name('searchFinanceYear');
    Route::post('/searchSupplier',[Admin\SupplierController::class,'searchSupplierFunction'])->name('searchSupplier');
    Route::post('/searchCustomer',[Admin\CustomerController::class,'searchCustomerFunction'])->name('searchCustomer');
    Route::post('/searchUser',[Admin\UserController::class,'searchUserFunction'])->name('searchUser');

####################################  delete Methoders ####################################

    Route::get('/delete-AccountSubControl/{id}',[Admin\AccountSubControlController::class,'deleteAccountSubControl'])->name('delete-AccountSubControl');
    Route::get('/delete-AccountControl/{id}',[Admin\AccountControlController::class,'deleteAccountControl'])->name('delete-AccountControl');
    Route::get('/delete-FinanceYear/{id}',[Admin\FinanceYearController::class,'deleteFinanceYear'])->name('delete-FinanceYear');
    Route::get('/delete-Supplier/{id}',[Admin\SupplierController::class,'deleteSupplier'])->name('delete-Supplier');
    Route::get('/delete-Customer/{id}',[Admin\CustomerController::class,'deleteCustomer'])->name('delete-Customer');
####################################  select option  Methodes ####################################

    Route::post('/get_selected_account_control',[Admin\AccountSubControlController::class,'getSelectedAccountControl'])->name('getSelectedAccountControl');
####################################  resources  ####################################

    Route::resources([
        'users'=>Admin\UserController::class,
        'suppliers'=>Admin\SupplierController::class,
        'customers'=>Admin\CustomerController::class,
        'categories'=>Admin\CategoryController::class,
        'financeYears'=>Admin\FinanceYearController::class,
        'branches'=>Admin\BranchController::class,
        'stocks'=>Admin\StockController::class,
        'accountHeads'=>Admin\AccountHeadController::class,
        'accountControls'=>Admin\AccountControlController::class,
        'accountSubControls'=>Admin\AccountSubControlController::class,
    ]);

});



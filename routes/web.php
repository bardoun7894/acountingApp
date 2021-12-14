<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User;
use App\Http\Controllers\Admin;

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

Auth::routes();
//
//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('home');
//})->name('dashboard');

//Route::get('/users',[HomeController::class,'showUsers'])->name('users');
//Route::get('/update/{id?}',[Admin\UserController::class,'updateUser']);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/user', [ User\DashboardController::class, 'index'])->name('user');
//Route::get('/admin', [ Admin\DashboardController::class, 'index'])->name('admin');

Route::middleware('auth')->group(function (){

    Route::get('/redirect',[HomeController::class,'redirect'])->name('redirect');
    Route::post('/get_selected_branch',[CategoryController::class,'getSelectedBranch'])->name('getSelectedBranch');
    Route::resources([
        'users'=>Admin\UserController::class,
        'categories'=>Admin\CategoryController::class,
        'branches'=>Admin\BranchController::class,
        'stocks'=>Admin\StockController::class,
    ]);
}) ;



<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('home2');
});

Auth::routes();


Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'permission']], function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::get('/categories-datatables', [CategoryController::class, 'datatables'])->name('categories.datatables');
    
    Route::resource('inventories', InventoryController::class);
    Route::get('/inventories-datatables', [InventoryController::class, 'datatables'])->name('inventories.datatables');
    Route::post('inventories/import-barang-excel', [InventoryController::class, 'import_excel'])->name('inventories.import-barang-excel');
    Route::get('get-no-box', [InventoryController::class, 'get_no_box'])->name('get-no-box');
    // Route::get('inventories/{no_box?}', [InventoryController::class, 'details'])->name('detail-box');
    // Route::get('inventories/{no_box?}', [InventoryController::class, 'detailcoba'])->name('detail-box');
    Route::get('detail-barang/{no_box?}', [InventoryController::class, 'details'])->name('detail-barang');
    Route::post('inventory-no-box', [InventoryController::class, 'update_no_box'])->name('no-box-inventory');


    Route::resource('rooms', RoomController::class);
    Route::get('/rooms-datatables', [RoomController::class, 'datatables'])->name('rooms.datatables');
    /* route roles permission*/
    Route::resource('roles', RolesController::class);
    Route::resource('permissions', PermissionsController::class);
    Route::resource('users', UsersController::class);
    Route::get('/users-datatables', [UsersController::class, 'datatables'])->name('users.datatables');
    
    Route::resource('transactions', TransactionController::class);
    Route::get('/transactions-datatables', [TransactionController::class, 'datatables'])->name('transactions.datatables');
    
});
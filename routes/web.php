<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\ShipperController;

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
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(UserController::class)->group(function(){
    Route::get('/logout', 'logout')->name('user.logout');
});

Route::controller(TransactionController::class)->group(function(){
    Route::get('/transactions/history', 'transactionsHistoryPage')->name('transactions.history.page');
    Route::get('/transactions/add', 'addTransactionPage')->name('add.transaction.page');
    Route::post('/transactions/additem', 'addTransactionItem')->name('add.transaction.item');
    Route::get('transactions/deleteitem/{id}', 'deleteTransactionItem')->name('delete.transaction.item');
    Route::post('transactions/maketransaction', 'makeTransaction')->name('make.transaction');
    Route::get('transactions/edit/page/{id}', 'editTransactionPage')->name('edit.transaction.page');
    Route::post('/transactions/updateitem/{id}', 'updateTransactionItem')->name('update.transaction.item');
    Route::post('/transactions/edit/{id}', 'editTransaction')->name('edit.transaction');
    Route::get('/transactions/details/{transactionnumber}', 'transactionDetails')->name('transaction.details');
    Route::get('/transactions/history/delete/{id}', 'deleteTransaction')->name('delete.transaction');
    Route::get('/transactions/approval/page', 'approvalTransactionPage')->name('approval.transaction.page');
    Route::get('/transactions/approve/{id}', 'approveTransaction')->name('approve.transaction');
    Route::get('/transactions/data/{id}', 'transactionDataPage')->name('transaction.data.page');
});

Route::controller(StockController::class)->group(function(){
    Route::get('/stock/itemstocklist', 'itemStockListPage')->name('item.stock.list.page');
    Route::get('/stock/almostemptyitem', 'almostEmptyPage')->name('almost.empty.item.page');
    Route::get('/stock/add', 'addStockPage')->name('add.stock.page');
    Route::post('/stock/addstock', 'addStock')->name('add.stock');
    Route::get('/stock/editiitem/{id}', 'editItemPage')->name('edit.item.page');
    Route::post('stock/edititem', 'editItem')->name('edit.item');
    Route::get('/stock/deleteitem/{id}', 'deleteItem')->name('delete.item');
});

Route::controller(CategoryController::class)->group(function(){
    Route::get('/category/categorylist', 'categoryListPage')->name('category.list.page');
    Route::get('/category/addCategoryPage', 'addCategoryPage')->name('add.category.page');
    Route::post('/category/add', 'addCategory')->name('add.category');
    Route::get('/category/editCategoryPage/{id}', 'editCategoryPage')->name('edit.category.page');
    Route::post('/category/edit/{id}', 'editCategory')->name('edit.category');
    Route::get('/category/delete/{id}', 'deleteCategory')->name('delete.category');
});

Route::controller(UnitController::class)->group(function(){
    Route::get('/unit/unitlist', 'unitListPage')->name('unit.list.page');
    Route::get('/unit/addunitPage', 'addUnitPage')->name('add.unit.page');
    Route::post('/unit/add', 'addUnit')->name('add.unit');
    Route::get('/unit/editunitPage/{id}', 'editUnitPage')->name('edit.unit.page');
    Route::post('/unit/edit/{id}', 'editUnit')->name('edit.unit');
    Route::get('/unit/delete/{id}', 'deleteUnit')->name('delete.unit');
});

Route::controller(PaymentController::class)->group(function(){
    Route::get('/payment/list/page', 'paymentListPage')->name('payment.list.page');
    Route::get('/payment/add/page', 'addPaymentPage')->name('add.payment.page');
    Route::post('payment/add', 'addPayment')->name('add.payment');
    Route::get('/payment/edit/page/{id}', 'editPaymentPage')->name('edit.payment.page');
    Route::post('/payment/edit/{id}', 'editPayment')->name('edit.payment');
    Route::get('/payment/delete/{id}', 'deletePayment')->name('delete.payment');
});

Route::controller(ShipperController::class)->group(function(){
    Route::get('shipper/list/page', 'shipperListPage')->name('shipper.list.page');
    Route::get('/shipper/add/page', 'addShipperPage')->name('add.shipper.page');
    Route::post('/shipper/add', 'addShipper')->name('add.shipper');
    Route::get('/shipper/edit/page/{id}', 'editShipperPage')->name('edit.shipper.page');
    Route::post('/shipper/edit/{id}', 'editShipper')->name('edit.shipper');
    Route::get('/shipper/delete/{id}', 'deleteShipper')->name('delete.shipper');
});

Route::controller(DefaultController::class)->group(function(){
    Route::get('/get/item/category', 'getItemCategory')->name('get.item.category');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

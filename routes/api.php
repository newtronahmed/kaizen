<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\VendorController;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Route::resources([
//     'customer' => CustomerController::class,
//     'inventory' => InventoryController::class,
//     'receipt' => ReceiptController::class,
//     'supplier' => SupplierController::class,
//     'invoice' => InvoiceController::class,
//     'discount' => DiscountController::class,
// ]);

Route::resource('customers', CustomerController::class);
Route::resource('inventories', InventoryController::class);
Route::resource('receipts', ReceiptController::class);
Route::resource('vendors', VendorController::class);
Route::resource('invoices', InvoiceController::class);
Route::resource('discounts', DiscountController::class);
Route::resource('products', ProductController::class);
Route::resource('payments', PaymentController::class);


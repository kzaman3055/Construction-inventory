<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Status\StatusController;
use App\Models\Category;
use App\Models\PurchaseInvoice;
use App\Models\SaleInvoice;

use App\Http\Controllers\POS\CustomerController;

use App\Models\SubCategory;
use Illuminate\Http\Request;

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
    return view('auth.login');
});

Route::group(['middleware' => 'prevent-back-history'],function(){


Auth::routes();

// Admin controller Start




Route::group(['middleware' => 'auth'], function () {
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.dashboard');
Route::resource('manage-supplier', 'App\Http\Controllers\POS\SupplierController');






Route::resource('manage-customer', CustomerController::class);
Route::post('amountDetails/update/{id}', [CustomerController::class, 'AmountDetails'])->name('amountDetails.update');


Route::post('/dailycoststore', [CustomerController::class, 'dailycoststore'])->name('customer.dailycoststore');


Route::post('dailyCost/update/{id}', [CustomerController::class, 'DailyCostAmount'])->name('dailyCost.update');




Route::delete('/dailyCostDestroy/{id}', [CustomerController::class, 'DailyCostAmountDestroy'])->name('dailyCost.destroy');







Route::get('/projectdata/{id}', [CustomerController::class, 'showdata'])->name('project.showdata');


Route::resource('manage-location', 'App\Http\Controllers\Other\LocationController');
Route::resource('manage-daily-cost-category', 'App\Http\Controllers\Other\DailyCostCategoryController');



Route::resource('manage-unit', 'App\Http\Controllers\Other\UnitController');
Route::resource('manage-shop', 'App\Http\Controllers\Shop\ShopController');

Route::resource('manage-category', 'App\Http\Controllers\Product\CategoryController');
// Route::resource('manage-category', 'App\Http\Controllers\Product\CategoryController');
// Route::post('/category/subcategorystore', 'App\Http\Controllers\Product\CategoryController@subcategorystore')->name('category.subcategorystore');

// Route::resource('manage-subcategory', 'App\Http\Controllers\Product\SubCategoryController');


Route::resource('manage-product', 'App\Http\Controllers\Product\ProductController');

//get data to add data in product

Route::get('/getCategoriesByBrandId/{brandId}', function ($brandId) {
    $categories = \App\Models\Category::where('brand_id', $brandId)->pluck('name', 'id')->toArray();
    return response()->json(['categories' => $categories]);
})->name('getCategoriesByBrandId');


Route::get('/getSubcategoriesByCategoryId/{categoryId}', function ($categoryId) {
    $subcategories = \App\Models\SubCategory::where('category_id', $categoryId)->pluck('name', 'id')->toArray();
    return response()->json(['subcategories' => $subcategories]);
})->name('getSubcategoriesByCategoryId');


//get data to edit data in product


Route::get('/get-categories/{brandId}', 'App\Http\Controllers\Product\ProductController@getCategories');
Route::get('/get-subcategories/{categoryId}', 'App\Http\Controllers\Product\ProductController@getSubcategories');
//get product by Supplier

Route::get('/getProductsBySupplierId/{supplierId}', function ($supplierId) {
    $products = \App\Models\Product::where('suppliers_id', $supplierId)->pluck('name', 'product_code')->toArray();
    return response()->json(['products' => $products]);
})->name('getProductsBySupplierId');




Route::resource('manage-product-purchase', 'App\Http\Controllers\Product\ProductPurchaseController');
Route::resource('manage-product-sale', 'App\Http\Controllers\Product\ProductSaleController');


// Route::resource('manage-product-purchase', 'App\Http\Controllers\Product\ProductStockController');

// Route::get('manage-product-stock/{id}/input-stock', 'App\Http\Controllers\Product\ProductStockController@InputStock')->name('manage-product-stock.input-stock');

// Route::get('manage-product-purchase/{id}/input-purchase', 'App\Http\Controllers\Product\ProductStockController@InputPurchase')->name('manage-product-purchase.input-purchase');




Route::post('supplierstatus/update/{id}', [StatusController::class, 'SupplierStatus'])->name('supplierstatus.update');

Route::post('customerstatus/update/{id}', [StatusController::class, 'CustomerStatus'])->name('customerstatus.update');

Route::post('shopstatus/update/{id}', [StatusController::class, 'ShopStatus'])->name('shopstatus.update');
Route::post('productstatus/update/{id}', [StatusController::class, 'ProductStatus'])->name('productstatus.update');



//manage pay in perchase
Route::post('/purchaseproductpay/update/{id}', [StatusController::class, 'PurchaseProductPayUpdate'])->name('purchaseproductpay.update');
Route::post('/saleproductpay/update/{id}', [StatusController::class, 'SaleProductPayUpdate'])->name('saleproductpay.update');

Route::get('/mark-as-paid/{id}', function($id) {
    $purchaseinvoicedata = PurchaseInvoice::find($id);
    $total_price = $purchaseinvoicedata->total_price;
    $purchaseinvoicedata->pay = $total_price;
    $purchaseinvoicedata->due = 0;
    $purchaseinvoicedata->save();
    return redirect()->back()->with('message', 'Data added Successfully!');
})->name('mark-as-paid');


Route::get('/sale-mark-as-paid/{id}', function($id) {
    $saleinvoicedata = SaleInvoice::find($id);
    $total_price = $saleinvoicedata->total_price;
    $saleinvoicedata->pay = $total_price;
    $saleinvoicedata->due = 0;
    $saleinvoicedata->save();
    return redirect()->back()->with('message', 'Data added Successfully!');
})->name('sale-mark-as-paid');

Route::get('/invoices/purchase/{id}', 'App\Http\Controllers\Product\InvoiceController@showPurchaseInvoice')->name('purchase-invoice.show');

Route::get('/invoices/sale/{id}', 'App\Http\Controllers\Product\InvoiceController@showSaleInvoice')->name('sale-invoice.show');

Route::post('/Return/update', 'App\Http\Controllers\Product\InvoiceController@ReturnUpdate')->name('return.update');
Route::get('/return-product/update/{id}', 'App\Http\Controllers\Product\InvoiceController@ReturnProductUpdate')->name('returnproduct.update');









Route::get('/returnInvoices/sale/{id}', 'App\Http\Controllers\Product\InvoiceController@ReturnSaleInvoice')->name('ReturnSaleInvoice.show');


});
});
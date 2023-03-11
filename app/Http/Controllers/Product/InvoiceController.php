<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductPurchase;
use App\Models\ProductSale;

use App\Models\ProductStock;
use App\Models\PurchaseInvoice;
use App\Models\SaleInvoice;

use App\Models\Supplier;
use App\Models\Unit;




class InvoiceController extends Controller
{




    public function showPurchaseInvoice($id)
{
    $data['purchaseinvoice'] = PurchaseInvoice::where('invoice_code', $id)->get();
    $data['purchasedata'] = ProductPurchase::where('invoice_code', $id)->get();
    $data['productdata'] = Product::all();
    $data['supplierdata'] = Supplier::all();
    $data['unitdata'] = Unit::all();


    return view('admin.product.buy_invoice', $data);
}


public function showSaleInvoice($id)
{
    $data['saleinvoice'] = SaleInvoice::where('invoice_code', $id)->get();
    $data['saledata'] = ProductSale::where('invoice_code', $id)->get();
    $data['productdata'] = Product::all();
    $data['supplierdata'] = Supplier::all();
    $data['unitdata'] = Unit::all();


    return view('admin.product.sale_invoice', $data);
}





}

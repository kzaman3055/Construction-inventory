<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductPurchase;
use App\Models\Category;
use App\Models\ProductSale;
use App\Models\PurchaseInvoice;
use App\Models\SaleInvoice;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;


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

    public function ReturnSaleInvoice($id)
    {

        $data['invoiceid'] = $id;
        $data['categorydata'] = Category::all();


        $data['saleinvoice'] = SaleInvoice::where('invoice_code', $id)->get();
        $data['saledata'] = ProductSale::where('invoice_code', $id)->get();
        $data['productdata'] = Product::all();
        $data['supplierdata'] = Supplier::all();
        $data['unitdata'] = Unit::all();

        return view('admin.product.return_sale_invoice', $data);
    }


    public function ReturnUpdate(Request $request)
    {
        $input = $request->all();

        // iterate through each invoice code and product code combination
        foreach ($input['quantity'] as $invoiceCode => $productData) {
            foreach ($productData as $productCode => $quantity) {
                // retrieve the sale record for the given invoice and product code
                $sale = ProductSale::where('invoice_code', $invoiceCode)
                    ->where('product_code', $productCode)
                    ->firstOrFail();

                // validate the input quantity
                if (!is_numeric($quantity) || $quantity < 0) {
                    return redirect()->back()->with('error', 'Invalid quantity.');
                }

                // check if the updated quantity is less than or equal to the original quantity
                if ($quantity <= $sale->quantity) {
                    $sale->quantity = $quantity;
                    $sale->save();
                } else {
                    return redirect()->back()->with('error', 'Return quantity cannot be greater than the sold quantity.');
                }
            }
        }

        // redirect back to the previous page or to a success page
        return redirect()->back()->with('success', 'Quantity updated successfully.');
    }




}

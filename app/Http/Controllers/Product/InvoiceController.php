<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPurchase;
use App\Models\ProductSale;
use App\Models\ProductStock;
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
            $totalPrice = 0; // initialize total price for this invoice code
            foreach ($productData as $productCode => $quantity) {
                // retrieve the sale record for the given invoice and product code
                $sale = ProductSale::where('invoice_code', $invoiceCode)
                    ->where('product_code', $productCode)
                    ->firstOrFail();

                // validate the input quantity
                if (!is_numeric($quantity) || $quantity < 0) {
                    return redirect()->back()->with('error', 'Invalid quantity.');
                }

                // calculate the difference between original quantity and updated quantity
                $quantityDiff = $sale->quantity - $quantity;

                // update the ProductStock model with the difference
                $stock = ProductStock::where('product_code', $productCode)->firstOrFail();
                $stock->stock_quantity += $quantityDiff;
                $stock->save();

                // check if the updated quantity is less than or equal to the original quantity
                if ($quantity <= $sale->quantity) {
                    $sale->quantity = $quantity;
                    $sale->total = $quantity * $sale->price; // recalculate total based on the latest quantity and price
                    $sale->save();
                } else {
                    return redirect()->back()->with('error', 'Return quantity cannot be same or greater than the sold quantity.');
                }
                $totalPrice += $sale->total; // add this sale's total to the total price for this invoice code
            }
            // update the SaleInvoice model with the total price for this invoice code
            $invoice = SaleInvoice::where('invoice_code', $invoiceCode)->firstOrFail();
            $invoice->total_price = $totalPrice;
            $invoice->due = $totalPrice;
            $invoice->status = 1;

            $invoice->save();
        }

        // redirect back to the previous page or to a success page
        return redirect()->action('App\Http\Controllers\Product\InvoiceController@showSaleInvoice', ['id' => $invoiceCode])->with('success', 'Quantity updated successfully.');
    }

    public function ReturnProductUpdate($id)
    {
        $sale = ProductSale::select('invoice_code', 'product_code', 'quantity', 'total')->where('id', $id)->firstOrFail();

        // Retrieve the SaleInvoice model with the given invoice code
        $saleInvoice = SaleInvoice::where('invoice_code', $sale->invoice_code)->firstOrFail();

        // Subtract the total value from the total_price value
        $saleInvoice->total_price -= $sale->total;
        $saleInvoice->due = $saleInvoice->total_price;
        $saleInvoice->status = 1;
        // Save the updated SaleInvoice model
        $saleInvoice->save();

        // Retrieve the ProductStock model with the given product code
        $productStock = ProductStock::where('product_code', $sale->product_code)->firstOrFail();

        // Add the sale quantity to the stock quantity
        $productStock->stock_quantity += $sale->quantity;

        // Save the updated ProductStock model
        $productStock->save();
        $sale = ProductSale::find($id);
        $sale->delete();

        // Check if there are any remaining ProductSale records with the same invoice_code
        $count = ProductSale::where('invoice_code', $sale->invoice_code)->count();
        if ($count <= 0) {
            // Delete the corresponding SaleInvoice model if there are no remaining ProductSale records
            SaleInvoice::where('invoice_code', $sale->invoice_code)->delete();
        }

        return redirect()->back()->with('error', 'Data Deleted Successfully!');

    }

}

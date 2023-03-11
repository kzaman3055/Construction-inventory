<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Category;

use App\Models\ProductPurchase;
use App\Models\ProductSale;

use App\Models\ProductStock;
use App\Models\SaleInvoice;
use App\Models\PurchaseInvoice;


use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Support\Str;
use App\Models\Customer;



use Illuminate\Http\Request;

class ProductSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

   // $data['branddata'] = Brand::all();
   $data['customerdata'] = Customer::all();

   $data['unitdata'] = Unit::all();
   $data['supplierdata'] = Supplier::all();
   $data['purchasedata'] = ProductPurchase::all();
   $data['saledata'] = ProductSale::all();
   $data['saleinvoicedata'] = SaleInvoice::all();

   $data['purchaseinvoicedata'] = PurchaseInvoice::all();
   $data['categorydata'] = Category::all();
   $data['alldata'] = Product::all();
   return view('admin.product.view_sale', $data);




    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        $validateData = $request->validate([
            'customer_id' => 'required',
            'product_code.*' => 'required',
            'quantity.*' => 'required',
            'price.*' => 'required',
        ]);

        $totalsale = count($request->product_code);
        $total_price = 0;
        $invoice = 'INVS-' . date('Ymd') . '-' . strtoupper(Str::random(6));
        $notAvailableProducts = [];

        if ($totalsale != null) {
            for ($i = 0; $i < $totalsale; $i++) {
                $productCode = $request->product_code[$i];
                $quantity = $request->quantity[$i];
                $price = $request->price[$i];
                $total = $price * $quantity;

                // Check if product is available in stock
                $existingStock = ProductStock::where('product_code', $productCode)->first();
                if (!$existingStock || $existingStock->stock_quantity < $quantity) {
                    $notAvailableProducts[] = $productCode;
                    continue;
                }

                // Make the sale
                $data = new ProductSale();
                $data->invoice_code = $invoice;
                $data->customer_id = $request->customer_id;
                $data->product_code = $productCode;
                $data->quantity = $quantity;
                $data->price = $price;
                $data->total = $total;
                $total_price += $total;
                $data->save();

                // Update stock quantity
                $existingStock->stock_quantity -= $quantity;
                $existingStock->save();
            }

            // If there are any products that are not available, return with an error message
            if (count($notAvailableProducts) > 0) {
                $errorMessage = 'The following products are not available: ' . implode(', ', $notAvailableProducts);
                return redirect()->back()->with('error', 'Check Quantity First!');
            }

            // Make the invoice
            $invoiceData = new SaleInvoice();
            $invoiceData->invoice_code = $invoice;
            $invoiceData->total_price = $total_price;
            $invoiceData->customer_id = $request->customer_id;
            $invoiceData->pay = $request->pay;
            $invoiceData->due = $invoiceData->total_price - $invoiceData->pay;
            $invoiceData->status = ($invoiceData->due == 0) ? 1 : 0;
            $invoiceData->save();

            return redirect()->back()->with('message', 'Data added Successfully!');
        }
    }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

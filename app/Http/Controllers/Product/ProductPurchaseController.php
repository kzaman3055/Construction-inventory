<?php
namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductPurchase;
use App\Models\ProductStock;
use App\Models\PurchaseInvoice;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data['branddata'] = Brand::all();
        $data['unitdata'] = Unit::all();
        $data['supplierdata'] = Supplier::all();
        $data['purchasedata'] = ProductPurchase::all();
        $data['purchaseinvoicedata'] = PurchaseInvoice::all();
        $data['categorydata'] = Category::all();
        // $data['subcategorydata'] = SubCategory::all();
        $data['alldata'] = Product::all();
        return view('admin.product.view_stock', $data);
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
            'supplier_id' => 'required',
            'product_code' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);
        $totalpurchase = count($request->product_code);
        $total_price = 0;
        $invoice = 'INVP-' . date('Ymd') . '-' . strtoupper(Str::random(6));
        if ($totalpurchase != null) {
            for ($i = 0; $i < $totalpurchase; $i++) {
                $data = new ProductPurchase();
                $data->invoice_code = $invoice;
                $data->supplier_id = $request->supplier_id[$i];
                $data->product_code = $request->product_code[$i];
                $data->quantity = $request->quantity[$i];
                $data->price = $request->price[$i];
                $data->total = $request->price[$i] * $request->quantity[$i];
                $total_price += $request->price[$i] * $request->quantity[$i];
                $data->save();
                // Check if product_code already exists in PurchaseStock
                $existingPurchaseStock = ProductStock::where('product_code', $request->product_code[$i])->first();
                if ($existingPurchaseStock) {
                    // If product_code already exists, update stock_quantity by adding the new quantity
                    $existingPurchaseStock->stock_quantity += $request->quantity[$i];
                    $existingPurchaseStock->save();
                } else {
                    // If product_code does not exist, insert a new record
                    $newPurchaseStock = new ProductStock();
                    $newPurchaseStock->product_code = $request->product_code[$i];
                    $newPurchaseStock->stock_quantity = $request->quantity[$i];
                    $newPurchaseStock->save();
                }
            }
            $invoiceData = new PurchaseInvoice();
            $invoiceData->invoice_code = $invoice;
            $invoiceData->total_price = $total_price;
            $invoiceData->pay = $request->pay;
            $invoiceData->due = $invoiceData->total_price - $invoiceData->pay;
            if ($invoiceData->due == 0) {
                $invoiceData->status = 1;
            } else {
                $invoiceData->status = 0;
            }
            $invoiceData->save();
        }
        return redirect()->back()->with('message', 'Data added Successfully!');
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






    }
}

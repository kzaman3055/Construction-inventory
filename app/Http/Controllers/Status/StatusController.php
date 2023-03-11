<?php

namespace App\Http\Controllers\Status;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Shop;
use App\Models\Product;
use App\Models\PurchaseInvoice;
use App\Models\SaleInvoice;





use DB;
use Illuminate\Http\Request;

class StatusController extends Controller
{

    public function SupplierStatus(Request $request, $id)
    {

        $data['alldata'] = Supplier::all();

        DB::table('suppliers')->where('id', $id)->update(['status' => $request->status]);

        return redirect()->back()->with($data)->with('info','Status Changed Successfully');

    }

    public function CustomerStatus(Request $request, $id)
    {

        $data['alldata'] = Customer::all();

        DB::table('customers')->where('id', $id)->update(['status' => $request->status]);

        return redirect()->back()->with($data)->with('info','Status Changed Successfully');

    }
    public function ShopStatus(Request $request, $id)
    {

        $data['alldata'] = Shop::all();

        DB::table('shops')->where('id', $id)->update(['status' => $request->status]);

        return redirect()->back()->with($data)->with('info','Status Changed Successfully');

    }
    public function ProductStatus(Request $request, $id)
    {

        $data['alldata'] = Product::all();

        DB::table('products')->where('id', $id)->update(['status' => $request->status]);

        return redirect()->back()->with($data)->with('info','Status Changed Successfully');

    }



    public function PurchaseProductPayUpdate(Request $request, $id)
    {
        try {
            $purchase = PurchaseInvoice::findOrFail($id);

            $purchase->pay += $request->pay;
            $purchase->due -= $request->pay;

            $purchase->save();

            return redirect()->back()->with('info', 'Payment updated successfully');
        } catch (\Throwable $th) {
            // Log the error message
            error_log($th->getMessage());

            // Redirect back with error message
            return redirect()->back()->with('error', 'Failed to update payment');
        }



    }


    public function SaleProductPayUpdate(Request $request, $id)
    {
        try {
            $purchase = SaleInvoice::findOrFail($id);

            $purchase->pay += $request->pay;
            $purchase->due -= $request->pay;

            $purchase->save();

            return redirect()->back()->with('info', 'Payment updated successfully');
        } catch (\Throwable $th) {
            // Log the error message
            error_log($th->getMessage());

            // Redirect back with error message
            return redirect()->back()->with('error', 'Failed to update payment');
        }



    }



}

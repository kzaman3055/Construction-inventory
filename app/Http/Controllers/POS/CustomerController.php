<?php
namespace App\Http\Controllers\POS;
use App\Models\Product;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\DailyCost;
use App\Models\DailyCostCategory;
use App\Models\ProductSale;
use App\Models\Unit;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['alldailycostcategory'] = DailyCostCategory::all();

        $data['alldata'] = Customer::all();
        return view('admin.customer.view_customer', $data);
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
            'name' => 'required ',
            'email' => 'required ',
            'mobile' => 'required ',
            'address' => 'required ',

        ]);
        $data = new Customer();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->address = $request->address;

        $data->save();
        return redirect()->back()->with('message', 'Data added Successfully!');
    }

    public function dailycoststore(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'category_id' => 'required|array',
            'category_id.*' => 'required|integer',
            'amount' => 'required|array',
            'amount.*' => 'required|numeric',
        ]);

        $totalinput = count($request->category_id);

        if ($totalinput > 0) {
            for ($i = 0; $i < $totalinput; $i++) {
                $data = new DailyCost();
                $data->customer_id = $request->customer_id;
                $data->cost_category_id = $request->category_id[$i];
                $data->amount = $request->amount[$i];
                $data->save();
            }
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

        $data['alldata'] = Customer::all();
        $data['customerdata'] = Customer::find($id);
        $data['alldailycostcategory'] = DailyCostCategory::all();

        return view('admin.customer.view_customer', $data);

    }

    public function showdata($id)
    {

        $data['customerdata'] = Customer::find($id);
        $data['unitdata'] = Unit::all();


        $data['alldailycost'] = DailyCost::where('customer_id', $id)->get();

        $data['materialdata'] = ProductSale::where('customer_id', $id)->get();

        $todaydailycost = DailyCost::where('customer_id', $id)->whereDate('created_at', today())->sum('amount');
        $todaymaterialcost = ProductSale::where('customer_id', $id)->whereDate('created_at', today())->sum('total');

        $totaldailycost = DailyCost::where('customer_id', $id)->sum('amount');
        $totalmaterialcost = ProductSale::where('customer_id', $id)->sum('total');

        $data['productdata'] = Product::all();

        $data['categorydata'] = DailyCostCategory::all();

        return view('admin.customer.view_customer_data', $data)
        ->with('totaldailycost', $totaldailycost)
        ->with('totalmaterialcost', $totalmaterialcost)
        ->with('todaydailycost', $todaydailycost)
        ->with('todaymaterialcost', $todaymaterialcost);

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['alldata'] = Customer::all();
        $data['editdata'] = Customer::find($id);
        return view('admin.customer.view_customer', $data);
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
        $data = Customer::findOrFail($id);
        $input = $request->all();
        $action = $data->update($input);
        return redirect()->route('manage-customer.index')->with('info', 'Data updated successfully!');
    }

    public function AmountDetails($id, Request $request)
    {
        $customer = Customer::findOrFail($id);

        // Update the customer's square_feet, estimation, and advance_amount based on the request input
        $customer->square_feet = $request->input('square_feet');
        $customer->estimation = $request->input('estimation');
        $customer->advance_amount = $request->input('advance_amount');

        // Save the changes to the database
        $customer->save();

        // Redirect back to the customer details page
        return redirect()->route('manage-customer.index')->with('info', 'Data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Customer::findOrFail($id);
        $action = $data->delete();
        return redirect()->back()->with('error', 'Data Deleted Successfully!');
    }
}

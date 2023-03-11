<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['alldata'] = Supplier::all();
        return view('admin.supplier.view_supplier', $data);

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

        $data = new Supplier();

        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->address = $request->address;

        $data->save();

        return redirect()->back()->with('message','Data added Successfully!');

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

        $data['alldata'] = Supplier::all();
        $data['editdata'] = Supplier::find($id);

        return view('admin.supplier.view_supplier', $data);
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


        $data = Supplier::findOrFail($id);
        $input = $request->all();
        $action = $data->update($input);






        return redirect()->route('manage-supplier.index')->with('info','Data updated successfully!');




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $data = Supplier::findOrFail($id);
        $action = $data->delete();

        return redirect()->back()->with('error','Data Deleted Successfully!');



    }
}

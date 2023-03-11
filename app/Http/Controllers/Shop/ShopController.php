<?php

namespace App\Http\Controllers\Shop;
use App\Models\Shop;
use App\Models\Location;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['alldata'] = Shop::all();
        $locationdata['locationdata'] = Location::all();

        return view('admin.shop.view_shop', $data)->with($locationdata);

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
            'contact_person' => 'required ',
            'email' => 'required ',
            'mobile' => 'required ',
            'location' => 'required ',
            'address' => 'required ',
            'notes' => 'required ',
        ]);
        $data = new Shop();
        $data->name = $request->name;
        $data->contact_person = $request->contact_person;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->location = $request->location;
        $data->address = $request->address;
        $data->notes = $request->notes;

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


        $data['alldata'] = Shop::all();
        $data['editdata'] = Shop::find($id);

        $locationdata['locationdata'] = Location::all();
        return view('admin.shop.view_shop', $data)->with($locationdata);
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

        $data = Shop::findOrFail($id);
        $input = $request->all();
        $action = $data->update($input);
        return redirect()->route('manage-shop.index')->with('info','Data updated successfully!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $data = Shop::findOrFail($id);
        $action = $data->delete();
        return redirect()->back()->with('error','Data Deleted Successfully!');



    }
}

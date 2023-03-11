<?php

namespace App\Http\Controllers\Other;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['alldata'] = Location::all();
        return view('admin.other.view_location', $data);

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

        ]);

        $totallocation = count($request->name);
        if ($totallocation != null) {

            for ($i = 0; $i < $totallocation; $i++) {

                $data = new Location();
                $data->name = $request->name[$i];

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

dd($id);


        $data['alldata'] = Location::all();
        $data['editdata'] = Location::find($id);
        return view('admin.other.view_location', $data);

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

        $data = Location::findOrFail($id);
        $input = $request->all();
        $action = $data->update($input);
        return redirect()->route('manage-location.index')->with('info', 'Data updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $data = Location::findOrFail($id);
        $action = $data->delete();
        return redirect()->back()->with('error', 'Data Deleted Successfully!');

    }
}

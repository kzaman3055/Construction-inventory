<?php

namespace App\Http\Controllers\Other;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;


class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



        $data['alldata'] = Unit::all();
        return view('admin.other.view_unit', $data);
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
        $data = new Unit;
        $data->name = $request->name;

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



        $data['alldata'] = Unit::all();
        $data['editdata'] = Unit::find($id);
        return view('admin.other.view_unit', $data);




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


        $data = Unit::findOrFail($id);
        $input = $request->all();
        $action = $data->update($input);
        return redirect()->route('manage-unit.index')->with('info','Data updated successfully!');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $data = Unit::findOrFail($id);
        $action = $data->delete();
        return redirect()->back()->with('error','Data Deleted Successfully!');

    }
}

<?php

namespace App\Http\Controllers\Other;

use App\Http\Controllers\Controller;
use App\Models\DailyCostCategory;

use Illuminate\Http\Request;

class DailyCostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $data['alldata'] = DailyCostCategory::all();
        return view('admin.other.view_dailycostcategory', $data);


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

        $totalcategory = count($request->name);
        if ($totalcategory != null) {

            for ($i = 0; $i < $totalcategory; $i++) {

                $data = new DailyCostCategory();
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



        $data['alldata'] = DailyCostCategory::all();
        $data['editdata'] = DailyCostCategory::find($id);
        return view('admin.other.view_dailycostcategory', $data);

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




        $data = DailyCostCategory::findOrFail($id);
        $input = $request->all();
        $action = $data->update($input);
        return redirect()->route('manage-daily-cost-category.index')->with('info', 'Data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {



        $data = DailyCostCategory::findOrFail($id);
        $action = $data->delete();
        return redirect()->back()->with('error', 'Data Deleted Successfully!');




    }
}

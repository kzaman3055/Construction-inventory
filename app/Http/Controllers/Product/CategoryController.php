<?php

namespace App\Http\Controllers\Product;
use App\Models\Category;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $data['alldata'] = Category::all();
        return view('admin.product.view_category', $data);


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

                $data = new Category();
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['alldata'] = Category::all();
        $data['editdata'] = Category::find($id);
        return view('admin.product.view_category', $data);
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


        $data = Category::findOrFail($id);
        $input = $request->all();
        $action = $data->update($input);
        return redirect()->route('manage-category.index')->with('info', 'Data updated successfully!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $data = Category::findOrFail($id);
        $action = $data->delete();
        return redirect()->back()->with('error','Data Deleted Successfully!');

    }

    }



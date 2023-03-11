<?php
namespace App\Http\Controllers\Product;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['unitdata'] = Unit::all();
        $data['supplierdata'] = Supplier::all();
        $data['categorydata'] = Category::all();
        $data['alldata'] = Product::all();
        return view('admin.product.view_product', $data);
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
    // public function store(Request $request)
    // {
    //     dd($request);
    //     $validatedData = $request->validate([
    //         'name' => 'required',
    //         'brand_id' => 'required',
    //         'category_id' => 'required',
    //         'subcategory_id' => 'required',
    //         'suppliers_id' => 'required',
    //         'unit_id' => 'required',
    //         'description' => 'required',
    //         'price' => 'required',
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
    //     ]);
    //     $data = new Product();
    //     $data->name = $request->name;
    //     $prefix = strtoupper(substr($request->name, 0, 2)); // Get the first two letters of the product name and convert to uppercase
    //     $data->product_code = $prefix . '-' . Str::random(8); // Combine the prefix with a randomly generated string
    //     $data->brand_id = $request->brand_id;
    //     $data->category_id = $request->category_id;
    //     $data->subcategory_id = $request->subcategory_id;
    //     $data->suppliers_id = $request->suppliers_id;
    //     $data->unit_id = $request->unit_id;
    //     $data->description = $request->description;
    //     $data->price = $request->price;
    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         // get the current date and time
    //         $now = Carbon::now();
    //         // generate a unique filename
    //         $filename = $data->id . '_' . $data->name . '_' . $now->format('Y-m-d_H-i-s') . '.' . $image->getClientOriginalExtension();
    //         // store the image in the specified directory
    //         $path = $image->storeAs('public/product_images', $filename, 'public');
    //         $data->image = $path;
    //     }
    //     $data->save();
    //     return redirect()->back()->with('message', 'Data added successfully!');
    // }
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name.*' => 'required',
            'category_id.*' => 'required',
            'subcategory_id.*' => 'required',
            'suppliers_id.*' => 'required',
            'unit_id.*' => 'required',
            'description.*' => 'required',
            // 'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
        ]);
        // Loop through the input fields and create a new product for each
        $productcount = count($request->name);
            if ($productcount != null) {
                for ($i = 0; $i < $productcount; $i++) {
            $data = new Product();
            $data->name = $request->name[$i];
            $data->category_id = $request->category_id[$i];
            $data->suppliers_id = $request->suppliers_id[$i];
            $data->unit_id = $request->unit_id[$i];
            $data->description = $request->description[$i];
            $prefix = strtoupper(substr($request->name[$i], 0, 2)); // Get the first two letters of the product name and convert to uppercase
            $data->product_code = $prefix . '-' . Str::random(8); // Combine the prefix with a randomly generated string
            // if ($request->hasFile('image.'.$i)) {
            //     $image = $request->file('image.'.$i);
            //     // get the current date and time
            //     $now = Carbon::now();
            //     // generate a unique filename
            //     $filename = $data->product_code . '_' . $data->name . '_' . $now->format('Y-m-d_H-i-s') . '.' . $image->getClientOriginalExtension();
            //     // store the image in the specified directory
            //     $path = $image->storeAs('public/product_images', $filename, 'public');
            //     $data->image = $path;
            // }
            $data->save();
        }
        }
        return redirect()->back()->with('message', 'Data added successfully!');
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



        $data['unitdata'] = Unit::all();
        $data['supplierdata'] = Supplier::all();
        $data['categorydata'] = Category::all();
        $data['alldata'] = Product::all();




        $data['editdata'] = Product::find($id);
        return view('admin.product.view_product', $data);



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
        $data = Product::findOrFail($id);
        $input = $request->all();

        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $old_image = $data->image;

        //     if (Storage::disk('public')->exists($old_image)) {
        //         Storage::disk('public')->delete($old_image);
        //     }

        //     $now = Carbon::now();
        //     $filename = $data->product_coded . '_' . $data->name . '_' . $now->format('Y-m-d_H-i-s') . '.' . $image->getClientOriginalExtension();
        //     $path = $image->storeAs('public/product_images', $filename, 'public');
        //     $input['image'] = $path;
        // }

        $data->update($input);

        return redirect()->route('manage-product.index')->with('info', 'Data updated successfully!');
    }









    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Product::findOrFail($id);
        $filePath = 'public/' . $data->image;
        if (\Storage::exists($filePath)) {
            \Storage::delete($filePath);
        }
        $action = $data->delete();
        return redirect()->back()->with('error', 'Data Deleted Successfully!');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function getSubcategory($id)
    // {
    //     $data['Subcategorise'] = SubCategory::where('category_id', $id)->get();
    //     return response()->json($id);
    // }

    public function getCategories($brandId)
    {
        $categories = Category::where('brand_id', $brandId)->get();
        return response()->json($categories);
    }


    public function getSubcategories($categoryId)
    {
        $subcategories = Subcategory::where('category_id', $categoryId)->get();
        return response()->json($subcategories);
    }



}

@extends('admin.admin_master')
@section('admin')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="page-title">Manage Product</h3>
                        <div class="d-inline-block align-items-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><i class="mdi mdi-home-outline"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add & Manage Product</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main content -->
            <section class="content">
                <!-- tabs -->
                <div class="row">
                    <div class="col-12">
                        <div class="box box-default">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs customtab2" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#product_list"
                                            role="tab"><span class="hidden-sm-up"><i class="ion-home"></i></span> <span
                                                class="hidden-xs-down">All Material</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#add_product"
                                            role="tab"><span class="hidden-sm-up"><i class="ion-person"></i></span>
                                            <span class="hidden-xs-down">Add Material</span></a> </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <?php

                                    $btn = 'Store';
                                    ?>



                                    <div class="tab-pane active" id="product_list" role="tabpanel">
                                        <div class="col-xl-12">


                                            @if (!empty($editdata))
                                                <?php

                                                $btn = 'Update';

                                                ?>

                                                <div class="box-header with-border">
                                                    <h3 class="box-title">Update Material</h3>
                                                </div>
                                                <div class="box-body">
                                                    {{ Form::open(['route' => ['manage-product.update', $editdata->id], 'method' => 'PUT', 'files' => true]) }}

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Name</label>
                                                                <div class="controls">
                                                                    <input type="text" name="name"
                                                                        class="form-control"
                                                                        value="{{ !empty($editdata->name) ? $editdata->name : '' }}"
                                                                        required placeholder="Enter Name">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Category</label>
                                                                <select name="category_id" class="form-control select2"
                                                                    style="width: 100%;" ">
                                                                            <option value="" selected disabled>Select Category</option>
                                                                              @foreach ($categorydata as $category)
                                                                    <option value="{{ $category->id }}"
                                                                        {{ $category->id == $editdata->category_id ? 'selected' : '' }}>
                                                                        {{ $category->name }}</option>
                                            @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Supplier</label>
                                            <select name="suppliers_id" class="form-control select2" style="width: 100%;"
                                                required>
                                                <option value="" selected="selected" disabled="">Select Supplier
                                                </option>
                                                @foreach ($supplierdata as $key => $supplier)
                                                    @if ($supplier->status == 1)
                                                        <option value="{{ $supplier->id }}"
                                                            {{ $supplier->id == $editdata->suppliers_id ? 'selected' : '' }}>
                                                            {{ $supplier->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Unit</label>
                                            <select name="unit_id" class="form-control select2" style="width: 100%;"
                                                required>
                                                <option value="" selected="selected" disabled="">Select Unit
                                                </option>
                                                @foreach ($unitdata as $key => $unit)
                                                    <option value="{{ $unit->id }}"
                                                        {{ $unit->id == $editdata->unit_id ? 'selected' : '' }}>
                                                        {{ $unit->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        {{-- <div class="form-group">
                                                                <label>Select Image</label>
                                                                <div class="controls">
                                                                    <input type="file" name="image" class="form-control" id="image">
                                                                </div>
                                                                <label>Preview</label>
                                                                <div class="controls">
                                                                    @if ($editdata->image)
                                                                        <img id="showimage" src="{{ asset('storage/' . $editdata->image) }}" style="width: 100px; height: 100px; border: 1px solid #000000;">
                                                                    @else
                                                                        <img id="showimage" src="{{ asset('storage/public/no_image.jpg') }}" style="width: 100px; height: 100px; border: 1px solid #000000;">
                                                                    @endif
                                                                </div>
                                                            </div> --}}
                                    </div>

                                    <div class="col-md-6">








                                        <div class="form-group">
                                            <label>Description</label>
                                            <div class="controls">
                                                <textarea name="description" class="form-control" rows="5" required placeholder="Enter Description">{{ $editdata->description }}</textarea>
                                            </div>
                                        </div>










                                    </div>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-success pull-right">{{ $btn }}</button>
                                </div>

                                {!! Form::close() !!}
                            </div>
                            @endif



                            <div class="box-header with-border">
                                <h3 class="box-title">All Material List</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="table-responsive">
                                <table id="example"
                                    class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                    <thead>
                                        <tr>
                                            <th>SL#</th>
                                            {{-- <th>Image</th> --}}
                                            <th>Name</th>
                                            <th>Code</th>

                                            <th>Category</th>
                                            <th>Supplier</th>
                                            {{-- <th>Price</th> --}}
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($alldata as $key => $product)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                {{-- <td><img src="{{ asset('storage/' . $product->image) }}"
                                                                        alt="{{ $product->name }}" width="100"
                                                                        height="100"></td> --}}
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->product_code }}</td>


                                                @foreach ($categorydata as $category)
                                                    @if ($category->id == $product->category_id)
                                                        <td>{{ $category->name }}</td>
                                                    @endif
                                                @endforeach

                                                @foreach ($supplierdata as $supplier)
                                                    @if ($supplier->id == $product->suppliers_id)
                                                        <td>{{ $supplier->name }}</td>
                                                    @endif
                                                @endforeach
                                                <td>{{ $product->description }}</td>
                                                <td>
                                                    @if ($product->status == 1)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Deactive
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group mb-5">
                                                        <button type="button" class="btn-flat btn-light  dropdown-toggle"
                                                            data-toggle="dropdown"><i
                                                                class="fa  fa-wrench
                                                                        "></i></button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item"
                                                                href="{{ route('manage-product.edit', $product->id) }}"><i
                                                                    class="fa fa-pencil"></i> Edit</a>
                                                            <a class="dropdown-item" data-toggle="modal"
                                                                href="#editModal{{ $product->id }}"><i
                                                                    class="fa fa-check"></i>Status</a>
                                                            <form
                                                                action="{{ route('manage-product.destroy', $product->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a type="submit"
                                                                    class="dropdown-item show-alert-delete-box">
                                                                    <i title="Delete" class="fa fa-trash"></i>Delete
                                                                </a>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                                <!-- Status Modal -->
                                                <div class="modal fade"
                                                    id="editModal{{ $product->id }}"data-bs-backdrop="static"
                                                    data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"><i class="fa fa-edit"></i>
                                                                    Edit
                                                                    Status</h4>
                                                            </div>
                                                            {!! Form::open([
                                                                'route' => ['productstatus.update', $product->id],
                                                                'enctype' => 'multipart/form-data',
                                                                'method' => 'POST',
                                                            ]) !!}
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="input-group">
                                                                            <label class="col-3 col-form-label">
                                                                                Status </label>
                                                                            <select name="status" class="form-select">
                                                                                <option value="" selected=""
                                                                                    disabled="">
                                                                                    Select Status
                                                                                </option>
                                                                                <option value="1"
                                                                                    {{ $product->status == '1' ? 'selected' : '' }}>
                                                                                    Available</option>
                                                                                <option value="0"
                                                                                    {{ $product->status == '0' ? 'selected' : '' }}>
                                                                                    Not Available</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer pull-right">
                                                                <button type="button" class="btn btn-danger"
                                                                    data-dismiss="modal">Close</button>
                                                                {{ Form::submit('Update', ['class' => 'btn btn-success']) }}
                                                            </div>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- /.box-body -->
                                <!-- /.box -->
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="add_product" role="tabpanel">
                        <div class="row">
                            <div class="col-xl-12">

                                <div class="box-header with-border">
                                    <h4 class="box-title">Add Material</h4>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    {!! Form::open(['route' => ['manage-product.store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                    <div class="row" id="product-fields">
                                        <div class="product-field col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Supplier <span class="text-danger">*</span></label>
                                                        <select name="suppliers_id[]" class="form-control select2"
                                                            style="width: 100%;" required>
                                                            <option value="" selected="selected" disabled="">
                                                                Select Supplier</option>
                                                            @foreach ($supplierdata as $key => $supplier)
                                                                @if ($supplier->status == 1)
                                                                    <option value="{{ $supplier->id }}">
                                                                        {{ $supplier->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Name <span class="text-danger">*</span></label>
                                                        <div class="controls">
                                                            <input type="text" name="name[]" class="form-control"
                                                                value="" required placeholder="Enter Product Name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Category <span class="text-danger">*</span></label>
                                                        <select name="category_id[]"
                                                            class="form-control category-select select2"
                                                            style="width: 100%;" required>
                                                            <option value="" selected="selected" disabled="">
                                                                Select Category</option>
                                                            @foreach ($categorydata as $key => $category)
                                                                <option value="{{ $category->id }}">
                                                                    {{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>



                                                    <div class="form-group">
                                                        <label>Unit <span class="text-danger">*</span></label>
                                                        <select name="unit_id[]" class="form-control select2"
                                                            style="width: 100%;" required>
                                                            <option value="" selected="selected" disabled="">
                                                                Select Unit</option>
                                                            @foreach ($unitdata as $key => $unit)
                                                                <option value="{{ $unit->id }}">
                                                                    {{ $unit->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>


                                                    {{-- <div class="form-group">
                                                                        <label>Select Image</label>
                                                                        <div class="controls">
                                                                            <input type="file" name="image[]"
                                                                                class="form-control" value=""
                                                                                id="image" required
                                                                                placeholder="Enter Product Type">
                                                                        </div>
                                                                        <label>preview</label>
                                                                        <div class="controls">
                                                                            <img id="showimage"
                                                                                src="/storage/public/no_image.jpg"
                                                                                style="width: 100px; width: 100px; border: 1px solid #000000;">
                                                                        </div>
                                                                    </div>







                                                                    <div class="form-group">
                                                                        <label>Select Image</label>
                                                                        <div class="controls">
                                                                            <input type="file" name="image[]"
                                                                                class="form-control" value=""
                                                                                id="image" required
                                                                                placeholder="Enter Product Type">
                                                                        </div>
                                                                        <label>preview</label>
                                                                        <div class="controls">
                                                                            <img id="showimage"
                                                                                src="/storage/public/no_image.jpg"
                                                                                style="width: 100px; width: 100px; border: 1px solid #000000;">
                                                                        </div>
                                                                    </div> --}}











                                                </div>
                                                <div class="col-md-6">





                                                    <div class="form-group">
                                                        <label>Description <span class="text-danger">*</span></label>
                                                        <div class="controls">
                                                            <textarea name="description[]" class="form-control" rows="5" required placeholder="Enter Product Name"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="border: 4px solid transparent;"></div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="pull-right">
                                                <button type="button" id="add-product" class="btn btn-success"><i
                                                        class="fa fa-plus-circle "></i> Add more</button>
                                                <button type="submit"
                                                    class="btn btn-primary">{{ $btn }}</button>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        $(document).ready(function() {
                                            // Add product field
                                            $('#add-product').click(function() {
                                                var html = `


                                                                    <div class = "product-field col-md-12">
                                                                        <h4 class="box-title">Add more Product</h4>

    <div class="row">
                                                                    <div class="col-md-6 ">


                                                                        <div class="form-group">
                                                                        <label>Supplier <span class="text-danger">*</span></label>
                                                                        <select name="suppliers_id[]"
                                                                            class="form-control supplier-select" style="width: 100%;"
                                                                            required>
                                                                            <option value="" selected="selected"
                                                                                disabled="">Select Supplier</option>
                                                                            @foreach ($supplierdata as $key => $supplier)
                                                                                @if ($supplier->status == 1)
                                                                                    <option value="{{ $supplier->id }}">
                                                                                        {{ $supplier->name }}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                              <div class="form-group">
                                                                <label>Name <span class="text-danger">*</span></label>
                                                                <div class="controls">
                                                                  <input type="text" name="name[]" class="form-control" value="" required placeholder="Enter Product Name">
                                                                </div>
                                                              </div>
                                                              <div class="form-group">
                                                                <label>Category <span class="text-danger">*</span></label>
                                                                <select name="category_id[]" class="form-control category-select" required>
                                                                  <option value="" selected="selected" disabled="">Select Category</option>
                                                                  @foreach ($categorydata as $key => $category)
                                                                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                                  @endforeach
                                                                </select>
                                                              </div>










                                                                    <div class="form-group">
                                                                        <label>Unit <span class="text-danger">*</span></label>
                                                                        <select name="unit_id[]" class="form-control unit-select"
                                                                            style="width: 100%;" required>
                                                                            <option value="" selected="selected"
                                                                                disabled="">Select Unit</option>
                                                                            @foreach ($unitdata as $key => $unit)
                                                                                <option value="{{ $unit->id }}">
                                                                                    {{ $unit->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>




                                                              <div style="border: 4px solid transparent;"></div>
                                                            </div>
<div class="col-md-6">













                                                                <div class="form-group">
                            <label>Description <span class="text-danger">*</span></label>
                            <div class="controls">
                                <textarea name="description[]" class="form-control" rows="5" required placeholder="Enter Product Name"></textarea>
                            </div>
                        </div>
                                                              <div class="pull-right">
                                                                <button type="button" class="remove-product btn btn-danger"><i class="fa fa-minus-circle "></i> Remove</button>
                                                        </div>
</div>
    </div>
</div>
 `;









                                                $('#product-fields').append(html);


                                                // Initialize select2 for new dropdowns
                                                $('.category-select').select2();
                                                $('.supplier-select ').select2();
                                                $('.unit-select ').select2();


                                            });
                                            // Remove product field
                                            $(document).on('click', '.remove-product', function() {
                                                $(this).closest('.product-field').remove();
                                            });


                                        });
                                    </script>
                                    {!! Form::close() !!}
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                    </div>





                </div>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- END tabs -->
    </section>
    <!-- /.content -->
    </div>
    </div>
    </div>


    {{-- show image --}}
    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $(document).on("change", "#image", function() {



                var input = this;
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(input).closest(".form-group").find("#showimage").attr("src", e.target.result);
                }
                if (input.files[0]) {
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $(input).closest(".form-group").find("#showimage").attr("src",
                        "/public/storage/public/no_image.jpg");
                }
            });
        });
    </script> --}}






@endsection

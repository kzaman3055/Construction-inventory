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
                                                class="hidden-xs-down">All Product</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#add_product"
                                            role="tab"><span class="hidden-sm-up"><i class="ion-person"></i></span>
                                            <span class="hidden-xs-down">Add Product</span></a> </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane " id="product_list" role="tabpanel">
                                        <div class="col-xl-12">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">All Product List</h3>
                                                <h6 class="box-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="table-responsive">
                                                <table id="example"
                                                    class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                                    <thead>
                                                        <tr>
                                                            <th>SL#</th>
                                                            <th>Name</th>
                                                            <th>Image</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($alldata as $key => $product)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>{{ $product->name }}</td>
                                                                <td><img src="{{ asset('storage/' . $product->image) }}"
                                                                        alt="{{ $product->name }}" width="100"
                                                                        height="100"></td>
                                                                </td>
                                                                <td>
                                                                    <div class="btn-group mb-5">
                                                                        <button type="button"
                                                                            class="btn-flat btn-light  dropdown-toggle"
                                                                            data-toggle="dropdown"><i
                                                                                class="fa  fa-wrench
                                                                        "></i></button>
                                                                        <div class="dropdown-menu">
                                                                            <a class="dropdown-item"
                                                                                href="{{ route('manage-product.edit', $product->id) }}"><i
                                                                                    class="fa fa-pencil"></i> Edit</a>
                                                                            <form
                                                                                action="{{ route('manage-product.destroy', $product->id) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <a type="submit"
                                                                                    class="dropdown-item show-alert-delete-box">
                                                                                    <i title="Delete"
                                                                                        class="fa fa-trash"></i>Delete
                                                                                </a>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <!-- /.box-body -->
                                                <!-- /.box -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane active" id="add_product" role="tabpanel">
                                        <div class="add_item">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <?php

                                                    $btn = 'Add';

                                                    ?>
                                                    <div class="box-header with-border">

                                                        <h4 class="box-title">Add Product</h4>

                                                    </div>
                                                    <!-- /.box-header -->
                                                    <div class="box-body">
                                                        {!! Form::open(['route' => ['manage-product.store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                                        <div class="add_item">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Name</label>
                                                                        <div class="controls">
                                                                            <input type="text" name="name[]"
                                                                                class="form-control" value="" required
                                                                                placeholder="Enter Product Name">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Brand</label>
                                                                        <select name="brand[]" class="form-control select2"
                                                                            style="width: 100%;">
                                                                            <option value="" selected="selected"
                                                                                disabled="">Select Brand
                                                                            </option>
                                                                            @foreach ($branddata as $key => $brand)
                                                                                <option value="{{ $brand->name }}">
                                                                                    {{ $brand->name }}</option>
                                                                            @endforeach

                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Category</label>
                                                                        <select name="category_id[]" id="category"
                                                                            class="form-control select2"
                                                                            style="width: 100%;">
                                                                            <option value="" selected="selected"
                                                                                disabled="">Select Category</option>
                                                                            @foreach ($categorydata as $key => $category)
                                                                                <option value="{{ $category->id }}">
                                                                                    {{ $category->name }}</option>
                                                                            @endforeach

                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Subcategory</label>
                                                                        <select name="subcategory_id[]" id="subcategory"
                                                                            class="form-control select2"
                                                                            style="width: 100%;">
                                                                            <option value="" selected="selected"
                                                                                disabled="">Select Category for
                                                                                Subcategory</option>
                                                                        </select>
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
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-6">

                                                                    <div class="form-group">
                                                                        <label>Supplier</label>
                                                                        <div class="controls">
                                                                            <input type="text" name="supplier_id[]"
                                                                                class="form-control" value=""
                                                                                required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Unite</label>
                                                                        <div class="controls">
                                                                            <input type="text" name="unit_id[]"
                                                                                class="form-control" value=""
                                                                                required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Quantity</label>
                                                                        <div class="controls">
                                                                            <input type="text" name="quantity[]"
                                                                                class="form-control" value=""
                                                                                required placeholder="Enter Product Name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Price</label>
                                                                        <div class="controls">
                                                                            <input type="text" name="price[]"
                                                                                class="form-control" value=""
                                                                                required placeholder="Enter Product Name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Description</label>
                                                                        <div class="controls">
                                                                            <textarea name="description[]" class="form-control" rows="5" required placeholder="Enter Product Name"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="pull-right">
                                                                        <span class="btn btn-success addeventmore">
                                                                            <i class="fa fa-plus-circle"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div style="border: 4px solid transparent;"></div>
                                                        <div class="pull-right">
                                                            <button type="submit"
                                                                class="btn btn-success">{{ $btn }}</button>
                                                        </div>

                                                        {!! Form::close() !!}
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
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
    <div style="visibility: hidden;">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                <h4 class="box-title">Add another Product</h4>

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name</label>
                            <div class="controls">
                                <input type="text" name="name[]" class="form-control" value="" required
                                    placeholder="Enter Product Name">
                            </div>
                        </div>


                        <div class="form-group">
                            <label>Brand</label>
                            <div class="controls">
                                <input type="text" name="brand_id[]" class="form-control" value="" required>
                            </div>
                        </div>
                         <div class="form-group">
                                    <label>Category</label>
                                    <select name="category_id[]" id="category" class="form-control select2" style="width: 100%;">
                                        <option value="" selected="selected" disabled="">Select Category</option>
                                        @foreach ($categorydata as $key => $category)
                                        <option value="{{ $category->id }}"> {{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Subcategory</label>
                                    <select name="subcategory[]" id="subcategory" class="form-control select2" style="width: 100%;">
                                        <option value="" selected="selected" disabled="">Select Category for Subcategory</option>
                                    </select>
                                </div>


                        <div class="form-group">
                            <label>Select Image</label>
                            <div class="controls">
                                <input type="file" name="image[]" class="form-control" value="" id="image"
                                    required placeholder="Enter Product Type">
                            </div>
                            <label>preview</label>
                            <div class="controls">
                                <img id="showimage" src="/storage/public/no_image.jpg"
                                    style="width: 100px; width: 100px; border: 1px solid #000000;">
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label>Supplier</label>
                            <div class="controls">
                                <input type="text" name="supplier_id[]" class="form-control" value="" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Unite</label>
                            <div class="controls">
                                <input type="text" name="unit_id[]" class="form-control" value="" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <div class="controls">
                                <input type="text" name="quantity[]" class="form-control" value="" required
                                    placeholder="Enter Product Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <div class="controls">
                                <input type="text" name="price[]" class="form-control" value="" required
                                    placeholder="Enter Product Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <div class="controls">
                                <textarea name="description[]" class="form-control" rows="5" required placeholder="Enter Product Name"></textarea>
                            </div>
                        </div>
                        <div class="text-right" style="padding-top: 22px;">
                            <span class="btn btn-success addeventmore"><i class=" fa fa-plus-circle "></i> </span>
                            <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle "></i> </span>
                        </div>
                    </div>
                </div>
                <!-- End col-md-5 -->
            </div>
        </div>
    </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            var counter = 0;
            $(document).on("click", ".addeventmore", function() {
                var whole_extra_item_add = $('#whole_extra_item_add').html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click", '.removeeventmore', function(event) {
                $(this).closest(".delete_whole_extra_item_add").remove();
                counter -= 1
            });
        });
    </script>



    <script type="text/javascript">
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
    </script>


    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('#category').on('change', function(event) {
                event.preventDefault(); // prevent default action

                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: '/subcategories/' + category_id,
                        dataType: 'json',
                        success: function(data) {
                            $('#subcategory').empty();
                            $.each(data, function(key, value) {
                                $('#subcategory').append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#subcategory').empty();
                }
            });
        });
    </script> --}}



    <script type="text/javascript">
        $(document).ready(function() {
            $('#category').on('change', function(event) {
                event.preventDefault(); // prevent default action

                var category_id = $(this).val();
                if (category_id) {
                    $.get('/subcategories/' + category_id, function(data) {
                        $('#subcategory').empty();
                        data.forEach(function(subcategory) {
                            $('#subcategory').append('<option value="' + subcategory.id +
                                '">' + subcategory.name + '</option>');
                        });
                    }, 'json');
                } else {
                    $('#subcategory').empty();
                }
            });
        });
    </script>


@endsection

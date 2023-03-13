@extends('admin.admin_master')
@section('admin')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="page-title">Return Material</h3>
                        <div class="d-inline-block align-items-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><i class="mdi mdi-home-outline"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Manage Return Material</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main content -->
            <section class="content">
                <div class="row">





                    <div class="col-12">

                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Return For ID# {{ $invoiceid }} </h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <form method="POST" action="{{ route('return.update') }}">
                                        @csrf
                                        <table id="return_inv" class="display table table-bordered table-separated"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>

                                                    <th>Name</th>
                                                    <th>Category</th>

                                                    <th>Quantity</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>


                                                @foreach ($saledata as $key => $sale)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>


                                                        @foreach ($productdata as $product)
                                                            @if ($product->product_code == $sale->product_code)
                                                                <td>{{ $product->name }} </td>
                                                            @endif
                                                        @endforeach



                                                        @foreach ($categorydata as $category)
                                                            @foreach ($productdata as $product)
                                                                @if ($product->product_code == $sale->product_code && $product->category_id == $category->id)
                                                                    <td>
                                                                        {{ $category->name }}
                                                                    </td>
                                                                @endif
                                                            @endforeach
                                                        @endforeach



                                                        @foreach ($unitdata as $unit)
                                                            @foreach ($productdata as $product)
                                                                @if ($product->product_code == $sale->product_code && $product->unit_id == $unit->id)
                                                                    <td>
                                                                        <input type="text"
                                                                            name="quantity[{{ $sale->invoice_code }}][{{ $sale->product_code }}]"
                                                                            value="{{ !empty($sale->quantity) ? $sale->quantity : '' }}">
                                                                        {{ $unit->name }}
                                                                    </td>
                                                                @endif
                                                            @endforeach
                                                        @endforeach


                                                        <td>
                                                            <div class="btn-group mb-5">
                                                                <button type="button"
                                                                    class="btn-flat btn-light  dropdown-toggle"
                                                                    data-toggle="dropdown"><i
                                                                        class="fa  fa-wrench
                                                            "></i></button>



                                                                <div class="dropdown-menu">

                                                                    <a class="dropdown-item" href=""><i
                                                                            class="fa fa-pencil"></i> Edit</a>

                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach





                                            </tbody>

                                        </table>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
























                </div>
            </section>
            <!-- /.content -->
        </div>
    </div>
@endsection

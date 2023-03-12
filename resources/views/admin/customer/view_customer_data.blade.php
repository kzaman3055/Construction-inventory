@extends('admin.admin_master')
@section('admin')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="page-title">Project Data</h3>
                        <div class="d-inline-block align-items-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><i class="mdi mdi-home-outline"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Project Data</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main content -->
            <section class="content">

                <!--With table!-->
                <div class="col-md-6 col-xl-6 col-6">




                    <div class="box">
                        <div class="box-header with-border">
                            <div class="row">
                                <div class="col-md-6">





                                    <h4 class="box-title">Data of <strong style="color: blue"> {{ $customerdata->name }}
                                        </strong></h4>
                                </div>
                                <div class="col-md-6 text-right">
                                    <div class="dropdown">
                                        <a data-toggle="dropdown" href="#"><i
                                                class="ti-more-alt rotate-90 text-black"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-picture-o"></i>
                                                Shots</a>
                                            <a class="dropdown-item" href="#"><i class="ti-check"></i> Follow</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#"><i class="fa fa-ban"></i> Block</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-body box-profile">

                            <div class="row">
                                <div class="col-xl-6">
                                    <div>
                                        <p>Project Name :<span style="color: black"
                                                class="text-gray pl-10">{{ $customerdata->name }}</span> </p>
                                        <p>Squre Feet :<span style="color: black"
                                                class="text-gray pl-10">{{ $customerdata->square_feet }}</span></p>
                                        <p>Estimated Amount: <span style="color: black"
                                                class="text-gray pl-10">{{ number_format($customerdata->estimation) }}
                                                &#2547;</span></p>

                                        <p>Advance Amount :<span style="color: black"
                                                class="text-gray pl-10">{{ number_format($customerdata->advance_amount) }}
                                                &#2547;
                                            </span></p>
                                        <p>Total Daily cost of {{ date('d F Y') }}
                                            :<span style="color: black"
                                                class="text-gray pl-10">{{ number_format($todaydailycost) }} &#2547;
                                            </span></p>
                                        <p>Total Material cost of {{ date('d F Y') }}
                                            :<span style="color: black"
                                                class="text-gray pl-10">{{ number_format($todaymaterialcost) }} &#2547;
                                            </span></p>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div>

                                        <p>Total Daily Cost: <span style="color: black"
                                                class="text-gray pl-10">{{ number_format($totaldailycost) }} &#2547;</span>
                                        </p>
                                        <p>Total Material Cost :<span style="color: black"
                                                class="text-gray pl-10">{{ number_format($totalmaterialcost) }}
                                                &#2547;</span></p>

                                        <p>Total Cost :<span style="color: black"
                                                class="text-gray pl-10">{{ number_format($totaldailycost + $totalmaterialcost) }}
                                                &#2547;
                                            </span></p>
                                        <p>Rest Estimated Amount :<span style="color: black"
                                                class="text-gray pl-10">{{ number_format($customerdata->estimation - ($totaldailycost + $totalmaterialcost)) }}
                                                &#2547;
                                            </span></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>



                <div class="col-12">
                    <div class="box box-default">

                        <!-- /.box-header -->
                        <div class="box-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs customtab2" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tab1"
                                        role="tab"><span class="hidden-sm-up"><i class="ion-home"></i></span> <span
                                            class="hidden-xs-down">Daily Cost</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab2"
                                        role="tab"><span class="hidden-sm-up"><i class="ion-person"></i></span> <span
                                            class="hidden-xs-down">Material Cost</span></a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1" role="tabpanel">
                                    <div class="col-12">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Daily Cost List</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="table-responsive">
                                            <table id="example"
                                                class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                                <thead>
                                                    <tr>
                                                        <th>SL#</th>

                                                        <th>Category</th>
                                                        <th>Amount</th>
                                                        <th>Date</th>


                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($alldailycost as $key => $dailycost)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>



                                                            @foreach ($categorydata as $category)
                                                                @if ($category->id == $dailycost->cost_category_id)
                                                                    <td>{{ $category->name }}</td>
                                                                @endif
                                                            @endforeach

                                                            <td>{{ number_format($dailycost->amount) }} &#2547;</td>
                                                            <td>{{ $dailycost->created_at->format('d F Y') }}</td>




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

                                                                        <form action="" method="POST">
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
                                <div class="tab-pane" id="tab2" role="tabpanel">
                                    <div class="col-12">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Material Cost List</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="table-responsive">
                                            <table id="example6"
                                                class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                                <thead>
                                                    <tr>
                                                        <th>SL#</th>

                                                        <th>Name</th>
                                                        <th>Quantity</th>
                                                        <th>Amount</th>
                                                        <th>Date</th>


                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($materialdata as $key => $materiacost)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>



                                                            @foreach ($productdata as $product)
                                                                @if ($product->product_code == $materiacost->product_code)
                                                                    <td>{{ $product->name }}</td>
                                                                @endif
                                                            @endforeach



                                                            @foreach ($unitdata as $unit)
                                                                @foreach ($productdata as $product)
                                                                    @if ($product->product_code == $materiacost->product_code && $product->unit_id == $unit->id)
                                                                        <td> {{ $materiacost->quantity }}
                                                                            {{ $unit->name }}
                                                                        </td>
                                                                    @endif
                                                                @endforeach
                                                            @endforeach
                                                            <td>{{ number_format($materiacost->total) }} &#2547;</td>

                                                            <td>{{ $materiacost->created_at->format('d F Y') }}</td>




                                                            <td>
                                                                <div class="btn-group mb-5">
                                                                    <button type="button"
                                                                        class="btn-flat btn-light  dropdown-toggle"
                                                                        data-toggle="dropdown"><i
                                                                            class="fa  fa-wrench
                                                            "></i></button>
                                                                    <div class="dropdown-menu">
                                                                      
                                                                                <a class="dropdown-item"
                                                                                href="{{ route('sale-invoice.show', ['id' => $materiacost->invoice_code]) }}"><i
                                                                                    class="fa fa-file-text-o
                                                                                "></i>Show
                                                                                Invoice</a>

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

                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>










        </div>

    </div>
    </section>
    <!-- /.content -->
    </div>
    </div>
@endsection

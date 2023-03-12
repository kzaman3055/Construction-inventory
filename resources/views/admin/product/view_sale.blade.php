@extends('admin.admin_master')
@section('admin')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="page-title">Manage Stock</h3>
                        <div class="d-inline-block align-items-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><i class="mdi mdi-home-outline"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add & Manage Stock</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main content -->
            <section class="content">
                <?php
                $btn = 'Store';
                ?>
                <!-- tabs -->
                <div class="row">
                    <div class="col-12">
                        <div class="box box-default">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs customtab2" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#manage_sale"
                                            role="tab"><span class="hidden-sm-up"><i class="ion-person"></i></span>
                                            <span class="hidden-xs-down">New Transfer</span></a>
                                    </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#sle_list"
                                            role="tab"><span class="hidden-sm-up"><i class="ion-person"></i></span>
                                            <span class="hidden-xs-down">Transfer List</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#sale_Invoice_list"
                                            role="tab"><span class="hidden-sm-up"><i class="ion-person"></i></span>
                                            <span class="hidden-xs-down">Transfer Invoice List</span></a> </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="manage_sale" role="tabpane1">
                                        <div class="col-xl-12">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">Transfer Product</h4>
                                                <a type="submit" href="{{ URL::to('manage-customer') }}"
                                                    class="btn btn-primary pull-right"style="margin-right: 10px;">Add
                                                    Customer</a>
                                            </div>
                                            <!-- /.box-header -->

                                            <div class="box-body">
                                                {!! Form::open([
                                                    'route' => ['manage-product-sale.store'],
                                                    'method' => 'POST',
                                                    'enctype' => 'multipart/form-data',
                                                ]) !!}
                                                <div class="row" id="product-fields">
                                                    <div class="product-field col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Customer/Project</label>
                                                                    <select name="customer_id"
                                                                        class="form-control customer-select select2"
                                                                        style="width: 100%;" required>
                                                                        <option value="" selected="selected"
                                                                            disabled="">Select Customer/Project</option>
                                                                        @foreach ($customerdata as $key => $customer)
                                                                            <option value="{{ $customer->id }}">
                                                                                {{ $customer->name }} Mobile:
                                                                                {{ $customer->mobile }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Product</label>
                                                                    <select name="product_code[]"
                                                                        class="form-control supplier-select select2"
                                                                        style="width: 100%;" required>
                                                                        <option value="" selected="selected"
                                                                            disabled="">Select Product</option>
                                                                        @foreach ($alldata as $key => $product)
                                                                            @php
                                                                                $stockQuantity = App\Models\ProductStock::where('product_code', $product->product_code)->first()->stock_quantity ?? 0;
                                                                            @endphp
                                                                            @if ($stockQuantity > 0)
                                                                                <option
                                                                                    value="{{ $product->product_code }}">
                                                                                    {{ $product->name }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Quantity</label>
                                                                    <div class="controls">
                                                                        <input type="number" name="quantity[]"
                                                                            class="form-control" value="" required
                                                                            placeholder="Enter Product Quantity"
                                                                            min="1">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Price</label>
                                                                    <div class="controls">
                                                                        <input type="number" name="price[]"
                                                                            class="form-control" value="" required
                                                                            placeholder="Enter Product Price"
                                                                            min="1">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="controls">
                                                                        <input type="hidden" name="total[]"
                                                                            class="form-control" value=""
                                                                            placeholder="Enter Product Name">
                                                                    </div>
                                                                </div>
                                                                <div class="bb-1 border-info"></div>
                                                                <br>
                                                                <div
                                                                    style="display: flex; justify-content: flex-end;  font-size: 1.2em;">
                                                                    <b>Total: </b> <span id="total-price"></span> &#2547;
                                                                </div>
                                                                <br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="border: 4px solid transparent;"></div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div
                                                            style="display: flex; justify-content: flex-end; font-size: 1.2em;">
                                                            <b>Grand Total: </b><span id="grand_total-price"></span>&#2547;
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="pull-right">
                                                                <div class="form-group">
                                                                    <label>Pay Amount</label>
                                                                    <div class="controls">
                                                                        <input type="number" name="pay"
                                                                            class="form-control" value="" required
                                                                            placeholder="Enter Amount" min="1">
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    style="display: flex; justify-content: flex-end; color: red; font-size: 1.2em;">
                                                                    <b>Payment Due: </b> <span id="payment-due"></span>
                                                                    &#2547;
                                                                </div>
                                                                <br>
                                                                <button type="button" id="add-product"
                                                                    class="btn btn-success"><i
                                                                        class="fa fa-plus-circle "></i>
                                                                    Add more</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">{{ $btn }}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <script>
                                                        $(document).ready(function() {
                                                            $(document).on('change', 'input[name="quantity[]"], input[name="price[]"]',
                                                                function() {
                                                                    var productField = $(this).closest('.product-field');
                                                                    var quantity = parseInt(productField.find('input[name="quantity[]"]').val()) || 0;
                                                                    var price = parseFloat(productField.find('input[name="price[]"]').val()) || 0;
                                                                    var total = quantity * price;
                                                                    productField.find('input[name="total_in[]"]').val(total);
                                                                    productField.find('#total-price').text(total);
                                                                });
                                                            // Add product field
                                                            $('#add-product').click(function() {
                                                                var html = `
                                                <div class = "product-field col-md-12">
                                                <div class="row">
                                                <div class="col-md-6 ">
                                                                <div class="form-group">
                                                                    <label>Product</label>
                                                                    <select name="product_code[]" class="form-control product-select select2" style="width: 100%;" required>
                                                                        <option value="" selected="selected" disabled="">Select Product</option>
                                                                        @foreach ($alldata as $key => $product)
                                                                            @php
                                                                                $stockQuantity = App\Models\ProductStock::where('product_code', $product->product_code)->first()->stock_quantity ?? 0;
                                                                            @endphp
                                                                            @if ($stockQuantity > 0)
                                                                                <option value="{{ $product->product_code }}">
                                                                                    {{ $product->name }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                <div style="border: 4px solid transparent;"></div>
                                                </div>
                                                <div class="col-md-6">
                                                         <div class="form-group">
                                                            <label>Quantity</label>
                                                            <div class="controls">
                                                              <input type="number" name="quantity[]" class="form-control" value="" required placeholder="Enter Product Quantity" min="1">
                                                            </div>
                                                          </div>





                                                          <div class="form-group">
                                                            <label>Price</label>
                                                            <div class="controls">
                                                              <input type="number" name="price[]" class="form-control" value="" required placeholder="Enter Unit Price" min="1">
                                                            </div>
                                                          </div>
                                                          <div class="form-group">
                                                            <div class="controls">
                                                              <input type="hidden" name="total_in[]" class="form-control" value=""  >
                                                            </div>
                                                          </div>
                                                          <div class="bb-1 border-info"></div>
                                                         <br>
                                                         <div style="display: flex; justify-content: flex-end;  font-size: 1.2em;"><b>Total: </b> <span id="total-price"></span> &#2547;</div>
                                                        <br>



                                                <div class="pull-right">
                                                <button type="button" class="remove-product btn btn-danger"><i class="fa fa-minus-circle "></i> Remove</button>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                                                `;








                                                                $('#product-fields').append(html);
                                                                // Initialize select2 for new dropdowns customer-select
                                                                $('.product-select ').select2();
                                                            });
                                                            // Remove product field
                                                            $(document).on('click', '.remove-product', function() {
                                                                $(this).closest('.product-field').remove();
                                                            });
                                                            // Populate product dropdown based on selected supplier
                                                            // $(document).on('change', '.supplier-select', function() {
                                                            //     var supplierId = $(this).val();
                                                            //     var productSelect = $(this).closest('.product-field').find('.product-select');
                                                            //     productSelect.empty();
                                                            //     productSelect.append('<option value="">Select Product</option>');
                                                            //     if (supplierId) {
                                                            //         $.ajax({
                                                            //             url: '/getProductsBySupplierId/' + supplierId,
                                                            //             type: 'GET',
                                                            //             success: function(response) {
                                                            //                 if (response.products) {
                                                            //                     $.each(response.products, function(key, value) {
                                                            //                         productSelect.append('<option value="' + key +
                                                            //                             '">' + value + '</option>');
                                                            //                     });
                                                            //                 }
                                                            //             }
                                                            //         });
                                                            //     }
                                                            // });
                                                        });
                                                    </script>
                                                    {!! Form::close() !!}
                                                </div>
                                                <!-- /.box-body -->
                                                <h4 class="col-title">Product List</h4>
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table id="complex_header"
                                                            class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                                            <thead>
                                                                <tr>
                                                                    <th>SL#</th>
                                                                    <th>Product Category</th>
                                                                    <th>Product Name</th>
                                                                    <th>Product Code</th>
                                                               <th>Price &#2547;</th>
                                                                    <th>Stock Amount</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($alldata as $key => $product)
                                                                    <tr>
                                                                        <td>{{ $key + 1 }}</td>
                                                                        @foreach ($categorydata as $category)
                                                                            @if ($category->id == $product->category_id)
                                                                                <td>{{ $category->name }}</td>
                                                                            @endif
                                                                        @endforeach
                                                                        <td>{{ $product->name }}</td>
                                                                        <td>{{ $product->product_code }}</td>
                                                                        <td>
                                                                            @php
                                                                                $latest_purchase = App\Models\ProductPurchase::where('product_code', $product->product_code)
                                                                                    ->orderBy('created_at', 'desc')
                                                                                    ->first();
                                                                            @endphp
                                                                            @if ($latest_purchase)
                                                                                {{ $latest_purchase->price }} &#2547;
                                                                            @else
                                                                                <span class="badge badge-danger">Out of
                                                                                    Stock</span>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            {{ App\Models\ProductStock::where('product_code', $product->product_code)->first()->stock_quantity ?? '0' }}
                                                                            @foreach ($unitdata as $unit)
                                                                                @if ($unit->id == $product->unit_id)
                                                                                    {{ $unit->name }}
                                                                                @endif
                                                                            @endforeach
                                                                        </td>
                                                                        <td>
                                                                            @php
                                                                                $stockAmount = App\Models\ProductStock::where('product_code', $product->product_code)->first()->stock_quantity ?? '0';
                                                                            @endphp
                                                                            @if ($stockAmount == 0)
                                                                                <span class="badge badge-danger">Out of Stock</span>
                                                                            @elseif ($stockAmount < 10)
                                                                                <span
                                                                                    class="badge badge-warning">Warning</span>
                                                                            @else
                                                                                <span
                                                                                    class="badge badge-success">Available</span>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <caption style="font-size: 300px; font-weight: bold;"> List</caption>
                                                        <table id="example5" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                                            <caption style="font-size: 1px; font-weight: bold;">Customers List</caption>
                                                            <thead>Customers
                                                                <tr>
                                                                    <th>SL#</th>
                                                                    <th>Name</th>
                                                                    <th>Mobile</th>
                                                                    <th>Email</th>
                                                                    <th>Address</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($customerdata as $key => $customers)
                                                                    <tr>
                                                                        <td>{{ $key + 1 }}</td>
                                                                        <td>{{ $customers->name }}</td>
                                                                        <td>{{ $customers->mobile }}</td>
                                                                        <td>{{ $customers->email }}</td>
                                                                        <td>{{ $customers->address }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane " id="sle_list" role="tabpane2">
                                        <div class="col-xl-12">
                                        </div>
                                        <div class="box-header with-border">
                                            <h3 class="box-title">All Transfer list</h3>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="example3"
                                                class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                                <thead>
                                                    <tr>
                                                        <th>SL#</th>
                                                        <th>Product Name</th>
                                                        <th>Product Code</th>
                                                        <th>Invoice ID</th>
                                                        <th>Customer</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                        <th>Total</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($saledata as $key => $purchasedata)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            @foreach ($alldata as $product)
                                                                @if ($product->product_code == $purchasedata->product_code)
                                                                    <td>{{ $product->name }} </td>
                                                                @endif
                                                            @endforeach
                                                            <td>{{ $purchasedata->product_code }}</td>
                                                            <td>{{ $purchasedata->invoice_code }}</td>
                                                            @foreach ($customerdata as $customer)
                                                                @if ($customer->id == $purchasedata->customer_id)
                                                                    <td>{{ $customer->name }}</td>
                                                                @endif
                                                            @endforeach
                                                            @foreach ($unitdata as $unit)
                                                                @foreach ($alldata as $product)
                                                                    @if ($product->product_code == $purchasedata->product_code && $product->unit_id == $unit->id)
                                                                        <td> {{ $purchasedata->quantity }}
                                                                            {{ $unit->name }}
                                                                        </td>
                                                                    @endif
                                                                @endforeach
                                                            @endforeach
                                                            <td>{{ $purchasedata->price }}</td>
                                                            <td>{{ $purchasedata->total }}</td>
                                                            <td>{{ $purchasedata->created_at->format('h:i A d-m-Y') }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane " id="sale_Invoice_list" role="tabpane3">
                                        <div class="col-xl-12">
                                        </div>
                                        <div class="box-header with-border">
                                            <h3 class="box-title">All Transfer Invoice</h3>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="example"
                                                class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                                <thead>
                                                    <tr>
                                                        <th>SL#</th>
                                                        <th>Customer Name</th>
                                                        <th>Invoice ID</th>
                                                        <th>Date</th>
                                                         <th>Grand Total</th>
                                                        <th>Pay Amount</th>
                                                        <th>Due Amount</th>
                                                     <th>Letest Paying Date</th>
                                                        <th>action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($saleinvoicedata as $key => $saleinvoicedata)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            @foreach ($customerdata as $customer)
                                                            @if ($customer->id == $saleinvoicedata->customer_id)
                                                                <td>{{ $customer->name }}</td>
                                                            @endif
                                                        @endforeach
                                                            <td>{{ $saleinvoicedata->invoice_code }}</td>
                                                            <td>{{ $saleinvoicedata->created_at->format('h:i A d-m-Y') }}
                                                            </td>
                                                             <td>{{ $saleinvoicedata->total_price }} &#2547;</td>
                                                             <td>
                                                                @if ($saleinvoicedata->due == 0)
                                                                    <span class="badge badge-success">Fully Paid</span>
                                                                @else
                                                                    {{ $saleinvoicedata->pay }}
                                                                @endif
                                                            </td>
                                                             <td>
                                                                @if ($saleinvoicedata->due == 0)
                                                                    <span class="badge badge-success">No due</span>
                                                                @else
                                                                    {{ $saleinvoicedata->due }}
                                                                @endif
                                                            </td>
                                                             <td>{{ $saleinvoicedata->updated_at->format('h:i A d-m-Y') }}
                                                            <td>
                                                                <div class="btn-group mb-5">
                                                                    <button type="button"
                                                                        class="btn-flat btn-light  dropdown-toggle"
                                                                        data-toggle="dropdown"><i
                                                                            class="fa  fa-wrench
                                                    "></i></button>
                                                                    <div class="dropdown-menu">
                                                                        @if ($saleinvoicedata->due > 0)
                                                                            <a class="dropdown-item" data-toggle="modal"
                                                                                href="#editModal{{ $saleinvoicedata->id }}"><i
                                                                                    class="fa fa-pencil"></i> Update Pay
                                                                                Amount</a>
                                                                        @endif
                                                                        @if ($saleinvoicedata->due > 0)
                                                                            <a class="dropdown-item"
                                                                                href="{{ route('sale-mark-as-paid', $saleinvoicedata->id) }}"><i
                                                                                    class="fa fa-check"></i>Fully Paid</a>
                                                                        @endif
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('sale-invoice.show', ['id' => $saleinvoicedata->invoice_code]) }}"><i
                                                                                class="fa fa-file-text-o
                                                                            "></i>Show
                                                                            Invoice</a>
                                                                      
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            {{-- Modal For Pay amount --}}
                                                            <div class="modal fade"
                                                                id="editModal{{ $saleinvoicedata->id }}"data-bs-backdrop="static"
                                                                data-bs-keyboard="false" tabindex="-1"
                                                                aria-labelledby="exampleModalCenterTitle"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <!-- Modal content-->
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title"><i
                                                                                    class="fa fa-edit"></i>
                                                                                Update
                                                                                Pay Amount</h4>
                                                                        </div>
                                                                        {!! Form::open([
                                                                            'route' => ['saleproductpay.update', $saleinvoicedata->id],
                                                                            'enctype' => 'multipart/form-data',
                                                                            'method' => 'POST',
                                                                        ]) !!}
                                                                        @csrf
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Pay</label>
                                                                                        <div class="controls">
                                                                                            <input type="number"
                                                                                                name="pay"
                                                                                                class="form-control"
                                                                                                value="{{ $product->pay }}"
                                                                                                required
                                                                                                placeholder="Enter Amount"
                                                                                                min="1">
                                                                                        </div>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
            <!-- /.content -->
        </div>
    </div>
    </div>
    {{-- sum total --}}
    <script>
        $(document).ready(function() {
            // Calculate total price for each product
            $('#product-fields').on('input', 'input[name="quantity[]"], input[name="price[]"]',
                function() {
                    var productField = $(this).closest('.product-field');
                    var quantity = parseFloat(productField.find('input[name="quantity[]"]').val()) || 0;
                    var price = parseFloat(productField.find('input[name="price[]"]').val()) || 0;
                    var total = quantity * price;
                    productField.find('input[name="total[]"]').val(total);
                    // Show the total price in a div
                    var totalPrice = 0;
                    $('input[name="total[]"]').each(function() {
                        totalPrice += parseFloat($(this).val()) || 0;
                    });
                    $('#total-price').text(totalPrice.toFixed(2));
                });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Calculate grand total price
            function calculateGrandTotal() {
                var grandTotal = 0;
                $('input[name="total[]"], input[name="total_in[]"]').each(function() {
                    grandTotal += parseFloat($(this).val()) || 0;
                });
                $('#grand_total-price').text(grandTotal.toFixed(2));
                calculatePaymentDue();
            }
            // Call the calculateGrandTotal function whenever the input fields change
            $('#product-fields').on('input', 'input[name="quantity[]"], input[name="price[]"]', function() {
                calculateGrandTotal();
            });
            $(document).on('change', 'input[name="quantity[]"], input[name="price[]"]', function() {
                calculateGrandTotal();
            });
            // Remove product and recalculate grand total
            $(document).on('click', '.remove-product', function() {
                $(this).closest('.product-field').remove();
                calculateGrandTotal();
            });
            // Calculate payment due
            function calculatePaymentDue() {
                var grandTotal = parseFloat($('#grand_total-price').text()) || 0;
                var payAmount = parseFloat($('input[name="pay"]').val()) || 0;
                var paymentDue = grandTotal - payAmount;
                $('#payment-due').text(paymentDue.toFixed(2));
            }
            // Call the calculatePaymentDue function whenever the pay input field changes
            $(document).on('input', 'input[name="pay"]', function() {
                calculatePaymentDue();
            });
        });
    </script>

@endsection

@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper invoice-background">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Invoice</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Invoice</li>
                              <li class="breadcrumb-item active" aria-current="page"> Sale Invoice</li>
                          </ol>
                      </nav>
                  </div>
              </div>
          </div>
      </div>








      <!-- Main content -->
      <section class="invoice printableArea">
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <div class="bb-1 clearFix">
                  <div class="text-right pb-15">
                      <button id="print2" class="btn btn-rounded btn-warning" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="page-header">
                  <h2 class="d-inline"><span class="font-size-30">Sale Invoice</span></h2>
                  <div class="pull-right text-right">
                                                       @foreach ($saleinvoice as $key => $saleinvoice)
                      <h3>                                                      {{ \Carbon\Carbon::parse($saleinvoice->updated_at)->format('h:i A d-m-Y') }}
                      </h3>
                      @endforeach
                  </div>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-md-6 invoice-col">
                <img src="{{ url('../backend/images/logo/riser.svg') }}" width="90" height="50" alt="The Riser IT Logo" >
                <address>
                  <strong class="text-blue font-size-24">The Riser IT</strong><br>
                  <strong class="d-inline">
                    H#16, R# 22, Sector# 14, Uttara , Dhaka 1230, Bangladesh
                  </strong><br>
                  <strong>Phone: (880) 1701 621575 &nbsp;&nbsp;&nbsp;&nbsp; Email: info@theriserit.com</strong>
                </address>
              </div>
              @php
              $customer = \App\Models\Customer::find($saleinvoice->customer_id);
          @endphp

              <!-- /.col -->
              <div class="col-md-6 invoice-col text-right">


            <strong>To</strong>
                <address>
                  <strong class="text-blue font-size-24">
                    {{ $customer->name }}</strong><br>
                    {{ $customer->address }}<br>
                  <strong>Phone: {{ $customer->phone }} &nbsp;&nbsp;&nbsp;&nbsp; Email: {{ $customer->email }}</strong>
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-12 invoice-col mb-15">
                  <div class="invoice-details row no-margin">
                    <div class="col-md-6 col-lg-3"><b>Invoice </b>
                        {{ $saleinvoice->invoice_code }}
                    </div>
                    <div class="col-md-6 col-lg-3"><b>Purchase Date:</b>           {{ \Carbon\Carbon::parse($saleinvoice->created_at)->format('h:i A d-m-Y') }}</div>
                    <div class="col-md-6 col-lg-3"><b></b> </div>
                    <div class="col-md-6 col-lg-3"><b></b> </div>
                  </div>
              </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- Table row -->
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-bordered">
                  <tbody>
                  <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Product Code #</th>
                    <th>Supplier Name</th>
                    <th class="text-right">Quantity</th>
                    <th class="text-right">Unit Cost                                                                     &#2547;
                    </th>
                    <th class="text-right">Subtotal                                                                     &#2547;
                    </th>
                  </tr>
                  @foreach ($saledata as $key => $product)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>
            @foreach ($productdata as $products)
                @if ($product->product_code == $products->product_code)
                    {{ $products->name }}
                @endif
            @endforeach
        </td>
        <td>{{ $product->product_code }}</td>
        <td>
            @foreach ($productdata as $products)
            @if ($product->product_code == $products->product_code)
            @foreach ($supplierdata as $supplier)
                @if ($supplier->id == $products->suppliers_id)
                    {{ $supplier->name }}
                @endif
            @endforeach
            @endif
            @endforeach
        </td>
        <td class="text-right">{{$product->quantity}}
            @foreach ($productdata as $products)
                @if ($product->product_code == $products->product_code)
                    @foreach ($unitdata as $unit)
                        @if ($unit->id == $products->unit_id)
                            {{ $unit->name }}
                        @endif
                    @endforeach
                @endif
            @endforeach
        </td>
        <td class="text-right"> {{$product->price}}</td>
        <td class="text-right">{{$product->total}}</td>
    </tr>
@endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="col-12 text-right">
                  <div>
                      <p>Total amount  :  {{$saleinvoice->total_price}}</p>
                      <p>Paid amount :   {{$saleinvoice->pay}}</p>
                  </div>
                  <div class="total-payment">
                    <div class="total-payment">
                        @if ($saleinvoice->due == 0)
        <h3><b>Total Paid :</b> {{$saleinvoice->pay}}</h3>
    @elseif ($saleinvoice->due > 0)
        <h3><b>Total Due :</b> {{$saleinvoice->due}}</h3>
    @endif
                    </div>
                  </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>
</div>
@endsection

@extends('admin.admin_master')
@section('admin')



<?php

$total_sales = \App\Models\SaleInvoice::count('id');
$total_sale_due = \App\Models\SaleInvoice::sum('due');

$total_product =\App\Models\Product::count('id');
$total_customer =\App\Models\Customer::count('id');

$available_product = \App\Models\ProductStock::where('stock_quantity', '>', 0)->count('id');
$stock_out_product = \App\Models\ProductStock::where('stock_quantity', '=', 0)
                                   ->orWhereNull('stock_quantity')
                                   ->count('id');

$total_supplier = \App\Models\Supplier::count('id');
use Carbon\Carbon;

$current_month_sale_invoices = \App\Models\SaleInvoice::whereMonth('created_at', '=', Carbon::now()->month)->get();


?>

<style>.calculator{
	border:2px solid #ddd;
	width: 280px;
	box-sizing: border-box;
	margin: 40px auto 0;
	font-family: verdana;
}
.calculator .form-control{
	height: 60px;
}
.calculator .form-group{
	margin-bottom: 0;
}
.calculator input[type=text]{
	font-size: 1.5rem;
	color:#333;
}
.calculator .btn {
	font-size: 1.5rem;
	color:#333;
	width: 80px;
}
.calculator .btn-op {
	background-color: #999999;
}</style>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-full">
      <!-- Main content -->
      <section class="content">
          <div class="row">
              <div class="col-xl-2 col-6">
                  <div class="box overflow-hidden pull-up hov-rs">
                      <div class="box-body text-center">
                          <div class="icon bg-primary-light rounded w-60 h-60 mx-auto">
                              <i class="text-primary mr-0 font-size-24 mdi mdi-sale"></i>
                          </div>
                          <div>
                              <p class="text-mute mt-20 mb-0 font-size-16">Total sales</p>
                              <h3 class="text-dark mb-0 font-weight-500">{{$total_sales}}</h3>
                          </div>
                      </div>
                  </div>
              </div>


              <div class="col-xl-2 col-6">
                <div class="box overflow-hidden pull-up hov-rs">
                    <div class="box-body text-center">
                        <div class="icon bg-danger-light rounded w-60 h-60 mx-auto">
                            <i class="text-danger mr-0 font-size-24 mdi mdi-alert-octagram"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Total sales Due</p>
                            <h3 class="text-dark mb-0 font-weight-500">{{$total_sale_due}}</h3>
                        </div>
                    </div>
                </div>
            </div>

              <div class="col-xl-2 col-6">
                  <div class="box overflow-hidden pull-up hov-rs">
                      <div class="box-body text-center">
                          <div class="icon bg-warning-light rounded w-60 h-60 mx-auto">
                              <i class="text-warning mr-0 font-size-24 mdi mdi-dropbox"></i>
                          </div>
                          <div>
                              <p class="text-mute mt-20 mb-0 font-size-16">Available Product</p>
                              <h3 class="text-dark mb-0 font-weight-500">{{$available_product}}</h3>
                          </div>
                      </div>
                  </div>
              </div>


              <div class="col-xl-2 col-6">
                <div class="box overflow-hidden pull-up hov-rs">
                    <div class="box-body text-center">
                        <div class="icon bg-warning-light rounded w-60 h-60 mx-auto">
                            <i class="text-warning mr-0 font-size-24 mdi mdi-disk-alert"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Stock Out Product</p>
                            <h3 class="text-dark mb-0 font-weight-500">{{$stock_out_product}}</h3>
                        </div>
                    </div>
                </div>
            </div>
              <div class="col-xl-2 col-6">
                  <div class="box overflow-hidden pull-up hov-rs">
                      <div class="box-body text-center">
                          <div class="icon bg-info-light rounded w-60 h-60 mx-auto">
                              <i class="text-info mr-0 font-size-24 mdi mdi-account-multiple "></i>
                          </div>
                          <div>
                              <p class="text-mute mt-20 mb-0 font-size-16">Total Supplier</p>
                              <h3 class="text-dark mb-0 font-weight-500">{{$total_supplier}}</h3>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-xl-2 col-6">
                  <div class="box overflow-hidden pull-up hov-rs">
                      <div class="box-body text-center">
                          <div class="icon bg-danger-light rounded w-60 h-60 mx-auto">
                              <i class="text-danger mr-0 font-size-24 mdi mdi-account"></i>
                          </div>
                          <div>
                              <p class="text-mute mt-20 mb-0 font-size-16">Total Customer</p>
                              <h3 class="text-dark mb-0 font-weight-500">{{$total_customer}}</h3>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-12">
                <div class="box">


                    <div class="box-header">
                        <h4 class="box-title align-items-start flex-column">Time: <span id="current-time"></span></h4>
                    </div>


<script>
    function updateTime() {
        var currentTime = new Date();
        var hours = currentTime.getHours();
        var minutes = currentTime.getMinutes();
        var seconds = currentTime.getSeconds();
        var month = currentTime.getMonth() + 1;
        var day = currentTime.getDate();
        var year = currentTime.getFullYear();

        if (minutes < 10) {
            minutes = "0" + minutes;
        }
        if (seconds < 10) {
            seconds = "0" + seconds;
        }

        var timeString = hours + ":" + minutes + ":" + seconds;
        var dateString = month + "/" + day + "/" + year;

        document.getElementById("current-time").innerHTML = timeString + " on " + dateString;
    }

    setInterval(updateTime, 1000); // Update time every second
</script>


                  <!-- /.box-header -->
                  <div class="box-body">
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs" role="tablist">
                          <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#sale" role="tab"><span><i class="ion-home mr-15"></i>Sale of {{ \Carbon\Carbon::now()->format('M Y') }}
                          </span></a> </li>
                          <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#calculator" role="tab"><span><i class="ion-person mr-15"></i>Calculator</span></a> </li>
                          
                      </ul>
                      <!-- Tab panes -->
                      <div class="tab-content tabcontent-border">
                          <div class="tab-pane active" id="sale" role="tabpanel">
                            <br>
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Invoice ID</th>
                                          <th>Total</th>
                                          <th>Payment Status</th>
                                          <th>Sale Date</th>
                                      </tr>
                                  </thead>
                                  <tbody>

                                    @foreach ($current_month_sale_invoices as $key => $saleinvoice)
                                    <tr>


                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $saleinvoice->invoice_code }}</td>
                                          <td>{{ $saleinvoice->total_price }} &#2547;
                                        </td>
                                        <td>
                                            @if ($saleinvoice->due == 0)
                                                <span class="badge badge-success">No due</span>
                                            @else
                                            <span class="badge badge-denger">Have due</span>
                                            @endif
                                        </td>                                          <td>{{ $saleinvoice->created_at->format('d-m-Y') }}</td>
                                        </tr>
                                      @endforeach

                                  </tbody>

                              </table>
                              </div>
                          </div>
                          <div class="tab-pane" id="calculator" role="tabpanel">


<style>.calculator{
	border:2px solid #ddd;
	width: 280px;
	box-sizing: border-box;
	margin: 40px auto 0;
	font-family: verdana;
}
.calculator .form-control{
	height: 60px;
}
.calculator .form-group{
	margin-bottom: 0;
}
.calculator input[type=text]{
	font-size: 1.5rem;
	color:#333;
}
.calculator .btn {
	font-size: 1.5rem;
	color:#333;
	width: 80px;
}
.calculator .btn-op {
	background-color: #999999;
}</style>


                            <table class="calculator table">
                              <thead>
                                  <tr>
                                      <td colspan=7>
                                          <div class="output form-group">
                                              <input type="text" class="ans form-control" readonly name="">
                                          </div>
                                      </td>
                                  </tr>
                              </thead>
                              <tbody class="actions">
                                  <tr>
                                      <td colspan=3></td>
                                      <td>
                                          <button class="btn btn-op" data-value='*('>(</button>

                                      </td>
                                      <td>
                                          <button class="btn btn-op" data-value=')'>)</button>

                                      </td>
                                      <td>
                                          <button class="btn btn-op" data-value='%'>%</button>

                                      </td>
                                      <td>
                                          <button class="btn btn-op" data-value='ce'>CE</button>

                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                          <button class="btn btn-op" data-value='inv'>Inv</button>
                                      </td>
                                      <td>
                                          <button class="btn btn-op" data-value='sin'>sin</button>
                                      </td>
                                      <td>
                                          <button class="btn btn-op" data-value='ln'>ln</button>
                                      </td>
                                      <td>
                                          <button class="btn" data-value='7'>7</button>
                                      </td>
                                      <td>
                                          <button class="btn" data-value='8'>8</button>
                                      </td>
                                      <td>
                                          <button class="btn" data-value='9'>9</button>
                                      </td>
                                      <td>
                                          <button class="btn btn-op" data-value='/'>÷</button>

                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                          <button class="btn btn-op" data-value='*3.14'>π</button>
                                      </td>
                                      <td>
                                          <button class="btn btn-op" data-value='cos'>cos</button>
                                      </td>
                                      <td>
                                          <button class="btn btn-op" data-value='log'>log</button>
                                      </td>
                                      <td>
                                          <button class="btn" data-value='4'>4</button>
                                      </td>
                                      <td>
                                          <button class="btn" data-value='5'>5</button>
                                      </td>
                                      <td>
                                          <button class="btn" data-value='6'>6</button>
                                      </td>
                                      <td>
                                          <button class="btn btn-op" data-value='*'>	×</button>
                                      </td>
                                  </tr>

                                  <tr>
                                      <td>
                                          <button class="btn btn-op" data-value='e'>e</button>
                                      </td>
                                      <td>
                                          <button class="btn btn-op" data-value='tan'>tan</button>
                                      </td>
                                      <td>
                                          <button class="btn btn-op" data-value='radic'>√</button>
                                      </td>
                                      <td>
                                          <button class="btn" data-value='3'>3</button>
                                      </td>
                                      <td>
                                          <button class="btn" data-value='2'>2</button>
                                      </td>
                                      <td>
                                          <button class="btn" data-value='1'>1</button>
                                      </td>
                                      <td>
                                          <button class="btn btn-op" data-value='-'>-</button>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                          <button class="btn btn-op" data-value='exp'>EXP</button>
                                      </td>
                                      <td>
                                          <button class="btn btn-op" data-value='x^2'>x²</button>
                                      </td>
                                      <td>
                                          <button class="btn btn-op" data-value='**'>x^</button>
                                      </td>
                                      <td>
                                          <button class="btn btn-op" data-value='.'>.</button>
                                      </td>
                                      <td>
                                          <button class="btn" data-value='0'>0</button>
                                      </td>
                                      <td>
                                          <button class="btn btn-op" data-value='='>=</button>
                                      </td>
                                      <td>
                                          <button class="btn btn-op" data-value='+'>+</button>
                                      </td>
                                  </tr>
                              </tbody>
                              </table>





<script>const actions = document.querySelector('.actions');
	const ans = document.querySelector('.ans');
	console.log(actions);
	console.log(ans);
	let expression = '';
	let a=0;
	actions.addEventListener('click', (e) => {
		console.log(e.target);
		const value = e.target.dataset['value'];

		if(value !== undefined) {
			// I'm good to go.
			if(value == 'ce') {
				expression = '';
				ans.value = 0;
				return true;
			}
			else if(value == 'x^2'){
				expression =square();
			}

			else if(value == 'radic'){
				expression = Math.sqrt(expression);
			}
			else if(value == 'log'){
				expression = Math.log(expression);
			}
			else if(value == 'sin'){
				expression = Math.sin(expression);
			}
			else if(value == 'cos'){
				expression = Math.cos(expression);
			}
			else if(value == 'tan'){
				expression = Math.tan(expression);
			}

			else if(value == '=') {
				const answer = eval(expression);
				expression = answer;

			} else {
				expression += value;
			}

			if(expression == undefined) {
				expression = '';
				ans.value = 0;
			} else {
				ans.value = expression;
			}
			// expression += value;


		}

	});
	const square =()=> {
			return eval(expression*expression);
	}
  </script>











                          </div>
                          </div>

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

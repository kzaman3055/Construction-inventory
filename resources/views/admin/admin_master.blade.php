<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">
    <title>Inventory Management System - Dashboard</title>
    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ URL::asset('../backend/assets/css/vendors_css.css') }}">
    <!-- Style-->
    <link rel="stylesheet" href="{{ URL::asset('../backend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('../backend/assets/css/skin_color.css') }}">


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



    {{-- toster alart start--}}

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" >


    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    {{-- End toster alart start--}}

{{-- sweet alart --}}




<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">


{{-- sweet alart --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" integrity="sha512-jveC93oczeo0Tpkob0DQy2LMFgJb0xnppOsb+BYR0MzyFL9rELrCEJ2v+3qP3tIhGx56OJzwbGeKdzEGWlR8Ng==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js" integrity="sha512-JeJ/0n91wUGej0lnThquZMWc1fCAg7F+6p/zA6TLyU6fajx6PPlw3YiB3hFnZ9fnS5V5C5M1z5V7hFbPz4A7Mw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body class="hold-transition light-skin sidebar-mini theme-primary fixed">
    <div class="wrapper">
        @include('admin.body.header')
        <!-- Content Wrapper. Contains page content -->
        @include('admin.body.sidebar')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @yield('admin')
        <!-- /.content-wrapper -->
        @include('admin.body.footer')
    </div>
    <!-- ./wrapper -->
    <!-- Vendor JS -->
    <script src="{{ URL::asset('../backend/assets/js/vendors.min.js') }}"></script>
    <script src="{{ URL::asset('../backend/assets/icons/feather-icons/feather.min.js') }}"></script>











	<script src="{{ URL::asset('../backend/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js')}}"></script>
	<script src="{{ URL::asset('../backend/assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js')}}"></script>
	<script src="{{ URL::asset('../backend/assets/vendor_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js')}}"></script>
	<script src="{{ URL::asset('../backend/assets/vendor_components/select2/dist/js/select2.full.js')}}"></script>
	<script src="{{ URL::asset('../backend/assets/vendor_plugins/input-mask/jquery.inputmask.js')}}"></script>
	<script src="{{ URL::asset('../backend/assets/vendor_plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
	<script src="{{ URL::asset('../backend/assets/vendor_plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
	<script src="{{ URL::asset('../backend/assets/vendor_components/moment/min/moment.min.js')}}"></script>
	<script src="{{ URL::asset('../backend/assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
	<script src="{{ URL::asset('../backend/assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
	<script src="{{ URL::asset('../backend/assets/vendor_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
	<script src="{{ URL::asset('../backend/assets/vendor_plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
	<script src="{{ URL::asset('../backend/assets/vendor_plugins/iCheck/icheck.min.js')}}"></script>
	<script src="{{ URL::asset('../backend/assets/js/pages/advanced-form-element.js')}}"></script>

















    <script src="{{ URL::asset('../backend//assets/vendor_components/easypiechart/dist/jquery.easypiechart.js') }}">
    </script>
    <script src="{{ URL::asset('../backend/assets/vendor_components/apexcharts-bundle/irregular-data-series.js') }}">
    </script>
    <!-- Sunny Admin App -->
    <script src="{{ URL::asset('../backend/assets/js/template.js') }}"></script>
    <script src="{{ URL::asset('../backend/assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ URL::asset('../backend/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('../backend/assets/js/pages/data-table.js') }}"></script>
    <script src="{{ URL::asset('../backend/assets/js/pages/validation.js') }}"></script>
    <script src="{{ URL::asset('../backend/assets/js/pages/form-validation.js') }}"></script>

	<script src="{{ URL::asset('../backend/assets/vendor_plugins/JqueryPrintArea/demo/jquery.PrintArea.js')}}"></script>

	<script src="{{ URL::asset('../backend/assets/js/pages/invoice.js')}}"></script>




<script>
  @if(Session::has('message'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.success("{{ session('message') }}");
  @endif

  @if(Session::has('error'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.error("{{ session('error') }}");
  @endif

  @if(Session::has('info'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.info("{{ session('info') }}");
  @endif

  @if(Session::has('warning'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.warning("{{ session('warning') }}");
  @endif
</script>


{{-- Sweet alart --}}


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script type="text/javascript">
    $('.show-alert-delete-box').click(function(event){
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: "Are you sure?",
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            type: "warning",
            buttons: ["Cancel","Yes!"],
            confirmButtonColor: '#cc0000',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });
</script>






{{-- sweet alart --}}






</body>

</html>

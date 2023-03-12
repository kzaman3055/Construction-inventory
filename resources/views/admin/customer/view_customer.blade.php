@extends('admin.admin_master')
@section('admin')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="page-title">Manage Project</h3>
                        <div class="d-inline-block align-items-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><i class="mdi mdi-home-outline"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add & Manage Project</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main content -->
            <section class="content">


                <div class="col 12">




                    <div class="row">
                        <div class="col-xl-12">
                            <?php
                            if (!empty($editdata)) {
                                $btn = 'Update';
                            } else {
                                $btn = 'Add';
                            }
                            ?>
                            <div class="box">
                                <div class="box-header with-border">
                                    @if (!empty($editdata))
                                        <h4 class="box-title">Edit Project</h4>
                                    @elseif(!empty($customerdata))

                                        <h4 class="box-title">Add Daily Cost for <span style="color:red">{{ $customerdata->name}}</span></h4>

                                    @else
                                        <h4 class="box-title">Add Project</h4>
                                    @endif
                                </div>
                                <!-- /.box-header -->


                                @if(empty($customerdata))

                                <div class="box-body">
                                    @if (empty($editdata))
                                        {!! Form::open(['route' => ['manage-customer.store'], 'method' => 'POST']) !!}
                                    @else
                                        {{ Form::open(['route' => ['manage-customer.update', $editdata->id], 'method' => 'PUT', 'files' => true]) }}
                                    @endif
                                    <!-- text input -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <div class="controls">
                                                    <input type="text" name="name" class="form-control"
                                                        value="{{ !empty($editdata->name) ? $editdata->name : '' }}"
                                                        required placeholder="Enter Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <div class="controls">
                                                    <input type="email" name="email" class="form-control"
                                                        value="{{ !empty($editdata->email) ? $editdata->email : '' }}"
                                                        required data-validation placeholder="Enter Valid Email">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Mobile</label>
                                                <div class="controls">
                                                    <input type="tel" name="mobile" class="form-control"
                                                        value="{{ !empty($editdata->mobile) ? $editdata->mobile : '' }}"
                                                        required placeholder="Enter Mobile Number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <div class="controls">
                                                    <textarea rows="3" cols="5" name="address" class="form-control" required placeholder="Enter Address">{{ !empty($editdata->address) ? $editdata->address : '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit"
                                            class="btn btn-success pull-right">{{ $btn }}</button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>

                                @elseif(!empty($customerdata))

                                <div class="box-body">

                                    {!! Form::open(['route' => ['customer.dailycoststore'], 'method' => 'POST']) !!}
                                    <!-- text input -->
                                    <div class="cost-field col-md-12">

                                    <div class="row" id="cost-fields">

                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <label for="category_id">Category</label>
                                                <select name="category_id[]"  class="form-control select2">
                                                    <option value="" disabled selected>Select Category</option>
                                                    @foreach($alldailycostcategory as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>


                                                <input type="hidden" name="customer_id" class="form-control"
                                                value="{{ $customerdata->id}}"
                                                required placeholder="Enter Name">
                                            </div>


                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Amount &#2547;
                                                </label>
                                                <div class="controls">
                                                    <input type="number" name="amount[]" class="form-control"
                                                        value=""
                                                        required placeholder="Enter Amount">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4" style="padding-top: 22px;">
                                            <button type="button" id="add-cost"
                                            class="btn btn-success"><i
                                                class="fa fa-plus-circle "></i>
                                            More</button>
                                        </div><!-- End col-md-5 -->

                                    </div>
                                    </div>
                                    <div>
                                        <button type="submit"
                                            class="btn btn-success pull-right">{{ $btn }}</button>
                                    </div>





                                    <script>
                                        $(document).ready(function() {

                                            // Add cost field
                                            $('#add-cost').click(function() {
                                                var html = `


                                                <div class="cost-field col-md-12">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id[]"  class="form-control category-select">
                    <option value="" disabled selected>Select Category</option>
                    @foreach($alldailycostcategory as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <input type="hidden" name="customer_id" class="form-control" value="{{ $customerdata->id}}" required placeholder="Enter Name">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Amount &#2547;</label>
                <div class="controls">
                    <input type="number" name="amount[]" class="form-control" value="" required placeholder="Enter Amount">
                </div>
            </div>
        </div>
        <div class="col-md-4" style="padding-top: 22px;">
                <button type="button" class="remove-cost btn btn-danger"><i class="fa fa-minus-circle "></i> Remove</button>
        </div>
    </div>
</div>




                                `;
                                                $('#cost-fields').append(html);
                                                // Initialize select2 for new dropdowns customer-select
                                                $('.category-select ').select2();
                                            });
                                            // Remove product field
                                            $(document).on('click', '.remove-cost', function() {
                                                $(this).closest('.cost-field').remove();
                                            });

                                        });
                                    </script>


                                    {!! Form::close() !!}
                                </div>


                                @endif
                                <!-- /.box-body -->
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-xl-12">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">All Project List</h3>
                                    <h6 class="box-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table id="example"
                                            class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                            <thead>
                                                <tr>
                                                    <th>SL#</th>
                                                    <th>Name</th>
                                                    <th>Mobile</th>
                                                    <th>Email</th>
                                                    <th>Address</th>
                                                    <th>Status</th>
                                                    <th>Sq. Feet</th>
                                                    <th>Est. Amount</th>
                                                    <th>Advance</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($alldata as $key => $customers)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $customers->name }}</td>
                                                        <td>{{ $customers->mobile }}</td>
                                                        <td>{{ $customers->email }}</td>
                                                        <td>{{ $customers->address }}</td>
                                                        <td>
                                                            @if ($customers->status == 1)
                                                                <span class="badge badge-success">Active</span>
                                                            @else
                                                                <span class="badge badge-danger">Closed</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $customers->square_feet }}</td>
                                                        <td>{{ number_format($customers->estimation) }} &#2547;
                                                        </td>
                                                        <td>{{ number_format($customers->advance_amount) }} &#2547;
                                                        </td>

                                                        <td>
                                                            <div class="btn-group mb-5">
                                                                <button type="button"
                                                                    class="btn-flat btn-light dropdown-toggle"
                                                                    data-toggle="dropdown"><i
                                                                        class="fa  fa-wrench
                                                            "></i></button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('manage-customer.edit', $customers->id) }}"><i
                                                                            class="fa fa-pencil"></i> Edit</a>
                                                                    <a class="dropdown-item" data-toggle="modal"
                                                                        href="#editModal{{ $customers->id }}"><i
                                                                            class="fa fa-check"></i>Status</a>
                                                                    <a class="dropdown-item" data-toggle="modal"
                                                                        href="#editModal1{{ $customers->id }}"><i
                                                                            class="fa fa-check"></i>Assign Amount</a>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('manage-customer.show', $customers->id) }}"><i
                                                                            class="fa fa-pencil"></i> Add Daily Cost</a>

                                                                     <a class="dropdown-item" href="{{ route('project.showdata',  $customers->id) }}">
                                                                                <i class="fa fa-pencil"></i> View all cost
                                                                              </a>




                                                                            <form
                                                                        action="{{ route('manage-customer.destroy', $customers->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <a type="submit"
                                                                            class="dropdown-item show-alert-delete-box"> <i
                                                                                title="Delete"
                                                                                class="fa fa-trash"></i>Delete
                                                                        </a>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <!-- Status Modal -->
                                                            <div class="modal fade"
                                                                id="editModal{{ $customers->id }}"data-bs-backdrop="static"
                                                                data-bs-keyboard="false" tabindex="-1"
                                                                aria-labelledby="exampleModalCenterTitle"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <!-- Modal content-->
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title"><i
                                                                                    class="fa fa-edit"></i>
                                                                                Edit
                                                                                Status</h4>
                                                                        </div>
                                                                        {!! Form::open([
                                                                            'route' => ['customerstatus.update', $customers->id],
                                                                            'enctype' => 'multipart/form-data',
                                                                            'method' => 'POST',
                                                                        ]) !!}
                                                                        @csrf
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="input-group">
                                                                                        <label
                                                                                            class="col-3 col-form-label">
                                                                                            Status </label>
                                                                                        <select name="status"
                                                                                            class="form-select">
                                                                                            <option value=""
                                                                                                selected=""
                                                                                                disabled="">
                                                                                                Select Status
                                                                                            </option>
                                                                                            <option value="1"
                                                                                                {{ $customers->status == '1' ? 'selected' : '' }}>
                                                                                                Active</option>
                                                                                            <option value="0"
                                                                                                {{ $customers->status == '0' ? 'selected' : '' }}>
                                                                                                Deactive</option>
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



                                                            <div class="modal fade" id="editModal1{{ $customers->id }}"
                                                                data-bs-backdrop="static" data-bs-keyboard="false"
                                                                tabindex="-1" aria-labelledby="exampleModalCenterTitle"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <!-- Modal content-->
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title"><i
                                                                                    class="fa fa-edit"></i>
                                                                                Input Amount</h4>
                                                                        </div>
                                                                        {!! Form::open([
                                                                            'route' => ['amountDetails.update', $customers->id],
                                                                            'method' => 'POST',
                                                                        ]) !!}
                                                                        @csrf
                                                                        <div class="modal-body">
                                                                            <div class="row mb-3">
                                                                                <div class="col-4">
                                                                                    <label class="form-label">Square
                                                                                        Feet</label>
                                                                                </div>
                                                                                <div class="col-8">
                                                                                    <input type="text"
                                                                                        name="square_feet"
                                                                                        class="form-control"
                                                                                        value="{{ $customers->square_feet }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-3">
                                                                                <div class="col-4">
                                                                                    <label class="form-label">Estimation
                                                                                        Amount &#2547;
                                                                                    </label>
                                                                                </div>
                                                                                <div class="col-8">
                                                                                    <input type="number"
                                                                                        name="estimation"
                                                                                        class="form-control"
                                                                                        value="{{ $customers->estimation }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-3">
                                                                                <div class="col-4">
                                                                                    <label class="form-label">Advance
                                                                                        Amount &#2547;
                                                                                    </label>
                                                                                </div>
                                                                                <div class="col-8">
                                                                                    <input type="text"
                                                                                        name="advance_amount"
                                                                                        class="form-control"
                                                                                        value="{{ $customers->advance_amount }}">
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



                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <!-- /.box -->
                            </div>
                        </div>
                    </div>
                </div>

        </div>
        </section>
        <!-- /.content -->
    </div>
    </div>








{{--
    <div style="visibility: hidden;">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                <div class="form-row">

                    <div class="col-md-4">

                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select name="category_id"  id="category-select" class="form-control">
                                <option value="" disabled selected>Select Category</option>
                                @foreach($alldailycostcategory as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Amount </label>
                            <div class="controls">
                                <input type="text" name="name" class="form-control"
                                    value="{{ $customerdata->name}}"
                                    required placeholder="Enter Name">
                            </div>
                        </div>
                    </div>


                        <div class="col-4" style="padding-top: 22px;">
                            <span class="btn btn-success addeventmore"><i
                                    class=" fa fa-plus-circle "></i> </span>
                                    <span class="btn btn-danger removeeventmore"><i
                                        class=" fa fa-plus-circle "></i> </span>
                        </div><!-- End col-md-5 -->

                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.category-select').select2();
        });
        </script>

    <script type="text/javascript">
        $(document).ready(function(){
             var counter = 0;
             $(document).on("click",".addeventmore",function(){
                 var whole_extra_item_add = $('#whole_extra_item_add').html();
                 $(this).closest(".add_item").append(whole_extra_item_add);
                 counter++;
             });
             $(document).on("click",'.removeeventmore',function(event){
                 $(this).closest(".delete_whole_extra_item_add").remove();
                 counter -= 1
             });

         });
    </script>
 --}}










@endsection

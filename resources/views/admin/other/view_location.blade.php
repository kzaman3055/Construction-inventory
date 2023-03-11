@extends('admin.admin_master')
@section('admin')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="page-title">Manage Location</h3>
                        <div class="d-inline-block align-items-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><i class="mdi mdi-home-outline"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add & Manage Location</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xl-6">
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
                                    <h4 class="box-title">Edit Location</h4>
                                @else
                                    <h4 class="box-title">Add Location</h4>
                                @endif
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                @if (empty($editdata))
                                    {!! Form::open(['route' => ['manage-location.store'], 'method' => 'POST']) !!}



                                    <div class="add_item">
                                        <div class="row">

                                                <div class="col-8 form-group">
                                                    <label>Name</label>
                                                    <div class="controls">
                                                        <input type="text" name="name[]" class="form-control"
                                                            value="" required placeholder="Enter Location Name">
                                                    </div>
                                                </div>



                                                <div class="col-4" style="padding-top: 22px;">
                                                    <span class="btn btn-success addeventmore"><i
                                                            class=" fa fa-plus-circle "></i> </span>
                                                </div><!-- End col-md-5 -->
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit"
                                            class="btn btn-success pull-right">{{ $btn }}</button>
                                    </div>
                                @else
                                    {{ Form::open(['route' => ['manage-location.update', $editdata->id], 'method' => 'PUT', 'files' => true]) }}

                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Name</label>
                                        <div class="controls">
                                            <input type="text" name="name" class="form-control"
                                                value="{{ !empty($editdata->name) ? $editdata->name : '' }}" required
                                                placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit"
                                            class="btn btn-success pull-right">{{ $btn }}</button>
                                    </div>
                                @endif

                                {!! Form::close() !!}
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>





























                    <div class="col-xl-6">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">All Location List</h3>
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
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($alldata as $key => $locations)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $locations->name }}</td>
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
                                                                    href="{{ route('manage-location.edit', $locations->id) }}"><i
                                                                        class="fa fa-pencil"></i> Edit</a>
                                                                <form
                                                                    action="{{ route('manage-location.destroy', $locations->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <a type="submit"
                                                                        class="dropdown-item show-alert-delete-box"> <i
                                                                            title="Delete" class="fa fa-trash"></i>Delete
                                                                    </a>
                                                                </form>
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
            </section>
            <!-- /.content -->
        </div>
    </div>

    <div style="visibility: hidden;">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                <div class="form-row">

                        <div class="col-8 form-group">
                            <label>Name</label>
                            <div class="controls">
                                <input type="text" name="name[]" class="form-control"
                                    value="" required placeholder="Enter Location Name">
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

@endsection

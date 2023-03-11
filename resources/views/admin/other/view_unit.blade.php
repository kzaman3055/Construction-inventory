@extends('admin.admin_master')
@section('admin')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="page-title">Manage Unit</h3>
                        <div class="d-inline-block align-items-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><i class="mdi mdi-home-outline"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add & Manage Unit</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xl-4">
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
                                    <h4 class="box-title">Edit Unit</h4>
                                @else
                                    <h4 class="box-title">Add Unit</h4>
                                @endif
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                @if (empty($editdata))
                                    {!! Form::open(['route' => ['manage-unit.store'], 'method' => 'POST']) !!}
                                @else
                                    {{ Form::open(['route' => ['manage-unit.update', $editdata->id], 'method' => 'PUT', 'files' => true]) }}
                                @endif
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
                                    <button type="submit" class="btn btn-success pull-right">{{ $btn }}</button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">All Unit List</h3>
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
                                            @foreach ($alldata as $key => $units)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $units->name }}</td>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group mb-5">
                                                            <button type="button" class="btn-flat btn-light  dropdown-toggle"
                                                                data-toggle="dropdown"><i
                                                                    class="fa  fa-wrench
                                                            "></i></button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('manage-unit.edit', $units->id) }}"><i
                                                                        class="fa fa-pencil"></i> Edit</a>
                                                                <form
                                                                    action="{{ route('manage-unit.destroy', $units->id) }}" id="delete"
                                                                    method="POST">


@csrf
                                                                    @method('DELETE')


                                                                    {{-- <input name="_method" type="hidden" value="DELETE"> --}}


                                                                 <a  type="submit" class="dropdown-item show-alert-delete-box"> <i
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
@endsection

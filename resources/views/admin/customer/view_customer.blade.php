@extends('admin.admin_master')
@section('admin')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="page-title">Manage Customer</h3>
                        <div class="d-inline-block align-items-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><i class="mdi mdi-home-outline"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add & Manage Customer</li>
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
                                    <h4 class="box-title">Edit Customer</h4>
                                @else
                                    <h4 class="box-title">Add Customer</h4>
                                @endif
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                @if (empty($editdata))
                                    {!! Form::open(['route' => ['manage-customer.store'], 'method' => 'POST']) !!}
                                @else
                                    {{ Form::open(['route' => ['manage-customer.update', $editdata->id], 'method' => 'PUT', 'files' => true]) }}
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
                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="controls">
                                        <input type="email" name="email" class="form-control"
                                            value="{{ !empty($editdata->email) ? $editdata->email : '' }}" required
                                            data-validation placeholder="Enter Valid Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Mobile</label>
                                    <div class="controls">
                                        <input type="tel" name="mobile" class="form-control"
                                            value="{{ !empty($editdata->mobile) ? $editdata->mobile : '' }}" required
                                            placeholder="Enter Mobile Number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <div class="controls">
                                        <textarea rows="3" cols="5" name="address" class="form-control" required placeholder="Enter Address">{{ !empty($editdata->address) ? $editdata->address : '' }}</textarea>
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
                                <h3 class="box-title">All Customer List</h3>
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
                                                    <td>
                                                        <div class="btn-group mb-5">
                                                            <button type="button" class="btn-flat btn-light dropdown-toggle"
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
                                                                        class="fa fa-check"></i>Status</a>
                                                                <form
                                                                    action="{{ route('manage-customer.destroy', $customers->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <a type="submit" class="dropdown-item show-alert-delete-box"> <i
                                                                            title="Delete" class="fa fa-trash"></i>Delete
                                                                    </a>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <!-- Status Modal -->
                                                        <div class="modal fade"
                                                            id="editModal{{ $customers->id }}"data-bs-backdrop="static"
                                                            data-bs-keyboard="false" tabindex="-1"
                                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <!-- Modal content-->
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title"><i class="fa fa-edit"></i>
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
                                                                                    <label class="col-3 col-form-label">
                                                                                        Status </label>
                                                                                    <select name="status"
                                                                                        class="form-select">
                                                                                        <option value=""
                                                                                            selected="" disabled="">
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

                                                        <div class="modal fade" id="editModal1{{ $customers->id }}" data-bs-backdrop="static"
                                                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <!-- Modal content-->
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title"><i class="fa fa-edit"></i> Input Amount</h4>
                                                                    </div>
                                                                    {!! Form::open([
                                                                    'route' => ['amountDetails.update', $customers->id],
                                                                    'method' => 'POST'
                                                                    ]) !!}
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="input-group">
                                                                                    <label class="col-3 col-form-label">Square Feet</label>
                                                                                    <input type="text" name="square_feet" class="form-control"
                                                                                        value="{{ $customers->square_feet }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="input-group">
                                                                                    <label class="col-3 col-form-label">Estimation</label>
                                                                                    <input type="text" name="estimation" class="form-control"
                                                                                        value="{{ $customers->estimation }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="input-group">
                                                                                    <label class="col-3 col-form-label">Advance Amount</label>
                                                                                    <input type="text" name="advance_amount" class="form-control"
                                                                                        value="{{ $customers->advance_amount }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer pull-right">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
            </section>
            <!-- /.content -->
        </div>
    </div>
@endsection

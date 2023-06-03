@extends('templates.admin')

@section('content')
<link href="{{ asset('admin-assets/vendors/bower_components/dropify/dist/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Row -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark"></h6>
                </div>
                <div class="pull-right">
                    <!-- /.modal -->
                    <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-primary txt-light">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h5 class="modal-title font-20">Add Popup </h5>
                                </div>
                                <form action="{{ route('admin.popups.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="title" class="control-label mb-10">Title:</label>
                                            <input type="text" class="form-control" name="title" placeholder="Enter title" id="title" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="link" class="control-label mb-10">Link
                                            </label>
                                            <input type="text" class="form-control" name="link" placeholder="Enter link" id="link">
                                        </div>
                                        <div class="form-group">
                                            <label for="status" class="control-label mb-10">Status </label>
                                            <select name="status" id="status" class="form-control" required>
                                                <option value="">Select Status</option>
                                                <option value="main">Main</option>
                                                <option value="dashboard">Dashboard</option>
                                                <option value="deactivated">Deactivated</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="descp" class="control-label mb-10">Brief Description </label>
                                            <input type="text" class="form-control" name="descp" placeholder="Enter Description" id="descp" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <p class="text-dark" id="payment_method_label">Attach Image.</p>
                                                    <div class="mt-10">
                                                        <input type="file" id="input-file-now" name="image" class="dropify" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary btn-rounded">Save Popup</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary btn-rounded btn-lable-wrap" data-toggle="modal" data-target="#responsive-modal"><span class="btn-text">Add Popup</button>

                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table id="datable_1" class="table table-hover display  pb-30">
                                <thead class="data-table-head">
                                    <tr class="data-table-head">
                                        <th class="hd">Img</th>
                                        <th class="hd">Title</th>
                                        <th class="hd">Description</th>
                                        <th class="hd">Link</th>
                                        <th class="hd">Status</th>
                                        <th class="hd">Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th class="hd">Img</th>
                                        <th class="hd">Title</th>
                                        <th class="hd">Description</th>
                                        <th class="hd">Link</th>
                                        <th class="hd">Status</th>
                                        <th class="hd">Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($popups as $pop)
                                    <tr>
                                        <td><img src="{{ asset('uploads/'.$pop['image'] ) }} " width="40" alt=""></td>
                                        <td>{{ $pop['title'] }}</td>
                                        <td>{{ $pop['descp'] }}</td>
                                        <td>{{ $pop['link'] }}</td> 
                                        @if ($pop['status'] == "deactivated") 
                                        <td> <span class="label label-danger">Deactivated</span> </td>
                                        @else
                                        <td> <span class="label label-success">{{ $pop['status'] }}</span></td>
                                        @endif

                                        <td><a href="#" data-toggle="modal" data-target="#update-modal{{ $pop['id'] }}"> <button class="btn btn-warning btn-rounded ">
                                                    <span class="btn-label"><i class="fa fa-pencil"></i>
                                                    </span></button>
                                            </a> | <button onclick="event.preventDefault();
                                                        document.getElementById('delete_user_from-{{ $pop['id'] }}').submit()" class="btn btn-danger btn-rounded btn-lable-wrap right-label"><i class="fa fa-trash"></i>
                                                </span></button></td>
                                        <form id="delete_user_from-{{ $pop['id'] }}" action="{{ route('admin.popups.destroy', $pop['id']) }}" method="POST" style="display: none">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </tr>


                                    <!-- /.Update modal -->
                                    <div id="update-modal{{ $pop['id'] }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary txt-light">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h5 class="modal-title font-20">Update Popup</h5>
                                                </div>
                                                <form action="{{ route('admin.popups.update', $pop['id']) }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="title" class="control-label mb-10">Title:</label>
                                                            <input type="text" class="form-control" name="title" value="{{ $pop['title'] }}" placeholder="Enter title" id="title" required>
                                                        </div>
                
                                                        <div class="form-group">
                                                            <label for="link" class="control-label mb-10">Link
                                                            </label>
                                                            <input type="text" class="form-control" name="link" value="{{ $pop['link'] }}" placeholder="Enter link" id="link">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="status" class="control-label mb-10">Status</label>
                                                            <select name="status" id="status" class="form-control" required>
                                                                <option value="">Select Status</option>
                                                                <option value="1">Active</option>
                                                                <option value="0">Deactivated</option>
                                                            </select>
                                                        </div>
                
                                                        <div class="form-group">
                                                            <label for="descp" class="control-label mb-10">Brief Description </label>
                                                            <input type="text" class="form-control" name="descp" placeholder="Enter Description" id="descp" value="{{ $pop['descp'] }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="panel-wrapper collapse in">
                                                                <div class="panel-body">
                                                                    <p class="text-dark" id="payment_method_label">Attach Image.</p>
                                                                    <div class="mt-10">
                                                                        <input type="file" id="input-file-now" name="image" class="dropify" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                
                
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary btn-rounded">Update
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /Row -->

@endsection

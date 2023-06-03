@extends('templates.admin')

@section('content')
<link href="{{ asset('admin-assets/vendors/bower_components/dropify/dist/css/dropify.min.css') }}" rel="stylesheet" type="text/css"/>
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
                        <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary txt-light" id="modal-head">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">×</button>
                                        <h5 class="modal-title font-20 ">Add Payment Method</h5>
                                    </div>
                                    <form action="{{ route('admin.payment-methods.store') }}"  data-toggle="validator" role="form" method="POST" enctype="multipart/form-data">
                                        @csrf
                                    <div class="modal-body">
                                            <div class="form-group">
                                                <label for="recipient-name" class="control-label mb-10">Method Name:</label>
                                                <input type="text" class="form-control" name="name" placeholder="Enter name: Bitcoin" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="method_address" class="control-label mb-10">Wallet Addrress:</label>
                                                <input type="text" class="form-control" name="address" placeholder="Enter waller address 32 character long" required>

                                            </div>

                                            <div class="form-group">
                                                <div class="panel-wrapper collapse in">
                                                    <div class="panel-body">
                                                        <p class="text-dark" id="payment_method_label">Attach Payment Logo Here.</p>
                                                        <div class="mt-10">
                                                            <input type="file" id="input-file-now" name="image" class="dropify" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary btn-rounded" id="save_payment_method">Save Method</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary btn-rounded btn-lable-wrap" data-toggle="modal"
                            data-target="#responsive-modal" id="add-payment-method"><span class="btn-text">Add Payment</button>

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
                                            <th class="hd">Logo</th>
                                            <th class="hd">Name</th>
                                            <th class="hd">Address</th>
                                            <th class="hd">Status</th>
                                            <th class="hd">Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Logo</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody id="tbody">

                                        @foreach ($methods as $pay)
                                            <tr>
                                                <td><img src="{{ asset('uploads/'.$pay['image'] ) }} " width="40" alt=""></td>
                                                <td>{{ $pay['name'] }}</td>
                                                <td>{{ $pay['address'] }}</td>
                                                @if ($pay['active'] =="1" )
                                                    <td> <span class="label label-success">Active</span></td>

                                                @else
                                                    <td> <span class="label label-danger">Deactivated</span> </td>

                                                @endif


                                                <td><a href="#" class="edit-payment-method" action="{{ route('admin.payment-methods.update', $pay['id']  ) }}" id="{{ $pay['id'] }}" image="{{ asset('uploads/'.$pay['image'] ) }}" active="{{ $pay['active'] }}"  name="{{ $pay['name'] }}" address="{{ $pay['address'] }}" > <button
                                                    data-toggle="modal"
                                                    data-target="#update-modal" class="btn btn-warning btn-rounded btn-lable-wrap right-label"><i class="fa fa-pencil"></i>
                                                            </span></button></a> | <button onclick="event.preventDefault();
                                                            document.getElementById('delete_user_from-{{ $pay['id'] }}').submit()"  class="btn btn-danger btn-rounded btn-lable-wrap right-label"><i class="fa fa-trash"></i>
                                                                    </span></button>
                                                     </td>

                                                {{-- DELETE METHOD CALL --}}
                                                <form id="delete_user_from-{{ $pay['id'] }}"
                                                action="{{ route('admin.payment-methods.destroy', $pay['id']  ) }}" method="POST" style="display: none">
                                                @csrf
                                                @method('delete')
                                                </form>

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
    </div>
    <!-- /Row -->


    <div id="update-modal" class="modal fade" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary txt-light" id="modal-head">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">×</button>
                                        <h5 class="modal-title font-20 ">Update Payment Method</h5>
                                    </div>
                                    <form action="{{ route('admin.payment-methods.store') }}" id="update_payment_method_form"  data-toggle="validator" role="form" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                    <div class="modal-body">
                                            <div class="form-group">
                                                <label for="recipient-name" class="control-label mb-10">Method Name:</label>
                                                <input type="text" class="form-control" name="name" placeholder="Enter name: Bitcoin" id="method_name" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="method_address" class="control-label mb-10">Wallet Addrress:</label>
                                                <input type="text" class="form-control" name="address" placeholder="Enter waller address 32 character long" id="method_address" required>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-2"></div>
                                                <div class="col-md-4">
                                                    <div class="form-group text-center">
                                                        <br>
                                                        <br>
                                                        <button type="button" class="btn btn-success btn-rounded" active="" id="setPaymentMethodActive">Enable Method</button>
                                                        <input type="text" class="form-control" name="active"  id="paymentMethodActiveTXT" value=""  style="display: none">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group text-center">
                                                        <img src="" width="100" alt="" srcset="" id="payment_method_image" >
                                                    </div>

                                                </div>
                                                <div class="col-md-2"></div>
                                            </div>

                                            <div class="form-group">
                                                <div class="panel-wrapper collapse in">
                                                    <div class="panel-body">
                                                        <p class="text-dark" id="payment_method_label">Update Payment Logo Here.</p>
                                                        <div class="mt-10">
                                                            <input type="file" id="input-file-now" name="image" class="dropify" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    </div>
                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary btn-rounded" >Update Method</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
@endsection


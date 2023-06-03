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
                                    <div class="modal-header bg-primary txt-light">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">×</button>
                                        <h5 class="modal-title font-20">Add Withdrawal Method</h5>
                                    </div>
                                    <form action="{{ route('admin.withdrawal-method.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="recipient-name" class="control-label mb-10">Method Name:</label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Enter name: Bitcoin" id="method_name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="currency_code" class="control-label mb-10">Method Code:</label>
                                                    <select name="currency_code" id="currency_code" class="form-control" required>
                                                        <option value="">Select Currency Code</option>
                                                        <option value="BTC">Bitcoin (BTC)</option>
                                                        <option value="ETH">Ethereum (ETH)</option>
                                                        <option value="LTC">Litecoin (LTC)</option>
                                                        <option value="DASH">Dash (DASH)</option>
                                                        <option value="TZEC">Zcash (TZEC)</option>
                                                        <option value="DOGE">Dogecoin (DOGE)</option>
                                                        <option value="BCH">Bitcoin Cash (BCH)</option>
                                                        <option value="XMR">Monero (XMR)</option>
                                                        <option value="USDT">Tether (USDT)</option>
                                                    </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name" class="control-label mb-10">Fixed Charge
                                                    $:</label>
                                                <input type="decimal" class="form-control" name="charges"
                                                    placeholder="Enter charge: $5" id="fixed_charge">
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name" class="control-label mb-10">Minimum Amount
                                                    $:</label>
                                                <input type="text" class="form-control" name="min_amt"
                                                    placeholder="Enter Amount: $50" id="min_amt" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="method_address" class="control-label mb-10">Maximum Amount
                                                    $:</label>
                                                <input type="text" class="form-control" name="max_amt"
                                                    placeholder="Enter Amount: $5000" id="max_amt" required>
                                            </div>
                                            <div class="form-group">
                                                <div class="panel-wrapper collapse in">
                                                    <div class="panel-body">
                                                        <p class="text-dark" id="payment_method_label">Attach  Logo Here.</p>
                                                        <div class="mt-10">
                                                            <input type="file" id="input-file-now" name="image" class="dropify" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-rounded"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary btn-rounded">Save Method</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary btn-rounded btn-lable-wrap" data-toggle="modal"
                            data-target="#responsive-modal"><span class="btn-text">Add Method</button>

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
                                            <th class="hd">Name</th>
                                            <th class="hd">Fixed Charges</th>
                                            <th class="hd">Minimum Amount</th>
                                            <th class="hd">Maximum Amount</th>
                                            <th class="hd">Status</th>
                                            <th class="hd">Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Img</th>
                                            <th>Name</th>
                                            <th>Fixed Charges</th>
                                            <th>Minimum Amount</th>
                                            <th>Maximum Amount</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($methods as $met)
                                            <tr>
                                                <td><img src="{{ asset('uploads/'.$met['image'] ) }} " width="40" alt=""></td>
                                                <td>{{ $met['name'] }}</td>
                                                <td>{{ $met['charges'] }}</td>
                                                <td>{{ $met['min_amt'] }}</td>
                                                <td>{{ $met['max_amt'] }}</td>
                                                @if ($met['active'] == true)
                                                    <td> <span class="label label-success">Active</span></td>
                                                @else
                                                    <td> <span class="label label-danger">Deactivated</span> </td>
                                                @endif

                                                <td><a href="#" data-toggle="modal"
                                                        data-target="#update-modal{{ $met['id'] }}"> <button
                                                            class="btn btn-warning btn-rounded ">
                                                            <span class="btn-label"><i class="fa fa-pencil"></i>
                                                            </span></button>
                                                    </a> | <button
                                                        onclick="event.preventDefault();
                                                        document.getElementById('delete_user_from-{{ $met['id'] }}').submit()"
                                                        class="btn btn-danger btn-rounded btn-lable-wrap right-label"><i
                                                            class="fa fa-trash"></i>
                                                        </span></button></td>
                                                <form id="delete_user_from-{{ $met['id'] }}"
                                                    action="{{ route('admin.withdrawal-method.destroy', $met['id']) }}"
                                                    method="POST" style="display: none">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </tr>


                                            <!-- /.Update modal -->
                                            <div id="update-modal{{ $met['id'] }}" class="modal fade" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                                style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary txt-light">
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h5 class="modal-title font-20">Update Withdrawal Method</h5>
                                                        </div>
                                                        <form
                                                            action="{{ route('admin.withdrawal-method.update', $met['id']) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('put')
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="recipient-name"
                                                                        class="control-label mb-10">Method Name:</label>
                                                                    <input type="text" class="form-control" name="name"
                                                                        placeholder="Enter name: Bitcoin"
                                                                        value="{{ $met['name'] }}" id="method_name" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="currency_code" class="control-label mb-10">Method Code:</label>
                                                                        <select name="currency_code" id="currency_code" class="form-control" required>
                                                                            <option value="">Select Currency Code</option>
                                                                            <option value="BTC">Bitcoin (BTC)</option>
                                                                            <option value="ETH">Ethereum (ETH)</option>
                                                                            <option value="LTC">Litecoin (LTC)</option>
                                                                            <option value="DASH">Dash (DASH)</option>
                                                                            <option value="TZEC">Zcash (TZEC)</option>
                                                                            <option value="DOGE">Dogecoin (DOGE)</option>
                                                                            <option value="BCH">Bitcoin Cash (BCH)</option>
                                                                            <option value="XMR">Monero (XMR)</option>
                                                                            <option value="USDT">Tether (USDT)</option>
                                                                        </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="recipient-name"
                                                                        class="control-label mb-10">Fixed Charge $:</label>
                                                                    <input type="decimal" class="form-control"
                                                                        name="charges" placeholder="Enter charge: $5"
                                                                        value="{{ $met['charges'] }}" id="fixed_charge" required>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="recipient-name"
                                                                            class="control-label mb-10">Minimum Amount
                                                                            $:</label>
                                                                        <input type="text" class="form-control"
                                                                            name="min_amt" placeholder="Enter Amount: $50"
                                                                            value="{{ $met['min_amt'] }}" id="min_amt" required>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="active"
                                                                            class="control-label mb-10">Activate /
                                                                            Deactivate</label>
                                                                        <select name="active" class="form-control" id="">
                                                                            <option value="1">Activate</option>
                                                                            <option value="0">Deactivate</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="method_address"
                                                                        class="control-label mb-10">Maximum Amount
                                                                        $:</label>
                                                                    <input type="text" class="form-control" name="max_amt"
                                                                        placeholder="Enter Amount: $5000"
                                                                        value="{{ $met['max_amt'] }}" id="max_amt" required>
                                                                </div>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default btn-rounded"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-rounded">Update
                                                                    Method</button>
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

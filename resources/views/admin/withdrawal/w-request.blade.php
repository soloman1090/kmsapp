@extends('templates.admin')

@section('content')


<!-- Row -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    @if($single=="true")
                    <a href="/admin/withdrawal-request" class="btn btn-success">All Withdrawals</a>
                    @endif
                </div>
                <div class="pull-right">
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
                                        <th class="hd">S/N </th>
                                        <th class="hd">Name</th>
                                        <th class="hd">Email</th>
                                        <th class="hd">Method</th>
                                        <th class="hd">Amount</th>
                                        <th class="hd">Address</th>
                                        <th class="hd">Type</th>
                                        <th class="hd"> key</th>
                                        <th class="hd">Date</th>
                                        <th class="hd">Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>S/N </th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Method</th>
                                        <th>Paid</th>
                                        <th>Address</th>
                                        <th>Type</th>
                                        <th> key</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($withdrawals as $key=> $with)
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td><a href="/admin/withdrawal-request?user_id={{ $with['user_id'] }}">{{ $with['username'] }}</a></td>
                                        <td>{{ $with['email'] }}</td>
                                        <td>{{ $with['methodname'] }}</td>
                                        <td>${{ $with['amount_paid'] }}</td>
                                        <td>{{ $with['wallet_address'] }}</td>
                                        <td>{{ $with['wallet_type'] }}</td>
                                        <td>{{ $with['approval_key'] }}</td>
                                        <td>{{ $with['date'] }}</td>
                                        <td>
                                            <div class="dropdown show-on-hover">
                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                    Action <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">


                                                    <li><a href="#" onclick="event.preventDefault(); document.getElementById('approve_withdrawal_from-{{ $with['request_id'] }}').submit()">Approve Request</a></li>
                                                    <li><a href="#" data-toggle="modal" data-target="#delete-modal{{ $with['request_id'] }}">Delete With Reason</a></li>
                                                    <li><a href="#" onclick="event.preventDefault(); document.getElementById('delete_withdrawal_from-{{ $with['request_id'] }}').submit()">Just Delete</a></li>


                                                </ul>
                                            </div>
                                        </td>
                                        <form id="approve_withdrawal_from-{{ $with['request_id'] }}" action="{{ route('admin.withdrawal-request.update', $with['request_id'] ) }}" method="POST" style="display: none">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="amount_paid" value="{{ $with['amount_paid'] }}">
                                            <input type="hidden" name="amount_credited" value="{{ $with['amount_credited'] }}">
                                            <input type="hidden" name="wallet_address" value="{{ $with['wallet_address'] }}">
                                            <input type="hidden" name="methodname" value="{{ $with['methodname'] }}">
                                            <input type="hidden" name="wallet_type" value="{{ $with['wallet_type'] }}">
                                            <input type="hidden" name="email" value="{{ $with['email'] }}">
                                            <input type="hidden" name="username" value="{{ $with['username'] }}">
                                            <input type="hidden" name="user_id" value="{{ $with['user_id'] }}">
                                            <input type="hidden" name="currency_code" value="{{ $with['currency_code'] }}">
                                        </form>
                                        <form id="delete_withdrawal_from-{{ $with['request_id'] }}" action="{{ route('admin.withdrawal-request.destroy', $with['request_id'] ) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                        </form>


                                        <div id="delete-modal{{ $with['request_id'] }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning txt-light" style="background-color: #EE826D">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h5 class="modal-title font-20">Delete Request?</h5>
                                                    </div>
                                                    <form id="delete_withdrawal_from-{{ $with['request_id'] }}" action="{{ route('admin.withdrawal-request.destroy', $with['request_id'] ) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="hidden" name="amount_paid" value="{{ $with['amount_paid'] }}">
                                                        <input type="hidden" name="amount_credited" value="{{ $with['amount_credited'] }}">
                                                        <input type="hidden" name="wallet_address" value="{{ $with['wallet_address'] }}">
                                                        <input type="hidden" name="methodname" value="{{ $with['methodname'] }}">
                                                        <input type="hidden" name="wallet_type" value="{{ $with['wallet_type'] }}">
                                                        <input type="hidden" name="email" value="{{ $with['email'] }}">
                                                        <input type="hidden" name="username" value="{{ $with['username'] }}">
                                                        <input type="hidden" name="user_id" value="{{ $with['user_id'] }}">
                                                        <input type="hidden" name="currency_code" value="{{ $with['currency_code'] }}">
                                                        <div class="modal-body">
                                                            <h4>Are you sure you want to delete this request?</h4> <br>
                                                            <div class="form-group">
                                                                <div class="col-lg-10">
                                                                    <input type="text" placeholder="Enter Reason" name="message" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger btn-rounded">Delete Request
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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

@endsection

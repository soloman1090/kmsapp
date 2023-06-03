@extends('templates.admin')

@section('content')
<!-- Row -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <a href="users-investments" class="btn btn-success">Show All Investments</a>
                </div>
                <div class="pull-right">
                    <a href="#myModal" data-toggle="modal" title="Compose" class="btn btn-success btn-block">
                        Create Investment
                    </a>
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

                                        <th class="hd">S/N</th>
                                        <th class="hd">Name</th>
                                        <th class="hd">Package</th>
                                        <th class="hd">Date</th>
                                        <th class="hd">Amount</th>
                                        <th class="hd">Duration</th>
                                        <th class="hd">ROI</th>
                                        <th class="hd">Payout</th>
                                        <th class="hd">Payment ID</th>
                                        <th class="hd">Status</th>
                                        <th class="hd">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Package</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Duration</th>
                                        <th>ROI</th>
                                        <th>Payout</th>
                                        <th>Wallet Hash</th>
                                        <th>Action</th>
                                        <th>Status</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($investments as $key => $invest)
                                    <tr>
                                        <td scope="row">{{ $key }}</td>
                                        <td><a href="users-investments?user_id={{ $invest['user_id'] }}">{{ $invest['username'] }} <br> <small style="font-size: 10px">({{ $invest['email'] }})</small></a>
                                        </td>
                                        <td>{{ $invest['packagename'] }}</td>
                                        <td>{{ $invest['date'] }}</td>
                                        <td>${{ $invest['amount'] }}</td>
                                        <td>{{ $invest['duration'] }}</td>
                                        <td>${{ $invest['returns'] }}</td>
                                        <td>{{ $invest['payout'] }}</td>
                                        @if ($invest['wallet_id']==null)
                                        <td>Wallet </td>
                                        @else
                                        <td>{{ $invest['wallet_id'] }}</td>
                                        @endif
                                        {{-- action area --}}
                                        <td>
                                            <div class="dropdown show-on-hover">
                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                    Action <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    @if ($priviledge=="admin")
                                                    @if ($invest['status'] != 'completed' && $invest['status'] != 'mismatch')
                                                    <li><a href="#" onclick="event.preventDefault();
                                                            document.getElementById('activatePortfolio-{{ $invest['id'] }}').submit()">Activate
                                                            Portfolio</a></li>
                                                    @endif

                                                    <li><a href="#editModal{{ $invest['id'] }}" data-toggle="modal">Edit Investment</a></li>
                                                    @if ($invest['status'] != 'dormant')
                                                    <li><a href="#completeModal{{ $invest['id'] }}" data-toggle="modal">Return Capital</a></li>
                                                    @endif
                                                    <li><a href="#" data-toggle="modal" data-target="#delete_investment_from-{{ $invest['id'] }}">Delete
                                                            Investment</a></li>
                                                    @endif

                                                </ul>
                                            </div>
                                        </td>
                                        {{-- status Area --}}
                                        @if ($invest['status'] == 'completed' || $invest['status'] == 'mismatch')
                                        <td> <span class="label label-success">Active</span></td>
                                        @elseif ($invest['status'] == 'pending')
                                        <td> <span class="label label-warning">Pending</span></td>
                                        @elseif ($invest['status'] == 'expired')
                                        <td> <span class="label label-danger">Expired</span></td>
                                        @elseif ($invest['status'] == 'error')
                                        <td> <span class="label label-danger">Payment Error</span></td>
                                        @elseif ($invest['status'] == 'cancelled')
                                        <td> <span class="label label-danger">Payment Cancelled</span></td>
                                        @else
                                        <td> <span class="label label-danger">{{ $invest['status'] }}</span>
                                        </td>
                                        @endif


                                        <form id="activatePortfolio-{{ $invest['id'] }}" action="{{ route('admin.users-investments.update', $invest['id']) }}" method="POST" style="display: none">
                                            @csrf
                                            @method('put')
                                        </form>
                                        {{-- Block Account End --}}  

                                        <div id="completeModal{{ $invest['id'] }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning txt-light" style="background-color: #0e84d3">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h5 class="modal-title font-20">Return Capital?</h5>
                                                    </div>
                                                    <form id="" action="{{ route('admin.users-investments.update', $invest['id']) }}" method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <div class="modal-body">
                                                            <input type="hidden" value="{{ $invest['user_id'] }}" name="user_id" />
                                                            <input type="hidden" value="return_capital" name="update" />
                                                            <h4>Are you sure you want to return capital this investment?</h4>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger btn-rounded">Confirm
                                                                Action
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="delete_investment_from-{{ $invest['id'] }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning txt-light" style="background-color: #EE826D">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h5 class="modal-title font-20">Delete Activity?</h5>
                                                    </div>
                                                    <form id="" action="{{ route('admin.users-investments.destroy', $invest['id']) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <div class="modal-body">
                                                            <input type="hidden" value="{{ $invest['user_id'] }}" name="user_id" />
                                                            <h4>Are you sure you want to delete this investment?</h4>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger btn-rounded">Delete
                                                                Investment
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </tr>


                                    <!-- Modal -->
                                    <div aria-hidden="true" role="dialog" tabindex="-1" id="editModal{{ $invest['id'] }}" class="modal fade" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                    <h4 class="modal-title">Update Investment</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form role="form" class="form-horizontal" method="POST" action="{{ route('admin.users-investments.update', $invest['id']) }}">
                                                        @csrf
                                                        @method('put')
                                                        <div class="form-group investGroup">
                                                            <label class="col-lg-2 control-label">User</label>
                                                            <div class="col-lg-10">
                                                                <select name="user_id" id="user_id" class="form-control">
                                                                    <option value="">Select User</option>
                                                                    @foreach ($users as $key => $user)
                                                                    @if ($invest['user_id'] == $user->user_id)
                                                                    <option selected value="{{ $user->user_id }}">
                                                                        ({{ $user->user_id }})-:{{ $user->name }}-{{ $user->email }}
                                                                    </option>
                                                                    @else
                                                                    <option value="{{ $user->user_id }}">
                                                                        ({{ $user->user_id }})-:{{ $user->name }}-{{ $user->email }}
                                                                    </option>
                                                                    @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <br>
                                                        <div class="form-group investGroup">
                                                            <label class="col-lg-2 control-label">Package</label>
                                                            <div class="col-lg-10">
                                                                <select name="package_id" id="package_id" class="form-control">
                                                                    <option value="">Select Package</option>
                                                                    @foreach ($packages as $key => $pack)
                                                                    @if ($invest['package_id'] == $pack->id)
                                                                    <option selected value="{{ $pack->id }}">
                                                                        ({{ $key + 1 }})-{{ $pack->name }}
                                                                    </option>
                                                                    @else
                                                                    <option value="{{ $pack->id }}">
                                                                        ({{ $key + 1 }})-{{ $pack->name }}
                                                                    </option>
                                                                    @endif
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                        </div>
                                                        <br>
                                                        <br>

                                                        <div class="form-group ">
                                                            <label class="col-lg-2 control-label">Payout</label>
                                                            <div class="col-lg-10">
                                                                <select name="payout" class="form-control" id="payout" required>
                                                                    <option value="">Select Payout</option>
                                                                    <option value="daily_payout" @if ($invest['payout']=='daily_payout' ) selected @endif>
                                                                        Daily Payout</option>
                                                                    <option value="monthly_payout" @if ($invest['payout']=='monthly_payout' ) selected @endif>
                                                                        Monthly Payout</option>
                                                                    <option value="6_months_compounding" @if ($invest['payout']=='6_months_compounding' ) selected @endif>
                                                                        6 Months Compounding</option>
                                                                    <option value="7_months_compounding" @if ($invest['payout']=='7_months_compounding' ) selected @endif>
                                                                        7 Months Compounding</option>
                                                                    <option value="8_months_compounding" @if ($invest['payout']=='8_months_compounding' ) selected @endif>
                                                                        8 Months Compounding</option>
                                                                    <option value="9_months_compounding" @if ($invest['payout']=='9_months_compounding' ) selected @endif>
                                                                        9 Months Compounding</option>
                                                                    <option value="10_months_compounding" @if ($invest['payout']=='10_months_compounding' ) selected @endif>
                                                                        10 Months Compounding</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group ">
                                                                    <label class="col-lg-4 control-label">Duration</label>
                                                                    <div class="col-lg-8">
                                                                        <select name="duration" class="form-control" id="duration" required>
                                                                            <option value="">Select Duration
                                                                            </option>
                                                                            <option value="5" @if ($invest['duration']=='5' ) selected @endif>
                                                                                5 Months</option>
                                                                            <option value="6" @if ($invest['duration']=='6' ) selected @endif>
                                                                                6 Months</option>
                                                                            <option value="7" @if ($invest['duration']=='7' ) selected @endif>
                                                                                7 Months</option>
                                                                            <option value="8" @if ($invest['duration']=='8' ) selected @endif>
                                                                                8 Months</option>
                                                                            <option value="9" @if ($invest['duration']=='9' ) selected @endif>
                                                                                9 Months</option>
                                                                            <option value="10" @if ($invest['duration']=='10' ) selected @endif>
                                                                                10 Months</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group ">
                                                                    <label class="col-lg-2 control-label">Status</label>
                                                                    <div class="col-lg-10">
                                                                        <select name="status" class="form-control" id="payout" required>
                                                                            <option value="">Select Status</option>
                                                                            <option value="pending" @if ($invest['status']=='pending' ) selected @endif>
                                                                                Pending</option>
                                                                            <option value="completed" @if ($invest['status']=='completed' ) selected @endif>
                                                                                Completed</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="form-group">
                                                            <label class="col-lg-2 control-label">Payment ID
                                                            </label>
                                                            <div class="col-lg-10">
                                                                <input type="text" placeholder="Enter payment id" value="{{ $invest['txn_id'] }}" name="transaction_id" id="transaction_id" class="form-control">
                                                            </div>
                                                        </div>
                                                        <br> <br>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">Amount</label>
                                                                    <div class="col-lg-8">
                                                                        <input type="text" placeholder="" name="amount" value="{{ $invest['amount'] }}" id="amount" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">Return</label>
                                                                    <div class="col-lg-8">
                                                                        <input type="text" placeholder="" name="return" value="{{ $invest['returns'] }}" id="return" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">Start
                                                                        Date</label>
                                                                    <div class="col-lg-8">
                                                                        <input type="date" placeholder="" value="{{ $invest['start_date'] }}" name="start_date" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">End
                                                                        Date</label>
                                                                    <div class="col-lg-8">
                                                                        <input type="date" placeholder="" value="{{ $invest['end_date'] }}" name="end_date" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="form-group">
                                                            <div class="col-lg-offset-2 col-lg-10">
                                                                <input type="hidden" value="normal_update" name="update">
                                                                <button class="btn btn-success" type="submit">Update
                                                                    Investment</button>
                                                            </div>
                                                        </div>
                                                        <br>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="container">
                                <div class="row">
                                    <div class="col-3">
                                        <h5><b>PAGE VIEWS</b></h5>
                                    </div>
                                    <div class="col">
                                        <h5> <span> {{ $investments->links()}}</span></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /Row -->


<!-- Modal -->
<div aria-hidden="true" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Create Investment</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="form-horizontal" method="POST" action="{{ route('admin.users-investments.store') }}">
                    @csrf
                    <div class="form-group investGroup">
                        <label class="col-lg-2 control-label">User</label>
                        <div class="col-lg-10">
                            <select name="user_id" id="user_id" class="form-control">
                                <option value="">Select User</option>
                                @foreach ($users as $key => $user)
                                <option value="{{ $user->user_id }}">
                                    ({{ $user->user_id }})-:{{ $user->name }}-{{ $user->email }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group investGroup">
                        <label class="col-lg-2 control-label">Package</label>
                        <div class="col-lg-10">
                            <select name="package_id" id="package_id" class="form-control">
                                <option value="">Select Package</option>
                                @foreach ($packages as $key => $pack)
                                <option value="{{ $pack->id }}">({{ $key + 1 }})-{{ $pack->name }}
                                </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="col-lg-4 control-label">Currency</label>
                                <div class="col-lg-8">
                                    <select name="currency" class="form-control" id="currency" required>
                                        <option value="">Select Currency</option>
                                        <option value="BTC">Bitcoin (BTC)</option>
                                        <option value="ETH">Ethereum (ETH)</option>
                                        <option value="LTC">Litecoin (LTC)</option>
                                        <option value="DASH">Dash (DASH)</option>
                                        <option value="TZEC">Zcash (TZEC)</option>
                                        <option value="DOGE">Dogecoin (DOGE)</option>
                                        <option value="BCH">Bitcoin Cash (BCH)</option>
                                        <option value="XMR">Monero (XMR)</option>
                                        <option value="TRX">Tron (TRX)</option>
                                        <option value="USDT">Tether (USDT)</option>
                                        <option value="BANK-TRANSFER">BANK-TRANSFER</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="col-lg-4 control-label">Payout</label>
                                <div class="col-lg-8">
                                    <select name="payout" class="form-control" id="payout" required>
                                        <option value="">Select Payout</option>
                                        <option value="daily_payout">Daily Payout</option>
                                        <option value="monthly_payout">Monthly Payout</option>
                                        <option value="6_months_compounding">6 Months Compounding</option>
                                        <option value="7_months_compounding">7 Months Compounding</option>
                                        <option value="8_months_compounding">8 Months Compounding</option>
                                        <option value="9_months_compounding">9 Months Compounding</option>
                                        <option value="10_months_compounding">10 Months Compounding</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="col-lg-4 control-label">Duration</label>
                                <div class="col-lg-8">
                                    <select name="duration" class="form-control" id="duration" required>
                                        <option value="">Select Duration</option>
                                        <option value="5">5 Months</option>
                                        <option value="6">6 Months</option>
                                        <option value="7">7 Months</option>
                                        <option value="8">8 Months</option>
                                        <option value="9">9 Months</option>
                                        <option value="10">10 Months</option>
                                        <option value="102">11 Months</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="col-lg-4 control-label">Status</label>
                                <div class="col-lg-8">
                                    <select name="status" class="form-control" id="payout" required>
                                        <option value="">Select Status</option>
                                        <option value="pending">Pending</option>
                                        <option value="completed">Completed</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Payment ID</label>
                        <div class="col-lg-10">
                            <input type="text" placeholder="Enter payment id" name="transaction_id" id="transaction_id" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Amount</label>
                                <div class="col-lg-8">
                                    <input type="text" placeholder="" name="amount" id="amount" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Return</label>
                                <div class="col-lg-8">
                                    <input type="text" placeholder="" name="return" id="return" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Start Date</label>
                                <div class="col-lg-8">
                                    <input type="date" placeholder="" name="start_date" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-lg-4 control-label">End Date</label>
                                <div class="col-lg-8">
                                    <input type="date" placeholder="" name="end_date" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-success" type="submit">Create Investment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection

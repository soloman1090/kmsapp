@extends('templates.admin')

@section('content')
<!-- Row -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <a href="reinvestments" class="btn btn-success">Show All Investments</a>
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

                                        <th class="hd">S/N</th>
                                        <th class="hd">Name</th>
                                        <th class="hd">Package</th>
                                        <th class="hd">Date</th>
                                        <th class="hd">Reinvestment Amount</th>
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
                                        <th>Reinvestment Amount</th>
                                        <th>Wallet Hash</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($investments as $key=> $invest)
                                    <tr>
                                        <td scope="row">{{ $key }}</td>
                                        <td><a href="reinvestments?user_id={{ $invest['user_id'] }}">{{ $invest['username'] }} <br /><small style="font-size: 10px">({{ $invest['email'] }})</small></a></td>
                                        <td>{{ $invest['packagename'] }}</td>
                                        <td>{{ $invest['date'] }}</td>
                                        <td>${{ $invest['topup_amount'] }}</td>
                                        @if ($invest['wallet_id']==null)
                                        <td>Wallet </td>
                                        @else
                                        <td>{{ $invest['wallet_id'] }}</td>
                                        @endif
                                        @if ($invest['status']=="completed" || $invest['status']=="mismatch")
                                        <td> <span class="label label-success">Active</span></td>
                                        @elseif ($invest['status']=="pending" )
                                        <td> <span class="label label-warning">Pending</span></td>
                                        @elseif ($invest['status']=="expired" )
                                        <td> <span class="label label-danger">Expired</span></td>
                                        @elseif ($invest['status']=="error" )
                                        <td> <span class="label label-danger">Payment Error</span></td>
                                        @elseif ( $invest['status']=="cancelled" )
                                        <td> <span class="label label-danger">Payment Cancelled</span></td>
                                        @else
                                        <td> <span class="label label-danger">{{ $invest['status'] }}</span></td>
                                        @endif
                                        <td>
                                            @if ($invest['status']!="completed" && $invest['status']!="mismatch")
                                            <div class="dropdown show-on-hover">
                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                    Action <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">


                                                    <li><a href="#" onclick="event.preventDefault();
                                                            document.getElementById('activatePortfolio-{{ $invest['id'] }}').submit()">Activate Portfolio</a></li>
                                                     <li><a href="#" data-toggle="modal"
                                                        data-target="#approve_investment_from-{{ $invest['id'] }}">Just Approve</a></li>
                                                    <li><a href="#" onclick="event.preventDefault();
                                                                document.getElementById('delete_investment_from-{{ $invest['id'] }}').submit()">Delete Investment</a></li>


                                                </ul>
                                            </div>
                                            @endif
                                        </td>


                                        <form id="activatePortfolio-{{ $invest['id'] }}" action="{{ route('admin.reinvestments.update', $invest['id'] ) }}" method="POST" style="display: none">
                                            @csrf
                                            @method('put')
                                        </form>
                                        {{-- Block Account End --}}

                                        <form id="delete_investment_from-{{ $invest['id'] }}" action="{{ route('admin.reinvestments.destroy', $invest['id'] ) }}" method="POST" style="display: none">
                                            @csrf
                                            @method('delete')
                                        </form>

                                        <div id="approve_investment_from-{{ $invest['id'] }}" class="modal fade"
                                        tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                        style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning txt-light"
                                                    style="background-color: #EE826D">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                    <h5 class="modal-title font-20">Approve Transaction?</h5>
                                                </div>
                                                <form id=""
                                                action="{{ route('admin.reinvestments.update', $invest['id'] ) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-body">
                                                        <input type="hidden" value="{{ $invest['user_id'] }}" name="user_id"/>
                                                        <input type="hidden" value="activate" name="activate">
                                                        <h4>Please note that this has not been confirmed...Are you sure you want to Approve this investment?</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default btn-rounded"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger btn-rounded">Approve
                                                            Investment
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

@endsection

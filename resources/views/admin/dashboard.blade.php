@extends('templates.admin')

@section('content')

<div class="pt-25">
    <!-- Row -->
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                        <div class="sm-data-box">
                            <div class="container-fluid">
                                <a href="{{ route('admin.users.index') }}" class="text-dark">
                                <div class="row">
                                    <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                        <span class="txt-dark block counter"><span class="counter-anim">{{$users}}</span></span>
                                        <span class="weight-500 uppercase-font block font-16 txt-primary">Total Users</span>
                                    </div>
                                    <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                        <i class="icon-people data-right-rep-icon txt-dark"></i>
                                    </div>
                                </div>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                        <div class="sm-data-box">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                        <span class="txt-dark block counter"><span class="counter-anim">{{ $blockedUsers }}</span></span>
                                        <span class="weight-500 uppercase-font block txt-primary">Users Blocked</span>
                                    </div>
                                    <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                        <i class=" icon-user-unfollow data-right-rep-icon txt-dark"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                        <div class="sm-data-box">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                        <span class="txt-dark block counter">$<span class="counter-anim">119,235</span></span>
                                        <span class="weight-500 uppercase-font block txt-primary">Total Balance</span>
                                    </div>
                                    <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                        <i class="icon-wallet data-right-rep-icon txt-dark"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <a href="/admin/users-investments">
                        <div class="panel-body pa-0">
                            <div class="sm-data-box">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                            <span class="txt-dark block counter">$<span class="counter-anim">{{ $totalInvested }}</span></span>
                                            <span class="weight-500 uppercase-font block txt-primary">Total Invested</span>
                                        </div>
                                        <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                            <i class=" icon-briefcase data-right-rep-icon txt-dark"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->

     <!-- Row -->
     <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                        <div class="sm-data-box">
                            <div class="container-fluid">

                                <a href="/admin/investment-packages">
                                    <div class="row">
                                        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                            <span class="txt-dark block counter"><span class="counter-anim">{{ $packages }}</span></span>
                                            <span class="weight-500 uppercase-font block font-13 txt-primary">All Packages</span>
                                        </div>
                                        <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                            <i class="icon-present data-right-rep-icon txt-dark"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                        <div class="sm-data-box">
                            <div class="container-fluid">
                               <a href="/admin/withdrawal-history">
                                <div class="row">
                                    <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                        <span class="txt-dark block counter"><span class="counter-anim">{{ $withdrawals }}</span></span>
                                        <span class="weight-500 uppercase-font block txt-primary">Total Withdrawal</span>
                                    </div>
                                    <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                        <i class="icon-credit-card data-right-rep-icon txt-dark"></i>
                                    </div>
                                </div>
                               </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                        <div class="sm-data-box">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                        <span class="txt-dark block counter">$<span class="counter-anim">{{ $totalWithdrawn }}</span></span>
                                        <span class="weight-500 uppercase-font block txt-primary">Total Withdrawn</span>
                                    </div>
                                    <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                        <i class="icon-docs data-right-rep-icon txt-dark"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                        <div class="sm-data-box">
                            <div class="container-fluid">
                                <a href="/admin/payment-methods">
                                    <div class="row">
                                        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                            <span class="txt-dark block counter"><span class="counter-anim">{{ $payment_methods }}</span></span>
                                            <span class="weight-500 uppercase-font block txt-primary">Payment Methods</span>
                                        </div>
                                        <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                            <i class="  icon-layers data-right-rep-icon txt-dark"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->



<!-- Row -->
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="panel panel-default card-view panel-refresh">
            <div class="refresh-container">
                <div class="la-anim-1"></div>
            </div>
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Recent Registrations</h6>
                </div>
                <div class="pull-right">

                    <a href="#" class="pull-left inline-block full-screen mr-15">
                        <i class="zmdi zmdi-fullscreen"></i>
                    </a>
                    <a href="/admin/users" class="pull-left inline-block mr-15">
                        <i class="zmdi zmdi-eye"></i>
                    </a>

                </div>
                <div class="clearfix"></div>
            </div>
            @if (count($recentUsers)>0)
            <div class="panel-wrapper collapse in">
                <div class="panel-body row pa-0">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>User Name </th>
                                        <th>Emails</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentUsers as $key=> $user)
                                    @if($user->email!="admin1@test.com")

                                    <tr>
                                        <td><span class="txt-dark weight-800">{{ $user->name }} {{ $user->last_name }}</span></td>
                                        <td>{{ $user->email }}</td>
                                        <td><a href="#" onclick="event.preventDefault();
                                            document.getElementById('approve_user_account-{{ $user->user_id }}').submit()" class="btn-sm btn-primary">Approve</a>
                                            <form id="approve_user_account-{{ $user->user_id }}"
                                                action="{{ route('admin.users.update', $user->user_id) }}"
                                                method="POST" style="display: none">
                                                @csrf
                                                @method('put')
                                                <input type="text" name="approve" value="approved" >
                                            </form>

                                        </td>
                                    </tr>
                                    @endif

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="text-center"><h1>No New Registrations Yet</h1></div>
            @endif

        </div>
    </div>

    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="panel panel-default card-view panel-refresh">
            <div class="refresh-container">
                <div class="la-anim-1"></div>
            </div>
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Recent Withdrawals</h6>
                </div>
                <div class="pull-right">

                    <a href="#" class="pull-left inline-block full-screen mr-15">
                        <i class="zmdi zmdi-fullscreen"></i>
                    </a>
                    <a href="/admin/withdrawal-request" class="pull-left inline-block mr-15">
                        <i class="zmdi zmdi-eye"></i>
                    </a>

                </div>
                <div class="clearfix"></div>
            </div>
            @if (count($recentWithdrawals)>0)
            <div class="panel-wrapper collapse in">
                <div class="panel-body row pa-0">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Type</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentWithdrawals as $key=> $with)
                                    <tr>
                                        <td>{{ $with['username'] }}</td>
                                        <td class="text-success">${{ $with['amount_paid'] }}</td>
                                        <td>{{ $with['wallet_type'] }}</td>
                                        <td>{{ $with['wallet_address'] }}</td>
                                        @if ($with['approved']==true)
                                        <td > <span class="label label-success">Aproved</span></td>
                                        @else
                                        <td > <span class="label label-danger">Not Aproved</span> </td>
                                        @endif

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="text-center">
                <h1> Recent Withdrawal Request yet</h1>
            </div>
            @endif
        </div>
    </div>

</div>
<!-- Row -->

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-default card-view panel-refresh">
            <div class="refresh-container">
                <div class="la-anim-1"></div>
            </div>
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Recent Payments</h6>
                </div>
                <div class="pull-right">

                    <a href="#" class="pull-left inline-block full-screen mr-15">
                        <i class="zmdi zmdi-fullscreen"></i>
                    </a>
                    <a href="/admin/users-investments" class="pull-left inline-block mr-15">
                        <i class="zmdi zmdi-eye"></i>
                    </a>

                </div>
                <div class="clearfix"></div>
            </div>
            @if (count($recentInvestments)>0)
            <div class="panel-wrapper collapse in">
                <div class="panel-body row pa-0">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Package</th>
                                        <th>Amount</th>
                                        <th>ROI</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentInvestments as $key=> $invest)
                                    <tr>
                                        <td><a href="users-investments?user_id={{ $invest['user_id'] }}">{{ $invest['username'] }}</a></td>
                                        <td>{{ $invest['packagename'] }}</td>
                                        <td class="text-success">${{ $invest['amount'] }}</td>
                                        <td class="text-success">${{ $invest['returns'] }}</td>
                                        <td>{{ $invest['date'] }}</td>
                                        @if ($invest['status']=="completed"||  $invest['status']=="mismatch")
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
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="text-center">
                <h1> Recent investments yet</h1>
            </div>
            @endif
        </div>
    </div>
</div>
</div>


@endsection


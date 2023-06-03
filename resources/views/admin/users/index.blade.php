@extends('templates.admin')

@section('content')

<style>
    .divider {
        width: 100%;
        height: 1px;
        background-color: #eaeaea;
        margin: 10px;
    }

</style>


<!-- Row -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">All Users Datas</h6>
                    <a href="/export-users" class="btn btn-success">Export Users</a>
                </div>

                <div class="pull-right">

                    <label for="">Full Search with email address</label>
                    <form action="{{ route('admin.users.index') }}" method="get">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" name="search" placeholder="name,email,phone" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-success" type="submit">Search</button>
                            </div>
                        </div>
                    </form>

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
                                        <th class="hd">Last Name</th>
                                        <th class="hd">Email</th>
                                        <th class="hd">Phone</th>
                                        <th class="hd">City</th>
                                        <th class="hd">Referred By</th>
                                        <th class="hd">Voyager</th>
                                        <th class="hd">Actions</th>
                                        <th class="hd">Verified</th>
                                        <th class="hd">Status</th>
                                        <th class="hd"></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>City</th>
                                        <th>Referred By</th>
                                        <th>Voyager</th>
                                        <th>Actions</th>
                                        <th>Verified</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($users as $key=> $user)
                                    @if($user->email!="admin1@test.com")
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td>{{ $user->name }}</td>
                                        @if($user->last_name=="subadmin")
                                        <td> <span class="label label-primary">SUB-ADMIN</span></td>
                                        @else
                                        <td>{{ $user->last_name }}</td>
                                        @endif
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->city }}</td>
                                        <td>{{ $user->referred_user['name'] }} ({{ $user->referred_user['email'] }})</td>

                                        {{-- Voyager Status --}}
                                        @if($user->voyager==null)
                                        <td> Regular</td>
                                        @elseif($user->voyager=="pending")
                                        <td> <span class="label label-warning">Pending Activation</span></td>
                                        @elseif($user->voyager=="revoked")
                                        <td> <span class="label label-danger">Voyager Revoked</span></td>
                                        @else
                                        <td> <span class="label label-primary">Voyager</span></td>
                                        @endif
                                        {{-- Voyager Status --}}

                                        <td>
                                            <div class="dropdown show-on-hover">
                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                    Action <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    @if ($priviledge=="admin")
                                                    <li><a href="{{ route('admin.impersonate', $user->user_id ) }}">Login</a></li>
                                                    <li><a href="" data-toggle="modal" data-target="#update-user-modal{{ $user->user_id }}">View User</a></li>
                                                    @if($user->voyager==null )
                                                    <li><a href="" data-toggle="modal" data-target="#make-voyager-modal{{ $user->user_id }}">Make Voyager</a></li>
                                                    @elseif($user->voyager=="pending"|| $user->voyager=="revoked")
                                                    <li><a href="" data-toggle="modal" data-target="#activate-voyager-modal{{ $user->user_id }}">Activate Voyager</a></li>
                                                    @else
                                                    <li><a href="" data-toggle="modal" data-target="#revoke-voyager-modal{{ $user->user_id }}">Revoke Voyager</a></li>
                                                    @endif

                                                    <li><a href="#" onclick="event.preventDefault(); document.getElementById('verify_account-{{ $user->user_id }}').submit()">Verify User</a></li>
                                                    <li><a href="#" onclick="event.preventDefault(); document.getElementById('remove2fa-{{ $user->user_id }}').submit()">Remove 2fa</a></li>
                                                    <li><a href="" data-toggle="modal" data-target="#upline-user-modal{{ $user->user_id }}">Assign Upline</a></li>
                                                    <li><a href="users?downlines={{ $user->user_id }}">Downlines</a></li>
                                                    <li><a href="activities?user_id={{ $user->user_id }}">Activities</a></li>
                                                    <li><a href="reinvestments?user_id={{ $user->user_id }}">Reinvestments</a></li>
                                                    <li><a href="users-investments?user_id={{ $user->user_id }}">Investments</a></li>
                                                    <li><a href="withdrawal-request?user_id={{ $user->user_id }}">Withdrawals</a></li> 

                                                    {{-- @if($user->last_name=="subadmin")
                                                    <li><a href="" data-toggle="modal" data-target="#revoke-subadmin-modal{{ $user->user_id }}">Revoke SubAdmin</a></li>
                                                    @else
                                                    <li><a href="" data-toggle="modal" data-target="#make-subadmin-modal{{ $user->user_id }}">Assign SubAdmin</a></li>
                                                    @endif --}}

                                                    <li><a href="" data-toggle="modal" data-target="#delete-user-modal{{ $user->user_id }}">Delete Account </a></li>
                                                    {{-- account status section --}}
                                                    @if($user->blocked==null)
                                                    <li><a href="#" onclick="event.preventDefault();  document.getElementById('approve_user_account-{{ $user->user_id }}').submit()">Approve Account</a></li>

                                                    @elseif ($user->blocked=="blocked")
                                                    <li><a href="#" onclick="event.preventDefault(); document.getElementById('open_user_account-{{ $user->user_id }}').submit()">Open Account</a></li>
                                                    @else
                                                    <li><a href="#" onclick="event.preventDefault(); document.getElementById('block_user_account-{{ $user->user_id }}').submit()">Block Account</a></li>

                                                    @endif
                                                    {{-- account status section  end --}}

                                                    @else
                                                    <li><a href="users?downlines={{ $user->user_id }}">View Downlines</a></li>
                                                    <li><a href="users-investments?user_id={{ $user->user_id }}">Investments</a></li>
                                                    @endif


                                                    {{-- Block Account  --}}
                                                    <form id="block_user_account-{{ $user->user_id }}" action="{{ route('admin.users.update', $user->user_id) }}" method="POST" style="display: none">
                                                        @csrf
                                                        @method('put')
                                                        <input type="text" name="block" value="block">
                                                    </form>

                                                    {{-- Approve Account --}}
                                                    <form id="approve_user_account-{{ $user->user_id }}" action="{{ route('admin.users.update', $user->user_id) }}" method="POST" style="display: none">
                                                        @csrf
                                                        @method('put')
                                                        <input type="text" name="approve" value="approved">
                                                    </form>


                                                    {{-- Open Account Start --}}
                                                    <form id="open_user_account-{{ $user->user_id }}" action="{{ route('admin.users.update', $user->user_id) }}" method="POST" style="display: none">
                                                        @csrf
                                                        @method('put')
                                                        <input type="text" name="open" value="opened">
                                                    </form>
                                                    {{-- Open Account End --}}


                                                    {{-- verify account button --}}
                                                    <form id="verify_account-{{ $user->user_id }}" action="{{ route('admin.users.update', $user->user_id) }}" method="POST" style="display: none">
                                                        @csrf
                                                        @method('put')
                                                        <input type="text" name="verify" value="verify">
                                                    </form>

                                                    {{-- Remove 2fa account button --}}
                                                    <form id="remove2fa-{{ $user->user_id }}" action="{{ route('admin.users.update', $user->user_id) }}" method="POST" style="display: none">
                                                        @csrf
                                                        @method('put')
                                                        <input type="text" name="remove_2fa" value="remove_2fa">
                                                    </form>
                                                </ul>
                                            </div>

                                        </td>
                                        @if($user->email_verified_at==null)
                                        <td> <span class="label label-warning">Pending</span></td>
                                        @else
                                        <td> <span class="label label-success">Verified</span></td>
                                        @endif

                                        @if($user->blocked==null)
                                        <td> <span class="label label-warning">Pending</span></td>
                                        @elseif ($user->blocked=="blocked")
                                        <td> <span class="label label-danger">Suspended</span></td>
                                        @elseif ($user->blocked=="approved" || $user->blocked=="opened")
                                        <td> <span class="label label-success">Active</span></td>
                                        @endif
                                        <td></td>


                                        <form id="delete_user_from-{{ $user->user_id }}" action="{{ route('admin.users.destroy', $user->user_id) }}" method="POST" style="display: none">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </tr>
                                    @endif

                                    <div id="update-user-modal{{ $user->user_id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary txt-light">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h5 class="modal-title font-20">View And manage
                                                        {{ $user->name }} {{ $user->last_name }} Profile</h5>
                                                </div>
                                                <form data-toggle="validator" id="update_trader_form" action="{{ route('admin.users.update', $user->user_id) }}" role="form" method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-body">
                                                        <input type="hidden" value="account_wallets" name="account_wallets" />
                                                        <div class="row">
                                                            <div class="form-group col-md-12 text-center">
                                                                <label for="trader_name" class="control-label  ">Uploaded Id:</label>
                                                                <img src="{{ $app_url.'/uploads/'.$user->kyc  }}" id="trader_image" style="width:100%; height:100px;  object-fit:contain;" />
                                                            </div>


                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <div class="form-group">
                                                                            <label for="inputAmount">Enter 2fa Code </label>
                                                                            <input type="text" class="form-control 2fa" name="2fa" id="2fa" placeholder="Enter 2fa code">

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <br>
                                                                        <a href="/admin/users?auth=yes" class="btn btn-info">Generate Code</a>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="name" class="control-label">First Name:</label>
                                                                        <input type="text" name="name" value="{{$user->name}}" class="form-control" />

                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="last_name" class="control-label">Last Name:</label>
                                                                        <input type="text" name="last_name" value="{{$user->last_name}}" class="form-control" />
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="phone" class="control-label">Phone:</label>
                                                                        <input type="text" name="phone" value="{{ $user->phone }}" class="form-control" />

                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="city" class="control-label">City:</label>
                                                                        <input type="text" name="city" value="{{$user->city}}" class="form-control" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="state" class="control-label">State:</label>
                                                                        <input type="text" name="state" value="{{ $user->state }}" class="form-control" />

                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="address" class="control-label">Address:</label>
                                                                        <input type="text" name="address" value="{{$user->address}}" class="form-control" />
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="trader_name" class="control-label  ">Email:</label>

                                                                        <input type="email" name="email" value="{{$user->email}}" class="form-control" />

                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="trader_name" class="control-label  ">Referral Code:</label>

                                                                        <input type="text" name="referalcode" value="{{$user->referalcode}}" class="form-control" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="trader_name" class="control-label  ">Main Wallet Balance</label>
                                                                        <input type="decimal" name="main_wallet" value="{{$user->main_wallet}}" class="form-control" />
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="trader_name" class="control-label  ">Compound Balance</label>
                                                                        <input type="decimal" name="compound_wallet" value="{{$user->compound_wallet}}" class="form-control" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary btn-rounded">Update Account
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="upline-user-modal{{ $user->user_id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary txt-light">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h5 class="modal-title font-20">Assign upline to
                                                        {{ $user->name }} {{ $user->last_name }}</h5>
                                                </div>
                                                <form data-toggle="validator" id="update_trader_form" action="{{ route('admin.users.update', $user->user_id) }}" role="form" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('put')

                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-1"></div>
                                                            <div class="col-md-10">
                                                                <input type="hidden" name="user_id" value="{{$user->user_id}}" />
                                                                <input type="hidden" name="upline_update" value="{{$user->user_id}}" />
                                                                <input type="email" name="upline_id" placeholder="Enter Upline Email" class="form-control" />

                                                            </div>
                                                            <div class="col-md-1"></div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary btn-rounded">Assign Upline
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="delete-user-modal{{ $user->user_id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning txt-light" style="background-color: #EE826D">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h5 class="modal-title font-20">Delete User?</h5>
                                                </div>
                                                <form id="" action="{{ route('admin.users.destroy', $user->user_id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <div class="modal-body">
                                                        <h4>Are you sure you want to delete this user account?</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger btn-rounded">Delete Account
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="make-voyager-modal{{ $user->user_id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary txt-light"   >
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h5 class="modal-title font-20">Make Voyager?</h5>
                                                </div>
                                                <form id="" action="{{ route('admin.users.update', $user->user_id) }}" method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-body">
                                                        <h4>Are you sure you want make:  {{ $user->name }} {{ $user->last_name }} A VOYAGER  ?</h4>
                                                        <input type="hidden" name="user_id" value="{{$user->user_id}}" />
                                                        <input type="hidden" name="voyager" value="assign" />
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary btn-rounded">Approve
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="revoke-voyager-modal{{ $user->user_id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning txt-light" style="background-color: #EE826D">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h5 class="modal-title font-20">Revoke Voyager?</h5>
                                                </div>
                                                <form id="" action="{{ route('admin.users.update', $user->user_id) }}" method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-body">
                                                        <h4>Are you sure you want REVOKE  {{ $user->name }} {{ $user->last_name }} VOYAGER ACCOUNT  ?</h4>
                                                        <input type="hidden" name="user_id" value="{{$user->user_id}}" />
                                                        <input type="hidden" name="voyager" value="revoke" />
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger btn-rounded">Revoke
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="activate-voyager-modal{{ $user->user_id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-success txt-light" style="background-color: #4DD4A8">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h5 class="modal-title font-20">Activate Voyager?</h5>
                                                </div>
                                                <form id="" action="{{ route('admin.users.update', $user->user_id) }}" method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-body">
                                                        <h4>Are you sure you want Activate  {{ $user->name }} {{ $user->last_name }} VOYAGER ACCOUNT  ?</h4>
                                                        <input type="hidden" name="user_id" value="{{$user->user_id}}" />
                                                        <input type="hidden" name="voyager" value="active" />
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success btn-rounded">Activate
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="make-subadmin-modal{{ $user->user_id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-success txt-light" style="background-color: #4DD4A8">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h5 class="modal-title font-20">Make Sub-Admin?</h5>
                                                </div>
                                                <form id="" action="{{ route('admin.users.update', $user->user_id) }}" method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-body">
                                                        <h4>Are you sure you want give   {{ $user->name }} Subadmin rights  ?</h4>
                                                        <input type="hidden" name="user_id" value="{{$user->user_id}}" />
                                                        <input type="hidden" name="sub_admin" value="subadmin" />
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success btn-rounded">Activate
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="revoke-subadmin-modal{{ $user->user_id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-success txt-light" style="background-color: #EE826D">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h5 class="modal-title font-20">Revoke Sub-Admin?</h5>
                                                </div>
                                                <form id="" action="{{ route('admin.users.update', $user->user_id) }}" method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-body">
                                                        <h4>Are you sure you remove as  {{ $user->name }} Subadmin ?</h4>
                                                        <input type="hidden" name="user_id" value="{{$user->user_id}}" />
                                                        <input type="hidden" name="sub_admin" value="revoke" />
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success btn-rounded">Revoke
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="container">
                                <div class="row">
                                    <h5><b>PAGE VIEWS</b>: <span> {{ $users->links()}}</span></h5>
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

</div>

@endsection

<script src="{{ asset('user-assets/js/jquery.min.js') }}"></script>

<script>
    if ($(".2fa").val() == "") {
        $(".amount-group").hide()
        $(".withdrawBtn").hide()
    }

    $(".2fa").on('keyup change', function() {

        if ($(this).val().length == 6) {
            $(".amount-group").show()
            $(".withdrawBtn").show()
        } else {
            $(".amount-group").hide()
            $(".withdrawBtn").hide()
        }
    })

</script>

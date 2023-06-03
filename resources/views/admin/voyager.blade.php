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
                                        <th class="hd">Email</th>
                                        <th class="hd">Amount</th>
                                        <th class="hd">Total Returns</th>
                                        <th class="hd">Key</th>
                                        <th class="hd">Status</th>
                                        
                                        <th class="hd">Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th class="hd">S/N</th>
                                        <th class="hd">Name</th>
                                        <th class="hd">Email</th>
                                        <th class="hd">Amount</th>
                                        <th class="hd">Total Returns</th>
                                         <th class="hd">Key</th>
                                        <th class="hd">Status</th> 
                                        <th class="hd">Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($voyagers as $key=> $voy)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $voy['username'] }}</td>
                                        <td>{{ $voy['email'] }}</td>
                                        <td>{{ $voy['amount'] }}</td>
                                        <td>{{ $voy['total_return'] }}</td>
                                        <td>{{ $voy['activation_key'] }}</td> 
                                        @if ($voy['status'] == "active") 
                                        <td> <span class="label label-success">Active</span> </td>
                                        @else
                                        <td> <span class="label label-danger">{{ $voy['status'] }}</span></td>
                                        @endif

                                        <td>
                                            <div class="dropdown show-on-hover">
                                                <button type="button" class="btn btn-success dropdown-toggle"
                                                    data-toggle="dropdown">
                                                    Action <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    @if($voy->status=="pending"|| $voy->status=="revoked")
                                                    <li><a href="" data-toggle="modal" data-target="#activate-voyager-modal{{ $voy->user_id }}">Activate Voyager</a></li>
                                                    @else
                                                    <li><a href="" data-toggle="modal" data-target="#revoke-voyager-modal{{ $voy->user_id }}">Revoke Voyager</a></li>
                                                    @endif
                                                    <li onclick="event.preventDefault();
                                                    document.getElementById('delete_user_from-{{ $voy['voyager_id'] }}').submit()"><a href="#" data-toggle="modal"
                                                            data-target="#delete-active-modal{{ $voy->voyager_id }}">Delete Account</a>
                                                    </li>
                                                </ul>
                                            </div>

                                           
                                            
                                        </td>
                                        
                                    </tr>


                                    <!-- /.deactivate modal -->
                                    <div id="deactivate-modal{{ $voy['voyager_id'] }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger txt-light" style="background-color: #EE826D">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h5 class="modal-title font-20">Deactivate Voyager</h5>
                                                </div>
                                                <form action="{{ route('admin.voyagers.update', $voy['voyager_id']) }}" method="post"  >
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-body">
                                                        <h3>Are you sure you want to DEACTIVATE this voyager account?</h3>    
                                                        <input type="hidden" name="status" value="deactivate">            
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger btn-rounded">Deactivate
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="revoke-voyager-modal{{ $voy->user_id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning txt-light" style="background-color: #EE826D">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h5 class="modal-title font-20">Revoke Voyager?</h5>
                                                </div>
                                                <form id="" action="{{ route('admin.users.update', $voy->user_id) }}" method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-body">
                                                        <h4>Are you sure you want REVOKE  {{ $voy->username }}  VOYAGER ACCOUNT  ?</h4>
                                                        <input type="hidden" name="user_id" value="{{$voy->user_id}}" />
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

                                    <div id="activate-voyager-modal{{ $voy->user_id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-success txt-light" style="background-color: #4DD4A8">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h5 class="modal-title font-20">Activate Voyager?</h5>
                                                </div>
                                                <form id="" action="{{ route('admin.users.update', $voy->user_id) }}" method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-body">
                                                        <h4>Are you sure you want Activate  {{ $voy->username }}  VOYAGER ACCOUNT  ?</h4>
                                                        <input type="hidden" name="user_id" value="{{$voy->user_id}}" />
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
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="container">
                                <div class="row">
                                    <div class="col-3"><h5><b>PAGE VIEWS</b></h5></div>
                                    <div class="col"><h5> <span> {{ $voyagers->links()}}</span></h5></div>
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

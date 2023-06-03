@extends('templates.admin')

@section('content')


<!-- Row -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark"></h6>
                </div>
                 
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table id="datable_1" class="table table-hover display  pb-30" >
                                <thead class="data-table-head" >
                                    <tr class="data-table-head">
                                        <th class="hd">S/N</th>
                                        <th class="hd">Name</th>
                                        <th class="hd">Email</th>
                                        <th class="hd">Method</th>
                                        <th class="hd">Amount</th>
                                        {{-- <th class="hd">Charges</th>
                                        <th class="hd">Credited</th> --}}
                                        <th class="hd">Address</th>
                                        <th class="hd">Type</th>
                                        <th class="hd">Date</th>
                                        <th class="hd">Actions</th>
                                        <th class="hd">Status</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th >S/N</th>
                                        <th >Full Name</th>
                                        <th >Email</th>
                                        <th >Method</th>
                                        <th >Paid</th>
                                        {{-- <th >Charges</th>
                                        <th >Credited</th> --}}
                                        <th >Address</th>
                                        <th >Type</th>
                                         <th >Date</th>
                                         <th>Actions</th>
                                        <th >Status</th>

                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($withdrawals as $key=> $with)
                                        <tr>
                                            <td>{{ $key }}</td>
                                            <td>{{ $with['username'] }}</td>
                                            <td>{{ $with['email'] }}</td>
                                            <td>{{ $with['methodname'] }}</td>
                                            <td>${{ $with['amount_paid'] }}</td>
                                            {{-- <td>${{ $with['charge'] }}</td>
                                            <td>${{ $with['amount_credited'] }}</td> --}}
                                            <td>{{ $with['wallet_address'] }}</td>
                                            <td>{{ $with['wallet_type'] }}</td>
                                            <td>{{ $with['date'] }}</td>
                                            <td>
                                                <div class="dropdown show-on-hover">
                                                    <button type="button" class="btn btn-success dropdown-toggle"
                                                        data-toggle="dropdown">
                                                        Action <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="#myModal{{ $with['id'] }}"
                                                            data-toggle="modal">Edit Withdrawal</a></li>
                                                        <li><a href="#">Delete Withdrawal</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                            @if ($with['approved']==true)
                                            <td > <span class="label label-success">Aproved</span></td>
                                            @else
                                            <td > <span class="label label-danger">Not Aproved</span> </td>
                                            @endif

                                                <!-- Modal -->
   
    <!-- /.modal -->

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="container">
                                <div class="row">
                                    <div class="col-3"><h5><b>PAGE VIEWS</b></h5></div>
                                    <div class="col"><h5> <span> {{ $withdrawals->links()}}</span></h5></div>
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

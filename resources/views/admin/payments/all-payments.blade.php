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
                <div class="pull-right">
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
                                        <th class="hd">#ID</th>
                                        <th class="hd">Full Name</th>
                                        <th class="hd">Method</th>
                                        <th class="hd">Amount</th>
                                        <th class="hd">Order Id</th>
                                        <th class="hd">Status</th>
                                        <th class="hd">Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th >#ID</th>
                                        <th >Full Name</th>
                                        <th >Method</th>
                                        <th >Amount</th>
                                        <th >Order Id</th>
                                        <th >Status</th>
                                        <th >Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($payments as $pay)
                                        <tr>
                                            <th scope="row">{{ $pay['id'] }}</th>
                                            <td>{{ $pay['user_name'] }}</td>
                                            <td>{{ $pay['method'] }}</td>
                                            <td>${{ $pay['amount'] }}</td>
                                            <td>{{ $pay['order_id'] }}</td>
                                            @if ($pay['status']==true)
                                            <td > <span class="label label-success">Aproved</span></td>
                                            @else
                                            <td > <span class="label label-danger">Not Aproved</span> </td>
                                            @endif

                                            <td><a href="#">	<button class="btn btn-success btn-rounded btn-lable-wrap right-label"><span class="btn-text">Approve</span> <span class="btn-label"><i class="fa fa-check"></i> </span></button>
                                                </a> </td>
                                            {{-- <form id="delete_user_from-{{ $pay['id'] }}"
                                                action="#" method="POST" style="display: none">
                                                @csrf
                                                @method('delete')
                                            </form> --}}
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

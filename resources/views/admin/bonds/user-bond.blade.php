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
                                <table id="datable_1" class="table table-hover display  pb-30">
                                    <thead class="data-table-head">
                                        <tr class="data-table-head">

                                            <th class="hd">#ID</th>
                                            <th class="hd">Name</th>
                                            <th class="hd">Package</th>
                                            <th class="hd">Date</th>
                                            <th class="hd">Amount</th>
                                            <th class="hd">Duration</th>
                                            <th class="hd">ROI</th>
                                            <th class="hd">payout</th>
                                            <th class="hd">Status</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th >#ID</th>
                                            <th >Name</th>
                                            <th >Package</th>
                                            <th >Date</th>
                                            <th >Amount</th>
                                            <th >Duration</th>
                                            <th> ROI</th>
                                            <th >payout</th>
                                            <th >Status</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($bonds as $bon)
                                            <tr>
                                                <th scope="row">{{ $bon['id'] }}</th>
                                                <td>{{ $bon['name'] }}</td>
                                                <td>{{ $bon['package'] }}</td>
                                                <td>{{ $bon['date'] }}</td>
                                                <td>${{ $bon['amount'] }}</td>
                                                <td>{{ $bon['duration'] }}</td>
                                                <td>${{ $bon['roi'] }}</td>
                                                <td>{{ $bon['payout'] }}</td>
                                                @if ($bon['status'] == true)
                                                    <td> <span class="label label-success">Active</span></td>
                                                @else
                                                    <td> <span class="label label-danger">Deactivated</span> </td>
                                                @endif

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


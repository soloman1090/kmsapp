@extends('templates.main-user')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/user/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="/user/withdrawal-history">Withdrawals</a></li>
            </ol>
        </nav>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h4>{{ $page_title }}</h4>
    </div>
    <img src="{{ asset('user-assets/images/widgets/withdrawal.jpg') }}" alt="" style="width: 100%; border-top-left-radius: 10px;
    border-top-right-radius: 10px;" >
    <div class="card-body">
       
        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead class="bg-dark text-white">
                <tr>
                    <th class="text-white">S/N</th>
                    <th class="text-white">Method</th>
                    <th class="text-white">Amount Paid</th>
                    <th class="text-white">Date</th>
                    {{-- <th class="text-white">Charge </th>
                    <th class="text-white">Amount Credited </th> --}}
                    <th class="text-white">Wallet Address </th>
                    <th class="text-white">Wallet Type </th>
                    <th class="text-white">Status</th>
                    <th class="text-white">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $key=> $req)
                <tr>
                    <td>{{ $key }}</td>

                     @if ($req['request_id']==94 || $req['request_id']== 95)
                    <td>Bank Transfer</td>
                    @else
                    <td>{{ $req['methodname'] }}</td>
                    @endif
                    <td>${{ $req['amount_paid'] }}</td>
                    <td>{{ $req['date'] }}</td>
                    {{-- <td>${{ $req['charge'] }}</td>
                    <td>${{ $req['amount_credited'] }}</td> --}}
                    <td>{{ $req['wallet_address'] }}</td>
                    <td>{{ $req['formatted_wallet_type'] }}</td>

                    @if ($req['approved']==true)
                    <td > <span class="badge bg-success">Aproved</span></td>
                    @else
                    <td > <span class="badge bg-danger">Pending Approval</span> </td>
                    @endif
                    <td>
                        @if ($req['approved']!=true)
                        {{-- <button type="button" class="btn btn-danger btn-sm" onclick="event.preventDefault();
                        document.getElementById('delete_request_from-{{ $req['request_id'] }}').submit()"><i class="mdi mdi-delete-forever me-2"></i>Delete Request</button> --}}
                        @endif

                         <form id="delete_request_from-{{ $req['request_id'] }}"
                            action="{{ route('user.withdrawal-history.destroy',  $req['request_id']) }}"
                            method="POST" style="display: none">
                            @csrf
                            @method('delete')
                        </form>
                </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div><!--end card-body-->
</div><!--end card-->


@endsection

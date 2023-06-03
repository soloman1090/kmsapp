@extends('templates.main-user')

@section('content')
 <!-- DataTables -->


 
<div class="card">
    <img src="{{ asset('user-assets/images/widgets/transaction_activity.jpg') }}" alt="" style="width: 100%; border-top-left-radius: 10px;
    border-top-right-radius: 10px;" >
    <br><br>
    <div class="card-header">
        <h4 class="card-title">Recent and past activities</h4>
    </div><!--end card-header-->
    <div class="card-body">
        
        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
            <thead class="bg-dark text-white">
                <tr>
                    <th class="text-white">S/N</th>
                    <th class="text-white">Title</th>
                    <th class="text-white">Date</th>
                    <th class="text-white">Description</th>
                    <th class="text-white">Amount</th>
                    <th class="text-white">Status</th>

                </tr>
            </thead>
            <tbody>
                @foreach($activities as $key=> $active)
                <tr>
                    <td>{{ $key }}</td>
                    <td class="text-primary">{{ $active->title }}</td>
                    <td>{{ $active->date }}</td>
                    <td>{{ $active->descp }}</td>
                    <td>${{ $active->amount }}</td>

                    @if ($active->category=="earning" || $active->category=="bonus")
                    <td > <span class="bg-success p-1 font-10 text-white">CREDITED</span></td>
                    @elseif ($active->category=="transfer")
                    <td > <span class="bg-primary p-1 font-10 text-white">TRANSFER</span></td>
                    @elseif ($active->category=="withdrawals")
                    <td > <span class="bg-danger p-1 font-10 text-white">WITHDRAWAL</span></td>
                    @elseif ($active->category=="deposit")
                    <td > <span class="bg-primary p-1 font-10 text-white">DEPOSIT</span></td>
                    @elseif ($active->category=="expired")
                    <td > <span class="bg-danger p-1 font-10 text-white">EXPIRED</span></td>
                    @elseif ($active->category=="error")
                    <td > <span class="bg-danger p-1 font-10 text-white">ERROR</span></td>
                    @elseif ($active->category=="cancelled")
                    <td > <span class="bg-danger p-1 font-10 text-white">CANCELLED</span></td>
                    @endif
                </tr>

                @endforeach
            </tbody>

        </table>
    </div><!--end card-body-->

    
</div><!--end card-->



@endsection



@extends('templates.main-user')

@section('content')
<img src="{{ asset('user-assets/images/widgets/referral.jpg') }}" alt="" style="width: 100%; border-top-left-radius: 10px;
border-top-right-radius: 10px;" >
<br><br>
<div class="row"> 
    <div class="col">
        <div class="  m-2">
            <span class="badge badge-outline-primary"><b>Referal Link: </b> <span class="badge  badge-soft-primary p-3">  https://palmalliance.com/register/?refer={{ $referral_code }} </span></span>
            <input id="refereee" class="form-control"  placeholder="show here" />
        </div>
    </div>
    <div class="col-auto">
        <div class="text-center m-2">
           <a  class="btn btn-primary" id="referralLink" href="#" referral_id="{{ $referral_code }}" >Copy Referral Link</a>
       </div>
   </div>
</div>
<div class="card">
    <div class="card-body">
        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead class="bg-dark text-white">
                <tr>
                    <th class="text-white">S/N</th>
                    <th class="text-white">Date</th>
                    <th class="text-white">Details</th>
                    <th class="text-white">Amount </th>
                    <th class="text-white">Status </th>
                </tr>
            </thead>
            <tbody>
                @foreach($bonus as $key=> $bon)
                <tr>
                    <td>{{ $key }}</td>
                    <td>{{ $bon->date }}</td>
                    <td>{{ $bon->descp }}</td>
                    <td>${{ $bon->amount }}</td>
                    <td>Paid</td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div><!--end card-body-->
</div><!--end card-->


@endsection


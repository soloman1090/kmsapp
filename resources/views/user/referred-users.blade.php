@extends('templates.main-user')

@section('content')
<img src="{{ asset('user-assets/images/widgets/referral.jpg') }}" alt="" style="width: 100%;  border-top-left-radius: 10px;
border-top-right-radius: 10px;" >
<br><br>
<div class="row">
    <div class="col">
        <h3>Referred Partners</h3>
    </div>
    <div class="col">
        <div class="text-center m-2">
            <span class="badge badge-outline-primary"><b>Referal Link: </b> <span class="badge  badge-soft-primary p-3"> https://palmalliance.com/register/?refer={{ $referral_code }} </span></span>
            <input id="refereee" class="form-control" placeholder="show here" />
        </div>
    </div>
    <div class="col-auto">
        <div class="text-center m-2">
            <a class="btn btn-primary" id="referralLink" href="#" referral_id="{{ $referral_code }}">Copy Referral Link</a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead class="bg-dark text-white">
                <tr>
                    <th class="text-white">S/N</th>
                    <th class="text-white">Full Name</th>
                    <th class="text-white">Email Address</th>
                    <th class="text-white">Invested </th>
                    <th class="text-white">Actions </th>
                </tr>
            </thead>
            <tbody>
                @foreach($referrals as $key=> $ref)
                <tr>
                    <td>{{ $key }} </td>
                    <td>{{ $ref->name }} {{ $ref->last_name }}</td>
                    <td>{{ $ref->email }}</td>
                    @if ($ref->invested==true)
                    <td> <span class="badge bg-success p-2 " style="font-size: 12px !important">Invested</span></td>
                    @else
                    <td> <span class="badge bg-warning p-2 " style="font-size: 12px !important">Pending</span> </td>
                    @endif
                    <td> <a href="#" data-bs-toggle="modal" data-bs-target="#downlines{{ $key }}">View Downlines</a>

                        <div class="modal fade" id="downlines{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title m-0" id="exampleModalDefaultLabel">{{ $ref->name }} {{ $ref->last_name }} Downlines
                                        </h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <!--end modal-header-->
                                    <div class="modal-body">
                                        <div class="row text-center">
                                            <div class="col-md-2">
                                                <div class="badge bg-primary">
                                                    <h6 class="text-white">LEVEL 1 >>></h6>
                                                </div><br>
                                                @foreach($ref->stage1Users as $key=> $stage1Users)
                                                |<br>
                                                @endforeach

                                            </div>
                                            <div class="col-md-10">
                                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap ">
                                                    <thead class="bg-dark text-white">
                                                        <tr>
                                                            <th class="text-white">S/N</th>
                                                            <th class="text-white">Full Name</th>
                                                            <th class="text-white">Email Address</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($ref->stage1Users as $key=> $stage1Users)
                                                        <tr>
                                                            <td>{{ $key }}</td>

                                                            <td>{{ $stage1Users->name ??"" }} {{ $stage1Users->last_name??"" }}</td>
                                                            <td>{{ $stage1Users->email??"" }}</td>
                                                        </tr>
                                                        @endforeach


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>



                                    </div>

                                    <!--end modal-body-->
                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-soft-secondary " data-bs-dismiss="modal">Close</button>
                                    </div>
                                    <!--end modal-footer-->

                                </div>
                                <!--end modal-content-->
                            </div>
                            <!--end modal-dialog-->
                        </div>
                        <!--end modal-->
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
    <!--end card-body-->
</div>
<!--end card-->
@endsection

@extends('templates.main-user')

@section('content')
<img src="{{ asset('user-assets/images/widgets/referral.jpg') }}" alt="" style="width: 100%;  border-top-left-radius: 10px;
border-top-right-radius: 10px;" >
<br><br>
<div class="container">
<div class="row mb-3">
<div class="col-md-4 mg-t-10 mg-sm-t-0">
            <div class="card card-body">
              <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Total Referrals</h6>
              <div class="d-flex d-lg-block d-xl-flex align-items-end">
                <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">3,137</h3>
                <p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium tx-danger d-inline-flex align-items-center">0.7% <ion-icon name="arrow-down-outline"></ion-icon></span> than last week</p>
              </div>
              <div class="chart-three">
                  <div id="flotChart4" class="flot-chart ht-30"></div>
                </div><!-- chart-three -->
            </div>
          </div><!-- col -->
          <div class="col-md-4 mg-t-10 mg-lg-t-0">
            <div class="card card-body">
              <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Total Invested</h6>
              <div class="d-flex d-lg-block d-xl-flex align-items-end">
                <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">$306.20</h3>
                <p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium tx-danger d-inline-flex align-items-center">0.3% <ion-icon name="arrow-down-outline"></ion-icon></span> than last week</p>
              </div>
              <div class="chart-three">
                  <div id="flotChart5" class="flot-chart ht-30"></div>
                </div><!-- chart-three -->
            </div>
          </div><!-- col -->
          <div class="col-md-4 mg-t-10 mg-lg-t-0">
            <div class="card card-body">
              <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Total Not Invested</h6>
              <div class="d-flex d-lg-block d-xl-flex align-items-end">
                <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">1,650</h3>
                <p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium tx-success d-inline-flex align-items-center">2.1% <ion-icon name="arrow-up-outline"></ion-icon></span> than last week</p>
              </div>
              <div class="chart-three">
                  <div id="flotChart6" class="flot-chart ht-30"></div>
                </div><!-- chart-three -->
            </div>
          </div><!-- col -->
</div>
<div class="row">
    <div class="col">
        <h3>Friends & Community</h3>
    </div>
    <div class="col">
        <div class="text-center m-2">
            <span class="badge badge-outline-primary"><b>Referal Link: </b> <span class="badge  badge-soft-primary p-3"> https://Dell Group.com/register/?refer={{ $referral_code }} </span></span>
            <input id="refereee" class="form-control" placeholder="show here" />
        </div>
    </div>
    <div class="col-auto">
        <div class="text-center m-2">
            <a class="btn btn-primary" id="referralLink" href="#" referral_id="{{ $referral_code }}">Copy Referral Link</a>
        </div>
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

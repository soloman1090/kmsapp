@extends('templates.main-user')

@section('content')
<img src="{{ asset('user-assets/images/widgets/referral.jpg') }}" alt="" style="width: 100%; border-top-left-radius: 10px;
border-top-right-radius: 10px;">
<br><br>
<div class="container">
    <div class="row mb-3">
        <div class="col-md-4 mg-t-10 mg-sm-t-0">
            <div class="card card-body">
                <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Bonus Wallet</h6>
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
                <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Total Bonus</h6>
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
                <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Total Bonus Witdrawals</h6>
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
            <div class="  m-2">
                <span class="badge badge-outline-primary"><b>Referal Link: </b> <span class="badge  badge-soft-primary p-3"> https://Dell Group.com/register/?refer={{ $referral_code }} </span></span>
                <input id="refereee" class="form-control" placeholder="show here" />
            </div>
        </div>
        <div class="col-auto">
            <div class="text-center m-2">
                <a class="btn btn-primary" id="referralLink" href="#" referral_id="{{ $referral_code }}">Copy Community Link</a>
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
    </div>
    <!--end card-body-->
</div>
<!--end card-->


@endsection

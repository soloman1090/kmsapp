@extends('templates.main-user')

@section('content')

<style>
    .short_img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
    }

</style>
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Make Investment</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Welcome to Dashboard</h4>
    </div>
     
</div>
<div class="card">
    <img src="{{ asset('user-assets/images/widgets/short-me.jpg') }}" alt="" style="width: 100%; border-top-left-radius: 10px;
border-top-right-radius: 10px;">
</div>

<div class="card">
    <div class="card-header">
        <h1 class="">Short Term Open Funds</h1>
    </div><!-- end card header -->
    {{-- <div class="card-body">

        <h1 class="text-center">Active Investments</h1>

        <br>
        @if($totalPending > 0)
        <div class="bg-soft-warning text-center p-3">
            <h5 class="text-dark   ">Your have {{ $totalPending }} Investments Pending for Activation</h5>
            <a href="user-investments/{{ $pendingId }}" target="_blank" class="btn btn-sm btn-outline-primary  px-4">Confirm Purchase</a>
            <br>
            <small class="text-secondary">Referesh Page again to see if activated</small>
        </div>
        @endif
        @if ($totalActive>0)
        <div class="row">
            <div class="col-lg-12">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <span class="  mb-3 lh-1 d-block text-truncate"><b>Total Compounding Capital</b></span>
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h1 class="m-0 amount2">${{ $totalCompouding }}</h1>
                                    </div>
                                    <div class="col-4">
                                        <div id="mini-chart2" data-colors='["#1A7BB7"]' class="apex-charts "></div>
                                    </div>

                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-6 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <span class="  mb-3 lh-1 d-block text-truncate "><b>Capital Invested</b></span>
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h1 class="m-0 amount1">${{ $totalInvested }}</h1>
                                    </div>
                                    <div class="col-4">
                                        <div id="mini-chart1" data-colors='["#1A7BB7"]' class="apex-charts "></div>
                                    </div>

                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-6 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <span class="  mb-3 lh-1 d-block text-truncate"><b>Active Investments</b></span>
                                <div class="row align-items-center">
                                    <div class="col-8">

                                        <h1 class="m-0">{{ $totalActive }}</h1>
                                    </div>
                                    <div class="col-4">
                                        <div id="mini-chart3" data-colors='["#1A7BB7"]' class="apex-charts "></div>
                                    </div>
                                    <div class="text-nowrap">

                                        @if ($totalPending > 0)
                                        <span class="badge bg-soft-warning text-dark">{{ $totalPending }}</span>
                                        <span class="ms-1 text-warning font-size-13">Pending Investments</span>

                                        @endif
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->





                    <div class="col-xl-6 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <span class="  mb-3 lh-1 d-block text-truncate"><b>Current Commission</b></span>
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h1 class="m-0">${{ $totalReturns }}</h1>
                                    </div>
                                    <div class="col-4">
                                        <div id="mini-chart4" data-colors='["#1A7BB7"]' class="apex-charts mb-2"></div>
                                    </div>

                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->




                </div>
                <!--end row-->

            </div>
            <!--end col-->


            <!--end col-->
        </div>
        <a href="#" class="accordion-button collapsed shadow-none  px-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><b>View Investments Activities</b></a>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample-faq">
            <div class="card m-3">
                <div class="accordion-body">
                    <div class="card-body ">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th class="text-white">S/N</th>
                                    <th class="text-white">Description</th>
                                    <th class="text-white">Date</th>
                                    <th class="text-white">Amount</th>
                                    <th class="text-white">Status </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activities as $key =>$act)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>{{ $act->descp }}</td>
                                    <td>{{ $act->date }}</td>
                                    <td>${{ $act->amount }}</td>
                                    @if ($act->category == 'earning' || $act->category == 'bonus')
                                    <td> <span class="bg-success p-1 font-10 text-white">CREDITED</span>
                                    </td>
                                    @elseif ($act->category == 'withdrawals')
                                    <td> <span class="bg-danger p-1 font-10 text-white">WITHDRAWAL</span>
                                    </td>

                                    @elseif ($act->category == 'deposit')
                                    <td> <span class="bg-primary p-1 font-10 text-white">DEPOSIT</span>
                                    </td>
                                    @elseif ($act->category == 'expired')
                                    <td> <span class="bg-danger p-1 font-10 text-white">EXPIRED</span>
                                    </td>
                                    @elseif ($act->category == 'error')
                                    <td> <span class="bg-danger p-1 font-10 text-white">ERROR</span>
                                    </td>
                                    @elseif ($act->category == 'cancelled')
                                    <td> <span class="bg-danger p-1 font-10 text-white">CANCELLED</span>
                                    </td>
                                    @endif
                                </tr>

                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="text-center">
            <img src="{{ asset('user-assets/images/portfolios/investment.png') }}" width="300" />
            <h3 class="text-center">No Active Investment Yet</h3>
            <br>
            <p> Scroll Down To Purchase An Investment</p>

        </div>
        @endif
        <hr>
    </div> --}}
    <div class="card-body">
        <hr>
        <h2 class="">Make Investments( {{ count($packages) }} )</h2>
        <hr>
        <div>
            @foreach ($packages as $key=> $pack)
            <div class="card">
                <div class="row">
                    <div class="col-3">
                        <img src="{{ asset("uploads/$pack->image") }}" alt="" class="short_img">
                    </div>
                    <div class="col-9">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h1 class="title1   mb-0 font-25">{{ $pack['name'] }} </h1>
                                    <h6>{{ $pack['category_name'] }}</h6>
                                </div>
                                {{-- <div class="col-auto ">
                                    <h4 class=" mb-0 font-18">{{ $pack['slots'] }} </h4>
                                <small>Slots Available</small>
                            </div> --}}
                        </div>
                        <hr>
                        <ul class="list-unstyled pricing-content-2">

                            <li><b class="text-dark">{{ $pack['info_head_1'] }}</b>
                                <p>{{ $pack['info_detail_1'] }}</p>
                            </li>
                            <li><i class="mdi mdi-earth text-primary"></i> {{ $pack['info_head_2'] }} <i class="mdi mdi-briefcase-variant text-primary"></i> {{ $pack['info_detail_2'] }} </li>

                            <div class="mt-3"> <span class="bg-light p-2" style="border-radius: 5px">Broad</span></div>
                            {{-- <li><b class="text-dark">{{ $pack['info_head_4'] }}</b>
                            <p>{{ $pack['info_detail_4'] }}</p>
                            </li>
                            <li><b class="text-dark">{{ $pack['info_head_5'] }}</b>
                                <p>{{ $pack['info_detail_5'] }}</p>
                            </li> --}}

                        </ul>
                        <div class=" row ">
                            <div class="col-md-3 text-center" style="border-right: 1px solid black">
                                <h4 class="amount">$ {{ $pack['formatted_min'] }}<br> <small style="font-size: 14px" class="text-muted">Min Investment</small> </h4>
                            </div>
                            <div class="col-md-3 text-center" style="border-right: 1px solid black">
                                <h4 class="amount ">$ {{ $pack['formatted_max'] }}<br> <small style="font-size: 14px" class="text-muted">Max Investment</small> </h4>
                            </div>
                            <div class="col-md-3 " style="border-right: 1px solid black">
                                <div class="text-center">
                                    <h4 class="amount ">{{ $pack['compound_percent'] }}% <br><small style="font-size: 14px" class="text-muted">Auto Compouding </small> </h4>
                                </div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="text-center">
                                    <h4 class="amount ">{{ $pack['min_percent'] }}% - {{ $pack['max_percent'] }}% <br><small style="font-size: 14px" class="text-muted">Daily dividends</small></h4> </small> </h2>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <a href="{{ route('user.make-investment.show',$pack['id'] ) }}" class="btn btn-primary w-100  btn-outline-dashed py-2"><span>Get Started With {{ $pack['name'] }}</span></a>


                        {{-- <form action="{{ route('user.get-payment.index') }}" method="get" class="form-parsley">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="user_id" value="{{ $user_id }}">
                                <input type="hidden" name="investment_packages_id" value="{{ $pack['id'] }}">
                                <input type="hidden" name="returns" id="returns" value="23.4">
                                <input type="hidden" name="payment_method" id="direct_deposit" value="direct_deposit">
                                <input type="hidden" name="payout" id="payout" value="short">
                                <input type="hidden" name="duration" id="duration" value="{{ $pack['duration'] }}">
                                <input type="hidden" name="amount" value="{{ $pack['min_amt'] }}">
                                <input type="hidden" name="currency" value="">

                            </div>
                            <button type="submit" class="btn btn-primary w-100  btn-outline-dashed py-2"><span>Get Started With {{ $pack['name'] }}</span></a>

                        </form> --}}

                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="modal fade" id="portModalDefault{{ $pack['id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="exampleModalDefaultLabel">Purchase A Short Investment
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!--end modal-header-->
                <div class="modal-body">
                    <h3 class="text-center">{{ $pack['name'] }}</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h1 class="text-center text-primary">${{ $pack['formatted_min'] }}</h1>
                            <div class="text-center">
                                <small class="text-center font-16">Minimum Investment</small>
                            </div>

                            <div class="row text-center">
                                <div class="col-md-12">
                                    <h3><b>{{ $pack['compound_percent'] }}%:</b></h3>
                                    <div class="text-center">
                                        <small class="text-center font-16">Auto Compounding Percentage</small>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12">
                                    <h3><b>{{ $pack['duration'] }}-Months:</b></h3>
                                    <div class="text-center">
                                        <small class="text-center font-16">Portfolio Duration</small>
                                    </div>

                                </div>
                            </div>
                        </div>



                        <div class="col-md-6">
                            <h5>Fill form to purchase investment portfolio</h5>
                            <br>

                        </div>
                    </div>
                </div>
                <!--end modal-body-->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-soft-primary btn-sm">Purchase </button>
                    <button type="button" class="btn btn-soft-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
                <!--end modal-footer-->

            </div>
            <!--end modal-content-->
        </div>
        <!--end modal-dialog-->
    </div> --}}
    @endforeach
</div>


</div>
</div>
</div>
</div>
@endsection

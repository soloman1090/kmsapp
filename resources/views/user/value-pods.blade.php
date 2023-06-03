@extends('templates.main-user')

@section('content')


<div class="card">
    <img src="{{ asset('user-assets/images/widgets/value-pods.jpg') }}" alt="" style="width: 100%; border-top-left-radius: 10px;
border-top-right-radius: 10px;">
</div>

<div class="card">
    <div class="card-header">
        <h1 class="">Unique Value Pods</h1>
    </div><!-- end card header -->
    <div class="card-body">

        <h1 class="text-center">Active Pods</h1>

        <br>
        @if($totalPending > 0)
        <div class="bg-soft-warning text-center p-3">
            <h5 class="text-dark   ">Your have {{ $totalPending }} Pods Pending for Activation</h5>
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
                                <span class="  mb-3 lh-1 d-block text-truncate"><b>Active PODS</b></span>
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
                                        <span class="ms-1 text-warning font-size-13">Pending PODS</span>
                                        
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
        <a href="#" class="accordion-button collapsed shadow-none  px-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><b>View Pods Activities</b></a>
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
            <h3 class="text-center">No Active PODS Yet</h3>
            <br>
            <p> Scroll Down To Purchase A POD</p>

        </div>
        @endif
        <hr>
    </div>
    <div class="card-body">
        <hr>
        <h2 class="text-center">Select A Pod</h2>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <div style="height:80vh; overflow:scroll;">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        @foreach ($packages as $key=> $pack)
                        <a class="nav-link mb-2 @if ($key==0)active @endif" id="v-pills-home-tab{{ $pack['id'] }}" data-bs-toggle="pill" href="#v-pills-home{{ $pack['id'] }}" role="tab" aria-controls="v-pills-home{{ $pack['id'] }}" aria-selected="true">
                            <div class="card " @if ($key==0) style="margin-bottom: -10px;" @endif>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h4>{{ $pack['name'] }}</h4>
                                        </div>
                                        <div class="col-auto ">
                                            <h4 class=" mb-0 font-12">{{ $pack['slots'] }} </h4>
                                            <h6 class="text-muted" style="font-size:8px">Slots Available</h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <h3> <span style="font-size:30px">$</span>{{ $pack['formatted_min'] }} <small style="font-size: 14px" class="text-muted">USD</small></h3>
                                    <h6 class="text-muted" style="font-size:12px">Minimum Investment</h6>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5> {{ $pack['compound_percent'] }}% </h5>
                                            <h6 class="text-muted" style="font-size:12px">Commission</h6>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <h5> {{ $pack['compound_duration'] }}-Months </h5>
                                            <h6 class="text-muted" style="font-size:12px">Portfolio Duration</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach


                    </div>
                </div>
            </div><!-- end col -->
            <div class="col-md-1"></div>
            <div class="col-md-7">
                <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                    @foreach ($packages as $key=> $pack)
                    <div class="tab-pane fade  @if ($key==0)show active @endif" id="v-pills-home{{ $pack['id'] }}" role="tabpanel" aria-labelledby="v-pills-home-tab{{ $pack['id'] }}">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h1 class="title1   mb-0 font-25">{{ $pack['name'] }} </h1>
                                        <h6>{{ $pack['category_name'] }}</h6>
                                    </div>
                                    <div class="col-auto ">
                                        <h4 class=" mb-0 font-18">{{ $pack['slots'] }} </h4>
                                        <small>Slots Available</small>
                                    </div>
                                </div>
                                <hr>
                                <div class=" row ">
                                    <div class="col-md-4">
                                        <h2 class="amount">$ {{ $pack['formatted_min'] }} <small style="font-size: 14px" class="text-muted">USD</small> </h2>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <h2 class="amount ">{{ $pack['duration'] }} <small style="font-size: 14px" class="text-muted">months</small> </h2>
                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="text-center">
                                            <h2 class="amount ">{{ $pack['compound_percent'] }}% <small style="font-size: 14px" class="text-muted">Commission</small> </h2>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <ul class="list-unstyled pricing-content-2">

                                    <li><b class="text-dark">{{ $pack['info_head_1'] }}</b>
                                        <p>{{ $pack['info_detail_1'] }}</p>
                                    </li>
                                    <li><b class="text-dark">{{ $pack['info_head_2'] }}</b>
                                        <p>{{ $pack['info_detail_2'] }} </p>
                                    </li>
                                    <li><b class="text-dark">{{ $pack['info_head_3'] }}</b>
                                        <p>{{ $pack['info_detail_3'] }}</p>
                                    </li>
                                    <li><b class="text-dark">{{ $pack['info_head_4'] }}</b>
                                        <p>{{ $pack['info_detail_4'] }}</p>
                                    </li>
                                    <li><b class="text-dark">{{ $pack['info_head_5'] }}</b>
                                        <p>{{ $pack['info_detail_5'] }}</p>
                                    </li>

                                </ul>
                                <hr>
                                <a href="" data-bs-toggle="modal" data-bs-target="#portModalDefault{{ $pack['id'] }}" class="btn btn-primary w-100  btn-outline-dashed py-2"><span>Get Started With {{ $pack['name'] }}</span></a>

                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="portModalDefault{{ $pack['id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title m-0" id="exampleModalDefaultLabel">Purchase Investment Pod
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
                                                        <small class="text-center font-16">Compounding Percentage</small>
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
                                            <form action="{{ route('user.get-payment.index') }}" method="get" class="form-parsley">
                                                @csrf
                                                <div class="row">
                                                    <input type="hidden" name="user_id" value="{{ $user_id }}">
                                                    <input type="hidden" name="investment_packages_id" value="{{ $pack['id'] }}">
                                                    <input type="hidden" name="returns" id="returns" value="23.4">
                                                    <input type="hidden" name="payment_method" id="direct_deposit" value="direct_deposit">
                                                    <input type="hidden" name="payout" id="payout" value="pods">
                                                    <input type="hidden" name="duration" id="duration" value="{{ $pack['duration'] }}">
                                                    <div class="form-group col-md-12">
                                                        <label for="inputAmount">Amount</label>
                                                        <input type="number" class="form-control" name="amount" id="inputAmount" placeholder="Enter Amount" required data-parsley-min="{{ $pack['min_amt'] }}" data-parsley-max="{{ $pack['max_amt'] }}">
                                                    </div>

                                                    <div class="form-group col-md-12" id="currency">
                                                        <label for="currency">Currency</label>
                                                        <select name="currency" class="form-control" id="currency_drop" required>
                                                            <option value="">Select Currency</option>
                                                            <option value="BTC">Bitcoin (BTC)</option>
                                                            <option value="ETH">Ethereum (ETH)</option>
                                                            <option value="LTC">Litecoin (LTC)</option>
                                                            <option value="DASH">Dash (DASH)</option>
                                                            <option value="TZEC">Zcash (TZEC)</option>
                                                            <option value="DOGE">Dogecoin (DOGE)</option>
                                                            <option value="BCH">Bitcoin Cash (BCH)</option>
                                                            <option value="XMR">Monero (XMR)</option>
                                                            <option value="TRX">Tron (TRX)</option>
                                                            <option value="USDT">Tether ERC-20( USDT)</option>
                                                            <option value="USDC">USD Coin (USDC)</option>
                                                            <option value="SHIB">Shiba Inu (SHIB)</option>
                                                            <option value="BTT">BitTorrent TRC-20 (BTT)</option>
                                                            <option value="USDT_TRX">Tether TRC-20 (USDT_TRX)</option>
                                                            <option value="BNB">BNB Chain (BNB)</option>
                                                            <option value="BUSD">Binance USD BEP-20 (BUSD)</option>
                                                            <option value="USDT_BSC">Tether BEP-20 (USDT_BSC)</option>
                                                        </select>
                                                    </div>

                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end modal-body-->
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-soft-primary btn-sm">Purchase </button>
                                    <button type="button" class="btn btn-soft-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                </div>
                                <!--end modal-footer-->
                                </form>
                            </div>
                            <!--end modal-content-->
                        </div>
                        <!--end modal-dialog-->
                    </div>
                    @endforeach

                </div>
            </div><!--  end col -->
        </div><!-- end row -->
    </div><!-- end card-body -->
</div>
@endsection

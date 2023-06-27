@extends('templates.main-user')

@section('content')
<link href="{{ asset('user-assets/css/skippr.css') }}" rel="stylesheet" type="text/css" />
<style>
    #containerSlider {
        width: 100%;
        height: 300px;
    }

    .newsHeading,
    .newsSummary {
        display: block;
        /* Fallback for non-webkit */
        display: -webkit-box;
        height: 4.8em;
        /* Fallback for non-webkit, line-height * 2 */
        line-height: 1.5em;
        -webkit-line-clamp: 4;
        /* if you change this, make sure to change the fallback line-height and height */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

</style>

<div class="row">
    <div class="col-lg-12">
        <div class="row justify-content-center">
            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <span class="  mb-3 lh-1 d-block text-truncate "><b>Accumulated Dividends</b></span>
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="m-0 amount1" amount="{{ $accumulatedDevidends }}">${{ $accumulatedDevidends }}</h4>
                            </div>
                            <div class="col-4">
                                <div id="mini-chart1" data-colors='["#1A7BB7"]' class="apex-charts "></div>
                            </div>
                            <div class="text-nowrap">
                                <span class="badge bg-soft-success text-success">+$20.9k</span>
                                <span class="ms-1 text-muted font-size-13">Since last week</span>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <span class="  mb-3 lh-1 d-block text-truncate"><b>Active Portfolios</b></span>
                        <div class="row align-items-center">
                            <div class="col-8">

                                <h4 class="m-0">{{ $investment_count?? 0 }}</h4>
                            </div>
                            <div class="col-4">
                                <div id="mini-chart3" data-colors='["#1A7BB7"]' class="apex-charts "></div>
                            </div>
                            <div class="text-nowrap">
                                <span class="badge bg-soft-success text-success">+ 29</span>
                                <span class="ms-1 text-muted font-size-13">Since last week</span>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

             

            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <span class="  mb-3 lh-1 d-block text-truncate"><b>Members Benefit Commission</b></span>
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="m-0 amount2" amount="{{ $accumulatedBonus??0 }}">${{ $accumulatedBonus??0 }}</h4>
                            </div>
                            <div class="col-4">
                                <div id="mini-chart5" data-colors='["#1A7BB7"]' class="apex-charts "></div>
                            </div>
                            <div class="text-nowrap">
                                <span class="badge bg-soft-warning text-danger">-29 Trades</span>
                                <span class="ms-1 text-muted font-size-13">Since last week</span>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <span class="  mb-3 lh-1 d-block text-truncate"><b>Compounding Dividends</b></span>
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="m-0">${{ $compound_wallet ?? 0 }}</h4>
                            </div>
                            <div class="col-4">
                                <div id="mini-chart4" data-colors='["#1A7BB7"]' class="apex-charts mb-2"></div>
                            </div>
                            <div class="text-nowrap">
                                <span class="badge bg-soft-success text-success">+2.95%</span>
                                <span class="ms-1 text-muted font-size-13">Since last week</span>
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
<!--end row-->
<div class="row">
    <div class="col-md-12 col-lg-5">
        <!-- card -->
        <div class="card card-h-100">
            <!-- card body -->
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center mb-4">
                    <h5 class="card-title me-2">Wallet Overview</h5>
                    <div class="ms-auto">
                         
                    </div>
                </div>

                <div class="row align-items-center">
                    <div class="col-sm">
                        <div id="wallet-balance" data-colors='["#2AB57D", "#1A7BB7", "#084567"]' data-labels='[ "Portfolio Dividend", "Referral Bonus","Transfers"]'  
                        data-values='["40", "45", "15"]' class="apex-charts"></div>
                    </div>
                    <div class="col-sm align-self-center">
                        <div class="mt-4 mt-sm-0">
                            <div>
                                <p class="mb-2"><i class="mdi mdi-circle align-middle font-size-10 me-2 text-success"></i> Portfolio Dividend</p>
                                <h6 class="m-0 amount3" amount="{{ $accumulatedEarnings }}">${{ $accumulatedEarnings }}</h6>
                            </div>

                            <div class="mt-4 pt-2">
                                <p class="mb-2"><i class="mdi mdi-circle align-middle font-size-10 me-2 text-primary"></i> Referral Bonus</p>
                                <h6 class="m-0 amount4" amount="{{ $accumulatedBonus??0 }}">${{ $accumulatedBonus??0 }}</h6>
                            </div>

                            <div class="mt-4 pt-2">
                                <p class="mb-2"><i class="mdi mdi-circle align-middle font-size-10 me-2 text-info"></i> Transfers</p>
                                <h6>$ {{ $accumulatedTransfer }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
    <div class="col-md-12 col-lg-4">
        <div class="row">
            <div class="col-xl-12">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="d-flex flex-wrap align-items-center  ">
                            <h5 class="card-title me-2">Investment Overview</h5>
                            
                        </div>
                        
                        <div class="row align-items-center text-center mt-3">
                            
                             
                                <div class=" mt-sm-0"> 
                                    <div class="row  ">
                                        <div class="col-4">
                                            <p class=" "><b>Invested </b></p>
                                            <h4 class="text-primary">${{ $invested_capital??0 }}</h4> 
                                        </div>
                                        <div class="col-4">
                                            <div>
                                                <p class=" text-uppercase font-size-11"> <b>Earnings</b></p>
                                                
                                                <h5 class="m-0 amount3 fw-medium text-success" amount="{{ $accumulatedEarnings }}">${{ $accumulatedEarnings }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div>
                                                <p class="   text-uppercase font-size-11"><b>Withdrawals</b></p>
                                                <h5 class="fw-medium text-danger">-${{ $accumulatedWithdrawals }}</h5>
                                            </div>
                                        </div>
                                    </div>

                                    
                                
                            </div>
                        </div>
                        <div class=" text-center mt-1 mb-3">
                            <p class="text-muted mb-2"> + 0.0012.23 ( 0.2 % ) <i class="mdi mdi-arrow-up ms-1 text-success"></i></p>
                            <a href="user-investments mt-2" class="btn btn-primary btn-sm">View more <i class="mdi mdi-arrow-right ms-1"></i></a>
                        </div>
                        <div class="ms-auto">
                            {{-- <div id="invested-overview" data-colors='["#1A7BB7", "#34c38f"]' class="apex-charts"></div> --}}

                            <a href="voyager-program" >
                                <div class="card @if ($voyager!=null) bg-primary  @else bg-danger @endif p-3 text-white text-center">
                                    <h3 class="text-white">Voyager Wallet </h3>
                                   @if ( $voyager!=null)
                                   <h3><i class="mdi mdi-wallet text-white"></i><span class="text-white"> ${{ $voyager->total_amount??"0.00" }}<span style="font-size: 13px">Earned</span></span></h3>
                                   <hr>
                                   <span style="font-size: 13px" class="text-white">${{ $voyager->daily_return??"0.00" }}Daily ROI</span>
                                   @else
                                   <h4><i class="mdi mdi-reload text-white"></i><span class="text-white">Inactive</b></h4>
                                   @endif
                                </div>
                            </a>
                        </div>

                       
                    </div>
                </div>
            </div>
            <!-- end col -->

            
            
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end col -->
    <div class="col-md-12 col-lg-3">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title">Main Wallet Balance</h4>
                    </div>
                    <!--end col-->
                    <div class="col-auto">
                        <i data-feather="dollar-sign" class="align-self-center icon-xs me-1"></i>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!--end card-header-->
            <div class="card-body">
                <div class="text-center">
                    <h1 class="amount5" amount="{{ $wallet_balance ?? 0 }}">${{ $wallet_balance ?? 0 }}</h1>
                    <div id="mini-chart2" data-colors='["#1A7BB7"]' class="apex-charts "></div>
                </div>
                <div class="text-center m-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#drawModalDefault" class="btn btn-outline-primary">Withdraw</a>
                </div>
            </div>
            <!--end card-body-->
        </div>
        <!--end card-->
        <div class="col-md-6 col-lg-12">
            <div class="card report-card">
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col">
                            <p class="text-dark mb-0 fw-semibold font-16">Total Referred Partners </p>
                            @if ($user_id==75)
                            <h3 class="m-0">{{count($referrals)+15}}</h3>
                            @elseif ($user_id==77)
                            <h3 class="m-0">{{count($referrals)+3}}</h3>
                            @elseif ($user_id==101)
                            <h3 class="m-0">{{count($referrals)+67}}</h3>
                            @elseif ($user_id==214)
                            <h3 class="m-0">{{count($referrals)+67}}</h3>
                            @elseif ($user_id==84)
                            <h3 class="m-0">{{count($referrals)+409}}</h3>
                            @else
                            <h3 class="m-0">{{count($referrals)}}</h3>
                            @endif
                        </div>
                        <div class="col-auto align-self-center">
                            <div class="report-main-icon bg-light-alt">
                                <i data-feather="users" class="align-self-center text-muted icon-sm"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        
    </div>
</div> <!-- end row-->
<div class="row">
    <div class="col-md-12 col-lg-8">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title">Recent News</h4>
                    </div>
                    <!--end col-->

                </div>
                <!--end row-->
            </div>
            <!--end card-header-->
            <div class="card-body">
                <div class="">
                    <div id="containerSlider">
                        <div id="newsSlider">
                            @foreach($news as $new)
                            <div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <img style="width: 100%; height:260px; object-fit:cover;" src="{{ $new->urlToImage }}" alt="">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="p-3">
                                            <span class="bg-soft-pink p-2 rounded">{{ $new->author }}</span>
                                            <h3 class="my-2 font-weight-bold newsHeading">{{ $new->title }}</h3>
                                            <p class="font-14 text-muted newsSummary">{{ $new->description }}
                                            </p>
                                            <a href="{{ $new->url }}" target="blank" class="btn btn-outline-primary">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- <div id="ana_dash_1" class="apex-charts"></div> --}}
                </div>
            </div>
            <!--end card-body-->
        </div>
        <!--end card-->
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title">Active Investment Sheet</h4>
                    </div>
                    <!--end col-->

                    <div class="col-auto">
                        <a href="user-investments" class="btn btn-outline-primary">
                            View Active Investments<i class="fi-arrow-right"></i>
                        </a>
                    </div>
                    <!--end col-->

                </div>
                <!--end row-->
            </div>
            <!--end card-header-->
            <div class="card-body">
                <ul class="list-group custom-list-group mb-n3">
                    @foreach($recent_investments as $invest)
                    <li class="list-group-item align-items-center d-flex justify-content-between pt-0">
                        <div class="media">
                            <div class="icon-info-activity">
                                <i data-feather="trending-up" class="me-3 align-self-center rounded "></i>
                            </div>
                            <div class="media-body align-self-center">
                                <h6 class="m-0">{{ $invest->packagename }} <br> ${{ $invest->amount }}</h6>
                                <p class="mb-0 text-muted">{{ $invest->date }}</p>
                            </div>
                            <!--end media body-->
                        </div>
                        <div class="align-self-center">
                            <a href="#" class="btn btn-sm btn-soft-primary" data-bs-toggle="collapse" data-bs-target="#collapseTwo{{ $invest->user_investments_id }}" aria-expanded="false" aria-controls="collapseTwo{{ $invest->user_investments_id }}">View Earnings<i data-feather="arrow-right-circle" class="align-self-center rounded font-5"></i></a>
                        </div>
                    </li>
                    @endforeach

                </ul>
            </div>
            <!--end card-body-->
            <div class="table-responsive browser_users">
                @foreach($dailyCredited as $key=> $dayC)
                <div id="collapseTwo{{ $dayC->invest_id }}" class="accordion-collapse collapse @if ( $key==0) show @endif " aria-labelledby="headingTwo" data-bs-parent="#accordionExample-faq">

                    <div class="accordion-body">
                        <h5 class="text-center">{{ $dayC->invest_name }} </h5>
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-top-0">Days</th>
                                    <th class="border-top-0">Amount</th>
                                    <th class="border-top-0">Status</th>
                                </tr>
                                <!--end tr-->
                            </thead>
                            <tbody>
                                @foreach($dayC->dailys as $daily)
                                @if($daily->status==false)
                                <tr>
                                    <td><a href="#" class="text-primary">{{ $daily->day }}</a></td>
                                    <td>$0.00</td>
                                    <td> <span class="bg-danger p-1 font-10 text-white">PENDING</span> </td>
                                </tr>
                                <!--end tr-->
                                @else
                                <tr>
                                    <td><a href="#" class="text-primary">{{ $daily->day }}</a></td>
                                    <td>${{ $daily->amount }}</td>
                                    <td> <span class="bg-success p-1 font-10 text-white">CREDITED</span> </td>
                                </tr>
                                <!--end tr-->
                                @endif

                                @endforeach
                            </tbody>
                        </table>
                        <!--end table-->
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!--end card-->
    </div>

</div>

 
    <div class="row"> 
       
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Quick Portfolio Purchase </h4>
                        </div>
                        <div class="col-auto">
                            <a href="view-investments-portfolio" class="btn btn-outline-primary">
                                View all Portfolios <i class="fi-arrow-right"></i>
                            </a>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <!--end card-header-->
                <div class="card-body">
                    <h6>Fill form to purchase investment portfolio</h6>

                    <form action="{{ route('user.get-payment.index') }}" method="get" class="form-parsley">
                        @csrf
                        <input type="hidden" name="quick_purchase" value="true">
                        <div class="row">
                            <input type="hidden" name="user_id" value="{{ $user_id }}">
                            <input type="hidden" name="returns" id="returns" value="23.4">
                            <div class="form-group col-md-12">
                                <label for="investment_packages_id">Package</label>
                                <select name="investment_packages_id" class="form-control" id="investment_packages_id" required>
                                    <option value="">Select Package</option>
                                    @foreach($packages as $key=> $pack)
                                    @if ($pack->package_type!="pods")
                                    <option value="{{ $pack->id}}" min_val="{{  $pack->min_amt }}" max_val="{{ $pack->max_amt }}">{{ $pack->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="purchaseAmount">Amount</label>
                                <input type="number" class="form-control" name="amount" id="purchaseAmount" placeholder="Enter Amount" required data-parsley-min="0" data-parsley-max="100">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputAmount">Select payment platform</label>
                                <select name="payment_method" id="port_payment_method" class="form-control" required>
                                    <option value="">Select Payment Platform</option>
                                    <option value="direct_deposit">Direct Deposit</option>
                                    <option value="main_wallet">Main Wallet</option>
                                    <option value="compound_wallet">Compound Wallet</option>
                                </select>
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
                            <div class="form-group col-md-12">
                                <label for="payout">Payout Dauration</label>
                                <select name="payout" class="form-control" id="payout" required>
                                    <option value="">Select Duration</option>
                                    <option value="daily_payout">Daily Payout</option>
                                    <option value="monthly_payout">Monthly Payout</option>
                                    <option value="6_months_compounding">6 Months Compounding</option>
                                    <option value="7_months_compounding">7 Months Compounding</option>
                                    <option value="8_months_compounding">8 Months Compounding</option>
                                    <option value="9_months_compounding">9 Months Compounding</option>
                                    <option value="10_months_compounding">10 Months Compounding</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-soft-primary ">Purchase portfolio</button>
                    </form>
                    <!--end /div-->
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <div class="col-lg-4"> 
            <div class="col-xl-12">
                <!-- card -->
                <div class="card bg-primary text-white shadow-primary card-h-100">
                    <!-- card body -->
                    <div class="card-body p-0">
                        <div id="carouselExampleCaptions1" class="carousel slide text-center widget-carousel" data-bs-ride="carousel">                                                   
                            <div class="carousel-inner">
                                @foreach ($Popup_Datas as $key=> $data )
                                    @if($data->status!="main" && $data->status!="deactivated")
                                    <div class="carousel-item {{ $key==0? "active" :"" }}">
                                        <img src="{{ $site_host.'/uploads/'.$data->image  }}" alt="" style="width:100%; height:580px; object-fit:cover;" >
                                    </div>
                                    @endif
                                @endforeach 
                            </div>
                            <!-- end carousel-inner -->
                            
                            {{-- <div class="carousel-indicators carousel-indicators-rounded">
                                @foreach ($Popup_Datas as $key=> $data )
                                <button type="button" data-bs-target="#carouselExampleCaptions1" data-bs-slide-to="{{ $key }}" class="{{ $key==0? "active" :"" }}"
                                    aria-current="{{ $key==0? "true" :"" }}" aria-label="Slide {{ $key }}"></button>
                                @endforeach 
                                 
                            </div> --}}
                            <!-- end carousel-indicators -->
                        </div>
                        <!-- end carousel -->
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            
            <!--end col-->
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Quick Re-Investment </h4>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <!--end card-header-->
                <div class="card-body">
                    <h6>Fill form to purchase investment portfolio</h6>

                    <form action="{{ route('user.reinvest.store') }}" method="post" class="form-parsley">
                        @csrf
                        <input type="hidden" name="quick_reinvest" value="true">

                        <div class="row mb-5">
                            <div class="form-group col-md-12">
                                <label for="investment_id">Active Investment</label>
                                <select name="investment_id" class="form-control" id="investment_id" required>
                                    <option value="">Select Investment</option>
                                    @foreach($recent_investments as $key=> $pack)
                                    <option value="{{ $pack->user_investments_id}}" category_name="{{  $pack->category_name }}" packagename="{{ $pack->packagename }}" curr_amount="{{ $pack->amount }}">{{ $pack->packagename}} - (${{ $pack->amount}})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="inputAmount">Add Amount</label>
                                <input type="decimal" name="amount" id="addAmountInput" placeholder="Add more funds to this portfolio" class="form-control" required data-parsley-min="100">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputAmount">Select payment platform</label>
                                <select name="payment_method" id="payment_method" class="form-control" required>
                                    <option value="">Select Payment Platform</option>
                                    <option value="direct_deposit">Direct Deposit</option>
                                    <option value="main_wallet">Main Wallet</option>
                                    <option value="compound_wallet">Compound Wallet</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12" id="reinvest_currency">
                                <label for="currency">Currency</label>
                                <select name="currency" class="form-control">
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
                        
                        <button type="submit" class="btn btn-soft-primary mt-5">Reinvest</button>
                    </form>
                    <!--end /div-->
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div> 
    </div>
    <!--end row-->
   {{-- <div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Transactions</h4>
                <a href="activity" class="btn btn-outline-primary">
                    View Transactions<i class="fi-arrow-right"></i>
                </a>
            </div><!-- end card header -->

            <div class="card-body px-0">
                <div class="table-responsive px-3" data-simplebar style="max-height: 352px;">
                    <table class="table align-middle table-nowrap table-borderless">
                        <tbody>
                            @foreach($activities as $active)
                            <tr>
                                <td style="width: 50px;"> 
                                    @if ($active->category=="earning" || $active->category=="bonus") 
                                    <div class="font-size-22 text-success">
                                        <i class="bx bx-down-arrow-circle d-block"></i>
                                    </div>
                                    @elseif ($active->category=="withdrawals")
                                     <div class="font-size-22 text-danger">
                                        <i class="bx bx-up-arrow-circle d-block"></i>
                                    </div>
                                    @elseif ($active->category=="transfer")
                                    <div class="font-size-22 text-success">
                                       <i class="bx bx-slider-alt d-block"></i>
                                   </div>
                                    @elseif ($active->category=="deposit")
                                    <div class="font-size-22 text-primary">
                                        <i class="bx bx-briefcase-alt d-block"></i>
                                    </div>
                                    @elseif ($active->category=="expired" || $active->category=="error" || $active->category=="cancelled")
                                    <div class="font-size-22 text-danger">
                                        <i class="bx bx-x d-block"></i>
                                    </div>
                                    
                                    @endif
                                </td>

                                <td>
                                    <div>
                                        <h5 class="font-size-14 mb-1">{{ $active->title }}</h5>
                                        <p class="font-size-14 mb-1" style="width: 20px">{{ $active->descp }}</p>
                                        <p class="text-muted mb-0 font-size-12">  {{ Carbon\Carbon::parse($active->date)->format('d F Y')  }}</p>
                                    </div>
                                </td>
                                 

                                <td>
                                    <div class="text-end">
                                        @if ($active->category=="earning" || $active->category=="bonus"|| $active->category=="transfer") 
                                        <h5 class="font-size-14 text-success mb-0">${{ $active->amount }}</h5>
                                        @elseif ($active->category=="deposit")
                                        <h5 class="font-size-14 text-primary mb-0">${{ $active->amount }}</h5>
                                        @else
                                        <h5 class="font-size-14 text-danger mb-0">${{ $active->amount }}</h5>
                                        @endif
                                        <p class="text-muted mb-0 font-size-12">Amount</p>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <div class="col-lg-4"> 
        <div class="col-xl-12">
            <!-- card -->
            <div class="card bg-primary text-white shadow-primary card-h-100">
                <!-- card body -->
                <div class="card-body p-0">
                    <div id="carouselExampleCaptions" class="carousel slide text-center widget-carousel" data-bs-ride="carousel">                                                   
                        <div class="carousel-inner">
                            @foreach ($messages as $key=> $mess )
                            <div class="carousel-item {{ $key==0? "active" :"" }}">
                                <div class="text-center p-4">                                     
                                    
                                    <h2 class="mt-3 lh-base fw-normal text-white"><b>Dell Group</b> Message</h2>
                                    <br>
                                    <p class="text-white font-size-20">{{ $mess->descp}}</p>
                                    <br><br>
                                    <a href="messages" class="btn btn-light btn-sm">View More <i class="mdi mdi-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                            @endforeach 
                        </div>
                        <!-- end carousel-inner -->
                        
                        <div class="carousel-indicators carousel-indicators-rounded">
                            @foreach ($messages as $key=> $mess )
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $key }}" class="{{ $key==0? "active" :"" }}"
                                aria-current="{{ $key==0? "true" :"" }}" aria-label="Slide {{ $key }}"></button>
                            @endforeach 
                             
                        </div>
                        <!-- end carousel-indicators -->
                    </div>
                    <!-- end carousel -->
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        
        <!--end col-->
    </div>
   </div> --}}

   <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title">Account Activities</h4>
                    </div>
                    <!--end col-->
                    <div class="col-auto">
                        <a href="activity" class="btn btn-outline-primary both">
                            View all Activities >><i class="fi-arrow-right"></i>
                        </a>
                    </div>
                    <!--end col-->

                </div>
                <!--end row-->
            </div>
            <!--end card-header-->
            <div class="card-body p-0">
                <div class="table-responsive browser_users ">
                    <table class="table mb-0 ">
                        <thead class="table-light ">
                            <tr class="tops">
                                <th class="border-top-0 ps-4"><b>Title</b></th>
                                <th class="border-top-0"><b>Description</b></th>
                                <th class="border-top-0"><b>Date</b></th>
                                <th class="border-top-0"><b>Amount</b></th>
                                <th class="border-top-0"><b>Status</b></th>
                            </tr>
                            <!--end tr-->
                        </thead>
                        <tbody>
                            @foreach($activities as $active)
                            <tr>
                                <td class="ps-4 pt-3 pb-3"><a href="#" class="text-primary">{{ $active->title }}</a></td>
                                <td class=" pt-3 pb-3">{{ $active->descp }}</td>
                                <td class=" pt-3 pb-3">{{ $active->date }}</td>
                                <td class=" pt-3 pb-3">${{ $active->amount }}</td>
                                @if ($active->category=="earning" || $active->category=="bonus")
                                <td class=" pt-3 pb-3"> <span class="bg-success p-1 font-10 text-white">WALLET CREDITED</span></td>
                                @elseif ($active->category=="compound_earning")
                                <td class=" pt-3 pb-3"> <span class="bg-danger p-1 font-10 text-white">COMPOUNDING INTEREST</span></td>
                                @elseif ($active->category=="withdrawals")
                                <td class=" pt-3 pb-3"> <span class="bg-danger p-1 font-10 text-white">WITHDRAWAL</span></td>
                                @elseif ($active->category=="deposit")
                                <td class=" pt-3 pb-3"> <span class="bg-primary p-1 font-10 text-white">DEPOSIT</span></td>
                                @elseif ($active->category=="expired")
                                <td class=" pt-3 pb-3"> <span class="bg-danger p-1 font-10 text-white">EXPIRED</span></td>
                                @elseif ($active->category=="error")
                                <td class=" pt-3 pb-3"> <span class="bg-danger p-1 font-10 text-white">ERROR</span></td>
                                @elseif ($active->category=="cancelled")
                                <td class=" pt-3 pb-3"> <span class="bg-danger p-1 font-10 text-white">CANCELLED</span></td>
                                @elseif ($active->category=="transfer")
                                <td> <span class="bg-success p-1 font-10 text-white">TRANSFER</span></td>
                                @endif

                            </tr>
                            <!--end tr-->
                            @endforeach

                        </tbody>

                    </table>
                    <!--end table-->
                </div>
                <!--end /div-->


            </div>
            <!--end card-body-->
        </div>
        <!--end card-->
    </div>
</div>
 
 <!-- right offcanvas -->
 <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header bg-white">
      <h3 id="offcanvasRightLabel " class="text-dark">Quick Survey</h3>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <hr>
     <h4>Would you like to see Portfolios with a shorter duration?</h4> 
       <form action="{{ route('user.dashboard.store') }}" method="POST">
        @csrf
        <div class="form-check">
            <input class="form-radio-input" type="radio" id="formCheck2"  name="choice" value="yes">
             
            <label class="form-check-label" for="formCheck2">
                Yes 
            </label>
            <div class="progress m-3 pro">
                <div class="progress-bar pro or" role="progressbar" aria-label="Example with label" style="width: {{ $surveyInfo->support??"0" }}%;" aria-valuenow="p{{ $surveyInfo->support??"0" }}" aria-valuemin="0" aria-valuemax="100"><b>{{ $surveyInfo->support??"0" }} %</b></div>
            </div>
            
        </div>
        <hr>
        <div class="form-check">
            <input class="form-radio-input" type="radio" id="formCheck2"  name="choice" value="no">
            <label class="form-check-label" for="formCheck2">
                No
            </label>
            <div class="progress m-3 pro">
                <div class="progress-bar pro or" role="progressbar" aria-label="Example with label" style="width: {{ $surveyInfo->withdrawals??"0" }}%;" aria-valuenow="p{{ $surveyInfo->withdrawals??"0" }}" aria-valuemin="0" aria-valuemax="100"><b>{{ $surveyInfo->withdrawals??"0" }} %</b></div>
            </div>
        </div>
        <hr>
         <div class="form-check">
            <input class="form-radio-input" type="radio" id="formCheck2"  name="choice" value="maybe">
            <label class="form-check-label" for="formCheck2">
                Maybe
            </label>
            <div class="progress m-3 pro">
                <div class="progress-bar pro or" role="progressbar" aria-label="Example with label" style="width: {{ $surveyInfo->deposits??"0" }}%;" aria-valuenow="p{{ $surveyInfo->deposits??"0" }}" aria-valuemin="0" aria-valuemax="100"><b>{{ $surveyInfo->deposits??"0" }} %</b></div>
            </div>
        </div>
        <hr>
       {{-- <div class="form-check">
            <input class="form-check-input" type="checkbox" id="formCheck2" name="functions" >
            <label class="form-check-label" for="formCheck2">
                Better technical functionalities
            </label>
        </div>
        <hr> --}}
        <label class="form-label" >
            Brief Comment
        </label>
        <textarea   class="form-control" name="comments" id="" cols="10" rows="3"> </textarea>
        <br>
        <div class="col-sm-auto">
            <button type="submit" class="btn btn-primary">Submit Survey</button>
        </div>
        
       </form>
    </div>
</div>
<br>
 



<div class="modal fade" id="drawModalDefault" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="exampleModalDefaultLabel">Withdrawal request
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!--end modal-header-->
            <div class="modal-body">
                <form action="{{ route('user.withdrawal-request.store') }}" method="post" class="form-parsley">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user_id }}">

                    <input type="hidden" name="currency_code" id="currency_code">
                    <input type="hidden" name="charge" id="charge">
                    <p>To make withdrawal, you have to generate a 2fa code with will be sent to your email address, paste the code on the 2fa field below to continue</p>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="inputAmount">Enter 2fa Code </label>
                                <input type="text" class="form-control 2fa" name="2fa" id="2fa" placeholder="Enter 2fa code">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <br>
                            <a href="dashboard?auth=yes" class="btn btn-info">Generate Code</a>
                        </div>
                    </div>

                    <div class="amount-group">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="inputAmount">Choose Withdraw Method</label>
                                <select name="withdrawal_methods_id" id="withdrawal_methods_id" required class="form-control">
                                    <option value="">Select Method</option>
                                    @foreach ($withdrawMethods as $met)
                                    <option value="{{ $met['id'] }}" currency_code="{{ $met['currency_code'] }}" charge="{{ $met['charges'] }}">{{ $met['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputAmount">Amount</label>
                                <input type="decimal" class="form-control" name="amount_paid" id="inputAmount" placeholder="Enter Amount" required data-parsley-min="0" data-parsley-max="0">
                            </div>
                            <input type="hidden" id="main_wallet_balance" value="{{ $main_wallet}}">
                            <input type="hidden" id="compound_wallet_balance" value="{{ $compound_wallet}}">
                            <div class="form-group col-md-12">
                                <label for="wallet">Wallet</label>
                                <select name="wallet_type" class="form-control" id="wallet_type" required>
                                    <option value="">Select Wallet</option>
                                    <option value="main_wallet">Portfolio Balance</option>
                                    <option value="compound_wallet">Compounding Dividends</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAmount">Wallet Address</label>
                            <input type="text" class="form-control" name="wallet_address" id="wallet_address" placeholder="Enter Wallet Address" required>
                        </div>
                    </div>

            </div>

            <!--end modal-body-->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary withdrawBtn">Withdraw</button>
                <button type="button" class="btn btn-soft-secondary " data-bs-dismiss="modal">Close</button>
            </div>
            <!--end modal-footer-->
            </form>
        </div>
        <!--end modal-content-->
    </div>
    <!--end modal-dialog-->
</div>
<!--end modal-->

<div class="modal fade" id="loadPopUp" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <!--end modal-header-->
            <div class="modal-body">
                @if($Popup_Data!=null)
                <h3>{{ $Popup_Data->title }}</h3>
                <a href="{{$Popup_Data->link}}">
                    <img src="{{ $site_host.'/uploads/'.$Popup_Data->image  }}" alt="" style="width: 100%; height:100%;">
                    <p>{{ $Popup_Data->descp }}</p>
                </a>
                @endif
            </div>

            <!--end modal-body-->
            <div class="modal-footer">

                <button type="button" class="btn btn-soft-primary " data-bs-dismiss="modal">Close</button>
            </div>
            <!--end modal-footer-->

        </div>
        <!--end modal-content-->
    </div>
    <!--end modal-dialog-->
</div>
<!--end modal-->
<script src="{{ asset('user-assets/js/jquery.min.js') }}"></script>
<script>
    $(window).on('load', function() { 

        @if($hasSurvey==null)
            //$('#offcanvasRight').offcanvas('show');
        @endif

        @if($Popup_Data != null && $Popup_Data -> status == "main")
        $('#loadPopUp').modal('show');
        @endif
        
    });
    localStorage.removeItem("reg_data")

  

    $("#withdrawal_methods_id").on('change', function() {
        //alert(`${$('option:selected', this).attr('currency_code')} and ${$('option:selected', this).attr('charge')}`)
        $("#currency_code").val($('option:selected', this).attr('currency_code'))
        $("#charge").val($('option:selected', this).attr('charge'))
    })

    $("#investment_packages_id").on('change', function() {
        $("#purchaseAmount").attr("data-parsley-min", $('option:selected', this).attr('min_val'))
        $("#purchaseAmount").attr("data-parsley-max", $('option:selected', this).attr('max_val'))
    })





    $("#wallet_type").on('change', function() {
        if ($(this).val() == "main_wallet") {
            $("#inputAmount").attr("data-parsley-max", $("#main_wallet_balance").val())
        } else if ($(this).val() == "compound_wallet") {
            $("#inputAmount").attr("data-parsley-max", $("#compound_wallet_balance").val())
        }
    })


    if ($(".2fa").val() == "") {
        $(".amount-group").hide()
        $(".withdrawBtn").hide()
    }

    $(".2fa").on('keyup change', function() {

        if ($(this).val().length == 6) {
            $(".amount-group").show()
            $(".withdrawBtn").show()
        } else {
            $(".amount-group").hide()
            $(".withdrawBtn").hide()
        }
    })

</script>

<script>
    $("#payment_method").on('change', function() {
        if ($(this).val() == "main_wallet" || $(this).val() == "compound_wallet") {
            $("#reinvest_currency").hide()
        } else {
            $("#reinvest_currency").show()
        }
    })

    $("#port_payment_method").on('change', function() {
        if ($(this).val() == "main_wallet" || $(this).val() == "compound_wallet") {
            $("#currency").hide()
            $("#currency_drop").attr("required", false)
        } else {
            $("#currency").show()
            $("#currency_drop").attr("required", true)
        }
    })

    

</script>
@endsection
 

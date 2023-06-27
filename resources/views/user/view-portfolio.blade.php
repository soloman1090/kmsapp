@extends('templates.main-user')

@section('content')
<style>
    .port1Heading {
        width: 100%;
        height: 450px;
        background-image: url('{{ asset('user-assets/images/portfolios/start.png') }}');
        background-size: cover;
        background-position: center;
        border-radius: 5px;
        padding-top: 100px;
    }

    .port1Heading h3 {
        color: white;
        padding-right: 100px;
        font-size: 30px;
        font-weight: 400;
        letter-spacing: 2px;
        line-height: 45px;
    }

    .port-title {
        font-weight: 900;
        font-size: 60px;
        line-height: 80px;
    }

    .port1-section .img1 {
        width: 70%;
    }

    .port1-section .img2 {
        width: 100%;
    }

    .img2 {
        width: 80%;
    }

    .port1-section h4 {
        font-weight: 800;
    }

</style>
<div class="card">
    <div class="port1Heading text-left ">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <h3 class=" p-3">The multi-asset nature of our approach means we cast the net wide to find individual investments and our research ranges from simpler research, such as equity funds, to more sophisticated areas such as investment trusts, structured products and more complex funds.
                </h3>
            </div>
        </div>
    </div>
    <div class="container p-5 port1-section">

        <h1 class="port-title text-center">Our Holistic Approach </h1>
        <br>
        <p class="font-22">We look to invest in companies and management teams who can benefit from our capital,
            strategic insight, institutional relationships, and robust operational support to amplify growth.</p>
        <br>
        <div class="row text-center">
            <div class="col-md-5">
                <h4 class="bold">Dell Group'S UNIQUE, VERTICALLY INTEGRATED MODEL</h4>
                <br>
                <img class="img1" src="{{ asset('user-assets/images/portfolios/port-img-1.png') }}" alt="">
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-5">
                <h4 class="bold">SUPPORTS A FLEXIBLE, SCALABLE PLATFORM</h4>
                <br>
                <img class="img2" src="{{ asset('user-assets/images/portfolios/port-img-2.png') }}" alt="">
            </div>
        </div>
    </div>
    <hr>
    <h1 class="port-title text-center">{{ $packages[0]['category_name'] }} </h1>
    <hr>
    <div class="row">

        <div class="col-lg-6">
            <div class="card">
                @if ($packages[0]['bonus_percentage']!=null && $packages[0]['bonus_percentage']>0)
                <div class="bg-danger btn-outline-dashed w-100 text-center p-2 text-white">Advanced Credit Financing Available @ <b>{{ $packages[0]['bonus_percentage']*100 }}%</b> For Minimum Investments Of <b>$5,000</b></div>
                @endif
                <div class="card-body">
                    <div class="pricingTable1 text-center">

                        <h3 class="title1 py-3 mt-2 mb-0 font-25">{{ $packages[0]['name'] }} <br> <small class="text-muted font-12">{{ $packages[0]['min_percent'] }}% - {{ $packages[0]['max_percent'] }}
                                Commision</small></h3>
                        <h6>Duration: <b>{{ $packages[0]['duration'] }} months</b> </h6>
                        <hr class="hr-dashed my-4">
                        <div class="text-center">
                            <h3 class="amount">$ {{ $packages[0]['min_amt'] }} USD </h3>
                        </div>
                        <ul class="list-unstyled pricing-content-2">
                            <li><b>{{ $packages[0]['compound_percent'] }}%</b> Compounding Percentage </li>
                            <li><b>{{ $packages[0]['compound_duration'] }}-Months</b> Compounding Duration </li>
                            <li><b>{{ $packages[0]['info_head_1'] }}</b>
                                <p>{{ $packages[0]['info_detail_1'] }}</p>
                            </li>
                            <li><b>{{ $packages[0]['info_head_2'] }}</b>
                                <p>{{ $packages[0]['info_detail_2'] }} </p>
                            </li>
                            <li><b>{{ $packages[0]['info_head_3'] }}</b>
                                <p>{{ $packages[0]['info_detail_3'] }}</p>
                            </li>
                            {{-- <li><b>{{ $pac['info_head_4'] }}</b>
                            <p>{{ $pac['info_detail_4'] }}</p>
                            </li> --}}
                        </ul>

                        <a href="" data-bs-toggle="modal" data-bs-target="#portModalDefault{{ $packages[0]['id'] }}" class="btn btn-primary w-100  btn-outline-dashed py-2"><span>Get Started </span></a>
                    </div>
                    <!--end pricingTable-->
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->

        <div class="modal fade" id="portModalDefault{{ $packages[0]['id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title m-0" id="exampleModalDefaultLabel">Purchase investment portfolio
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!--end modal-header-->
                    <div class="modal-body">
                        
                        <h3 class="text-center">{{ $packages[0]['name'] }}</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="bg-danger btn-outline-dashed w-100 text-center p-2 text-white">Advanced Credit Financing Available @ <b>{{ $packages[0]['bonus_percentage']*100 }}%</b> For Minimum Investments Of <b>$5,000</b></div>

                                <h1 class="text-center text-primary">${{ $packages[0]['min_amt'] }}</h1>
                                <div class="text-center">
                                    <small class="text-center font-16">Minimum Investment</small>
                                </div>
                                <hr>
                                <h2 class="text-center text-primary" style=" font-weight:500;">{{ $packages[0]['min_percent'] }} - {{ $packages[0]['max_percent'] }}%</h2>
                                <div class="text-center">
                                    <small class="text-center font-16">Commission</small>
                                </div>
                                <hr>
                                <div class="row text-center">
                                    <div class="col-md-12">
                                        <p><b>{{ $packages[0]['compound_percent'] }}%:</b> Compounding Percentage</p>
                                    </div>
                                    <hr>
                                    <div class="col-md-12">
                                        <p><b>{{ $packages[0]['duration'] }}-Months:</b> Portfolio Duration </p>
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
                                        <input type="hidden" name="investment_packages_id" value="{{ $packages[0]['id'] }}">
                                        <input type="hidden" name="returns" id="returns" value="23.4">
                                        <div class="form-group col-md-12">
                                            <label for="inputAmount">Amount</label>
                                            <input type="number" class="form-control" name="amount" id="inputAmount" placeholder="Enter Amount" required data-parsley-min="{{ $packages[0]['min_amt'] }}" data-parsley-max="{{ $packages[0]['max_amt'] }}">
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
                                                                    <option value="BCH">Bitcoin Cash (BCH)</option>
                                                                    <option value="USDTTRC20">Tether USD TRC20 (USDTTRC20)</option>
                                                                    <option value="USDTERC20">Tether USD ERC20 (USDTERC20)</option>

                                                                    {{-- <option value="DASH">Dash (DASH)</option>
                                                                    <option value="TZEC">Zcash (TZEC)</option>
                                                                    <option value="DOGE">Dogecoin (DOGE)</option> 
                                                                    <option value="XMR">Monero (XMR)</option>
                                                                    <option value="TRX">Tron (TRX)</option>
                                                                    <option value="USDT">Tether ERC-20( USDT)</option>
                                                                    <option value="USDC">USD Coin (USDC)</option>
                                                                    <option value="SHIB">Shiba Inu (SHIB)</option>
                                                                    <option value="BTT">BitTorrent TRC-20 (BTT)</option> 
                                                                    <option value="BNB">BNB Chain (BNB)</option>
                                                                    <option value="BUSD">Binance USD BEP-20 (BUSD)</option> --}}
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
        <!--end modal-->


        <div class="col-lg-6">
            <div class="card">
                {{-- @if ($packages[1]['bonus_percentage']!=null && $packages[1]['bonus_percentage']>0)
                <div class="bg-danger btn-outline-dashed w-100 text-center p-2 text-white">Advanced Credit Financing Available  @ <b>{{ $packages[1]['bonus_percentage']*100 }}%</b> For Minimum Investments Of <b>$5,000</b></div>
                @endif --}}
                <div class="card-body">
                    <div class="pricingTable1 text-center">

                        <h3 class="title1 py-3 mt-2 mb-0 font-25">{{ $packages[1]['name'] }} <br> <small class="text-muted font-12">{{ $packages[1]['min_percent'] }}% - {{ $packages[1]['max_percent'] }}
                                Commision</small></h3>
                        <h6>Duration: <b>{{ $packages[1]['duration'] }} months</b> </h6>
                        <hr class="hr-dashed my-4">
                        <div class="text-center">
                            <h3 class="amount">$ {{ $packages[1]['min_amt'] }} USD </h3>
                        </div>
                        <ul class="list-unstyled pricing-content-2">
                            <li><b>{{ $packages[1]['compound_percent'] }}%</b> Compounding Percentage </li>
                            <li><b>{{ $packages[1]['compound_duration'] }}-Months</b> Compounding Duration </li>
                            <li><b>{{ $packages[1]['info_head_1'] }}</b>
                                <p>{{ $packages[1]['info_detail_1'] }}</p>
                            </li>
                            <li><b>{{ $packages[1]['info_head_2'] }}</b>
                                <p>{{ $packages[1]['info_detail_2'] }} </p>
                            </li>
                            <li><b>{{ $packages[1]['info_head_3'] }}</b>
                                <p>{{ $packages[1]['info_detail_3'] }}</p>
                            </li>
                            
                        </ul>

                        <a href="" data-bs-toggle="modal" data-bs-target="#portModalDefault{{ $packages[1]['id'] }}" class="btn btn-primary w-100  btn-outline-dashed py-2"><span>Get Started </span></a>
                    </div>
                    <!--end pricingTable-->
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->

        <div class="modal fade" id="portModalDefault{{ $packages[1]['id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title m-0" id="exampleModalDefaultLabel">Purchase investment portfolio
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!--end modal-header-->
                    <div class="modal-body">
                        <h3 class="text-center">{{ $packages[1]['name'] }}</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                {{-- <div class="bg-danger btn-outline-dashed w-100 text-center p-2 text-white">Advanced Credit Financing Available @ <b>{{ $packages[1]['bonus_percentage']*100 }}%</b> For Minimum Investments Of <b>$5,000</b></div> --}}

                                <h1 class="text-center text-primary">${{ $packages[1]['min_amt'] }}</h1>
                                <div class="text-center">
                                    <small class="text-center font-16">Minimum Investment</small>
                                </div>
                                <hr>
                                <h2 class="text-center text-primary" style=" font-weight:500;">{{ $packages[1]['min_percent'] }} - {{ $packages[1]['max_percent'] }}%</h2>
                                <div class="text-center">
                                    <small class="text-center font-16">Commission</small>
                                </div>
                                <hr>
                                <div class="row text-center">
                                    <div class="col-md-12">
                                        <p><b>{{ $packages[1]['compound_percent'] }}%:</b> Compounding Percentage</p>
                                    </div>
                                    <hr>
                                    <div class="col-md-12">
                                        <p><b>{{ $packages[1]['duration'] }}-Months:</b> Portfolio Duration </p>
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
                                        <input type="hidden" name="investment_packages_id" value="{{ $packages[1]['id'] }}">
                                        <input type="hidden" name="returns" id="returns" value="23.4">
                                        <div class="form-group col-md-12">
                                            <label for="inputAmount">Amount</label>
                                            <input type="number" class="form-control" name="amount" id="inputAmount" placeholder="Enter Amount" required data-parsley-min="{{ $packages[1]['min_amt'] }}" data-parsley-max="{{ $packages[1]['max_amt'] }}">
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
                                                <option value="BCH">Bitcoin Cash (BCH)</option>
                                                <option value="USDTTRC20">Tether USD TRC20 (USDTTRC20)</option>
                                                <option value="USDTERC20">Tether USD ERC20 (USDTERC20)</option>

                                                {{-- <option value="DASH">Dash (DASH)</option>
                                                <option value="TZEC">Zcash (TZEC)</option>
                                                <option value="DOGE">Dogecoin (DOGE)</option> 
                                                <option value="XMR">Monero (XMR)</option>
                                                <option value="TRX">Tron (TRX)</option>
                                                <option value="USDT">Tether ERC-20( USDT)</option>
                                                <option value="USDC">USD Coin (USDC)</option>
                                                <option value="SHIB">Shiba Inu (SHIB)</option>
                                                <option value="BTT">BitTorrent TRC-20 (BTT)</option> 
                                                <option value="BNB">BNB Chain (BNB)</option>
                                                <option value="BUSD">Binance USD BEP-20 (BUSD)</option> --}}
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
        <!--end modal-->
        <!--end modal-->



    </div>
    <div class="container p-3">
        <div class="row">
            <div class="col-md-4">
                <h4>Our investment process has four stages, with the ultimate target of generating real returns well ahead of inflation.</h4>
                <img src="{{ asset('user-assets/images/portfolios/sniptxt1.PNG') }}" alt="" style="width: 90%">
            </div>
            <div class="col-md-4">
                <h4>Stage 1: Understand how much risk we need to reach our targets</h4>
                <p>Client outcomes drive our investment process and to achieve our minimum return targets, we start with how much risk we need to take over the longer term. In it’s simplest form, this is expressed as a percentage of the risk of investing in purely global shares</p>
                <br>
                <br>
                <h4>Stage 3: Identify the investments with the best growth potential.</h4>
                <p>Next we decide which asset classes to allocate capital towards, requiring us to identify and understand the best available opportunities around the world. To do this, we work with independent economists as well as those close to markets, to build a broad and balanced outlook.</p>
            </div>
            <div class="col-md-4">
                <h4>Stage 2: Decide how much risk to take right now</h4>
                <p>Every month we review whether to increase or decrease the risk of our portfolios, while always remaining within the agreed risk budget. Within any client’s mandate we can routinely flex risk up to around 110% and down to around 85% of the long term risk needed to deliver target returns.</p>
                <br>
                <br>
                <h4>Stage 4: Build the portfolio</h4>
                <p>This requires careful thought, not only about the potential returns from the investments identified in stage 3, but also how they interact and piece together. Our aim is to construct an efficient portfolio that offers the best risk reward profile within the tactical risk budget from stage 2.</p>
            </div>
        </div>
        <br>
        <br>
        <div class="text-center">
            <img class="img2 " src="{{ asset('user-assets/images/portfolios/Target_Return_Chart.png') }}" alt="">
        </div>
        <br>
        <br>
    </div>
    <hr>
    <h1 class="port-title text-center">{{ $packages[2]['category_name'] }} </h1>
    <hr>
    <div class="row">

        <div class="col-lg-6">
            <div class="card">
                {{-- @if ($packages[2]['bonus_percentage']!=null && $packages[2]['bonus_percentage']>0)
                <div class="bg-danger btn-outline-dashed w-100 text-center p-2 text-white">Advanced Credit Financing Available  @ <b>{{ $packages[2]['bonus_percentage']*100 }}%</b> For Minimum Investments Of <b>$5,000</b></div>
                @endif --}}
                <div class="card-body">
                    <div class="pricingTable1 text-center">

                        <h3 class="title1 py-3 mt-2 mb-0 font-25">{{ $packages[2]['name'] }} <br> <small class="text-muted font-12">{{ $packages[2]['min_percent'] }}% - {{ $packages[2]['max_percent'] }}
                                Commision</small></h3>
                        <h6>Duration: <b>{{ $packages[2]['duration'] }} months</b> </h6>
                        <hr class="hr-dashed my-4">
                        <div class="text-center">
                            <h3 class="amount">$ {{ $packages[2]['min_amt'] }} USD </h3>
                        </div>
                        <ul class="list-unstyled pricing-content-2">
                            <li><b>{{ $packages[2]['compound_percent'] }}%</b> Compounding Percentage </li>
                            <li><b>{{ $packages[2]['compound_duration'] }}-Months</b> Compounding Duration </li>
                            <li><b>{{ $packages[2]['info_head_1'] }}</b>
                                <p>{{ $packages[2]['info_detail_1'] }}</p>
                            </li>
                            <li><b>{{ $packages[2]['info_head_2'] }}</b>
                                <p>{{ $packages[2]['info_detail_2'] }} </p>
                            </li>
                            <li><b>{{ $packages[2]['info_head_3'] }}</b>
                                <p>{{ $packages[2]['info_detail_3'] }}</p>
                            </li>
                            <li>
                                <b>{{ $packages[2]['info_head_4'] }}</b>
                                <p>{{ $packages[2]['info_detail_4'] }}</p>
                            </li>
                        </ul>

                        <a href="" data-bs-toggle="modal" data-bs-target="#portModalDefault{{ $packages[2]['id'] }}" class="btn btn-primary w-100 btn-outline-dashed py-2"><span>Get Started </span></a>
                    </div>
                    <!--end pricingTable-->
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->

        <div class="modal fade" id="portModalDefault{{ $packages[2]['id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title m-0" id="exampleModalDefaultLabel">Purchase investment portfolio
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!--end modal-header-->
                    <div class="modal-body">
                        <h3 class="text-center">{{ $packages[2]['name'] }}</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                {{-- <div class="bg-danger btn-outline-dashed w-100 text-center p-2 text-white">Advanced Credit Financing Available @ <b>{{ $packages[2]['bonus_percentage']*100 }}%</b> For Minimum Investments Of <b>$5,000</b></div> --}}

                                <h1 class="text-center text-primary">${{ $packages[2]['min_amt'] }}</h1>
                                <div class="text-center">
                                    <small class="text-center font-16">Minimum Investment</small>
                                </div>
                                <hr>
                                <h2 class="text-center text-primary" style=" font-weight:500;">{{ $packages[2]['min_percent'] }} - {{ $packages[2]['max_percent'] }}%</h2>
                                <div class="text-center">
                                    <small class="text-center font-16">Commission</small>
                                </div>
                                <hr>
                                <div class="row text-center">
                                    <div class="col-md-12">
                                        <p><b>{{ $packages[2]['compound_percent'] }}%:</b> Compounding Percentage</p>
                                    </div>
                                    <hr>
                                    <div class="col-md-12">
                                        <p><b>{{ $packages[2]['duration'] }}-Months:</b> Portfolio Duration </p>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <h5>Fill form to purchase investment</h5>
                                <br>
                                <form action="{{ route('user.get-payment.index') }}" class="form-parsley" method="get">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="user_id" value="{{ $user_id }}">
                                        <input type="hidden" name="investment_packages_id" value="{{ $packages[2]['id'] }}">
                                        <input type="hidden" name="returns" id="returns" value="23.4">
                                        <div class="form-group col-md-12">
                                            <label for="inputAmount">Amount</label>
                                            <input type="number" class="form-control" name="amount" id="inputAmount" placeholder="Enter Amount" required data-parsley-min="{{ $packages[2]['min_amt'] }}" data-parsley-max="{{ $packages[2]['max_amt'] }}">
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
                                                                    <option value="BCH">Bitcoin Cash (BCH)</option>
                                                                    <option value="USDTTRC20">Tether USD TRC20 (USDTTRC20)</option>
                                                                    <option value="USDTERC20">Tether USD ERC20 (USDTERC20)</option>

                                                                    {{-- <option value="DASH">Dash (DASH)</option>
                                                                    <option value="TZEC">Zcash (TZEC)</option>
                                                                    <option value="DOGE">Dogecoin (DOGE)</option> 
                                                                    <option value="XMR">Monero (XMR)</option>
                                                                    <option value="TRX">Tron (TRX)</option>
                                                                    <option value="USDT">Tether ERC-20( USDT)</option>
                                                                    <option value="USDC">USD Coin (USDC)</option>
                                                                    <option value="SHIB">Shiba Inu (SHIB)</option>
                                                                    <option value="BTT">BitTorrent TRC-20 (BTT)</option> 
                                                                    <option value="BNB">BNB Chain (BNB)</option>
                                                                    <option value="BUSD">Binance USD BEP-20 (BUSD)</option> --}}
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
        <!--end modal-->

        <div class="col-lg-6">
            <div class="card">
                {{-- @if ($packages[3]['bonus_percentage']!=null && $packages[3]['bonus_percentage']>0)
                <div class="bg-danger btn-outline-dashed w-100 text-center p-2 text-white">Advanced Credit Financing Available  @ <b>{{ $packages[3]['bonus_percentage']*100 }}%</b> For Minimum Investments Of <b>$5,000</b></div>
                @endif --}}
                <div class="card-body">
                    <div class="pricingTable1 text-center">

                        <h3 class="title1 py-3 mt-2 mb-0 font-25">{{ $packages[3]['name'] }} <br> <small class="text-muted font-12">{{ $packages[3]['min_percent'] }}% - {{ $packages[3]['max_percent'] }}
                                Commision</small></h3>
                        <h6>Duration: <b>{{ $packages[3]['duration'] }} months</b> </h6>
                        <hr class="hr-dashed my-4">
                        <div class="text-center">
                            <h3 class="amount">$ {{ $packages[3]['min_amt'] }} USD </h3>
                        </div>
                        <ul class="list-unstyled pricing-content-2">
                            <li><b>{{ $packages[3]['compound_percent'] }}%</b> Compounding Percentage </li>
                            <li><b>{{ $packages[3]['compound_duration'] }}-Months</b> Compounding Duration </li>
                            <li><b>{{ $packages[3]['info_head_1'] }}</b>
                                <p>{{ $packages[3]['info_detail_1'] }}</p>
                            </li>
                            <li><b>{{ $packages[3]['info_head_2'] }}</b>
                                <p>{{ $packages[3]['info_detail_2'] }} </p>
                            </li>
                            <li><b>{{ $packages[3]['info_head_3'] }}</b>
                                <p>{{ $packages[3]['info_detail_3'] }}</p>
                            </li>
                            <li>
                                <b>{{ $packages[3]['info_head_4'] }}</b>
                                <p>{{ $packages[3]['info_detail_4'] }}</p>
                            </li>
                        </ul>

                        <a href="" data-bs-toggle="modal" data-bs-target="#portModalDefault{{ $packages[3]['id'] }}" class="btn btn-primary w-100 btn-outline-dashed py-2"><span>Get Started </span></a>
                    </div>
                    <!--end pricingTable-->
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->

        <div class="modal fade" id="portModalDefault{{ $packages[3]['id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title m-0" id="exampleModalDefaultLabel">Purchase investment portfolio
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!--end modal-header-->
                    <div class="modal-body">
                        <h3 class="text-center">{{ $packages[3]['name'] }}</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                {{-- <div class="bg-danger btn-outline-dashed w-100 text-center p-2 text-white">Advanced Credit Financing Available @ <b>{{ $packages[3]['bonus_percentage']*100 }}%</b> For Minimum Investments Of <b>$5,000</b></div> --}}

                                <h1 class="text-center text-primary">${{ $packages[3]['min_amt'] }}</h1>
                                <div class="text-center">
                                    <small class="text-center font-16">Minimum Investment</small>
                                </div>
                                <hr>
                                <h2 class="text-center text-primary" style=" font-weight:500;">{{ $packages[3]['min_percent'] }} - {{ $packages[3]['max_percent'] }}%</h2>
                                <div class="text-center">
                                    <small class="text-center font-16">Commission</small>
                                </div>
                                <hr>
                                <div class="row text-center">
                                    <div class="col-md-12">
                                        <p><b>{{ $packages[3]['compound_percent'] }}%:</b> Compounding Percentage</p>
                                    </div>
                                    <hr>
                                    <div class="col-md-12">
                                        <p><b>{{ $packages[3]['duration'] }}-Months:</b> Portfolio Duration </p>
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
                                        <input type="hidden" name="investment_packages_id" value="{{ $packages[3]['id'] }}">
                                        <input type="hidden" name="returns" id="returns" value="23.4">
                                        <div class="form-group col-md-12">
                                            <label for="inputAmount">Amount</label>
                                            <input type="number" class="form-control" name="amount" id="inputAmount" placeholder="Enter Amount" required data-parsley-min="{{ $packages[3]['min_amt'] }}" data-parsley-max="{{ $packages[3]['max_amt'] }}">
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
                                                                    <option value="BCH">Bitcoin Cash (BCH)</option>
                                                                    <option value="USDTTRC20">Tether USD TRC20 (USDTTRC20)</option>
                                                                    <option value="USDTERC20">Tether USD ERC20 (USDTERC20)</option>

                                                                    {{-- <option value="DASH">Dash (DASH)</option>
                                                                    <option value="TZEC">Zcash (TZEC)</option>
                                                                    <option value="DOGE">Dogecoin (DOGE)</option> 
                                                                    <option value="XMR">Monero (XMR)</option>
                                                                    <option value="TRX">Tron (TRX)</option>
                                                                    <option value="USDT">Tether ERC-20( USDT)</option>
                                                                    <option value="USDC">USD Coin (USDC)</option>
                                                                    <option value="SHIB">Shiba Inu (SHIB)</option>
                                                                    <option value="BTT">BitTorrent TRC-20 (BTT)</option> 
                                                                    <option value="BNB">BNB Chain (BNB)</option>
                                                                    <option value="BUSD">Binance USD BEP-20 (BUSD)</option> --}}
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
                            </div>
                        </div>
                    </div>
                    <!--end modal-body-->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-soft-primary btn-sm">Purchase</button>
                        <button type="button" class="btn btn-soft-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    </div>
                    <!--end modal-footer-->
                    </form>
                </div>
                <!--end modal-content-->
            </div>
            <!--end modal-dialog-->
        </div>
        <!--end modal-->


    </div>
    <div class="container p-5 text-center">
        <br>
        <br>
        <img class="img2" src="{{ asset('user-assets/images/portfolios/sniptxt2.PNG') }}" alt="">
        <br>
        <br>
    </div>
    <hr>
    <h1 class="port-title text-center">{{ $packages[4]['category_name'] }} </h1>
    <hr>
    <div class="row">

        <div class="col-lg-6">
            <div class="card">
                {{-- @if ($packages[4]['bonus_percentage']!=null && $packages[4]['bonus_percentage']>0)
                <div class="bg-danger btn-outline-dashed w-100 text-center p-2 text-white">Advanced Credit Financing Available @ <b>{{ $packages[4]['bonus_percentage']*100 }}%</b> For Minimum Investments Of <b>$5,000</b></div>
                @endif --}}
                <div class="card-body">
                    <div class="pricingTable1 text-center">

                        <h3 class="title1 py-3 mt-2 mb-0 font-25">{{ $packages[4]['name'] }} <br> <small class="text-muted font-12">{{ $packages[4]['min_percent'] }}% - {{ $packages[4]['max_percent'] }}
                                Commision</small></h3>
                        <h6>Duration: <b>{{ $packages[4]['duration'] }} months</b> </h6>
                        <hr class="hr-dashed my-4">
                        <div class="text-center">
                            <h3 class="amount">$ {{ $packages[4]['min_amt'] }} USD </h3>
                        </div>
                        <ul class="list-unstyled pricing-content-2">
                            <li><b>{{ $packages[4]['compound_percent'] }}%</b> Compounding Percentage </li>
                            <li><b>{{ $packages[4]['compound_duration'] }}-Months</b> Compounding Duration </li>
                            <li><b>{{ $packages[4]['info_head_1'] }}</b>
                                <p>{{ $packages[4]['info_detail_1'] }}</p>
                            </li>
                            <li><b>{{ $packages[4]['info_head_2'] }}</b>
                                <p>{{ $packages[4]['info_detail_2'] }} </p>
                            </li>
                            <li><b>{{ $packages[4]['info_head_3'] }}</b>
                                <p>{{ $packages[4]['info_detail_3'] }}</p>
                            </li>
                            <li><b>{{ $packages[4]['info_head_4'] }}</b>
                                <p>{{ $packages[4]['info_detail_4'] }}</p>
                            </li>
                        </ul>

                        <a href="" data-bs-toggle="modal" data-bs-target="#portModalDefault{{ $packages[4]['id'] }}" class="btn btn-primary w-100 btn-outline-dashed py-2"><span>Get Started </span></a>
                    </div>
                    <!--end pricingTable-->
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->

        <div class="modal fade" id="portModalDefault{{ $packages[4]['id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title m-0" id="exampleModalDefaultLabel">Purchase investment portfolio
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!--end modal-header-->
                    <div class="modal-body">
                        <h3 class="text-center">{{ $packages[4]['name'] }}</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                {{-- <div class="bg-danger btn-outline-dashed w-100 text-center p-2 text-white">Advanced Credit Financing Available @ <b>{{ $packages[4]['bonus_percentage']*100 }}%</b> For Minimum Investments Of <b>$5,000</b></div> --}}

                                <h1 class="text-center text-primary">${{ $packages[4]['min_amt'] }}</h1>
                                <div class="text-center">
                                    <small class="text-center font-16">Minimum Investment</small>
                                </div>
                                <hr>
                                <h2 class="text-center text-primary" style=" font-weight:500;">{{ $packages[4]['min_percent'] }} - {{ $packages[4]['max_percent'] }}%</h2>
                                <div class="text-center">
                                    <small class="text-center font-16">Commission</small>
                                </div>
                                <hr>
                                <div class="row text-center">
                                    <div class="col-md-12">
                                        <p><b>{{ $packages[4]['compound_percent'] }}%:</b> Compounding Percentage</p>
                                    </div>
                                    <hr>
                                    <div class="col-md-12">
                                        <p><b>{{ $packages[4]['duration'] }}-Months:</b> Portfolio Duration </p>
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
                                        <input type="hidden" name="investment_packages_id" value="{{ $packages[4]['id'] }}">
                                        <input type="hidden" name="returns" id="returns" value="23.4">
                                        <div class="form-group col-md-12">
                                            <label for="inputAmount">Amount</label>
                                            <input type="number" class="form-control" name="amount" id="inputAmount" placeholder="Enter Amount" required data-parsley-min="{{ $packages[4]['min_amt'] }}" data-parsley-max="{{ $packages[4]['max_amt'] }}">
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
                                                                    <option value="BCH">Bitcoin Cash (BCH)</option>
                                                                    <option value="USDTTRC20">Tether USD TRC20 (USDTTRC20)</option>
                                                                    <option value="USDTERC20">Tether USD ERC20 (USDTERC20)</option>

                                                                    {{-- <option value="DASH">Dash (DASH)</option>
                                                                    <option value="TZEC">Zcash (TZEC)</option>
                                                                    <option value="DOGE">Dogecoin (DOGE)</option> 
                                                                    <option value="XMR">Monero (XMR)</option>
                                                                    <option value="TRX">Tron (TRX)</option>
                                                                    <option value="USDT">Tether ERC-20( USDT)</option>
                                                                    <option value="USDC">USD Coin (USDC)</option>
                                                                    <option value="SHIB">Shiba Inu (SHIB)</option>
                                                                    <option value="BTT">BitTorrent TRC-20 (BTT)</option> 
                                                                    <option value="BNB">BNB Chain (BNB)</option>
                                                                    <option value="BUSD">Binance USD BEP-20 (BUSD)</option> --}}
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
        <!--end modal-->

        <div class="col-lg-6">
            <div class="card">
                {{-- @if ($packages[5]['bonus_percentage']!=null && $packages[5]['bonus_percentage']>0)
                <div class="bg-danger btn-outline-dashed w-100 text-center p-2 text-white">Advanced Credit Financing Available @ <b>{{ $packages[5]['bonus_percentage']*100 }}%</b> For Minimum Investments Of <b>$5,000</b></div>
                @endif --}}
                <div class="card-body">
                    <div class="pricingTable1 text-center">

                        <h3 class="title1 py-3 mt-2 mb-0 font-25">{{ $packages[5]['name'] }} <br> <small class="text-muted font-12">{{ $packages[5]['min_percent'] }}% - {{ $packages[5]['max_percent'] }}
                                Commision</small></h3>
                        <h6>Duration: <b>{{ $packages[5]['duration'] }} months</b> </h6>
                        <hr class="hr-dashed my-4">
                        <div class="text-center">
                            <h3 class="amount">$ {{ $packages[5]['min_amt'] }} USD </h3>
                        </div>
                        <ul class="list-unstyled pricing-content-2">
                            <li><b>{{ $packages[5]['compound_percent'] }}%</b> Compounding Percentage </li>
                            <li><b>{{ $packages[5]['compound_duration'] }}-Months</b> Compounding Duration </li>
                            <li><b>{{ $packages[5]['info_head_1'] }}</b>
                                <p>{{ $packages[5]['info_detail_1'] }}</p>
                            </li>
                            <li><b>{{ $packages[5]['info_head_2'] }}</b>
                                <p>{{ $packages[5]['info_detail_2'] }} </p>
                            </li>
                            <li><b>{{ $packages[5]['info_head_3'] }}</b>
                                <p>{{ $packages[5]['info_detail_3'] }}</p>
                            </li>
                            <li><b>{{ $packages[5]['info_head_4'] }}</b>
                                <p>{{ $packages[5]['info_detail_4'] }}</p>
                            </li>
                        </ul>

                        <a href="" data-bs-toggle="modal" data-bs-target="#portModalDefault{{ $packages[5]['id'] }}" class="btn btn-primary w-100 btn-outline-dashed py-2"><span>Get Started </span></a>
                    </div>
                    <!--end pricingTable-->
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->

        <div class="modal fade" id="portModalDefault{{ $packages[5]['id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title m-0" id="exampleModalDefaultLabel">Purchase investment portfolio
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!--end modal-header-->
                    <div class="modal-body">

                        <h3 class="text-center">{{ $packages[5]['name'] }}</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                {{-- <div class="bg-danger btn-outline-dashed w-100 text-center p-2 text-white">Advanced Credit Financing Available @ <b>{{ $packages[5]['bonus_percentage']*100 }}%</b> For Minimum Investments Of <b>$5,000</b></div> --}}

                                <h1 class="text-center text-primary">${{ $packages[5]['min_amt'] }}</h1>
                                <div class="text-center">
                                    <small class="text-center font-16">Minimum Investment</small>
                                </div>
                                <hr>
                                <h2 class="text-center text-primary" style=" font-weight:500;">{{ $packages[5]['min_percent'] }} - {{ $packages[5]['max_percent'] }}%</h2>
                                <div class="text-center">
                                    <small class="text-center font-16">Commission</small>
                                </div>
                                <hr>
                                <div class="row text-center">
                                    <div class="col-md-12">
                                        <p><b>{{ $packages[5]['compound_percent'] }}%:</b> Compounding Percentage</p>
                                    </div>
                                    <hr>
                                    <div class="col-md-12">
                                        <p><b>{{ $packages[5]['duration'] }}-Months:</b> Portfolio Duration </p>
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
                                        <input type="hidden" name="investment_packages_id" value="{{ $packages[5]['id'] }}">
                                        <input type="hidden" name="returns" id="returns" value="23.4">
                                        <div class="form-group col-md-12">
                                            <label for="inputAmount">Amount</label>
                                            <input type="number" class="form-control" name="amount" id="inputAmount" placeholder="Enter Amount" required data-parsley-min="{{ $packages[5]['min_amt'] }}" data-parsley-max="{{ $packages[5]['max_amt'] }}">
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
                                                                    <option value="BCH">Bitcoin Cash (BCH)</option>
                                                                    <option value="USDTTRC20">Tether USD TRC20 (USDTTRC20)</option>
                                                                    <option value="USDTERC20">Tether USD ERC20 (USDTERC20)</option>

                                                                    {{-- <option value="DASH">Dash (DASH)</option>
                                                                    <option value="TZEC">Zcash (TZEC)</option>
                                                                    <option value="DOGE">Dogecoin (DOGE)</option> 
                                                                    <option value="XMR">Monero (XMR)</option>
                                                                    <option value="TRX">Tron (TRX)</option>
                                                                    <option value="USDT">Tether ERC-20( USDT)</option>
                                                                    <option value="USDC">USD Coin (USDC)</option>
                                                                    <option value="SHIB">Shiba Inu (SHIB)</option>
                                                                    <option value="BTT">BitTorrent TRC-20 (BTT)</option> 
                                                                    <option value="BNB">BNB Chain (BNB)</option>
                                                                    <option value="BUSD">Binance USD BEP-20 (BUSD)</option> --}}
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
        <!--end modal-->
    </div>
</div>
<script src="{{ asset('user-assets/js/jquery.min.js') }}"></script>
<script>
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

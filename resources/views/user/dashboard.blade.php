@extends('templates.main-user')

@section('content')
<link href="{{ asset('main-user-assets/css/skippr.css') }}" rel="stylesheet" type="text/css" />

<style>
    #containerSlider {
        width: 100%;
        height: 360px;

    }

    .slide-bg {
        background-position: top !important;
        background-size: cover !important;
        background-repeat: no-repeat;
        text-align: right !important;
        display: flex;
        justify-content: right;
    }

    .text-part {
        height: 100px !important;
        width: 40%;
        margin-top: 150px;
    }

    .amount3 {
        font-weight: 800 !important;
    }

    .fixed-card-height {
        min-height: 450px;
    }

    .newsHeading,
    .newsSummary {
        display: block;
        /* Fallback for non-webkit */
        display: -webkit-box;
        height: 3.6em;
        /* Fallback for non-webkit, line-height * 2 */
        line-height: 1.3em;
        -webkit-line-clamp: 3;
        /* if you change this, make sure to change the fallback line-height and height */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .skippr {
        border-radius: 10px;
    }

</style>
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-30">
    <div>
        <h4 class="mg-b-0 tx-spacing--1">{{ $page_title }}</h4>
    </div>
    <div class="d-none d-md-flex">

    </div>
</div>

<div class="card">

    <!--end card-header-->
    <div class="card-body">
        <div class="">
            <div id="containerSlider">
                <div id="newsSlider">
                    @foreach($news as $new)
                    <div class="slide-bg" style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.054), rgba(0, 0, 0, 0.708)), url({{ $new->urlToImage }});">
                        <div class="p-3 text-part">
                            <span class="btn-outline-warning rounded px-1 py-1 text-warning">{{ $new->author }}</span>
                            <h3 class=" font-weight-bold newsHeading text-white">{{ $new->title }}</h3>

                            <a href="{{ $new->url }}" target="blank" class="btn btn-primary">Read More</a>
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

<br>
<br>
<div class="row">

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title">Quick Purchase </h4>
                    </div>
                    <div class="col-auto">
                        <a href="make-investments" class="btn btn-outline-primary">
                            INVEST<i class="fi-arrow-right"></i>
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
                    <input type="hidden" id="page_url" name="page_url" value="">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="fundsId">Package <i data-feather="alert-circle" class="tooltip-size text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Please choose the source of payment"></i></label>
                            <select class="form-select" id="package_id" name="package_id" required>
                                <option value="">Select Package</option>
                                @foreach($packages as $key=> $pack)
                                <option value="{{ $pack->id}}">{{ $pack->name}}: Amount( ${{ $pack->min_amt }} ) </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Choose Gateway <i data-feather="alert-circle" class="tooltip-size text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Need to work on this for now, use this"></i></label>
                            <select class="form-select" id="gateway" name="payment_method" required>
                                <option value="">Select Gate Way</option>
                                <option value="direct_deposit">Direct Deposit</option>
                                <option value="available_funds">Active Funds Balance</option>
                                <option value="active_interest">Active Interest Balance</option>
                                <option value="referral_commission">Referral Commission</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12" id="currency">
                            <label for="currency">Currency <i data-feather="alert-circle" class="tooltip-size text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Enter currency you need to use to make payment"></i></label>
                            <select name="currency" class="form-control" id="currency_drop" required>
                                <option value="">Select Currency</option>
                                <option value="USDTTRC20">Tether USD TRC20 (USDTTRC20)</option>
                                <option value="BTC">Bitcoin (BTC)</option>
                                <option value="BCH">Bitcoin Cash (BCH)</option>
                                <option value="ETH">Ethereum (ETH)</option>
                                <option value="USDTERC20">Tether USD ERC20 (USDTERC20)</option>
                                <option value="LTC">Litecoin (LTC)</option>


                            </select>
                        </div>
                        <div class="form-group col-md-12" id="fundsSide">
                            <label for="fundsId">Funding Source <i data-feather="alert-circle" class="tooltip-size text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Please choose the source of payment"></i></label>
                            <select class="form-select" id="funding_source" name="funding_source">
                                <option value="">Select Source</option>
                                @foreach($my_investments as $key=> $invest)
                                <option value="{{ $invest->user_investments_id}}" available_funds="{{  $invest->formatted_available_fund_balance }}" active_interest="{{ $invest->formatted_active_interest_balance }}">{{ $invest->package->name}}: AFB( ${{ $invest->formatted_available_fund_balance }} ) ---- AIB( ${{ $invest->formatted_active_interest_balance }} ) </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Investment Amount <i data-feather="alert-circle" class="tooltip-size text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Enter the amount you want to purchase for"></i></label>
                            <input type="number" class="form-control" id="inputEmail4" name="amount" placeholder="Enter Amount" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Select Process <i data-feather="alert-circle" class="tooltip-size text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="The interest process is borken down into three places, choose any one"></i></label>
                            <select class="form-select" name="payout" required id="payout">
                                <option value="">Select Interest Process</option>
                                <option value="bi_weekly">Regular Bi Weekly</option>
                                <option value="stacking_interest">Fixed Stacking Interest</option>
                                <option value="diverse_stacking_interest">Diverse Stacking Interest</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12" id="stacking_months">
                            <label for="stacking_months">Stacking Duration <i data-feather="alert-circle" class="tooltip-size text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="How long do you want the staking process to last"></i></label>
                            <select name="stacking_months" id="stacking_drop" class="form-control" required>
                                <option value="">Select Duration</option>
                                <option value="6">6 Stacking Months</option>
                                <option value="7">7 Stacking Months</option>
                                <option value="8">8 Stacking Months</option>
                                <option value="9">9 Stacking Months</option>
                                <option value="10">10 Stacking Months</option>
                                <option value="11">11 Stacking Months</option>
                                <option value="11">12 Stacking Months</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck1" required>
                                <label class="custom-control-label" for="customCheck1">Agree with Terms of Use and Privacy Policy</label>
                            </div>
                        </div>
                        <div class="col-md-12">

                            <button type="submit" class="btn btn-primary w-100"> Proceeed</button>

                        </div>
                    </div>
                </form>
                <!--end /div-->
            </div>
            <!--end card-body-->
        </div>
        <!--end card-->
    </div>
    {{-- <div class="col-lg-4">
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
    <img src="{{ $site_host.'/uploads/'.$data->image  }}" alt="" style="width:100%; height:580px; object-fit:cover;">
</div>
@endif
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
</div> --}}
<div class="col-lg-4">
    <div class="card">
        <div class="card-header d-flex align-items-start justify-content-between">
            <h4 class="card-title">Investments Summary </h4>
            <a href="" class="tx-13 link-03 d-flex align-items-center">Weekly Summary</a>
        </div><!-- card-header -->
        <div class="card-body pd-y-1 pd-x-10">
            <div class="row">
                @foreach ($my_investments as $key=> $invest)
                @if ($invest->status == 'expired' || $invest->status == 'error' || $invest->status == 'cancelled'|| $invest->status == 'finished'|| $invest->status == 'pending')
                @else
                <div class="col-lg-12 mg-t-30 mg-sm-t-0 mg-lg-t-30">
                    <div class="d-flex align-items-center justify-content-between mg-b-5">
                        <h6 class="tx-uppercase tx-10 tx-spacing-1 tx-color-02 tx-semibold mg-b-0">{{ $invest->packagename }}</h6>
                        <span class="tx-14">{{ $invest->formatted_next_earn_date }} <span class="tx-8 text-muted">Next Date</span> </span>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mg-b-5">
                        <h5 class="tx-normal tx-rubik lh-2 mg-b-0">${{ number_format($invest->returns,2)  }} <span class="tx-10 text-muted">Bi Weekly</span></h5>
                        <h6 class="tx-normal tx-rubik  lh-2 mg-b-0">{{ $invest->days }} <span class="tx-10 text-muted">Days Left </span></h6>
                    </div>
                    <div class="c100 p{{ $invest->daysLeft }} small mt-2 ">
                        <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="{{ $invest->days }}" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: {{ $invest->days }}%"></div>
                        </div>
                       
                        

                    </div>
                </div>
                @endif
                @endforeach
            </div><!-- row -->
            <br>
            <br>
        </div><!-- card-body -->
    </div><!-- card -->
</div><!-- col -->


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

                    <div class="col-md-12">

                        <button type="submit" class="btn btn-primary w-100"> Proceeed</button>

                    </div>
                </div>

                 
            </form>
            <!--end /div-->
        </div>
        <!--end card-body-->
    </div>
    <!--end card-->
</div>
</div>
<br>
<br>

<div class="col mg-t-10">
    <div class="card card-dashboard-table">
        <div class="card-header">
            <h4>System Logs</h4>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered ">
                <thead class="thead-dark">
                    <tr class="text-light">
                        <th class="text-light">S / N</th>
                        <th class="text-light">Category</th>
                        <th class="text-light">Message</th>

                        <th class="text-light">Date Of Activty</th>
                        <th class="text-light">Money</th>
                        <th class="text-light">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activities as $key=> $active)
                    <tr>
                        <td class=" pt-3 pb-3">{{ $key+1 }}</td>
                        @if ($active->category=="earning" || $active->category=="bonus")
                        <td class=" pt-3 pb-3"> <span class=" p-1 font-10 text-success">WALLET CREDITED</span></td>
                        @elseif ($active->category=="compound_earning")
                        <td class=" pt-3 pb-3"> <span class=" p-1 font-10 text-danger">COMPOUNDING INTEREST</span></td>
                        @elseif ($active->category=="withdrawals")
                        <td class=" pt-3 pb-3"> <span class="p-1 font-10 text-danger">WITHDRAWAL</span></td>
                        @elseif ($active->category=="deposit")
                        <td class=" pt-3 pb-3"> <span class=" p-1 font-10 text-primary">DEPOSIT</span></td>
                        @elseif ($active->category=="expired")
                        <td class=" pt-3 pb-3"> <span class=" p-1 font-10 text-danger">EXPIRED</span></td>
                        @elseif ($active->category=="error")
                        <td class=" pt-3 pb-3"> <span class=" p-1 font-10 text-danger">ERROR</span></td>
                        @elseif ($active->category=="cancelled")
                        <td class=" pt-3 pb-3"> <span class=" p-1 font-10 text-danger">CANCELLED</span></td>
                        @elseif ($active->category=="transfer")
                        <td> <span class=" p-1 font-10 text-success">TRANSFER</span></td>
                        @endif
                        <td class="ps-4 pt-3 pb-3 "><a href="#" class="text-primary">{{ $active->title }}</a></td>

                        <td class=" pt-3 pb-3 ">{{ $active->date }}</td>
                        <td class=" pt-3 pb-3 ">${{ $active->amount }}</td>
                        <td class=" pt-3 pb-3">{{ $active->descp }}</td>

                    </tr>
                    <!--end tr-->
                    @endforeach

                </tbody>
            </table>
        </div><!-- table-responsive -->
    </div><!-- card -->
</div><!-- col -->


<script src="{{ asset('main-user-assets/lib/jquery/jquery.min.js') }}"></script>
<script>
    $("#fundsSide").hide()
    $("#funding_source").attr("required", false)
    $("#currency").hide()
    $("#currency_drop").attr("required", false)

    $("#stacking_months").hide()
    $("#stacking_drop").attr("required", false)


    $("#gateway").on('change', function() {

        if ($(this).val() == "available_funds" || $(this).val() == "active_interest") {
            $("#fundsSide").show()
            $("#funding_source").attr("required", true)
            $("#currency").hide()
            $("#currency_drop").attr("required", false)
        } else if ($(this).val() == "direct_deposit") {
            $("#currency").show()
            $("#currency_drop").attr("required", true)
            $("#fundsSide").hide()
            $("#funding_source").attr("required", false)
        } else {
            $("#fundsSide").hide()
            $("#funding_source").attr("required", false)
            $("#currency").hide()
            $("#currency_drop").attr("required", false)
        }
    })

    $("#payout").on('change', function() {
        if ($(this).val() == "stacking_interest" || $(this).val() == "diverse_stacking_interest") {
            $("#stacking_months").show()
            $("#stacking_drop").attr("required", true)
        } else {
            $("#stacking_months").hide()
            $("#stacking_drop").attr("required", false)
        }
    })

    $("#package_id").on('change', function() {
        $("#page_url").val(`/user/make-investment/${$(this).val()}/edit`)
    })



    $("#funding_source").on('change', function() {
        $("#available_fund_balance").html("<b>$</b>" + $('option:selected', this).attr('available_funds'))
        $("#active_interest_balance").html("<b>$</b>" + $('option:selected', this).attr('active_interest'))
    })

</script>
@endsection

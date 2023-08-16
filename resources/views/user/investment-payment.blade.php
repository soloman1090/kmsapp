@extends('templates.main-user')

@section('content')
<!-- DataTables -->
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-30" id="upHeader">
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/user/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/user/make-investment">Purchase Portfolios</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="/user/make-investment/{{ $package->id  }}">{{ $package->name }} Portfolio</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Purchase {{ $package->name }}</a></li>
            </ol>
        </nav>
        
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h4 class="mg-b-0 tx-spacing--1">{{ $package->name }}</h4>
    </div>
    <div class="card-body">
        <div class="">
            <div class="set1">
        
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-3 p-3">
                            <p>Active Funds Balance</p>
                            <h1 id="available_fund_balance"><b>$</b>0.00 </h1>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3 p-3">
                            <p>Active Interest Balance</p>
                            <h1 id="active_interest_balance"><b>$</b>0.00 </h1>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3 p-3">
                            <p>Partner Commission</p>
                            <h1><b>$</b>{{ $user->formated_referral_wallet }} </h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <form action="{{ route('user.make-investment.create') }}" method="GET">
                    @csrf
                    <input type="hidden" name="package_id" value="{{ $package->id  }}">
                    <input type="hidden" name="page_url" value="/user/make-investment/{{ $package->id }}/edit">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <h2>Fill the form below to purchase investment</h2>
                            <div class="row">
        
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
                                        @foreach($investments as $key=> $invest)
                                        <option value="{{ $invest->id}}" available_funds="{{  $invest->formatted_available_fund_balance }}" active_interest="{{ $invest->formatted_active_interest_balance }}">{{ $invest->package->name}}: AFB( ${{ $invest->formatted_available_fund_balance }} ) ---- AIB( ${{ $invest->formatted_active_interest_balance }} ) </option>
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
                        </div>
                        <div class="col-md-3"></div>
                    </div>
        
                    {{-- <center> --}}
        
        
        
                    {{-- </center> --}}
                </form>
            </div>
        </div>
    </div>
</div>

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
        }else{
            $("#stacking_months").hide()
    $("#stacking_drop").attr("required", false)
        }
     })



    $("#funding_source").on('change', function() {
        $("#available_fund_balance").html("<b>$</b>" + $('option:selected', this).attr('available_funds'))
        $("#active_interest_balance").html("<b>$</b>" + $('option:selected', this).attr('active_interest'))
    })

</script>
@endsection

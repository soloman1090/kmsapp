@extends('templates.main-user')

@section('content')
<img src="{{ asset('user-assets/images/widgets/transaction_activity.jpg') }}" alt="" style="width: 100%; border-top-left-radius: 10px;
border-top-right-radius: 10px;">
<br><br>
<div class="card">
    <div class="card-body">

        <h3 class="text-center"><b>{{ $packageName }}</b></h3>
        <hr>
        @if ($package->bonus_percentage!=null && $package->bonus_percentage>0 && $package->package_type=!"short")
        <div class="m-1 bg-danger btn-outline-dashed w-100 text-center p-2 text-white">Advanced Credit Financing Available @ <b>{{ $package->bonus_percentage*100 }}%</b> For Minimum Investments Of <b>$5,000</b></div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h6><b class="text-white">Portfolio Balance</b></h6>
                                <h2 class="text-white "><b class="amount1" amount="{{$main_wallet}}">$ {{ $main_wallet }}</b></h2>
                                <input type="hidden" id="mainWalletInput" value="{{ $main_wallet }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-dark">
                            <div class="card-body">
                                <h6><b class="text-white">Compounding Dividends</b></h6>
                                <h2 class="text-white"><b class="amount2" amount="{{$compound_wallet}}">$ {{ $compound_wallet }}</b></h2>
                                <input type="hidden" id="compountWalletInput" value="{{ $compound_wallet }}">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <h1 class="text-center text-primary">${{ $min_amt }}</h1>
                        <div class="text-center">
                            <small class="text-center font-16"><b>Minimum Investment</b></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @if ($payout=="pods")
                        <h1 class="text-center text-primary" style=" font-weight:500;">{{ $duration }}-Months</h1>
                        <div class="text-center">
                            <small class="text-center font-16"><b>Compounding Duration</b></small>
                        </div>
                        
                        @else
                        <h1 class="text-center text-primary" style=" font-weight:500;">{{ $min_percent }}% - {{ $max_percent }}%</h1>
                        <div class="text-center">
                            <small class="text-center font-16"><b>Commission</b></small>
                        </div>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="text-center text-primary">{{ $compound_percent }}%</h1>
                        <div class="text-center">
                            <small class="text-center font-16"><b>Compounding Percentage</b></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h1 class="text-center text-primary" style=" font-weight:500;">{{ $duration }}-Months:</h1>
                        <div class="text-center">
                            <small class="text-center font-16"><b>Portfolio Duration</b></small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-1"></div>
            <div class="col-md-4">
                <h5>Edit form if you want to change your values</h5>
                <form action="{{ route('user.get-payment.create') }}" method="get" class="form-parsley">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="user_id" value="{{ $user_id }}">
                        <input type="hidden" name="investment_packages_id" value="{{ $investment_packages_id}}">
                        <input type="hidden" name="returns" id="returns" value="23.4">
                        <input type="hidden" name="duration" id="duration" value="{{ $duration }}">
                        <div class="form-group col-md-12">
                            <label for="inputAmount">Amount</label>
                            <input type="number" class="form-control" name="amount" id="inputAmount" placeholder="Enter Amount" required data-parsley-min="{{ $min_amt }}" data-parsley-max="{{ $max_amt }}">
                        </div>
                        @if ($payout=="pods")
                        <input type="hidden" name="payment_method" id="payment_method" value="{{ $payment_method }}">
                        @else
                        <div class="form-group col-md-12">
                            <label for="inputAmount">Payment Platform</label>
                            <select name="payment_method" id="port_payment_method" class="form-control" required>
                                <option value="">Select Payment Platform</option>
                                <option value="direct_deposit">Direct Deposit</option>
                                <option value="main_wallet">Main Wallet</option>
                                <option value="compound_wallet">Active Interest Funds</option>
                            </select>
                        </div>
                        @endif

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
                        @if ($payout=="pods") 
                        <input type="hidden" name="payout" value="{{ $payout }}">
                        @elseif ($payout=="short")
                        <div class="form-group col-md-12">
                            <label for="payout">Payout Duration</label>
                            <select name="payout" class="form-control" id="payout" required>
                                <option value="">Select Duration</option>
                                <option value="short">Daily Payout</option>
                                <option value="short">Monthly Payout</option>
                                <option value="short">2 Months Compounding</option>
                                <option value="short">3 Months Compounding</option>
                                <option value="short">4 Months Compounding</option>
                            </select>
                        </div>
                        @else
                        <div class="form-group col-md-12">
                            <label for="payout">Payout Duration</label>
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
                        @endif
                    </div>
                    <button type="submit" class="btn btn-soft-primary">Get Started </button>
                </form>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</div>











<script src="{{ asset('user-assets/js/jquery.min.js') }}"></script>
<script>
    let amount1 = parseFloat($(".amount1").attr("amount"))
    $(".amount1").text(`$${amount1.toLocaleString('en-US')}`)

    let amount2 = parseFloat($(".amount2").attr("amount"))
    $(".amount2").text(`$${amount2.toLocaleString('en-US')}`)




    $(".wallet_type").on('change', function() {
        if ($(this).val() == "main_wallet") {
            $(".inputAmount").attr("data-parsley-max", $(".main_wallet_balance").val())
        } else if ($(this).val() == "compound_wallet") {
            $(".inputAmount").attr("data-parsley-max", $(".compound_wallet_balance").val())
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

    $("#inputAmount").val(`{{  $amount }}`)
    $("#port_payment_method").val(`{{  $payment_method }}`)
    $("#currency_drop").val("{{ $currency }}")
    $("#payout").val("{{ $payout }}")

    if ($("#port_payment_method").val() == "main_wallet" || $("#port_payment_method").val() == "compound_wallet") {
        $("#currency").hide()
        $("#currency_drop").attr("required", false)
    } else {
        $("#currency").show()
        $("#currency_drop").attr("required", true)
    }

</script>

@endsection

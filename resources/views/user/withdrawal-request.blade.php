@extends('templates.main-user')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/user/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="/user/user-investments">Portfolios</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="/user/user-investments/{{ $investment->id }}/edit">{{ $investment->package->name  }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $page_title }}</li>
            </ol>
        </nav>
    </div>
</div>
<!-- DataTables -->
<div class="card">
    <div class="card-header">
        <h4>{{ $page_title }}</h4>
    </div>
    <div class="card-body">
        <div class="">
            <div class="set1">
        
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-3 p-3">
                            <p>Active Funds Balance</p>
                            <h1 id="available_fund_balance"><b>$</b>{{ $investment->formatted_available_fund_balance }} </h1>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3 p-3">
                            <p>Active Interest Balance</p>
                            <h1 id="active_interest_balance"><b>$</b>{{ $investment->formatted_active_interest_balance }} </h1>
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
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <form action="{{ route('user.withdrawal-request.index') }}" method="get">
                                @csrf
                                <input type="hidden" name="investment_id" value="{{ $investment->id }}">
                                <input type="hidden" name="auth" value="yes">
                                <button class="btn btn-warning w-100 mb-2 py-4 px-5">
                                    <b>Generate 2-FA Code</b>
                                </button>
                            </form>
                         </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>

                <form action="{{ route('user.withdrawal-request.store') }}" method="post" class="form-parsley">
                    @csrf
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <input type="hidden" name="user_id" value="{{ $user_id }}">
                            <input type="hidden" name="page_url" value="/user/user-investments/{{ $investment->id }}/edit">
                            <input type="hidden" name="investment_id" value="{{ $investment->id }}">
                            <input type="hidden" name="charge" id="charge">
                            <p>To make withdrawal, you have to generate a 2fa code with will be sent to your email address, paste the code on the 2fa field below to continue</p>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputAmount">Enter 2fa Code </label>
                                    <input type="text" class="form-control 2fa" name="2fa" id="2fa" placeholder="Enter 2fa code">
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
                                        <input type="decimal" class="form-control" name="amount_paid" id="inputAmount" placeholder="Enter Amount" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <select class="form-select" id="wallet_type" name="wallet_type" required>
                                            <option value="">Select Wallet</option>
                                             <option value="available_funds">Active Funds Balance</option>
                                            <option value="active_interest">Active Interest Balance</option>
                                            <option value="referral_commission">Referral Commission</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAmount">Wallet Address</label>
                                    <input type="text" class="form-control" name="wallet_address" id="wallet_address" placeholder="Enter Wallet Address" required>
                                </div>
                                <div class="col-md-12">
        
                                    <button type="submit" class="btn btn-primary w-100"> Proceeed</button>
        
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
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
        } else {
            $("#stacking_months").hide()
            $("#stacking_drop").attr("required", false)
        }
    })



    $("#fundsId").on('change', function() {
        $("#available_fund_balance").html("<b>$</b>" + $('option:selected', this).attr('available_funds'))
        $("#active_interest_balance").html("<b>$</b>" + $('option:selected', this).attr('active_interest'))
    })

</script>
@endsection

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
<div class="card">
    <div class="card-header">
        <h4>{{ $page_title }}</h4>
    </div>
    <div class="card-body">
        <img src="{{ asset('user-assets/images/widgets/inter_account_transfer.jpg') }}" alt="" style="width: 100%; border-top-left-radius: 10px;
border-top-right-radius: 10px;">
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
                <form action="{{ route('user.transfer.store') }}" method="post" class="form-parsley">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user_id }}">


                    <p>To make transfer, you have to generate a 2fa code with will be sent to your email address, paste the code on the 2fa field below to continue</p>
                    <div class="form-group">
                        <label for="inputAmount">Enter 2fa Code </label>
                        <input type="text" class="form-control 2fa" name="2fa" id="2fa" placeholder="Enter 2fa code">

                    </div>
                    <div class="amount-group">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="inputAmount">Amount</label>
                                <input type="number" class="form-control inputAmount" name="amount_paid" id="inputAmount" placeholder="Enter Amount" required data-parsley-min="10" data-parsley-max="0">

                            </div>
                            <input type="hidden" class="main_wallet_balance" value="{{ $user->main_wallet}}">
                            <input type="hidden" class="compound_wallet_balance" value="{{ $user->compound_wallet}}">
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
                            <label for="inputAmount">Receiver Email Address</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Enter Receiver Email Address" required>
                        </div>
                    </div>
                    <div class="col-md-12">
        
                        <button type="submit" class="btn btn-primary w-100"> Proceeed</button>

                    </div>
                </form>
               
            </div>

            <div class="col-md-3">
                 
            </div>
        </div>

    </div>
</div>









<script src="{{ asset('user-assets/js/jquery.min.js') }}"></script>
<script>
    let amount1 = parseFloat($(".amount1").attr("amount"))
    $(".amount1").text(`$${amount1.toLocaleString('en-US')}`)

    let amount2 = parseFloat($(".amount2").attr("amount"))
    $(".amount2").text(`$${amount2.toLocaleString('en-US')}`)

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


    $(".wallet_type").on('change', function() {
        if ($(this).val() == "main_wallet") {
            $(".inputAmount").attr("data-parsley-max", $(".main_wallet_balance").val())
        } else if ($(this).val() == "compound_wallet") {
            $(".inputAmount").attr("data-parsley-max", $(".compound_wallet_balance").val())
        }
    })

</script>

@endsection

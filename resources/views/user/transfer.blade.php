@extends('templates.main-user')

@section('content')
<img src="{{ asset('user-assets/images/widgets/inter_account_transfer.jpg') }}" alt="" style="width: 100%; border-top-left-radius: 10px;
border-top-right-radius: 10px;">
<br><br>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h6><b class="text-white">Portfolio Balance</b></h6>
                <h2 class="text-white " ><b class="amount1" amount="{{$user->main_wallet}}">$ {{ $user->main_wallet }}</b></h2>
                 <input type="hidden" id="mainWalletInput" value="{{ $user->main_wallet }}">
            </div>
        </div>
        
        <div class="card bg-dark">
            <div class="card-body">
                <h6><b class="text-white">Compounding Dividends</b></h6>
                <h2 class="text-white"><b class="amount2" amount="{{$user->compound_wallet}}">$ {{ $user->compound_wallet }}</b></h2>
                <input type="hidden" id="compountWalletInput" value="{{ $user->compound_wallet }}">
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('user.transfer.store') }}" method="post" class="form-parsley">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user_id }}">
                    

                    <p>To make transfer, you have to generate a 2fa code with will be sent to your email address, paste the code on the 2fa field below to continue</p>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="inputAmount">Enter 2fa Code </label>
                                <input type="text" class="form-control 2fa" name="2fa" id="2fa" placeholder="Enter 2fa code">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <br>
                            <a href="transfer?auth=yes" class="btn btn-info">Generate Code</a>
                        </div>
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
                                <label for="wallet">Wallet</label>
                                <select name="wallet_type" class="form-control wallet_type" id="wallet_type" required>
                                    <option value="">Select Wallet</option>
                                    <option value="main_wallet">Portfolio Balance</option>
                                    {{-- <option value="compound_wallet">Compounding Dividends</option> --}}
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAmount">Receiver Email Address</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Enter Receiver Email Address" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary withdrawBtn" id="">Confirm Transfer</button>
                </form>
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

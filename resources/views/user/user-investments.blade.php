@extends('templates.main-user')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/user/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">My Portfolios</li>
            </ol>
        </nav>
    </div>
</div>
<div class="card">
   
    <div class="card-header">
        <h4 class="card-title">My Portfolios</h4>
    </div>
    <!--end card-header-->
    <div class="card-body ">
        <img src="{{ asset('user-assets/images/widgets/active_investment.jpg') }}" alt="" style="width: 100%;border-top-left-radius: 5px;
        border-top-right-radius: 5px;">
        {{-- <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10 video-bg">
                <video style="width: 100%; height:450px" poster="{{ asset('assets/images/Header/video-bg.jpg') }}" controls>
                    <source src="{{ asset('assets/videos/how_to_reinvest.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <div class="col-md-1"></div>
        </div> --}}
        <br>
        @if (count($investments) == 0)
        <div class="text-center">
            <img src="{{ asset('user-assets/images/portfolios/investment.png') }}" width="300" />
            <h3 class="text-center">No Active Investments Yet</h3>
            <br>
            <a href="view-investments-portfolio" class="btn btn-primary btn-outline-dashed ">Start Investment</a>
        </div>
        @else
        @foreach ($investments as $invest)
        @if ($invest->status == 'expired' || $invest->status == 'error' || $invest->status == 'cancelled'|| $invest->status == 'finished')
        @else
        <div class="row mb-3">
            <div class="col-md-1"></div>
            <div class="col-md-10">

                <div class="accordion-item">
                    <div class="card-body FUND">
                       <div class="row">
                       <div class="col-md-4">
                            <div class="bg1" style="background-image: url({{ asset('uploads/'.$invest->image) }});"></div>
                       </div>
                       <div class="col-md-8">
                       <div class="texts">
                            <div class="row">
                                <div class="col">
                                    <h1 class="m-0 fw-semibold text-dark font-24 mt-3">
                                        {{ $invest->packagename }}</h1>
                                    <a href="#" class="text-muted  mb-0 font-13">
                                        @if ($invest->status == 'completed' || $invest->status == 'mismatch')
                                        <span class="badge badge-outline-success">Active</span>
                                        @elseif ($invest->status == 'pending')
                                        <span class="badge badge-outline-warning">Payment Pending</span>
                                        @elseif ($invest->status == 'pending_reinvest')
                                        <span class="badge badge-outline-warning">Pending
                                            Reinvestment</span>
                                        @elseif ($invest->status == 'expired')
                                        <span class="badge badge-outline-danger">Expired</span>
                                        @elseif ($invest->status == 'error')
                                        <span class="badge badge-outline-danger">Payment Error</span>
                                        @elseif ($invest->status == 'cancelled')
                                        <span class="badge badge-outline-danger">Payment
                                            Cancelled</span>
                                        @elseif ($invest->status == 'finished')
                                        <span class="badge bg-success " style="font-size: 20px !important">Investment Completed</span><br>
                                        @endif
                                        <span class="text-dark">Category :
                                        </span>{{ $invest->category_name }}
                                    </a>

                                    <div class="col-auto">
                                    @if ($invest->status == 'pending' || $invest->status == 'cancelled' || $invest->status == 'expired')
                                    <div></div>
                                    @else
                                    <div class="c100 p{{ $invest->daysLeft }} small mt-2 ">
                                    <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="{{ $invest->days }}" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: {{ $invest->days }}%"></div>
                                    </div>
                                        <div class="left mt-2">
                                            
                                            <h6 class="mb-0 text-muted"> {{ $invest->days }} Days Left</h6>
                                        </div>
                                        <div class="slice">
                                            <div class="bar"></div>
                                            <div class="fill"></div>
                                        </div>
                                        
                                    </div>
                                    
                                    @endif

                                </div>
                                </div>
                         
                            </div>
                        </div>
                        <div class="row mt-4 d-flex align-items-center">
                            <div class="col">
                                {{-- <h5 class="font-22 m-0 fw-bold">${{ $invest->amount }}</h5> --}}
                                <h4 class="font-14 m-0 fw-bold"><b class="tx-30">$</b>{{ number_format($invest->amount,2) }}</h4>
                                <p class="mb-0 text-muted">Investment Amount</p>
                            </div>
                            <div class="col">
                                {{-- <h5 class="font-20 m-0 fw-bold">(ROI) ${{ $invest->returns }}</h5> --}}
                                <h4 class="font-14 m-0 fw-bold"><b class="tx-30">$</b>{{  number_format($invest->returns*$invest->days,2) }}</h4>
                                <p class="mb-0 text-muted">Total Accumulated</p>
                            </div>
                            <div class="col">
                                {{-- <h5 class="font-20 m-0 fw-bold">{{ $invest->payout }}</h5> --}}
                                <h4 class="font-14 m-0 fw-bold"><b class="tx-30">$</b>{{ $invest->formatted_available_fund_balance }}</h4>
                                <p class="mb-0 text-muted">Active Funds</p>
                            </div>
                            <div class="col">
                                {{-- <h5 class="font-18 m-0 fw-bold">{{ $invest->duration }} Months</h5> --}}
                                <h4 class="font-14 m-0 fw-bold"><b class="tx-30">$</b>{{ $invest->formatted_active_interest_balance }} </h4>
                                <p class="mb-0 text-muted">Active Interest Funds</p>
                            </div>
                            {{-- <div class="col">
                                <h5 class="font-14 m-0 fw-bold">{{ $invest->date }}</h5>
                                <p class="mb-0 text-muted">Investment Date</p>
                            </div> --}}

                        </div>
                        <hr class="hr-dashed hr-menu">
                        @if ($invest->status == 'pending' )
                        <div class="row mt-4 d-flex align-items-center">
                            <div class="col">
                                <a href="{{ route('user.user-investments.show',$invest->investment_id) }}" class="btn btn-sm btn-primary  px-4">Click To Confirm Purchase</a>
                            </div>
                        </div>
                        @else
                        <div class="row mt-4 d-flex align-items-center">
                            {{-- <div class="col-3">
                                <a href="#" class="accordion-button collapsed shadow-none  px-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo{{ $invest->investment_id }}" aria-expanded="false" aria-controls="collapseTwo{{ $invest->investment_id }}">More Details</a>
                            </div> --}}

                            @if ($invest->status == 'finished')
                            {{-- <div class="col">
                                <a href="#" class="btn btn-sm btn-secondary  px-4">Re-invest</a>
                            </div>

                            <div class="col">
                                <a href="#" class="btn btn-sm btn-secondary  px-4">Make Withdrawal</a>
                            </div> --}}

                            <div class="col">
                                {{-- <a href="{{ routes('user.user-investments.edit',$invest->investment_id ) }}" class="btn btn-sm btn-secondary px-4">View More Details</a> --}}
                            </div>
                            @else

                            @if ( $invest->status == 'pending_reinvest')
                            <div class="col">
                                <a href="{{ route('user.user-investments.show',$invest->investment_id) }}" target="_blank" class="btn btn-sm btn-primary  px-4">Confirm Reinvestment</a>
                            </div>
                            @else
                            {{-- <div class="col">
                                <a href="#" class="btn btn-sm btn-primary  px-4" data-bs-toggle="modal" data-bs-target="#investModalDefault{{ $invest->investment_id }}">Re-invest</a>
                            </div> --}}
                            @endif

                            {{-- <div class="col">
                                <a href="#" class="btn btn-sm btn-secondary  px-4">Make Withdrawal</a>
                            </div> --}}

                            <div class="col">
                                {{-- DONT DELETE --}}
                                <a href="{{ route('user.user-investments.edit', $invest->investment_id) }}" class="btn btn-sm btn-secondary  btn-brand-02 w-100 px-4">View More Details</a>
                            </div>
                            @endif
                        </div>
                        @endif
                       </div>
                       </div>
                    </div>
                    <!--end card-body-->
                    <div class="modal fade" id="investModalDefault{{ $invest->investment_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title m-0" id="exampleModalDefaultLabel"> Reinvest into
                                        portfolio </h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!--end modal-header-->
                                <div class="modal-body">
                                    <form action="{{ route('user.reinvest.store') }}" method="post" class="form-parsley">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h6><b class="text-mute">Main Wallet
                                                                Balance</b></h6>
                                                        <h3>$ {{ $user->main_wallet }}</h3>
                                                        <input type="hidden" id="mainWalletInput" value="{{ $user->main_wallet }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h6><b class="text-mute">Active Interest Funds
                                                                Balance</b></h6>
                                                        <h3>$ {{ $user->compound_wallet }}</h3>
                                                        <input type="hidden" id="compountWalletInput" value="{{ $user->compound_wallet }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <input type="hidden" value="{{ $invest->investment_id }}" name="investment_id">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="inputAmount">Category</label>
                                                <input type="disabled" disabled class="form-control" value="{{ $invest->category_name }}">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="inputAmount">Investment Portfolio</label>
                                                <input type="disabled" disabled class="form-control" value="{{ $invest->packagename }}">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="inputAmount">Amount Invested</label>
                                                <input type="disabled" disabled class="form-control" value="${{ $invest->amount }}">
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
                                                    <option value="compound_wallet">Active Interest Funds</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12" id="currency">
                                                <label for="currency">Currency</label>
                                                <select name="currency" class="form-control">
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

                                        </div>
                                </div>
                                <!--end modal-body-->
                                <div class="modal-footer">
                                    <button type="submit" id="purchaseBtn" class="btn btn-primary btn-sm">Purchase </button>
                                    <button type="button" class="btn btn-soft-danger btn-sm" data-bs-dismiss="modal">Close</button>
                                </div>
                                <!--end modal-footer-->
                                </form>
                            </div>
                            <!--end modal-content-->
                        </div>
                        <!--end modal-dialog-->
                    </div>
                    <!--end modal-->

                   


                    <!--end card-->
                </div>
                <!--accordion end-->
            </div>
            <div class="col-md-1"></div>
        </div>







        @endif
        @endforeach
        @endif




    </div>
    <!--end card-body-->
</div>
<!--end card-->




<script src="{{ asset('user-assets/js/jquery.min.js') }}"></script>
<script>
    $("#payment_method").on('change', function() {

        if ($(this).val() == "main_wallet" || $(this).val() == "compound_wallet") {
            $("#currency").hide()
        } else {
            $("#currency").show()
        }
    })

    $("#purchaseBtn").on('click', function() {
        let method = $("#payment_method").val()
        let topUp = $("#addAmountInput").val()

        if (method == "main_wallet") {
            let balance = $("#mainWalletInput").val()

            if (topUp > balance) {
                alert("Insuffecient balance to perfrom this reinvestment")
            }

        } else if (method == "compound_wallet") {
            let balance = $("#compountWalletInput").val()
            if (topUp > balance) {
                alert("Insuffecient balance to perfrom this reinvestment")
            }
        }
    })

</script>

@endsection

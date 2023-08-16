@extends('templates.main-user')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/user/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="/user/user-investments">Portfolios</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $investment->package->name  }}</li>
            </ol>
        </nav>
    </div>
</div>
<div class="card">
    <img src="{{ asset('user-assets/images/widgets/active_investment.jpg') }}" alt="" style="width: 100%;border-top-left-radius: 5px;
        border-top-right-radius: 5px;">
        
    <div class="card-header">
        <div class="row">
            <div class="col-md">
                <h4 class="card-title">My Investments </h4>
            </div>
            @if($investment->status == 'pending_reinvest')
                <div class="col-md-auto">
                    <a href="{{ route('user.user-investments.show',$investment->id) }}" target="_blank" class="btn btn-sm btn-warning  px-4">Confirm Reinvestment</a>
                </div>
            @endif
             
        </div>

    </div>

    <div class="container">
        <div class="Investment margin20">
            <div class="row">
                <div class="col-md-6 ">
                    <div class="moon" style="background-image: url({{ asset('uploads/'.$investment->package->image) }})">
                        <h1>{{ $investment->package->name  }}</h1>
                    </div>
                </div>
                 <div class="col-md-3">
                    <div class="set1">
                        <div class="card mb-3 p-3">
                            <p>Invested Amount</p>
                            <h1><b class="tx-30">$</b>{{ $investment->formatted_amount }}</h1>
                        </div>
                        <div class="card mb-3 p-3">
                            <p>Accumulated Income </p>
                            <h1><b class="tx-30">$</b>{{ $investment->formatted_total_accumulated }}</h1>
                        </div>
                        <div class="card mb-3 p-3">
                            <p>Active Funds Balance </p>
                            <h1><b class="tx-30">$</b>{{ $investment->formatted_available_fund_balance }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="set1">
                        <div class="card mb-3 p-3">
                            <p>Active Interest Balance </p>
                            <h1><b class="tx-30">$</b>{{ $investment->formatted_active_interest_balance }}</h1>
                        </div>
                        <div class="card mb-3 p-3">
                            <p>Total Withdrawn </p>
                            <h1><b class="tx-30">$</b>{{ $investment->formatted_total_withdawal }}</h1>
                        </div>
                        <div class=" mb-3 ">
                           <form action="{{ route('user.withdrawal-request.index') }}" method="GET">
                            @csrf
                            <input type="hidden" name="investment_id" value="{{ $investment->id }}<">
                            <button class="btn btn-brand-02 w-100 mb-2">
                                Make Withdrawal <i class="bi bi-wallet2 text-white"></i>
                            </button>
                           </form>

                           <form action="{{ route('user.transfer.index') }}" method="GET">
                            @csrf
                            <input type="hidden" name="investment_id" value="{{ $investment->id }}<">
                            <button class="btn btn-brand-02 w-100 ">
                                Inter Account Transfer <i class="bi bi-send text-white"></i>
                            </button>
                           </form>
                           
                            {{-- <div class="col-3">
                                <a href="#" class="accordion-button collapsed shadow-none  px-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo{{ $invest->investment_id }}" aria-expanded="false" aria-controls="collapseTwo{{ $invest->investment_id }}">More Details</a>
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>
        <div class="set2">
            <span class="">Broad</span>
            <div class="mb-4"></div>
            <p>A growth portfolio providing access to selected top-tier growth equity and VC funds</p>
        </div>
 
    <div class="row">
        <div class="col-md-7">
            <div class="card p-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md">
                            <h4>Portfolio Summary</h4>
                        </div>
                        <div class="col-md">
                            <div class="c100 p{{ $investment->daysLeft }} small mt-2 ">
                                <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="{{ $investment->days }}" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: {{ $investment->days }}%"></div>
                                </div>
                                <div class="slice">
                                    <div class="bar"></div>
                                    <div class="fill"></div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-auto">
                            <div class="right mt-1">
                                <h6 class="mb-0 text-muted"> {{ $investment->days }} Days Left</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="set3">

                    <br>
                    <ul>
                        <li class="up">
                            <p><span class="greendot me-2"></span> INVESTMENT NAME</p>
                            <p> <span class="blue"> {{ $package->name }} </span> </p>
                        </li>
                        <li>
                            <p class="grey">ROI</p>
                            <h6> <span class="blue"> <b class="tx-20 blue">$</b>{{ $investment->returns }},</span> <small class="text-muted">Bi Weekly</small></h6>
                        </li>
                        <li>
                            <p class="grey">Payout</p>
                            <h6> {{ $investment->formatted_payout }}</h6>
                        </li>

                        <li>
                            <p class="grey">Next Earning Date</p>
                            <h6> {{ $investment->formatted_next_earn_date }}</h6>
                        </li>


                        @if($investment->compound_status==true )
                        <li>
                            <p class="grey">Stacking Status</p>
                            <h6> {{ $investment->end_date }}</h6>
                        </li>
                        <li>
                            <p class="grey">Stacking End Date</p>
                            <h6> {{ $investment->compound_end_date }}</h6>
                        </li>
                        @endif

                        @if ($investment->payout=="diverse_stacking_interest")
                        <li>
                            <p>Diverse Ration</p>
                            <h6> {{ $package->diverse_taken_percentage*100 }}%-(AIB)...........{{ 100-$package->diverse_taken_percentage*100 }}%-(AFB)</h6>
                        </li>
                        @endif

                        <li>
                            <p class="text-danger">Portfolio Expiration Date</p>
                            <h6> {{ $investment->end_date }}</h6>
                        </li>

                    </ul>
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <a href="#">
                                <button class="withbackbtn mb-3">
                                    <i class="bi bi-arrow-clockwise text-white"></i>
                                    Reinitiate Investment
                                </button>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="#">
                                <button class="withbackbtn btn-outline-primary mb-3 ">
                                    <i class="bi bi-arrow-clockwise text-white"></i>
                                    Capital Call
                                </button>
                            </a>
                        </div>
                    </div>



                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card p-3">
                <div class="card-header">
                    <h4>Make Reinvestment</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.reinvest.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="investment_id" value="{{ $investment->id  }}">
                        <input type="hidden" name="page_url" value="/user/user-investments/{{ $investment->id }}/edit">
                        <div class="row">

                            <div class="form-group col-md-12">
                                <label>Choose Gateway</label>
                                <select class="form-select" id="gateway" name="payment_method" required>
                                    <option value="">Select Gate Way</option>
                                    <option value="direct_deposit">Direct Deposit</option>
                                    <option value="available_funds">Active Funds Balance</option>
                                    <option value="active_interest">Active Interest Balance</option>
                                    <option value="referral_commission">Referral Commission</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12" id="currency">
                                <label for="currency">Currency</label>
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

                            <div class="form-group col-md-12">
                                <label for="inputEmail4">What amount would you like to add </label>
                                <input type="number" class="form-control" id="inputEmail4" name="amount" placeholder="Enter Amount" required>
                            </div>

                            <div class="col-md-12">

                                <button type="submit" class="btn btn-primary w-100"> Proceeed</button>

                            </div>
                        </div>

                        {{-- <center> --}}



                        {{-- </center> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="margin60">
        <div data-label="Example" class="df-example demo-table">
            <div class="table-responsive">
                <table class="table table-striped mg-b-0" id="example1">
                    <thead class="thead-secondary">
                        <tr>
                            <th scope="col">S\N</th>
                            <th scope="col">Type</th>
                            <th scope="col">Description</th>
                            <th scope="col">Date</th>
                            <th scope="col">Value</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                         
                            @foreach ($activities as $key =>$act)
                             
                            <tr>
                                <td>{{ $key }}</td>
                                <td>{{ $act->title }}</td>
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
            </div><!-- table-responsive -->
        </div>
    </div>

    
</div>
</div>

<script src="{{ asset('main-user-assets/lib/jquery/jquery.min.js') }}"></script>
<script>
     $("#gateway").on('change', function() {
        if ($(this).val() == "available_funds" || $(this).val() == "active_interest") {
             
            $("#currency").hide()
            $("#currency_drop").attr("required", false)
        } else if ($(this).val() == "direct_deposit") {
            $("#currency").show()
            $("#currency_drop").attr("required", true)
            
        } else {
            
            $("#currency").hide()
            $("#currency_drop").attr("required", false)
        }
    })
</script>
@endsection

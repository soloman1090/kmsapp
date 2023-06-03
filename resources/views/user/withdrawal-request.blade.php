@extends('templates.main-user')

@section('content')
<img src="{{ asset('user-assets/images/widgets/withdrawal.jpg') }}" alt="" style="width: 100%; border-top-left-radius: 10px;
border-top-right-radius: 10px;" >
<br><br>
<div class="row">
    @foreach ($methods as $met)
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="pricingTable1 text-center">
                    <div class="text-center">
                        <img src="{{ asset('uploads/'.$met['image'] ) }} " width="70" alt="">
                    </div>
                    <h3 class="title1 py-3 mt-1 mb-0  font-40">{{ $met['name'] }}</h3>
                    <div class="text-center">
                        <h3 class="amount">${{ $met['min_amt'] }} </h3>
                        <small class="text-muted font-16">Minimum Amount</small>
                    </div>
                    <br>
                    <br>
                    <h4 class="text-center">Withdrawal Duration</h4>
                    <p class="text-center">Payments are being processed within 24hours</p>
                    <br>
                    <h4 class="text-center">Wallet Type</h4>
                    <p class="text-center">Universally compactible with any bitcoin wallet</p>
                    <br>
                    {{-- <h4 class="text-center">Transaction fee</h4>
                    <p class="text-center">Payments are being processed within 24hours</p> --}}
                    {{-- <br> <small class=" font-14">Every withdrawal is charged at {{ $met['charges'] }}% transaction fee</small> <br><br> --}}
                    <a href="" data-bs-toggle="modal" data-bs-target="#drawModalDefault{{ $met['id'] }}" class="btn btn-primary w-100  btn-outline-dashed py-2"><span>Make Withdrawal </span></a>
                </div>
                <!--end pricingTable-->
            </div>
            <!--end card-body-->
        </div>
        <!--end card-->
    </div>
    <!--end col-->


    <div class="modal fade" id="drawModalDefault{{ $met['id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
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
                        <input type="hidden" name="withdrawal_methods_id" value="{{ $met['id'] }}">
                        <input type="hidden" name="currency_code" value="{{ $met['currency_code'] }}">
                        <input type="number" hidden name="charge" value="{{ $met['charges'] }}">
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
                                        <h6><b class="text-mute">Compound Wallet
                                                Balance</b></h6>
                                        <h3>$ {{ $user->compound_wallet }}</h3>
                                        <input type="hidden" id="compountWalletInput" value="{{ $user->compound_wallet }}">
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                <a href="withdrawal-request?auth=yes" class="btn btn-info">Generate Code</a>
                            </div>
                        </div>
                        <div class="amount-group">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="inputAmount">Amount</label>
                                    <input type="decimal" class="form-control inputAmount" name="amount_paid" id="inputAmount" placeholder="Enter Amount" required data-parsley-min="{{ $user->$met['min_amt'] ?? 0 }}" data-parsley-max="0">
    
                                </div>
                                <input type="hidden" class="main_wallet_balance" value="{{ $user->main_wallet}}">
                                <input type="hidden" class="compound_wallet_balance" value="{{ $user->compound_wallet}}">
                                <div class="form-group col-md-12">
                                    <label for="wallet">Wallet</label>
                                    <select name="wallet_type" class="form-control wallet_type" id="wallet_type" required>
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
                    <button type="submit" class="btn btn-primary withdrawBtn" id="">Withdraw</button>
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




    @endforeach


    <script src="{{ asset('user-assets/js/jquery.min.js') }}"></script>
    <script>
        if($(".2fa").val()==""){
            $(".amount-group").hide()
            $(".withdrawBtn").hide()
        }

        $(".2fa").on('keyup change', function() {
            
            if($(this).val().length==6){
                $(".amount-group").show()
                $(".withdrawBtn").show()
            }else{
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

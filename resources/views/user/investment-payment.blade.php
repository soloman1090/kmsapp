@extends('templates.main-user')

@section('content')
<!-- DataTables -->
<div class="">
    <div class="set1">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3 p-3">
                    <p>Available Fund Balance</p>
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
        <form>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Choose Gateway</label>
                    <select class="form-select">
                        <option value="">Select Gate Way</option>
                        <option value="direct_deposit">Direct Deposit</option>
                        <option value="available_funds">Available Funds Balance</option>
                        <option value="active_interest">Active Interest Balance</option>
                        <option value="referral_commission">Referral Commission</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                     <label for="fundsId">Funding Source</label>
                    <select name="fundsId" class="form-select" id="fundsId" >
                        <option value="">Select Source</option>
                        @foreach($investments as $key=> $invest)
                        <option value="{{ $invest->id}}" available_funds="{{  $invest->formatted_available_fund_balance }}" active_interest="{{ $invest->formatted_active_interest_balance }}">{{ $invest->package->name}}: AFB( ${{ $invest->formatted_available_fund_balance }} ) ---- AIB( ${{ $invest->formatted_active_interest_balance }} ) </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Investment Amount</label>
                    <input type="number" class="form-control" id="inputEmail4" placeholder="Enter Amount">
                </div>
                <div class="form-group col-md-6">
                    <label>Select Process</label>
                    <select class="form-select">
                        <option value="">Select Interest Process</option>
                        <option value="bi_weekly">Regular Bi Weekly</option>
                        <option value="stacking_interest">Fixed Stacking Interest</option>
                        <option value="diverse_stacking_interest">Diverse Stacking Interest</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                </div>
            </div>

            {{-- <center> --}}
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Agree with Terms of Use and Privacy Policy</label>
                </div>
            </div>

            <div class="col-md-6">

                <button type="submit" class="btn btn-primary w-100"> <a href="/user/investment-receipt" class="sub">Submit Form</a></button>

            </div>
            {{-- </center> --}}
        </form>
    </div>
</div>

<script src="{{ asset('main-user-assets/lib/jquery/jquery.min.js') }}"></script>
<script>
      $("#fundsId").on('change', function() {
        $("#available_fund_balance").html("<b>$</b>"+$('option:selected', this).attr('available_funds'))
        $("#active_interest_balance").html("<b>$</b>"+$('option:selected', this).attr('active_interest'))
    })
</script>
@endsection

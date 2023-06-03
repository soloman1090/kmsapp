@extends('templates.main-user')

@section('content')
 


<div class="card">
    <div class="container">
        <img src="{{ asset('user-assets/images/widgets/calculator.jpg') }}" alt="" style="width: 100%; border-top-left-radius: 10px;
border-top-right-radius: 10px;" >
        <div class="row">
    
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Investment Calculator</h2>
                        <p>Select your prefered potolio and amount you want to invest</p>
                    </div>
                    <div class="card-body">
                      
                        <div class="form-group  ">
                            <label for="wallet">Package</label>
                            <select name="package" class="form-control package" id="package" required>
                                <option value="">Select Package</option>
                                @foreach($packages as $key => $pack)
                                <option compound_percent="{{  $pack->compound_percent }}" min_percent="{{  $pack->min_percent }}" min_amt="{{ $pack->min_amt }}" duration="{{ $pack->duration }}"> {{ $pack->name }}</option>
                                @endforeach
    
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputAmount">Amount <span class=" p-2" id="amountLabel"></span></label>
                            <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Amount" required>
                        </div>
                        <button type="button" class="btn btn-primary calculateBtn" id="calculateBtn">Calculate Investment</button>
                    </div>
                </div>
            </div>
    
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
    
                        <h2>Investment Summary</h2>
    
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Normal Investment</h6>
                                <div class="row">
                                    <div class="col-6"><b>Daily ROI</b></div>
                                    <div class="col-6" id="dailyRoi">$0</div>
                                    <hr>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-6"><b>Weekly ROI</b></div>
                                    <div class="col-6" id="weeklyRoi">$0</div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-6"><b>Montly ROI</b></div>
                                    <div class="col-6" id="monthlyRoi">$0</div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-6"><b>Total ROI</b></div>
                                    <div class="col-6" id="totalRoi">$0</div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6>Compounding Investment</h6>
                                <div class="row">
                                    <div class="col-6"><b>Daily ROI</b></div>
                                    <div class="col-6" id="dailyComRoi">$0</div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-6"><b>Weekly ROI</b></div>
                                    <div class="col-6" id="weeklyComRoi">$0</div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-6"><b>Montly ROI</b></div>
                                    <div class="col-6" id="monthlyComRoi">$0</div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-6"><b>10 Months ROI</b></div>
                                    <div class="col-6" id="totalComRoi">$0</div>
                                    
                                </div>
                            </div>
                        </div>
    
    
    
    
    
    
                    </div>
    
                </div>
            </div>
        </div>
    </div>
    
</div>









<script src="{{ asset('user-assets/js/jquery.min.js') }}"></script>
<script>
    $("#package").on('click', function() {
        $("#amountLabel").html(`Minimum Amount=$${$('option:selected', this).attr('min_amt')}`)
    })

    $("#calculateBtn").on('click', function() {
        let compound_percent = $('option:selected', $("#package")).attr('compound_percent')
        let min_percent = $('option:selected', $("#package")).attr('min_percent')
        let min_val = $('option:selected', $("#package")).attr('min_amt')
        let duration = $('option:selected', $("#package")).attr('duration')
        let amount = $("#amount").val()

         
        if (amount >=  min_val ) {

            let compoundAmount = compound_percent / 100;
            let minAmount = min_percent / 100;

            compoundAmount = compoundAmount * amount;
            minAmount = minAmount * amount;

            weeklyAmount = minAmount * 5
            weeklyCompoundAmout = compoundAmount * 5

            monthlyAmount = minAmount * 20
            monthlyCompoundAmout = compoundAmount * 20

            totalDays = duration * 20
            totalComDays = 10 * 20

            totalAmount = minAmount * totalDays
            totalCompound = compoundAmount * totalComDays


            $("#dailyRoi").html(`$${minAmount.toFixed(2).toString().toLocaleString('en-US')}`)
            $("#weeklyRoi").html(`$${weeklyAmount.toFixed(2)}`)
            $("#monthlyRoi").html(`$${monthlyAmount.toFixed(2)}`)
            $("#totalRoi").html(`$${totalAmount.toFixed(2)}`)

            $("#dailyComRoi").html(`$${compoundAmount.toFixed(2)}`)
            $("#weeklyComRoi").html(`$${weeklyCompoundAmout.toFixed(2)}`)
            $("#monthlyComRoi").html(`$${monthlyCompoundAmout.toFixed(2)}`)
            $("#totalComRoi").html(`$${totalCompound.toFixed(2)}`)
        } else {
            alert(`Minmum Amount is $${min_val}, Please increase the amount you want to invest`)
        }


    })

</script>

@endsection

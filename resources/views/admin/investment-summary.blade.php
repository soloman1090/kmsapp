@extends('templates.admin')

@section('content')
<link href="{{ asset('admin-assets/vendors/bower_components/dropify/dist/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Row -->
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default card-view panel-refresh">
            <div class="refresh-container">
                <div class="la-anim-1"></div>
            </div>
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Investment Breakdown</h6>
                </div>
                <div class="pull-right">
                    
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <h1> <small class="bg-primary">TOTAL INVESTED</small>: <b>${{ $totalSystemInvested }}</b></h1>
                    <hr>
                    @foreach ($allPackages as $key=> $package)
                    <h4>{{ $package }}</h4>
                    <h1>${{ $amountInvests[$key] }}</h1>
                    <hr>
                    @endforeach
                </div>
            </div>	
        </div>	
    </div>

    <div class="col-md-6">
        <div class="panel panel-default card-view panel-refresh">
            <div class="refresh-container">
                <div class="la-anim-1"></div>
            </div>
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Investment Chart</h6>
                </div>
                <div class="pull-right">
                    
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div>
                        <canvas id="chart_10" height="253" class="hello mae"></canvas>
                    </div>	
                </div>
            </div>	
        </div>	
    </div>
   

     
</div>

<div class="row">

   

   
</div>
<!-- /Row -->
<script src="{{ asset('admin-assets/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('admin-assets/vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>

<script>
     $(window).on('load', function() {

    

        if( $('#chart_10').length > 0 ){
		var ctx2 = document.getElementById("chart_10").getContext("2d");
		var data2 = {
			labels:{!! json_encode($allPackages) !!} ,

			datasets: [
                
				{
					label: "Invested",
					backgroundColor: "#34dd5b",
					borderColor: "#34dd5b",
					data:  {!! json_encode($amountInvests) !!}
				},
                
               
				
			]
		};
		
		var hBar = new Chart(ctx2, {
			type:"bar",
			data:data2,
			
			options: {
				tooltips: {
					mode:"label"
				},
				scales: {
					yAxes: [{
						stacked: true,
						gridLines: {
							color: "rgba(135,135,135,0)",
						},
						ticks: {
							fontFamily: "Poppins",
							fontColor:"#878787"
						}
					}],
					xAxes: [{
						stacked: true,
						gridLines: {
							color: "rgba(135,135,135,0)",
						},
						ticks: {
							fontFamily: "Poppins",
							fontColor:"#878787"
						}
					}],
					
				},
				elements:{
					point: {
						hitRadius:40
					}
				},
				animation: {
					duration:	3000
				},
				responsive: true,
				maintainAspectRatio:false,
				legend: {
					display: false,
				},
				
				tooltip: {
					backgroundColor:'rgba(33,33,33,1)',
					cornerRadius:0,
					footerFontFamily:"'Poppins'"
				}
				
			}
		});
	}
});
</script>


@endsection

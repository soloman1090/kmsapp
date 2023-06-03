@extends('templates.admin')

@section('content')
<link href="{{ asset('admin-assets/vendors/bower_components/dropify/dist/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Row -->
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default card-view panel-refresh">
            <div class="refresh-container">
                <div class="la-anim-1"></div>
            </div>
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Survey Summary</h6>
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
                    <div class="label-chatrs mt-30">
                        <div class="inline-block mr-15">
                            <span class="clabels inline-block mr-5" style="background-color: #34dd5b"></span>
                            <span class="clabels-text font-12 inline-block txt-dark capitalize-font">Yes</span>
                        </div>
                        <div class="inline-block mr-15">
                            <span class="clabels inline-block  mr-5" style="background-color: #ef4220"></span>
                            <span class="clabels-text font-12 inline-block txt-dark capitalize-font">No</span>
                        </div>
                        <div class="inline-block mr-15">
                            <span class="clabels inline-block  mr-5" style="background-color: #efda20"></span>
                            <span class="clabels-text font-12 inline-block txt-dark capitalize-font">Maybe</span>
                        </div>	
                       											
                    </div>
                    
                </div>
            </div>	
        </div>	
        <div class="panel panel-default card-view panel-refresh">
            <form role="form" class="form-horizontal" method="POST" action="{{ route('admin.surveys.update', 1) }}">
                @csrf
                @method('put')
                 
                <div class="form-group">
                    <label class="col-lg-2 control-label">Yes </label>
                    <div class="col-lg-10">
                        <input type="text" placeholder="Enter Percentage" name="yes" id="transaction_id" class="form-control" value="{{ $surveyInfo->support??"0" }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">No </label>
                    <div class="col-lg-10">
                        <input type="text" placeholder="Enter Percentage" name="no" id="amount" class="form-control" value="{{ $surveyInfo->withdrawals??"0" }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Maybe </label>
                    <div class="col-lg-10">
                        <input type="text" placeholder="Enter Percentage" name="maybe" id="return" class="form-control" value="{{ $surveyInfo->deposits??"0" }}">
                    </div>
                </div> 
               
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button class="btn btn-success" type="submit">Update </button>
                    </div>
                </div>
            </form>
           </div>
    </div>
   <hr>
   

    <div class="col-md-8">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark"></h6>
                </div>
                <div class="pull-right">
                    
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                   
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table id="datable_1" class="table table-hover display  pb-30">
                                <thead class="data-table-head">
                                    <tr class="data-table-head">
                                        <th class="hd">S/N</th>
                                        <th class="hd">Name</th>
                                        <th class="hd">Yes</th>
                                        <th class="hd">No</th>
                                        <th class="hd">Maybe</th>
                                        {{-- <th class="hd">functions</th> --}}
                                        <th class="hd">Comments</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th class="hd">S/N</th>
                                        <th class="hd">Name</th>
                                        <th class="hd">Yes</th>
                                        <th class="hd">No</th>
                                        <th class="hd">Maybe</th>
                                        {{-- <th class="hd">Functions</th> --}}
                                        <th class="hd">Comments</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($surveys as $key=> $sor)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $sor['username'] }}</td>

                                        @if ($sor['support']=="Yes")
                                        <td> <span class="label label-success">Yes</span></td>
                                        @else
                                        <td><i class="fa fa-close text-danger" aria-hidden="true"></i></td>
                                        @endif

                                        @if ($sor['withdrawals']=="No")
                                        <td>  <span class="label label-danger">No</span></td>
                                        @else
                                        <td><i class="fa fa-close text-danger" aria-hidden="true"></i></td>
                                        @endif


                                        @if ($sor['deposits']=="Maybe")
                                        <td> <span class="label label-warning"> Maybe</span></td>
                                        @else
                                        <td><i class="fa fa-close text-danger" aria-hidden="true"></i></td>
                                        @endif


                                        {{-- @if ($sor['functions']=="Yes")
                                        <td>  <span class="label label-danger">Yes</span></td>
                                        @else
                                        <td><i class="fa fa-check text-success" aria-hidden="true"></i></td>
                                        @endif --}}
 
                                        <td>{{ $sor['comments'] }}</td>  
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="container">
                                <div class="row">
                                    <div class="col-3"><h5><b>PAGE VIEWS</b></h5></div>
                                    <div class="col"><h5> <span> {{ $surveys->links()}}</span></h5></div>
                                </div>
                            </div>
                        </div>
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
			labels: ["Yes", "No", "Maybe" ],
			datasets: [
                {
					label: "Yes",
					backgroundColor: "#34dd5b",
					borderColor: "#34dd5b",
					data:  {!! json_encode($arrayImprove) !!}
				},
				{
					label: "No",
					backgroundColor: "#34dd5b",
					borderColor: "#34dd5b",
					data:  {!! json_encode($arrayOkay) !!}
				},
                {
					label: "Maybe",
					backgroundColor: "#34dd5b",
					borderColor: "#34dd5b",
					data:  {!! json_encode($arrayOkay) !!}
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

@extends('templates.admin')

@section('content')
<link href="{{ asset('admin-assets/vendors/bower_components/dropify/dist/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />

<hr class="light-grey-hr mt-20 mb-20" />
<div class="row">
    <div class="col-md-12">
        <div class="pull-left">
            <h6 class="panel-title txt-dark">
                Manage Packages
            </h6>
        </div>
        <div class="pull-right">
            <!-- /.modal -->
            <div id="responsive-modal" class="modal fade modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary txt-light">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h5 class="modal-title font-20">Add Package</h5>
                        </div>
                        <form data-toggle="validator" action="{{ route('admin.investment-packages.store') }}" method="POST" role="form" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <h2>Package Info</h2>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="package_name" class="control-label mb-10">Package Name:</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter Package Name: PRIVATE BONDS" id="" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="category_name" class="control-label mb-10">Package Category Name:</label>
                                        <input type="text" class="form-control" name="category_name" placeholder="Category Name: SMALL CAP" id="" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="package_type" class="control-label mb-10">Package Type:</label>
                                        <select name="package_type" id="" class="form-control">
                                            <option value="">Select Package Type</option>
                                            <option value="normal">Normal</option>
                                            <option value="short">Short Term</option>
                                            <option value="pods">Pods</option>

                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="active_status" class="control-label mb-10">Active Status:</label>
                                        <select name="active_status" id="" class="form-control">
                                            <option value="">Select Status</option>
                                            <option value="active">Active</option>
                                            <option value="expired">Expired</option>

                                        </select>
                                    </div>



                                    <div class="form-group col-md-6">
                                        <label for="min_amt" class="control-label mb-10">Minimum Investment Amount:</label>
                                        <input type="number" class="form-control" name="min_amt" placeholder="Enter amount: $50" id="" required>
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label for="max_amount" class="control-label mb-10">Maximum Investment Amount:</label>
                                        <input type="number" class="form-control" name="max_amt" placeholder="Enter amount: $5000" id="" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="min_percent" class="control-label mb-10">Mini Percent:</label>
                                        <input type="decimal" class="form-control" name="min_percent" placeholder="Enter percent: 2.3%" id="" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="max_percent" class="control-label mb-10">Max Percent:</label>
                                        <input type="decimal" class="form-control" name="max_percent" placeholder="Enter amount: 32.4%" id="" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="bonus_percentage" class="control-label mb-10">Bonus Percent:</label>
                                        <input type="decimal" class="form-control" name="bonus_percentage" placeholder="Percent 20%" id="" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="running_days" class="control-label mb-10">Running Days:</label>
                                        <input type="number" class="form-control" name="running_days" placeholder="7-all week, 5,week-Days" id="" required>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="duration" class="control-label mb-10">Duration:</label>
                                        <input type="number" class="form-control" name="duration" placeholder="Enter amount: $50" id="" required>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="compound_duration" class="control-label mb-10">Compounding Duration</label>
                                        <input type="number" class="form-control" name="compound_duration" placeholder="Duration in months: 10" id="" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="slots" class="control-label mb-10">Slots Available</label>
                                        <input type="number" class="form-control" name="slots" placeholder="10" id="" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="compound_percent" class="control-label mb-10">Compound Percentage</label>
                                        <input type="decimal" class="form-control" name="compound_percent" placeholder="Pecentage:e.g 2.4" id="" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="start_date" class="control-label mb-10">Start Date </label>
                                        <input type="date" class="form-control" name="start_date" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="expire_date" class="control-label mb-10">Expiration Date </label>
                                        <input type="date" class="form-control" name="expire_date" required>
                                    </div>
                                    <hr>

                                    <div class="form-group col-md-4">
                                        <label for="level1_bonus" class="control-label mb-10">Level 1 Bonus</label>
                                        <input type="decimal" class="form-control" name="level1_bonus" placeholder="%:e.g 0.010" id="" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="level2_bonus" class="control-label mb-10">Level 2 Bonus </label>
                                        <input type="decimal" class="form-control" name="level2_bonus" placeholder="%:e.g 0.05" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="level3_bonus" class="control-label mb-10">Level 3 Bonus </label>
                                        <input type="decimal" class="form-control" name="level3_bonus" placeholder="%:e.g 0.025" required>
                                    </div>
                                    <hr>
                                </div>
                                <hr>
                                <h2>More Details</h2>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="info1_heading" class="control-label mb-10">Info Heading 1:</label>
                                        <input type="text" class="form-control" name="info_head_1" placeholder="Enter Info1 Heading:" id="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="info1_details" class="control-label mb-10">Info Details 1:</label>
                                        <input type="text" class="form-control" name="info_detail_1" placeholder="Enter Info1 Details" id="">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="info_head_2" class="control-label mb-10">Info Heading 2:</label>
                                        <input type="text" class="form-control" name="info_head_2" placeholder="Enter Info2 Heading:" id="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="info_detail_2" class="control-label mb-10">Info Details 2:</label>
                                        <input type="text" class="form-control" name="info_detail_2" placeholder="Enter Info2 Details" id="">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="info_head_3" class="control-label mb-10">Info Heading 3:</label>
                                        <input type="text" class="form-control" name="info_head_3" placeholder="Enter Info3 Heading:" id="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="info_detail_3" class="control-label mb-10">Info Details 3:</label>
                                        <input type="text" class="form-control" name="info_detail_3" placeholder="Enter Info3 Details" id="">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="info_head_4" class="control-label mb-10">Info Heading 4:</label>
                                        <input type="text" class="form-control" name="info_head_4" placeholder="Enter Info4 Heading:" id="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="info_detail_4" class="control-label mb-10">Info Details 4:</label>
                                        <input type="text" class="form-control" name="info_detail_4" placeholder="Enter Info4 Details" id="">
                                    </div>


                                </div>
                                <div class="form-group attachImage">
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body">
                                            <p class="text-dark" id="payment_method_label">Attach Image.</p>
                                            <div class="mt-10">
                                                <input type="file" id="input-file-now" name="image" class="dropify" />
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn-rounded">Save Package</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <button class="btn btn-primary btn-rounded btn-lable-wrap" data-toggle="modal" data-target="#responsive-modal"><span class="btn-text">Add Package</button>

        </div>
        <div class="clearfix"></div>
    </div>
</div>
<br>
<div class="row">

    @foreach ($packages as $pac)
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-primary contact-card card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <div class="pull-left user-detail-wrap">
                        <span class="block card-user-name">
                            <h4> {{ $pac['name'] }}</h4>
                            <h6>Category ({{ $pac['category_name'] }}) </h6>
                        </span>
                        <span class="block card-user-desn">
                            <h1><b>$ {{ $pac['min_amt'] }} USD</b></h1>
                        </span>
                    </div>
                </div>
                <div class="pull-right">
                    {{-- <a class="pull-left inline-block mr-15 edit_invest_package" data-toggle="modal" data-target="#edit-package-modal{{ $pac['id'] }}" href="#"  info_head_2="" info_detail_2="" info_head_3="" info_detail_3="" info_head_4="{{ $pac['info_head_4'] }}" info_detail_4="{{ $pac['info_detail_4'] }}" info_head_5="{{ $pac['info_head_5'] }}" info_detail_5="{{ $pac['info_detail_5'] }}" action="{{ route('admin.investment-packages.update', $pac['id']  ) }}">
                        <i class="zmdi zmdi-edit txt-light"></i>
                    </a> --}}
                    <a class="pull-left inline-block mr-15 edit_invest_package"  href="{{ route('admin.investment-packages.edit', $pac['id']) }}"  >
                        <i class="zmdi zmdi-edit txt-light"></i>
                    </a>
                    <a class="pull-left inline-block mr-15" onclick="event.preventDefault();
                    document.getElementById('delete_pac_from-{{ $pac['id'] }}').submit()" href="#">
                        <i class="zmdi zmdi-delete txt-light"></i>
                        {{-- DELETE METHOD CALL --}}
                        <form id="delete_pac_from-{{ $pac['id'] }}" action="{{ route('admin.investment-packages.destroy', $pac['id']  ) }}" method="POST" style="display: none">
                            @csrf
                            @method('delete')
                        </form>
                    </a>

                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body row">
                    <div class="user-others-details pl-15 pr-15">
                        <div>
                            <i class="fa fa-percent inline-block mr-10" aria-hidden="true"></i>
                            <h5 class="inline-block"><b class="txt-muted">Commission:</b> {{ $pac['min_percent'] }}% </h5>
                        </div>
                        <hr class="light-grey-hr mt-20 mb-20" />
                        <div>
                            <i class="fa fa-calendar inline-block mr-10" aria-hidden="true"></i>
                            <h5 class="inline-block"><b class="txt-muted">Duration:</b> {{ $pac['duration'] }}-Months</h5>
                        </div>
                        <hr class="light-grey-hr mt-20 mb-20" />
                        <div>
                            <i class="fa fa-calendar-o inline-block mr-10" aria-hidden="true"></i>
                            <h5 class="inline-block"><b class="txt-muted">Compounding:</b> {{ $pac['compound_duration'] }}-Months </h5>
                        </div>
                        <hr class="light-grey-hr mt-20 mb-20" />
                        <div>
                            <i class="fa fa-bar-chart inline-block mr-10" aria-hidden="true"></i>
                            <h5 class="inline-block"><b class="txt-muted">Compounding Percentage:</b> {{ $pac['compound_percent'] }}5% </h5>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


    <div id="edit-package-modal{{ $pac['id'] }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary txt-light">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title font-20">Update Package</h5>
                </div>
                <form data-toggle="validator" id="updateInvestPackageForm" action="{{ route('admin.investment-packages.store' ) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf 
                    <input type="hidden" name="package_id" value="{{ $pac['id'] }}">
                    <input type="hidden" name="update" value="true">
                    <div class="modal-body">
                        <h2>Package Info</h2>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="package_name" class="control-label mb-10">Package Name:</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Package Name: PRIVATE BONDS" value="{{ $pac['name'] }}" required>
                            </div>
    
                            <div class="form-group col-md-6">
                                <label for="category_name" class="control-label mb-10">Package Category Name:</label>
                                <input type="text" class="form-control" name="category_name" placeholder="Category Name: SMALL CAP" value="{{ $pac['category_name'] }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="package_type" class="control-label mb-10">Package Type:</label>
                                <select name="package_type" id="" class="form-control" required>
                                    <option value="">Select Package Type</option>
                                    <option value="normal">Normal</option>
                                    <option value="short">Short Term</option>
                                    <option value="pods">Pods</option>

                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="active_status" class="control-label mb-10">Active Status:</label>
                                <select name="active_status" id="" class="form-control" required>
                                    <option value="">Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="expired">Expired</option>

                                </select>
                            </div>
    
                            <div class="form-group col-md-6">
                                <label for="min_amt" class="control-label mb-10">Minimum Investment Amount:</label>
                                <input type="number" class="form-control" name="min_amt" placeholder="Enter amount: $50"  value="{{ $pac['min_amt'] }}" required>
                            </div>
    
    
                            <div class="form-group col-md-6">
                                <label for="max_amount" class="control-label mb-10">Maximum Investment Amount:</label>
                                <input type="number" class="form-control" name="max_amt" placeholder="Enter amount: $5000" value="{{ $pac['max_amt'] }}" required>
                            </div>
    
                            <div class="form-group col-md-6">
                                <label for="min_percent" class="control-label mb-10">Mini Percent:</label>
                                <input type="decimal" class="form-control" name="min_percent" placeholder="Enter percent: 2.3%" value="{{ $pac['min_percent'] }}" required>
                            </div>
    
                            <div class="form-group col-md-6">
                                <label for="max_percent" class="control-label mb-10">Max Percent:</label>
                                <input type="decimal" class="form-control" name="max_percent" placeholder="Enter amount: 32.4%" value="{{ $pac['max_percent'] }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="bonus_percentage" class="control-label mb-10">Bonus Percent:</label>
                                <input type="decimal" class="form-control" name="bonus_percentage" placeholder="Percent 20%" value="{{ $pac['bonus_percentage'] }}" id="" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="running_days" class="control-label mb-10">Running Days:</label>
                                <input type="number" class="form-control" name="running_days" placeholder="7-all week, 5,week-Days" value="{{ $pac['running_days'] }}" required>
                            </div>
    
                            <div class="form-group col-md-4">
                                <label for="duration" class="control-label mb-10">Duration:</label>
                                <input type="number" class="form-control" name="duration" placeholder="Months: 6" value="{{ $pac['duration'] }}" required>
                            </div>
    
                            <div class="form-group col-md-4">
                                <label for="compound_duration" class="control-label mb-10">Compounding Duration</label>
                                <input type="number" class="form-control" name="compound_duration" placeholder="Enter amount: 2.4%" value="{{ $pac['compound_duration'] }}" required>
                                
                            </div>
                            <div class="form-group col-md-4">
                                <label for="slots" class="control-label mb-10">Slots Available</label>
                                <input type="number" class="form-control" name="slots" value="{{ $pac['slots'] }}" placeholder="10" id="" >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="compound_percent" class="control-label mb-10">Compound Percentage</label>
                                <input type="decimal" class="form-control" name="compound_percent" placeholder="Pecentage:e.g 2.4" value="{{ $pac['compound_percent'] }}" required>
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label for="start_date" class="control-label mb-10">Start Date </label>
                                <input type="date" class="form-control" name="start_date" value="{{ $pac['start_date'] }}"   >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="expire_date" class="control-label mb-10">Expiration Date </label>
                                <input type="date" class="form-control" name="expire_date" value="{{ $pac['expire_date'] }}"   >
                            </div>
                            <hr>

                            <div class="form-group col-md-4">
                                <label for="level1_bonus" class="control-label mb-10">Level 1 Bonus</label>
                                <input type="decimal" class="form-control" name="level1_bonus" value="{{ $pac['level1_bonus'] }}"  placeholder="%:e.g 0.010" id="" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="level2_bonus" class="control-label mb-10">Level 2 Bonus </label>
                                <input type="decimal" class="form-control" name="level2_bonus" value="{{ $pac['level2_bonus'] }}"  placeholder="%:e.g 0.05" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="level3_bonus" class="control-label mb-10">Level 3 Bonus </label>
                                <input type="decimal" class="form-control" name="level3_bonus" value="{{ $pac['level3_bonus'] }}"  placeholder="%:e.g 0.025" required>
                            </div>
                        </div>
                        <hr>
                        <h2>More Details</h2>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="info1_heading" class="control-label mb-10">Info Heading 1:</label>
                                <input type="text" class="form-control" name="info_head_1" placeholder="Enter Info1 Heading:" value="{{ $pac['info_head_1'] }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="info1_details" class="control-label mb-10">Info Details 1:</label>
                                <textarea type="text" class="form-control" name="info_detail_1" id="body" rows="10" required> {{ $pac['info_detail_1'] }}</textarea>
                            </div>
    
                            <div class="form-group col-md-6">
                                <label for="info_head_2" class="control-label mb-10">Info Heading 2:</label>
                                <input type="text" class="form-control" name="info_head_2" placeholder="Enter Info2 Heading:" value="{{ $pac['info_head_2'] }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="info_detail_2" class="control-label mb-10">Info Details 2:</label>
                                <input type="text" class="form-control" name="info_detail_2" placeholder="Enter Info2 Details" value="{{ $pac['info_detail_2'] }}">
                            </div>
    
                            <div class="form-group col-md-6">
                                <label for="info_head_3" class="control-label mb-10">Info Heading 3:</label>
                                <input type="text" class="form-control" name="info_head_3" placeholder="Enter Info3 Heading:" value="{{ $pac['info_head_3'] }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="info_detail_3" class="control-label mb-10">Info Details 3:</label>
                                <input type="text" class="form-control" name="info_detail_3" placeholder="Enter Info3 Details" value="{{ $pac['info_detail_3'] }}">
                            </div>
    
                            <div class="form-group col-md-6">
                                <label for="info_head_4" class="control-label mb-10">Info Heading 4:</label>
                                <input type="text" class="form-control" name="info_head_4" placeholder="Enter Info4 Heading:" value="{{ $pac['info_head_4'] }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="info_detail_4" class="control-label mb-10">Info Details 4:</label>
                                <input type="text" class="form-control" name="info_detail_4" placeholder="Enter Info4 Details" value="{{ $pac['info_detail_4'] }}">
                            </div>
    
                            <div class="form-group col-md-6">
                                <label for="info_head_5" class="control-label mb-10">Info Heading 5:</label>
                                <input type="text" class="form-control" name="info_head_5" placeholder="Enter Info5 Heading:" value="{{ $pac['info_head_5'] }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="info_detail_5" class="control-label mb-10">Info Details 5:</label>
                                <input type="text" class="form-control" name="info_detail_5" placeholder="Enter Info5 Details" value="{{ $pac['info_detail_5'] }}">
                            </div>
                        </div>
                        <div class="form-group attachImage">
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <p class="text-dark" id="payment_method_label">Attach Image.</p>
                                    <div class="mt-10">
                                        <input type="file" id="input-file-now" name="image" class="dropify" />
                                    </div>
                                </div>
                            </div>
                        </div>
    
    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-rounded">Update Package</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

<script src="https://cdn.ckeditor.com/4.20.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'body' );
</script>

@endsection

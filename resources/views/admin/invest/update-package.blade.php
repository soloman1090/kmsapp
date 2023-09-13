
@extends('templates.admin')

@section('content')
<link href="{{ asset('admin-assets/vendors/bower_components/dropify/dist/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />

<div class="panel panel-primary contact-card card-view">
    <div class="panel-heading">
        <div class="pull-left">
            <div class="pull-left user-detail-wrap">
                <span class="block card-user-name">
                    <h4> {{ $pac['name'] }}</h4>
                    <h6>Category ({{ $pac['category_name'] }}) </h6>
                </span>
                
            </div>
        </div>
        
        <div class="clearfix"></div>
    </div>
    <div class="panel-wrapper collapse in">
        <div class="panel-body row">
            <form data-toggle="validator" id="updateInvestPackageForm" action="{{ route('admin.investment-packages.store' ) }}" method="POST" role="form" enctype="multipart/form-data">
                @csrf 
                <input type="hidden" name="package_id" value="{{ $pac['id'] }}">
                <input type="hidden" name="update" value="true">
                <div class="modal-body">
                    <h2>Package Info</h2>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="package_name" class="control-label mb-10">Package Name:</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Package Name: PRIVATE BONDS" value="{{ $pac['name'] }}" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="category_name" class="control-label mb-10">Package Category Name:</label>
                            <input type="text" class="form-control" name="category_name" placeholder="Category Name: SMALL CAP" value="{{ $pac['category_name'] }}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="package_type" class="control-label mb-10">Package Type:</label>
                            <select name="package_type" id="" class="form-control" required>
                                <option value="">Select Package Type</option>
                                <option value="normal">Normal</option>
                                <option value="short">Short Term</option>
                                <option value="pods">Pods</option>

                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="active_status" class="control-label mb-10">Active Status:</label>
                            <select name="active_status" id="" class="form-control" required>
                                <option value="">Select Status</option>
                                <option value="active">Active</option>
                                <option value="expired">Expired</option>

                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="min_amt" class="control-label mb-10">Minimum Investment Amount:</label>
                            <input type="number" class="form-control" name="min_amt" placeholder="Enter amount: $50"  value="{{ $pac['min_amt'] }}" required>
                        </div>


                        <div class="form-group col-md-4">
                            <label for="max_amount" class="control-label mb-10">Maximum Investment Amount:</label>
                            <input type="number" class="form-control" name="max_amt" placeholder="Enter amount: $5000" value="{{ $pac['max_amt'] }}" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="min_percent" class="control-label mb-10">Mini Percent:</label>
                            <input type="decimal" class="form-control" name="min_percent" placeholder="Enter percent: 2.3%" value="{{ $pac['min_percent'] }}" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="max_percent" class="control-label mb-10">Max Percent:</label>
                            <input type="decimal" class="form-control" name="max_percent" placeholder="Enter amount: 32.4%" value="{{ $pac['max_percent'] }}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="bonus_percentage" class="control-label mb-10">Bonus Percent:</label>
                            <input type="decimal" class="form-control" name="bonus_percentage" placeholder="Percent 20%" value="{{ $pac['bonus_percentage'] }}" id="" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="running_days" class="control-label mb-10">Running Days:</label>
                            <input type="number" class="form-control" name="running_days" placeholder="7-all week, 5,week-Days" value="{{ $pac['running_days'] }}" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="duration" class="control-label mb-10">Duration:</label>
                            <input type="number" class="form-control" name="duration" placeholder="Months: 6" value="{{ $pac['duration'] }}" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="compound_duration" class="control-label mb-10">Staking Duration</label>
                            <input type="number" class="form-control" name="compound_duration" placeholder="Enter amount: 2.4%" value="{{ $pac['compound_duration'] }}" required>
                            
                        </div>
                        <div class="form-group col-md-4">
                            <label for="slots" class="control-label mb-10">Slots Available</label>
                            <input type="number" class="form-control" name="slots" value="{{ $pac['slots'] }}" placeholder="10" id="" >
                        </div>
                        <div class="form-group col-md-4">
                            <label for="compound_percent" class="control-label mb-10">Staking Percentage</label>
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
                        <div class="form-group col-md-4">
                            <label for="diverse_taken_percentage" class="control-label mb-10">Diverse Staking Percentage </label>
                            <input type="decimal" class="form-control" name="diverse_taken_percentage" value="{{ $pac['diverse_taken_percentage'] }}"  placeholder="%:e.g 0.025" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="geography" class="control-label mb-10">Geography</label>
                            <input type="text" class="form-control" name="geography" value="{{ $pac['geography'] }}"  placeholder="Global" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="strategy" class="control-label mb-10">Strategy</label>
                            <input type="text" class="form-control" name="strategy" value="{{ $pac['strategy'] }}"  placeholder="Enter Strategy" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="portfolio_fund_targets" class="control-label mb-10">Portfolio Fund Targets</label>
                            <input type="text" class="form-control" name="portfolio_fund_targets" value="{{ $pac['portfolio_fund_targets'] }}"  placeholder="Enter Fund Targets" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="strategy_focus" class="control-label mb-10">Strategy Focus</label>
                            <input type="text" class="form-control" name="strategy_focus" value="{{ $pac['strategy_focus'] }}"  placeholder="Enter Focus" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="target_size" class="control-label mb-10">Target Size</label>
                            <input type="text" class="form-control" name="target_size" value="{{ $pac['target_size'] }}"  placeholder="Enter Targets" required>
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
                        <div class="form-group col-md-6">
                            <label for="info1_details" class="control-label mb-10">Info Details 1:</label>
                            <textarea type="text" class="form-control" name="info_detail_1" id="info_detail_1" rows="1" required> {{ $pac['info_detail_1'] }}</textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="info_head_2" class="control-label mb-10">Info Heading 2:</label>
                            <input type="text" class="form-control" name="info_head_2" placeholder="Enter Info2 Heading:" value="{{ $pac['info_head_2'] }}">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="info_detail_2" class="control-label mb-10">Info Details 2:</label>
                            <textarea type="text" class="form-control" name="info_detail_2" id="info_detail_2" rows="10" required> {{ $pac['info_detail_2'] }}</textarea>

                         </div>

                        <div class="form-group col-md-6">
                            <label for="info_head_3" class="control-label mb-10">Info Heading 3:</label>
                            <input type="text" class="form-control" name="info_head_3" placeholder="Enter Info3 Heading:" value="{{ $pac['info_head_3'] }}">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="info_detail_3" class="control-label mb-10">Info Details 3:</label>
                            <textarea type="text" class="form-control" name="info_detail_3" id="info_detail_3" rows="10" required> {{ $pac['info_detail_3'] }}</textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="info_head_4" class="control-label mb-10">Info Heading 4:</label>
                            <input type="text" class="form-control" name="info_head_4" placeholder="Enter Info4 Heading:" value="{{ $pac['info_head_4'] }}">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="info_detail_4" class="control-label mb-10">Info Details 4:</label>
                            <textarea type="text" class="form-control" name="info_detail_4" id="info_detail_4" rows="10" required> {{ $pac['info_detail_4'] }}</textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="info_head_5" class="control-label mb-10">Info Heading 5:</label>
                            <input type="text" class="form-control" name="info_head_5" placeholder="Enter Info5 Heading:" value="{{ $pac['info_head_5'] }}">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="info_detail_5" class="control-label mb-10">Info Details 5:</label>
                            <textarea type="text" class="form-control" name="info_detail_5" id="info_detail_5" rows="10" required> {{ $pac['info_detail_5'] }}</textarea>
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


<script src="https://cdn.ckeditor.com/4.20.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'info_detail_2' );
    CKEDITOR.replace( 'info_detail_3' );
    CKEDITOR.replace( 'info_detail_4' );
    CKEDITOR.replace( 'info_detail_5' );
</script>

@endsection
@extends('templates.admin')

@section('content')
<hr class="light-grey-hr mt-20 mb-20"/>
<div class="row">
    <div class="col-md-12">
        <div class="pull-left">
            <h6 class="panel-title txt-dark">
                Manage Bonds
            </h6>
        </div>
        <div class="pull-right">
            <!-- /.modal -->
            <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary txt-light">
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×</button>
                            <h5 class="modal-title font-20">Add Bonds Package</h5>
                        </div>
                        <form data-toggle="validator" action="{{ route('admin.bond-packages.store') }}" method="POST" role="form">
                            @csrf
                        <div class="modal-body">
                            <h2>Bond Info</h2>
                            <hr>
                               <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="package_name" class="control-label mb-10">Bond Name:</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter Package Name: PRIVATE BONDS" id=""  required>
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
                                        <label for="min_percent" class="control-label mb-10">Minimum Percentage:</label>
                                        <input type="decimal" class="form-control" name="min_percent" placeholder="Enter percent: 2.3%" id="" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="max_percent" class="control-label mb-10">Maximum Percentage:</label>
                                        <input type="number" class="form-control" name="max_percent" placeholder="Enter amount: 32.4%" id="" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="duration" class="control-label mb-10">Duration:</label>
                                        <input type="number" class="form-control" name="duration" placeholder="Enter amount: $50" id="" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="compound_duration" class="control-label mb-10">Compounding Duration</label>
                                        <select name="compound_duration" id="" class="form-control">
                                            <option value="">Select Duration</option>
                                            <option value="6">6 Months</option>
                                            <option value="5">5 Months</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="compound_duration" class="control-label mb-10">Compounding Percentage</label>
                                        <input type="number" class="form-control" name="compound_percent" placeholder="Enter amount: 2.4%" id="" required>

                                    </div>
                                </div>
                                <hr>
                                <h2>More Details</h2>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="info1_heading" class="control-label mb-10">Info Heading 1:</label>
                                        <input type="text" class="form-control" name="info_head_1" placeholder="Enter Info1 Heading:" id="" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="info1_details" class="control-label mb-10">Info Details 1:</label>
                                        <input type="text" class="form-control" name="info_detail_1" placeholder="Enter Info1 Details" id="" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="info_head_2" class="control-label mb-10">Info Heading 2:</label>
                                        <input type="text" class="form-control" name="info_head_2" placeholder="Enter Info2 Heading:" id="" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="info_detail_2" class="control-label mb-10">Info Details 2:</label>
                                        <input type="text" class="form-control" name="info_detail_2" placeholder="Enter Info2 Details" id="" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="info_head_3" class="control-label mb-10">Info Heading 3:</label>
                                        <input type="text" class="form-control" name="info_head_3" placeholder="Enter Info3 Heading:" id="" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="info_detail_3" class="control-label mb-10">Info Details 3:</label>
                                        <input type="text" class="form-control" name="info_detail_3" placeholder="Enter Info3 Details" id="" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="info_head_4" class="control-label mb-10">Info Heading 4:</label>
                                        <input type="text" class="form-control" name="info_head_4" placeholder="Enter Info4 Heading:" id="" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="info_detail_4" class="control-label mb-10">Info Details 4:</label>
                                        <input type="text" class="form-control" name="info_detail_4" placeholder="Enter Info4 Details" id="" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="info_head_5" class="control-label mb-10">Info Heading 5:</label>
                                        <input type="text" class="form-control" name="info_head_5" placeholder="Enter Info5 Heading:" id="" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="info_detail_5" class="control-label mb-10">Info Details 5:</label>
                                        <input type="text" class="form-control" name="info_detail_5" placeholder="Enter Info5 Details" id="" required>
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

            <button class="btn btn-primary btn-rounded btn-lable-wrap" data-toggle="modal"
                data-target="#responsive-modal"><span class="btn-text">Add Bond</button>

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
                        </span>
                        <span class="block card-user-desn">
                            <h1><b>$ {{ $pac['min_amt'] }} USD</b></h1>
                        </span>
                    </div>
                </div>
                <div class="pull-right">
                    <a class="pull-left inline-block mr-15 edit_invest_package" data-toggle="modal" 
                data-target="#edit-package-modal"  href="#" 
                name="{{ $pac['name'] }}" 
                min_amt="{{ $pac['min_amt'] }}"
                max_amt="{{ $pac['max_amt'] }}"
                min_percent="{{ $pac['min_percent'] }}"
                max_percent="{{ $pac['max_percent'] }}"
                duration="{{ $pac['duration'] }}"
                compound_duration="{{ $pac['compound_duration'] }}"
                compound_percent="{{ $pac['compound_percent'] }}"
                info_head_1="{{ $pac['info_head_1'] }}"
                info_detail_1="{{ $pac['info_detail_1'] }}"
                info_head_2="{{ $pac['info_head_2'] }}"
                info_detail_2="{{ $pac['info_detail_2'] }}"
                info_head_3="{{ $pac['info_head_3'] }}"
                info_detail_3="{{ $pac['info_detail_3'] }}"
                info_head_4="{{ $pac['info_head_4'] }}"
                info_detail_4="{{ $pac['info_detail_4'] }}"
                info_head_5="{{ $pac['info_head_5'] }}"
                info_detail_5="{{ $pac['info_detail_5'] }}" action="{{ route('admin.bond-packages.update', $pac['id']  ) }}">
                        <i class="zmdi zmdi-edit txt-light"></i>
                    </a>
                    <a class="pull-left inline-block mr-15" onclick="event.preventDefault();
                    document.getElementById('delete_pac_from-{{ $pac['id'] }}').submit()" href="#">
                        <i class="zmdi zmdi-delete txt-light"></i>
                         {{-- DELETE METHOD CALL --}}
                         <form id="delete_pac_from-{{ $pac['id'] }}"
                         action="{{ route('admin.bond-packages.destroy', $pac['id']  ) }}" method="POST" style="display: none">
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
                            <i class="fa fa-percent inline-block mr-10"  aria-hidden="true"></i>
                            <h5 class="inline-block"><b class="txt-muted">Commission:</b> {{ $pac['min_percent'] }}% </h5>
                        </div>
                        <hr class="light-grey-hr mt-20 mb-20"/>
                        <div>
                            <i class="fa fa-calendar inline-block mr-10"  aria-hidden="true"></i>
                            <h5 class="inline-block"><b class="txt-muted">Duration:</b> {{ $pac['duration'] }}-Months</h5>
                        </div>
                        <hr class="light-grey-hr mt-20 mb-20"/>
                        <div>
                            <i class="fa fa-calendar-o inline-block mr-10"  aria-hidden="true"></i>
                            <h5 class="inline-block"><b class="txt-muted">Compounding:</b> {{ $pac['compound_duration'] }}-Months </h5>
                        </div>
                        <hr class="light-grey-hr mt-20 mb-20"/>
                        <div>
                            <i class="fa fa-bar-chart inline-block mr-10"  aria-hidden="true"></i>
                            <h5 class="inline-block"><b class="txt-muted">Compounding Percentage:</b> {{ $pac['compound_percent'] }}5% </h5>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>


 <div id="edit-package-modal" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary txt-light">
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×</button>
                            <h5 class="modal-title font-20">Update Bond Package</h5>
                        </div>
                        <form data-toggle="validator" id="updateInvestPackageForm" action="{{ route('admin.bond-packages.store') }}" method="POST" role="form">
                            @csrf
                            @method('put')
                        <div class="modal-body">
                            <h2>Bond Info</h2>
                            <hr>
                               <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="package_name" class="control-label mb-10">Bond Name:</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter Package Name: PRIVATE BONDS" id="name"  required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="min_amt" class="control-label mb-10">Minimum Investment Amount:</label>
                                        <input type="number" class="form-control" name="min_amt" placeholder="Enter amount: $50" id="min_amt" required>
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label for="max_amount" class="control-label mb-10">Maximum Investment Amount:</label>
                                        <input type="number" class="form-control" name="max_amt" placeholder="Enter amount: $5000" id="max_amt" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="min_percent" class="control-label mb-10">Minimum Percentage:</label>
                                        <input type="decimal" class="form-control" name="min_percent" placeholder="Enter percent: 2.3%" id="min_percent" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="max_percent" class="control-label mb-10">Maximum Percentage:</label>
                                        <input type="number" class="form-control" name="max_percent" placeholder="Enter amount: 32.4%" id="max_percent" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="duration" class="control-label mb-10">Duration:</label>
                                        <input type="number" class="form-control" name="duration" placeholder="Enter amount: $50" id="duration" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="compound_duration" class="control-label mb-10">Compounding Duration</label>
                                        <select name="compound_duration" id="compound_duration" class="form-control">
                                            <option value="">Select Duration</option>
                                            <option value="6">6 Months</option>
                                            <option value="5">5 Months</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="compound_duration" class="control-label mb-10">Compounding Percentage</label>
                                        <input type="number" class="form-control" name="compound_percent" placeholder="Enter amount: 2.4%" id="compound_percent" required>

                                    </div>
                                </div>
                                <hr>
                                <h2>More Details</h2>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="info1_heading" class="control-label mb-10">Info Heading 1:</label>
                                        <input type="text" class="form-control" name="info_head_1" placeholder="Enter Info1 Heading:" id="info_head_1" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="info1_details" class="control-label mb-10">Info Details 1:</label>
                                        <input type="text" class="form-control" name="info_detail_1" placeholder="Enter Info1 Details" id="info_detail_1" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="info_head_2" class="control-label mb-10">Info Heading 2:</label>
                                        <input type="text" class="form-control" name="info_head_2" placeholder="Enter Info2 Heading:" id="info_head_2" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="info_detail_2" class="control-label mb-10">Info Details 2:</label>
                                        <input type="text" class="form-control" name="info_detail_2" placeholder="Enter Info2 Details" id="info_detail_2" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="info_head_3" class="control-label mb-10">Info Heading 3:</label>
                                        <input type="text" class="form-control" name="info_head_3" placeholder="Enter Info3 Heading:" id="info_head_3" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="info_detail_3" class="control-label mb-10">Info Details 3:</label>
                                        <input type="text" class="form-control" name="info_detail_3" placeholder="Enter Info3 Details" id="info_detail_3" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="info_head_4" class="control-label mb-10">Info Heading 4:</label>
                                        <input type="text" class="form-control" name="info_head_4" placeholder="Enter Info4 Heading:" id="info_head_4" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="info_detail_4" class="control-label mb-10">Info Details 4:</label>
                                        <input type="text" class="form-control" name="info_detail_4" placeholder="Enter Info4 Details" id="info_detail_4" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="info_head_5" class="control-label mb-10">Info Heading 5:</label>
                                        <input type="text" class="form-control" name="info_head_5" placeholder="Enter Info5 Heading:" id="info_head_5" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="info_detail_5" class="control-label mb-10">Info Details 5:</label>
                                        <input type="text" class="form-control" name="info_detail_5" placeholder="Enter Info5 Details" id="info_detail_5" required>
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
@endsection


@extends('templates.admin')

@section('content')
<link href="{{ asset('admin-assets/vendors/bower_components/dropify/dist/css/dropify.min.css') }}" rel="stylesheet" type="text/css"/>
<hr class="light-grey-hr mt-20 mb-20"/>
<div class="row">
    <div class="col-md-12">
        <div class="pull-left">
            <h6 class="panel-title txt-dark">
                Manage Traders
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
                            <h5 class="modal-title font-20">Add Trader</h5>
                        </div>
                        <form data-toggle="validator" action="{{ route('admin.traders.store') }}" role="form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <h2>Trader Info</h2>
                            <hr>
                               <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="trader_name" class="control-label mb-10">Name:</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter Trader Name: Mike James"   required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="position" class="control-label mb-10">Position:</label>
                                        <input type="text" class="form-control" name="position" placeholder="Enter Trader Position: Manager"  required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="phone" class="control-label mb-10">WhatsApp Phone Number:</label>
                                        <input type="number" class="form-control" name="phone" placeholder="Enter WhatsApp Contact"  required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="link" class="control-label mb-10">Email Address:</label>
                                        <input type="email" class="form-control" name="mail" placeholder="Enter Email Address"  required>
                                    </div>
                                   


                                    <div class="form-group col-md-6">
                                        <label for="descp" class="control-label mb-10">Short Description:</label>
                                        <input type="text" class="form-control" name="descp" placeholder="Enter Trader Description"  required>
                                    </div>
                                     <div class="form-group col-md-6">
                                        <label for="link" class="control-label mb-10">Profile Link:</label>
                                        <input type="text" class="form-control" name="link" placeholder="Enter Profile Link"  required>
                                    </div>

                                  

                                    <div class="form-group">
                                        <div class="panel-wrapper collapse in">
                                            <div class="panel-body">
                                                <label for="address" class="control-label mb-10 text-dark">Attach Trader Profile Image Here.</label>
                                                
                                                <div class="mt-10">
                                                    <input type="file" id="input-file-now" name="image" class="dropify"  />
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-rounded">Add Trader</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

            <button class="btn btn-primary btn-rounded btn-lable-wrap" data-toggle="modal"
                data-target="#responsive-modal"><span class="btn-text">Add Trader</button>

        </div>
        <div class="clearfix"></div>
    </div>
</div>
<br>

<div class="row">
    @foreach ($traders as $trs)
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-primary contact-card card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <div class="pull-left user-img-wrap mr-15">
                        <img class="card-user-img img-circle pull-left" src="{{ asset('uploads/'.$trs['image'] ) }}" style="object-fit:cover;" alt="user"/>
                    </div>
                    <div class="pull-left user-detail-wrap">
                        <span class="block card-user-name">
                            <h4>{{ $trs['name'] }}</h4>
                        </span>
                        <span class="block card-user-desn">
                            <h5>{{ $trs['position'] }}</h5>
                        </span>
                    </div>
                </div>
                <div class="pull-right">
										<a class="pull-left inline-block mr-15 edit_trader_btn"
                                         data-toggle="modal" data-target="#update-trader-modal" 
                                        name="{{ $trs['name'] }}"
                                        position="{{ $trs['position'] }}"
                                        phone="{{ $trs['phone'] }}"
                                        mail="{{ $trs['mail'] }}"
                                        descp="{{ $trs['descp'] }}"
                                        link="{{ $trs['link'] }}"
                                        action="{{ route('admin.traders.update', $trs['id']  ) }}"
                                        
                                        image ="{{ asset('uploads/'.$trs['image'] ) }}" href="#">
											<i class="zmdi zmdi-edit txt-light"></i>
										</a>

										<a class="pull-left inline-block mr-15" onclick="event.preventDefault();
                                        document.getElementById('delete_trader_from-{{ $trs['id'] }}').submit()" href="#">
											<i class="zmdi zmdi-delete txt-light"></i>
                                            {{-- DELETE METHOD CALL --}}
                         <form id="delete_trader_from-{{ $trs['id'] }}"
                         action="{{ route('admin.traders.destroy', $trs['id']  ) }}" method="POST" style="display: none">
                         @csrf
                         @method('delete')   </form>
										</a>
										
									</div>

                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body row">
                    <div class="user-others-details pl-15 pr-15">
                        <div class="mb-15">
                            <i class="zmdi zmdi-email-open inline-block mr-10"></i>
                            <span class="inline-block txt-dark">{{ $trs['mail'] }}</span>
                        </div>
                        <hr class="light-grey-hr mt-20 mb-20"/>
                        <div>
                           <p><b>Info:</b>{{ $trs['descp'] }} </p>
                        </div>
                        <hr class="light-grey-hr mt-20 mb-20"/>
                    </div>

                    <div class="emp-detail pl-15 pr-15">
                       <a href="{{ $trs['link'] }}" target="blank"> <button class="btn btn-primary  btn-block btn-anim"><i class="fa fa-eye"></i><span class="btn-text">View Profile</span></button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>



<div id="update-trader-modal" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary txt-light">
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×</button>
                            <h5 class="modal-title font-20">Update Trader</h5>
                        </div>
                        <form data-toggle="validator" id="update_trader_form" action="{{ route('admin.traders.store') }}" role="form" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <h2>Trader Info</h2>
                            <hr>
                               <div class="row">
                                 <div class="form-group col-md-12 text-center">
                                       <img src="" class="img-circle" id="trader_image" style="width:100%; height:100px; object-fit:contain;"/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="trader_name" class="control-label mb-10">Name:</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter Trader Name: Mike James" id="name"  required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="position" class="control-label mb-10">Position:</label>
                                        <input type="text" class="form-control" name="position" placeholder="Enter Trader Position: Manager" id="position" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="phone" class="control-label mb-10">WhatsApp Phone Number:</label>
                                        <input type="number" class="form-control" name="phone" placeholder="Enter WhatsApp Contact" id="phone" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="link" class="control-label mb-10">Email Address:</label>
                                        <input type="email" class="form-control" name="mail" placeholder="Enter Email Address" id="mail" required>
                                    </div>
                                   


                                    <div class="form-group col-md-6">
                                        <label for="descp" class="control-label mb-10">Short Description:</label>
                                        <input type="text" class="form-control" name="descp" placeholder="Enter Trader Description" id="descp" required>
                                    </div>
                                     <div class="form-group col-md-6">
                                        <label for="link" class="control-label mb-10">Profile Link:</label>
                                        <input type="text" class="form-control" name="link" placeholder="Enter Profile Link" id="link" required>
                                    </div>

                                   

                                    <div class="form-group">
                                        <div class="panel-wrapper collapse in">
                                            <div class="panel-body">
                                                <label for="address" class="control-label mb-10 text-dark">Update Trader Profile Image Here.</label>
                                                
                                                <div class="mt-10">
                                                    <input type="file" id="input-file-now" name="image"  class="dropify"  />
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-rounded">Update Trader</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
@endsection

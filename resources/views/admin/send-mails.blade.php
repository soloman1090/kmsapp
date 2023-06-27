
@extends('templates.admin')

@section('content')
<link href="{{ asset('admin-assets/vendors/bower_components/dropify/dist/css/dropify.min.css') }}" rel="stylesheet" type="text/css"/>

<aside class="col-lg-12 col-md-12 pl-0">
    <div class="panel panel-refresh pa-0">
         <!-- Modal -->
         <div aria-hidden="true" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                        <h4 class="modal-title">Compose</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" data-toggle="validator" class="form-horizontal" method="POST" action="{{ route('admin.sendmail.store') }}"  enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <label class="control-label">Mail To</label>
                                            <select name="user_id[]" id="userSelect" class="form-control" required multiple>
                                                <option value="all">Every User (All)</option>
                                                @foreach ($users as $user)
                                                <option value="{{ $user->user_id }}">{{ $user->email }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <label class="control-label">Title</label>
                                            <input type="text" placeholder="Enter title, e.g Dear Partner" name="title"  class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <label class="control-label">Subject</label>
                                            <input type="text" placeholder="Enter Subject, e.g Welcome to Dell Group" name="subject"  class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <label class="control-label">End Text</label>
                                            <input type="text" placeholder="Buttom Text, e.g Merry Christmas" name="end_text"  class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Text 1</label>
                                <div class="col-lg-10">
                                    <textarea class="textarea_editor form-control" name="descp" rows="2" required placeholder="Enter text for line 1 ..."></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Text 2</label>
                                <div class="col-lg-10">
                                    <textarea class="textarea_editor form-control" name="descp2" rows="2"  placeholder="Enter text for line 2..."></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Text 3</label>
                                <div class="col-lg-10">
                                    <textarea class="textarea_editor form-control" name="descp3" rows="2"  placeholder="Enter text for line 3..."></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <label class="control-label">Button Text</label>
                                            <input type="text" placeholder="Button text e.g Client Access"  name="action_text"  class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <label class="control-label">Button Url</label>
                                            <input type="text" placeholder="Button Url e.g https://Dell Group.com/"  name="action_url"  class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="panel-wrapper collapse in">
                                            <div class="panel-body">
                                                <label class="control-label">Attach main image</label>
                                                <div class="mt-10">
                                                    <input type="file" id="input-file-now" name="img" class="dropify"  />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="panel-wrapper collapse in">
                                            <div class="panel-body">
                                                <label class="control-label">Attach Event image</label>
                                                <div class="mt-10">
                                                    <input type="file" id="input-file-now2" name="img_event" class="dropify" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-success" type="submit">Send Email</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

         <!-- Modal -->
         <div aria-hidden="true" role="dialog" tabindex="-1" id="myModal2" class="modal fade" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                        <h4 class="modal-title">Compose</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" data-toggle="validator" class="form-horizontal" method="POST" action="{{ route('admin.sendmail.store') }}"  enctype="multipart/form-data">
                            @csrf
                              
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <label class="control-label">Subject</label>
                                            <input type="hidden" name="bulk" id="" value="bulk">
                                            <input type="text" placeholder="Enter Subject, e.g Welcome to Dell Group" name="subject"  class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                
                            </div> 
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-success" type="submit">Send Email</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


            <div class="refresh-container">
                <div class="la-anim-1"></div>
            </div>
            <div class="panel-heading pt-20 pb-20 pl-15 pr-15">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">All Sent Emails including status</h6>
                    <button class="btn btn-success" href="#myModal2" data-toggle="modal">Send Bulk Mail</button>
                </div>
                <div class="pull-right">
                    <a href="#myModal" data-toggle="modal"  title="Compose"    class="btn btn-success btn-block">  Compose  </a>
                </div>

                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body inbox-body pa-0">

                    <div class="table-responsive mb-0">
                        <table id="datable_1"  class="table table-inbox display table-hover mb-0">
                            <thead class="data-table-head">
                                <tr class="data-table-head">
                                    <th class="hd">Title</th>
                                    <th class="hd">User</th>
                                    <th class="hd">User Email</th>
                                    <th class="hd">Subject</th>
                                    <th class="hd">Main Image</th>
                                    <th class="hd">Event Image</th>
                                    <th class="hd">Delivered</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($allMails as $key=> $aMail)
                                <tr >
                                    <td >{{ $aMail->title }}</td>
                                    <td >{{ $aMail->name }}</td>
                                    <td >{{ $aMail->uesrEmail }}</td>
                                    <td >{{ $aMail->subject }}</td>
                                    <td ><img src="{{ $aMail->img }}" width="30" alt=""></td>
                                    <td ><img src="{{ $aMail->img_event }}" width="30" alt=""></td>
                                    @if ($aMail->sent_status==="pending")
                                    <td > <span class="label label-warning">Pending</span></td>
                                    @else
                                    <td > <span class="label label-success">Delivered</span></td>
                                    @endif
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</aside>

<script src="{{ asset('user-assets/js/jquery.min.js') }}"></script>
<script>
    $("#userSelect").on("change", function(){
        if($(this).val()=="all"){
            $(this).attr("name", "user_id")
        }else{
            $(this).attr("name", "user_id[]")
        }
    })
</script>

@endsection

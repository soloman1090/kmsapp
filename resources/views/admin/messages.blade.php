
@extends('templates.admin')

@section('content')
<style>
    .unread{padding: 20px}
</style>
<div class="row">
    <aside class="col-lg-3 col-md-4 pr-0">
        <div class="mt-20 mb-20 ml-15 mr-15">

            <!-- Modal -->
            <div aria-hidden="true" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                            <h4 class="modal-title">Compose</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form" class="form-horizontal" method="POST" action="{{ route('admin.messsages.store') }}">
                                @csrf
                                {{-- <div class="form-group">
                                    <label class="col-lg-2 control-label">To</label>
                                    <div class="col-lg-10">
                                        <select name="user_id" id="" class="form-control">
                                            <option value="0">Every User</option>
                                            @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                <input type="hidden" name="user_id" value="0">
                                <input type="hidden" name="category" value="From Admin">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Title</label>
                                    <div class="col-lg-10">
                                        <input type="text" placeholder="" name="title"  class="form-control">
                                    </div>
                                </div>
                                {{-- <div class="form-group">
                                    <label class="col-lg-2 control-label">Subject</label>
                                    <div class="col-lg-10">
                                        <select name="category" id="" class="form-control">
                                            <option value="KyC Updating">KyC Updating</option>
                                            <option value="Profile Completion">Profile Completion</option>
                                            <option value="Enable 2FA Authentication">Enable 2FA Authentication</option>
                                            <option value="Create A Protfolio">Create A Protfolio</option>
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Message</label>
                                    <div class="col-lg-10">
                                        <textarea class="textarea_editor form-control" name="descp" rows="15" placeholder="Enter text ..."></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-success" type="submit">Send</button>
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
        </div>



    </aside>

    <aside class="col-lg-11 col-md-11 pl-0">
        <div class="panel panel-refresh pa-0">
            <div class="refresh-container">
                <div class="la-anim-1"></div>
            </div>
            <div class="panel-heading pt-20 pb-20 pl-15 pr-15">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">inbox</h6>
                </div>
                <div class="pull-right">
                    <a href="#myModal" data-toggle="modal"  title="Compose"    class="btn btn-success btn-block">
                        Compose
                        </a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body inbox-body pa-0">

                    <div class="table-responsive mb-0">
                        <table id="datable_1"  class="table table-inbox display table-hover mb-0">
                            <thead class="data-table-head">
                                <tr class="data-table-head">
                                    <th class="hd">Name</th>
                                    <th class="hd">Title</th>
                                    <th class="hd">Category</th>
                                    <th class="hd">Descp</th>
                                    <th class="hd">Date</th>
                                    <th class="hd">Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($messages as $mess)
                                <tr class="unread p-4">
                                    @if ($mess->owner==0)
                                    <td class="view-message">Every One</td>
                                    @else
                                    <td class="view-message">{{ $mess->owner }}</td>
                                    @endif
                                    <td class="view-message">{{ $mess->title }}</td>
                                    <td class="view-message"><span class="label label-warning">{{ $mess->category }}</span></td>
                                    <td class="view-message">{{ $mess->descp }}</td>
                                    <td class="view-message">{{ $mess->date }}</td>
                                    <td><a href="" ><i class="fa fa-eye mr-15"></i> </a> | <i class="fa fa-trash ml-15"
                                        onclick="event.preventDefault();
                                            document.getElementById('delete_user_from-{{ $mess->id }}').submit()"></i>
                                </td>
                                <form id="delete_user_from-{{ $mess->id }}"
                                    action="{{ route('admin.messsages.destroy',  $mess->id) }}"
                                    method="POST" style="display: none">
                                    @csrf
                                    @method('delete')
                                </form></td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </aside>
</div>
@endsection

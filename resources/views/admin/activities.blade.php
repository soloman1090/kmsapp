@extends('templates.admin')

@section('content')
    <style>
        .unread {
            padding: 20px;
        }
    </style>
    <div class="row">
        <aside class="col-lg-12 col-md-12 p-2">
            <div class="panel panel-refresh pa-0">
                <div class="refresh-container">
                    <div class="la-anim-1"></div>
                </div>
                <div class="panel-heading pt-20 pb-20 pl-15 pr-15">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Activites</h6>
                    </div>
                    <div class="pull-right">
                        @if ($single == 'true')
                            <a href="#myModal" data-toggle="modal" title="Compose" class="btn btn-success btn-block">
                                Create Activities
                            </a>
                        @endif

                        <label for="">Full Search </label>
                    <form action="{{ route('admin.activities.index') }}" method="get">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" name="search" placeholder="title, status, date" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-success" type="submit">Search</button>
                            </div>
                        </div>
                    </form>


                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body inbox-body pa-0">

                        <div class="table-responsive mb-0">
                            <table id="datable_1" class="table table-inbox display table-hover mb-0">
                                <thead class="data-table-head">
                                    <tr class="data-table-head">
                                        <th class="hd">S/N</th>
                                        <th class="hd">Name</th>
                                        <th class="hd">Title</th>
                                        <th class="hd">Description</th>
                                        <th class="hd">Amount</th>
                                        <th class="hd">Date</th>
                                        <th class="hd">Actions</th>
                                        <th class="hd">Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($activities as $key => $active)
                                        <tr class="unread p-4">
                                            <td class="view-message">{{ $key }}</td>
                                            <td class="view-message"><a href="activities?user_id={{ $active->user_id }}">{{ $active->name }}</a> </td>
                                            <td class="view-message">{{ $active->title }}</td>
                                            <td class="view-message">{{ $active->descp }}</td>
                                            <td class="view-message">${{ $active->amount }}</td>
                                            <td class="view-message">{{ $active->date }}</td>
                                            <td class="view-message">
                                                <div class="dropdown show-on-hover">
                                                    <button type="button" class="btn btn-success dropdown-toggle"
                                                        data-toggle="dropdown">
                                                        Action <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="#" data-toggle="modal"
                                                                data-target="#delete-active-modal{{ $active->id }}">Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>

                                            @if ($active->category == 'earning' || $active->category == 'bonus')
                                                <td class="view-message"><span
                                                        class="label label-success">{{ $active->category }}</span></td>
                                            @elseif ($active->category == 'withdrawals')
                                                {{-- <td > <span class="bg-danger p-1 font-10 text-white">WITHDRAWAL</span></td> --}}
                                                <td class="view-message"><span
                                                        class="label label-danger">{{ $active->category }}</span></td>
                                            @elseif ($active->category == 'deposit')
                                                {{-- <td > <span class="bg-primary p-1 font-10 text-white">DEPOSIT</span></td> --}}
                                                <td class="view-message"><span
                                                        class="label label-primary">{{ $active->category }}</span></td>
                                            @elseif ($active->category == 'expired')
                                                {{-- <td > <span class="bg-primary p-1 font-10 text-white">DEPOSIT</span></td> --}}
                                                <td class="view-message"><span
                                                        class="label label-danger">{{ $active->category }}</span></td>
                                            @elseif ($active->category == 'error')
                                                {{-- <td > <span class="bg-primary p-1 font-10 text-white">DEPOSIT</span></td> --}}
                                                <td class="view-message"><span
                                                        class="label label-danger">{{ $active->category }}</span></td>
                                            @elseif ($active->category == 'cancelled')
                                                {{-- <td > <span class="bg-primary p-1 font-10 text-white">DEPOSIT</span></td> --}}
                                                <td class="view-message"><span
                                                        class="label label-danger">{{ $active->category }}</span></td>
                                            @endif
                                        </tr>

                                        <div id="delete-active-modal{{ $active->id }}" class="modal fade"
                                            tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                            style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning txt-light"
                                                        style="background-color: #EE826D">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">×</button>
                                                        <h5 class="modal-title font-20">Delete Activity?</h5>
                                                    </div>
                                                    <form id=""
                                                        action="{{ route('admin.activities.destroy', $active->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <div class="modal-body">
                                                           <input type="hidden" value="{{ $active->user_id }}" name="user_id"/>
                                                            <h4>Are you sure you want to delete this record from this
                                                                account?</h4>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default btn-rounded"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger btn-rounded">Delete
                                                                Activity
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="container">
                                <div class="row">
                                    <div class="col-3"><h5><b>PAGE VIEWS</b></h5></div>
                                    <div class="col"><h5> <span> {{ $activities->links()}}</span></h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>



    <!-- Modal -->
    <div aria-hidden="true" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title">Create Activity</h4>
                </div>
                <div class="modal-body">
                    <form role="form" class="form-horizontal" method="POST"
                        action="{{ route('admin.activities.store') }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user_id }}">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Title</label>
                            <div class="col-lg-4">
                                <select name="title" id="title" class="form-control">
                                    <option value="">Select Title</option>
                                    <option value="Daily Earning">Daily Earning</option>
                                    <option value="Referral Bonus">Referral Bonus</option>

                                </select>
                            </div>
                            <label class="col-lg-2 control-label">Bulk Type</label>
                            <div class="col-lg-4">
                                <select name="send_type" id="send_type" class="form-control">
                                    <option value="">Select Type</option>
                                    <option value="single">Single Activity</option>
                                    <option value="multiple">Multiple Activity</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Category</label>
                            <div class="col-lg-10">
                                <select name="category" id="category" class="form-control">
                                    <option value="">Select Category</option>
                                    <option value="earning">Earning</option>
                                    <option value="deposit">Deposit</option>
                                    <option value="bonus">Bonus</option>
                                    <option value="withdrawal">Withdrawal</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group investGroup">
                            <label class="col-lg-2 control-label">Investment</label>
                            <div class="col-lg-10">
                                <select name="user_investments_id" id="selectInvest" class="form-control">
                                    <option value="">Select Investment</option>
                                    @foreach ($userInvestments as $key => $invests)
                                        <option value="{{ $invests->id }}">Investment-{{ $invests->amount }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="form-group percentGroup">
                            <label class="col-lg-2 control-label">Percentage</label>
                            <div class="col-lg-10">
                                <input type="number" placeholder="" name="percentage" id="percentage"
                                    class="form-control">
                            </div>
                        </div>
                        @foreach ($userInvestments as $key => $invests)
                            <input type="number" hidden id="invest{{ $invests->id }}"
                                value="{{ $invests->returns }}" investName="{{ $invests->packagename }}" />
                        @endforeach

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Amount</label>
                            <div class="col-lg-10">
                                <input type="text" placeholder="" name="amount" id="amount" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Start Date</label>
                                    <div class="col-lg-8">
                                        <input type="date" placeholder="" name="start_date" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-lg-4 control-label">End Date</label>
                                    <div class="col-lg-8">
                                        <input type="date" placeholder="" name="end_date" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-lg-2 control-label">Description</label>
                            <div class="col-lg-10">
                                <textarea class="textarea_editor form-control" name="descp" id="descp" rows="5"
                                    placeholder="Enter activty description ..."></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-success" type="submit">Create Activity</button>
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

    <script src="{{ asset('user-assets/js/jquery.min.js') }}"></script>
    <script>
        $(".investGroup").show()
        $(".percentGroup").hide()

        $("#selectInvest").on('change', function() {


            let inputName = `invest${$(this).val()}`
            $("#amount").val($(`#${inputName}`).val())

            let category = $("#category").val()
            let descp
            if (category == "earning") {
                $(".investGroup").show()
        $(".percentGroup").hide()
                descp = `Credited $${$(`#${inputName}`).val()} interest of ${$(`#${inputName}`).attr('investName')}`
            }  else if (category == "") {
                alert("Please select a category")
            }

            $("#descp").val(descp)

        })

        $("#category").on('change', function() {
            createPrcentage()
        })

        $("#percentage").on('change', function() {
            createPrcentage()
        })

        function createPrcentage() {
            let category = $("#category").val()
            let descp
            if (category == "bonus") {

                $(".investGroup").hide()
                $(".percentGroup").show()

                descp = `Credited ${$("#percentage").val()}% - ${$("#amount").val()} as referral bonus`
            } else if (category == "") {
                alert("Please select a category")
            }

            $("#descp").val(descp)
        }
    </script>
@endsection

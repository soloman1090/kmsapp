@extends('templates.main-user')

@section('content')



<div class="card">
    <img src="{{ asset('user-assets/images/widgets/investment_history.jpg') }}" alt="" style="width: 100%; border-top-left-radius: 10px;
    border-top-right-radius: 10px;" >
        <br><br>
    <div class="card-header">
    </div>
    <!--end card-header-->
    <div class="card-body ">
        @if(count($investments)==0)
        <div class="text-center">
            <img src="{{asset('user-assets/images/portfolios/profit.jpg')}}" width="400" />
            <h3 class="text-center">No Completed Investments Yet</h3>
            <br>
            <a href="user-investments" class="btn btn-primary btn-outline-dashed ">View Investments</a>
        </div>
        @else
        @foreach ($investments as $invest)
        <div class="row mb-3">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="accordion-item">
                    <div class="card-body ">
                        <div class="text-center">
                            <div class="row">
                                <div class="col">
                                    <h1 class="m-0 fw-semibold text-dark font-24 mt-3">
                                        {{ $invest->packagename}}</h1>
                                    <a href="#" class="text-muted  mb-0 font-13"> <span class="text-dark">Status : </span> <span class="badge badge-outline-danger">Investment-{{ $invest->status }}</span></a>

                                </div>
                                <div class="col-auto">
                                    <div class="c100 p0 small">
                                        <span>{{ -$invest->daysLeft??'' }}</span>
                                        <div class="slice">
                                            <div class="bar"></div>
                                            <div class="fill"></div>
                                        </div>
                                    </div>
                                    <h5 class="mb-0 text-muted">Days Left</h5>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4 d-flex align-items-center">
                            <div class="col">
                                <h5 class="font-22 m-0 fw-bold">${{ $invest->amount}}</h5>
                                <p class="mb-0 text-muted">Amount Invested</p>
                            </div>
                            <div class="col">
                                <h5 class="font-20 m-0 fw-bold">(ROI) ${{ $invest->returns }}</h5>
                                <p class="mb-0 text-muted">Weekly Returns</p>
                            </div>
                            <div class="col">
                                <h5 class="font-20 m-0 fw-bold">{{ $invest->payout }}</h5>
                                <p class="mb-0 text-muted">Payout</p>
                            </div>
                            <div class="col">
                                <h5 class="font-18 m-0 fw-bold">{{ $invest->duration }} Months</h5>
                                <p class="mb-0 text-muted">Duration</p>
                            </div>
                            <div class="col">
                                <h5 class="font-13 m-0 fw-bold">{{ $invest->date }} &nbsp to &nbsp {{ $invest->end_date }}</h5>
                                <p class="mb-0 text-muted">Investment Date</p>
                            </div>
                        </div>
                        <hr class="hr-dashed hr-menu">
                        <div class="row mt-4 d-flex align-items-center">
                            <div class="col-3">
                                <a href="#" class="accordion-button collapsed shadow-none  px-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo{{ $invest->investment_id }}" aria-expanded="true" aria-controls="collapseTwo{{ $invest->investment_id }}">More Details</a>
                            </div>

                            @if ($invest->status=="dormant" || $invest->status=="cancelled"|| $invest->status=="pending")

                            @else
                            {{-- <div class="col-3">
                                <a href="#" class="btn btn-sm btn-primary  px-4" data-bs-toggle="modal" data-bs-target="#withdrawModal{{ $invest->investment_id }}">Withdraw Capital</a>
                            </div> --}}
                            <div class="col-3">
                                <a href="#" class="btn btn-sm btn-secondary  px-4" >Withdraw Capital</a>
                            </div>

                            <div class="col-3">
                                <a href="#" class="btn btn-sm btn-primary  px-4" data-bs-toggle="modal" data-bs-target="#investModal{{ $invest->investment_id }}">Re-Initiate Investment</a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <!--end card-body-->

                    <div id="collapseTwo{{ $invest->investment_id }}" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample-faq">
                        <div class="card m-3">
                            <div class="accordion-body">
                                <div class="card-body ">
                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="bg-dark text-white">
                                            <tr>
                                                <th class="text-white">Action</th>
                                                <th class="text-white">Date</th>
                                                <th class="text-white">Amount</th>
                                                <th class="text-white">Status </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($activities as $act)
                                            @if($invest->investment_id==$act->user_investments_id)
                                            <tr>
                                                <td>{{ $act->title }}</td>
                                                <td>{{ $act->date}}</td>
                                                <td>${{ $act->amount }}</td>
                                                @if ($act->category=="earning" || $act->category=="bonus")
                                                <td> <span class="bg-success p-1 font-10 text-white">CREDITED</span></td>
                                                @elseif ($act->category=="withdrawals")
                                                <td> <span class="bg-danger p-1 font-10 text-white">WITHDRAWAL</span></td>
                                                @elseif ($act->category=="deposit")
                                                <td> <span class="bg-primary p-1 font-10 text-white">DEPOSIT</span></td>
                                                @elseif ($act->category=="expired")
                                                <td> <span class="bg-danger p-1 font-10 text-white">EXPIRED</span></td>
                                                @elseif ($act->category=="error")
                                                <td> <span class="bg-danger p-1 font-10 text-white">ERROR</span></td>
                                                @elseif ($act->category=="cancelled")
                                                <td> <span class="bg-danger p-1 font-10 text-white">CANCELLED</span></td>
                                                @endif
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end card-->
                </div>
                <!--accordion end-->
            </div>
            <div class="col-md-1"></div>
        </div>


        <div class="modal fade" id="withdrawModal{{ $invest->investment_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title m-0" id="exampleModalDefaultLabel">Withdrawal Capital?
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!--end modal-header-->
                    <div class="modal-body">
                        <form action="{{ route('user.investment-history.update', $invest->investment_id ) }}" method="post" class="form-parsley">
                            @csrf
                            @method('put')
                            <input type="hidden" name="type" value="withdraw">
                            <h4>Are you sure you want to withdraw the capital for this investment.</h4>
                    </div>

                    <!--end modal-body-->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Withdraw Capital</button>
                        <button type="button" class="btn btn-soft-secondary " data-bs-dismiss="modal">Close</button>
                    </div>
                    <!--end modal-footer-->
                    </form>
                </div>
                <!--end modal-content-->
            </div>
            <!--end modal-dialog-->
        </div>
        <!--end modal-->

        <div class="modal fade" id="investModal{{ $invest->investment_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title m-0" id="exampleModalDefaultLabel">Re-Start investment?
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!--end modal-header-->
                    <div class="modal-body">
                        <form action="{{ route('user.investment-history.update', $invest->investment_id ) }}" method="post" class="form-parsley">
                            @csrf
                            @method('put')
                            <input type="hidden" name="type" value="reinvest">
                            <h4>Are you sure you want to <b>Re-Start</b> this investment.?</h4>
                    </div>

                    <!--end modal-body-->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Start</button>
                        <button type="button" class="btn btn-soft-secondary " data-bs-dismiss="modal">Close</button>
                    </div>
                    <!--end modal-footer-->
                    </form>
                </div>
                <!--end modal-content-->
            </div>
            <!--end modal-dialog-->
        </div>
        @endforeach

        @endif




    </div>
    <!--end card-body-->
</div>
<!--end card-->

@endsection

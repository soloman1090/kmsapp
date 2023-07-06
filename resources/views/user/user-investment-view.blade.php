@extends('templates.main-user')
@section('content')
<div class="card">
    <img src="{{ asset('user-assets/images/widgets/active_investment.jpg') }}" alt="" style="width: 100%;border-top-left-radius: 5px;
        border-top-right-radius: 5px;">
    <br><br>
    <div class="card-header">
        <h4 class="card-title">My Investments</h4>

    </div>

<div class="container">
    <div class="Investment margin60">
        <div class="row">
            <div class="col-md-5 ">
                <div class="moon">
                    <h1>Moonfare</h1>
                </div>
            </div>
            <div class="col-md-3">
                <div class="set1">
                    <div class="card mb-3 p-3">
                        <p>Investment Amount</p>
                        <h1>23,903</h1>
                    </div>
                    <div class="card mb-3 p-3">
                        <p>Total Accumulated </p>
                        <h1>32,432</h1>
                    </div>
                    <div class="card mb-3 p-3">
                        <p>Portfolio Wallet </p>
                        <h1> 3,223</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="set1">
                    <div class="card mb-3 p-3">
                        <p>Compound Wallet </p>
                        <h1>3434</h1>
                    </div>
                    <div class="card mb-3 p-3">
                        <p>Total Withdrawn  </p>
                        <h1>32,432</h1>
                    </div>
                    <div class=" mb-3 ">
                        <button class="btn btn-brand-02 w-100  mb-1">
                            Make Withdrawal
                        </button>
                        {{-- <div class="col-3">
                                <a href="#" class="accordion-button collapsed shadow-none  px-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo{{ $invest->investment_id }}" aria-expanded="false" aria-controls="collapseTwo{{ $invest->investment_id }}">More Details</a>
                            </div> --}}
                        <button class="btn btn-brand-02 w-100  mb-1">
                            View more details
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="set2">
            <span class="">Broad</span>
            <div class="mb-4"></div>
            <p>A growth portfolio providing access to selected top-tier growth equity and VC funds</p>
        </div>
        {{-- <div id="collapseTwo{{ $invest->investment_id }}" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample-faq">
            <div class="card m-3">
                <div class="accordion-body">
                    <div class="card-body ">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th class="text-white">S/N</th>
                                    <th class="text-white">Action</th>
                                    <th class="text-white">Date</th>
                                    <th class="text-white">Amount</th>
                                    <th class="text-white">Status </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activities as $key =>$act)
                                @if ($invest->investment_id == $act->user_investments_id)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>{{ $act->title }}</td>
                                    <td>{{ $act->date }}</td>
                                    <td>${{ $act->amount }}</td>
                                    @if ($act->category == 'earning' || $act->category == 'bonus')
                                    <td> <span class="bg-success p-1 font-10 text-white">CREDITED</span>
                                    </td>
                                    @elseif ($act->category == 'withdrawals')
                                    <td> <span class="bg-danger p-1 font-10 text-white">WITHDRAWAL</span>
                                    </td>

                                    @elseif ($act->category == 'deposit')
                                    <td> <span class="bg-primary p-1 font-10 text-white">DEPOSIT</span>
                                    </td>
                                    @elseif ($act->category == 'expired')
                                    <td> <span class="bg-danger p-1 font-10 text-white">EXPIRED</span>
                                    </td>
                                    @elseif ($act->category == 'error')
                                    <td> <span class="bg-danger p-1 font-10 text-white">ERROR</span>
                                    </td>
                                    @elseif ($act->category == 'cancelled')
                                    <td> <span class="bg-danger p-1 font-10 text-white">CANCELLED</span>
                                    </td>
                                    @endif
                                </tr>
                                @endif
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-md-8">
            <div class="card p-3">
                <div class="set3">
                    <ul>
                        <li class="up">
                            <p ><span class="greendot me-2"></span> IN FINAL CLOSE</p>
                            <p> <span class="blue">INVESTMENT PROCESS</span> </p>
                        </li>
                        <li>
                            <p class="grey">Strategy</p>
                            <p> <span class="blue"> Growth Equity,</span> Portfolio</p>
                        </li>
                        <li>
                            <p class="grey">Geography</p>
                            <p>Global</p>
                        </li>
                        <li>
                            <p class="grey">Fund Lifetime</p>
                            <p> <span class="blue"> >12 years </span></p>
                        </li>
                        <li>
                            <p class="grey">Investment Period</p>
                            <p>Up to 2 years</p>
                        </li>
                        <li>
                            <p class="grey"># of Investments</p>
                            <p>~ 150</p>
                        </li>
                        <li>
                            <p class="grey">Closing date</p>
                            <p>Q4 2022</p>
                        </li>
                        <li>
                            <p class="grey">Min. Investment</p>
                            <p>$60,000</p>
                        </li>
                    </ul>
                    <button class="nobackbtn mb-3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-expand" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13A.5.5 0 0 1 1 8ZM7.646.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 1.707V5.5a.5.5 0 0 1-1 0V1.707L6.354 2.854a.5.5 0 1 1-.708-.708l2-2ZM8 10a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 14.293V10.5A.5.5 0 0 1 8 10Z"/>
                        </svg>Compare Fund
                    </button> <br>
                    <button class="withbackbtn mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                        </svg>
                        Complete Profile
                    </button>
                    <center><p class="fsize10">Please complete your profile to unlock confidential fund information and request an allocation</p></center>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

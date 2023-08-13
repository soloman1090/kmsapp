@extends('templates.main-user')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-30" id="upHeader">
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/user/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/user/make-investment">Purchase Portfolios</a></li>
                <li class="breadcrumb-item active" aria-current="page">View Portfolio</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">{{ $package->name }}</h4>
    </div>
</div>
<div class="Investment">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="Overflow" id="overContent">
                    <div class="row">
                        <div class="col-md-8 ">
                            <div class="moon" style="background-image: url({{ asset("uploads/$package->image") }});">
                                <h1>{{ $package->category_name }}</h1>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="set1">
                                <div class="card mb-3 p-3">
                                    <p>Portfolio Fund Trgets</p>
                                    <h1>~ {{ $package->portfolio_fund_targets }}</h1>
                                </div>
                                <div class="card mb-3 p-3">
                                    <p>Strategy Focus</p>
                                    <h1>{{ $package->strategy_focus }}</h1>
                                </div>
                                <div class="card mb-3 p-3">
                                    <p>Target Size</p>
                                    <h1>${{ $package->target_size }}m</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="set2">
                        <span class="">Broad</span>
                        <div class="mb-4"></div>
                        <p>A growth portfolio providing access to selected top-tier growth equity and VC funds</p>
                    </div>
                  <div class="dymanic-data">
                    <div class="set4 margin50">
                        <h1> {!! $package->info_head_2 !!}</h1>
                        {!! $package->info_detail_2 !!}

                    </div>
                    <div class="set5 margin50">
                        <h1> {!! $package->info_head_3 !!}</h1>
                        {!! $package->info_detail_3 !!}


                    </div>
                    <div class="set6 margin50">
                        <h1> {!! $package->info_head_4 !!}</h1>
                        {!! $package->info_detail_4 !!}
                    </div>

                    <div class="set7 margin50">
                        <h1> {!! $package->info_head_5 !!}</h1>
                        {!! $package->info_detail_5 !!}
                    </div>
                  </div>


                </div>
            </div>
            <div class="col-md-4">
                <div class="">
                    <div class="card p-3">
                        <div class="set3">
                            <ul>
                                <li class="up">
                                    <p><span class="greendot me-2"></span> INVESTMENT NAME</p>
                                    <p> <span class="blue"> {{ $package->name }} </span> </p>
                                </li>
                                <li>
                                    <p class="grey">Strategy</p>
                                    <p> <span class="blue"> {{ $package->strategy_focus }},</span> Portfolio</p>
                                </li>
                                <li>
                                    <p class="grey">Geography</p>
                                    <p>{{ $package->geography }}</p>
                                </li>
                                
                                <li>
                                    <p class="grey">Investment Period</p>
                                    <p>Up to {{ $package->duration }} Month</p>
                                </li>
                                
                                <li>
                                    <p class="grey">Closing date</p>
                                    <p>{{ $package->expire_date }}</p>
                                </li>
                                <li>
                                    <p class="grey">Min. Investment</p>
                                    <p>${{ $package->min_amt }}</p>
                                </li>
                                <li>
                                    <p class="grey">Max. Investment</p>
                                    <p>${{ $package->max_amt }}</p>
                                </li>
                                <li>
                                    <p class="grey">Staking Investment</p>
                                    <p>{{ $package->compound_percent }}%</p>
                                </li>
                                <li>
                                    <p class="grey">Bi Weekly Divided</p>
                                    <p>{{ $package->min_percent }} - {{ $package->max_percent }}%</p>
                                </li>
                            </ul>

                            <a href="{{ route('user.make-investment.edit',$package->id ) }}">
                                <button class="withbackbtn mb-3">
                                    <i class="bi bi-bag text-white"></i>
                                    Purchase Investment
                                </button>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@extends('templates.main-user')

@section('content')

<style>
    .short_img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
    }

</style>
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/user/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Make Investment</li>
            </ol>
        </nav>
    </div>

</div>
<div class="card">
    <img src="{{ asset('user-assets/images/widgets/short-me.jpg') }}" alt="" style="width: 100%; border-top-left-radius: 10px;
border-top-right-radius: 10px;">
</div>

<div class="card">
    <div class="card-header">
        <h1 class="">Investment Portfolios</h1>
    </div><!-- end card header -->
    
    <div class="card-body">
        <hr>
        <h2 class="">Portfolios Available( {{ count($packages) }} )</h2>
        <hr>
        <div>
            @foreach ($packages as $key=> $pack)
            <div class="card">
                <div class="row">
                    <div class="col-3">
                        <img src="{{ asset("uploads/$pack->image") }}" alt="" class="short_img">
                    </div>
                    <div class="col-9">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h1 class="title1   mb-0 font-25">{{ $pack['name'] }} </h1>
                                    <h6>{{ $pack['category_name'] }}</h6>
                                </div>
                                {{-- <div class="col-auto ">
                                    <h4 class=" mb-0 font-18">{{ $pack['slots'] }} </h4>
                                <small>Slots Available</small>
                            </div> --}}
                        </div>
                        <hr>
                        <ul class="list-unstyled pricing-content-2">

                            <li><b class="text-dark">{{ $pack['info_head_1'] }}</b>
                                <p>{{ $pack['info_detail_1'] }}</p>
                            </li>
 
                            <div class="mt-3"> <span class="bg-light p-2" style="border-radius: 5px">{{ $pack['strategy_focus'] }}</span></div>
                            {{-- <li><b class="text-dark">{{ $pack['info_head_4'] }}</b>
                            <p>{{ $pack['info_detail_4'] }}</p>
                            </li>
                            <li><b class="text-dark">{{ $pack['info_head_5'] }}</b>
                                <p>{{ $pack['info_detail_5'] }}</p>
                            </li> --}}

                        </ul>
                        <div class=" row ">
                            <div class="col-md-3 text-center" style="border-right: 1px solid black">
                                <h4 class="amount">$ {{ $pack['formatted_min'] }}<br> <small style="font-size: 14px" class="text-muted">Min Investment</small> </h4>
                            </div>
                            <div class="col-md-3 text-center" style="border-right: 1px solid black">
                                <h4 class="amount ">$ {{ $pack['formatted_max'] }}<br> <small style="font-size: 14px" class="text-muted">Max Investment</small> </h4>
                            </div>
                            <div class="col-md-3 " style="border-right: 1px solid black">
                                <div class="text-center">
                                    <h4 class="amount ">{{ $pack['compound_percent'] }}% <br><small style="font-size: 14px" class="text-muted">Auto Compouding </small> </h4>
                                </div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="text-center">
                                    <h4 class="amount ">{{ $pack['min_percent'] }}% - {{ $pack['max_percent'] }}% <br><small style="font-size: 14px" class="text-muted">Daily dividends</small></h4> </small> </h2>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <a href="{{ route('user.make-investment.show',$pack['id'] ) }}" class="btn btn-primary w-100  btn-outline-dashed py-2 text-white">Get Started With {{ $pack['name'] }}</a>


                        {{-- <form action="{{ route('user.get-payment.index') }}" method="get" class="form-parsley">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="user_id" value="{{ $user_id }}">
                                <input type="hidden" name="investment_packages_id" value="{{ $pack['id'] }}">
                                <input type="hidden" name="returns" id="returns" value="23.4">
                                <input type="hidden" name="payment_method" id="direct_deposit" value="direct_deposit">
                                <input type="hidden" name="payout" id="payout" value="short">
                                <input type="hidden" name="duration" id="duration" value="{{ $pack['duration'] }}">
                                <input type="hidden" name="amount" value="{{ $pack['min_amt'] }}">
                                <input type="hidden" name="currency" value="">

                            </div>
                            <button type="submit" class="btn btn-primary w-100  btn-outline-dashed py-2"><span>Get Started With {{ $pack['name'] }}</span></a>

                        </form> --}}

                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="modal fade" id="portModalDefault{{ $pack['id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="exampleModalDefaultLabel">Purchase A Short Investment
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!--end modal-header-->
                <div class="modal-body">
                    <h3 class="text-center">{{ $pack['name'] }}</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h1 class="text-center text-primary">${{ $pack['formatted_min'] }}</h1>
                            <div class="text-center">
                                <small class="text-center font-16">Minimum Investment</small>
                            </div>

                            <div class="row text-center">
                                <div class="col-md-12">
                                    <h3><b>{{ $pack['compound_percent'] }}%:</b></h3>
                                    <div class="text-center">
                                        <small class="text-center font-16">Auto Compounding Percentage</small>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12">
                                    <h3><b>{{ $pack['duration'] }}-Months:</b></h3>
                                    <div class="text-center">
                                        <small class="text-center font-16">Portfolio Duration</small>
                                    </div>

                                </div>
                            </div>
                        </div>



                        <div class="col-md-6">
                            <h5>Fill form to purchase investment portfolio</h5>
                            <br>

                        </div>
                    </div>
                </div>
                <!--end modal-body-->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-soft-primary btn-sm">Purchase </button>
                    <button type="button" class="btn btn-soft-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
                <!--end modal-footer-->

            </div>
            <!--end modal-content-->
        </div>
        <!--end modal-dialog-->
    </div> --}}
    @endforeach
</div>
</div>
</div>
</div>
</div>

<div class="container">
<div class="closedFunds margin40">
    <h2 class="mb-4" >Closed funds (56)</h2>
    <!-- Flickity HTML init -->
    <div class="carousel" data-flickity='{ "freeScroll": true, "wrapAround": true }'>
        <div class="carousel-cell">
            <div class="set">
                <div class="top">
                    <h3>khosla ventures</h3>
                </div>
                <div class="middle">
                    <span>Access A68 SCSP investing in</span>
                    <h3>Khosla ventures VIII & Opp 2</h3>
                    <p>The funds will pursue investments in deep tech start-ups operating in large and ....</p>
                    <ul class="mb-3">
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe-americas" viewBox="0 0 16 16">
                            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM2.04 4.326c.325 1.329 2.532 2.54 3.717 3.19.48.263.793.434.743.484-.08.08-.162.158-.242.234-.416.396-.787.749-.758 1.266.035.634.618.824 1.214 1.017.577.188 1.168.38 1.286.983.082.417-.075.988-.22 1.52-.215.782-.406 1.48.22 1.48 1.5-.5 3.798-3.186 4-5 .138-1.243-2-2-3.5-2.5-.478-.16-.755.081-.99.284-.172.15-.322.279-.51.216-.445-.148-2.5-2-1.5-2.5.78-.39.952-.171 1.227.182.078.099.163.208.273.318.609.304.662-.132.723-.633.039-.322.081-.671.277-.867.434-.434 1.265-.791 2.028-1.12.712-.306 1.365-.587 1.579-.88A7 7 0 1 1 2.04 4.327Z"/>
                            </svg> <p>North America</p>
                        </li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase-fill" viewBox="0 0 16 16">
                            <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v1.384l7.614 2.03a1.5 1.5 0 0 0 .772 0L16 5.884V4.5A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5z"/>
                            <path d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85v5.65z"/>
                            </svg><p>venture Capital</p>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <p>Consumer Dictionary</p>
                        <p class="ms-4">More....</p>
                    </div>
                </div>
                <div class="down">
                    <h4>$18 million</h4>
                    <p>total commitment</p>
                </div>
            </div>
        </div>
        <div class="carousel-cell">
            <div class="set">
                <div class="top">
                    <h3>khosla ventures</h3>
                </div>
                <div class="middle">
                    <span>Access A68 SCSP investing in</span>
                    <h3>Khosla ventures VIII & Opp 2</h3>
                    <p>The funds will pursue investments in deep tech start-ups operating in large and ....</p>
                    <ul class="mb-3">
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe-americas" viewBox="0 0 16 16">
                            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM2.04 4.326c.325 1.329 2.532 2.54 3.717 3.19.48.263.793.434.743.484-.08.08-.162.158-.242.234-.416.396-.787.749-.758 1.266.035.634.618.824 1.214 1.017.577.188 1.168.38 1.286.983.082.417-.075.988-.22 1.52-.215.782-.406 1.48.22 1.48 1.5-.5 3.798-3.186 4-5 .138-1.243-2-2-3.5-2.5-.478-.16-.755.081-.99.284-.172.15-.322.279-.51.216-.445-.148-2.5-2-1.5-2.5.78-.39.952-.171 1.227.182.078.099.163.208.273.318.609.304.662-.132.723-.633.039-.322.081-.671.277-.867.434-.434 1.265-.791 2.028-1.12.712-.306 1.365-.587 1.579-.88A7 7 0 1 1 2.04 4.327Z"/>
                            </svg> <p>North America</p>
                        </li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase-fill" viewBox="0 0 16 16">
                            <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v1.384l7.614 2.03a1.5 1.5 0 0 0 .772 0L16 5.884V4.5A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5z"/>
                            <path d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85v5.65z"/>
                            </svg><p>venture Capital</p>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <p>Consumer Dictionary</p>
                        <p class="ms-4">More....</p>
                    </div>
                </div>
                <div class="down">
                    <h4>$18 million</h4>
                    <p>total commitment</p>
                </div>
            </div>
        </div>
        <div class="carousel-cell">
            <div class="set">
                <div class="top">
                    <h3>khosla ventures</h3>
                </div>
                <div class="middle">
                    <span>Access A68 SCSP investing in</span>
                    <h3>Khosla ventures VIII & Opp 2</h3>
                    <p>The funds will pursue investments in deep tech start-ups operating in large and ....</p>
                    <ul class="mb-3">
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe-americas" viewBox="0 0 16 16">
                            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM2.04 4.326c.325 1.329 2.532 2.54 3.717 3.19.48.263.793.434.743.484-.08.08-.162.158-.242.234-.416.396-.787.749-.758 1.266.035.634.618.824 1.214 1.017.577.188 1.168.38 1.286.983.082.417-.075.988-.22 1.52-.215.782-.406 1.48.22 1.48 1.5-.5 3.798-3.186 4-5 .138-1.243-2-2-3.5-2.5-.478-.16-.755.081-.99.284-.172.15-.322.279-.51.216-.445-.148-2.5-2-1.5-2.5.78-.39.952-.171 1.227.182.078.099.163.208.273.318.609.304.662-.132.723-.633.039-.322.081-.671.277-.867.434-.434 1.265-.791 2.028-1.12.712-.306 1.365-.587 1.579-.88A7 7 0 1 1 2.04 4.327Z"/>
                            </svg> <p>North America</p>
                        </li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase-fill" viewBox="0 0 16 16">
                            <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v1.384l7.614 2.03a1.5 1.5 0 0 0 .772 0L16 5.884V4.5A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5z"/>
                            <path d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85v5.65z"/>
                            </svg><p>venture Capital</p>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <p>Consumer Dictionary</p>
                        <p class="ms-4">More....</p>
                    </div>
                </div>
                <div class="down">
                    <h4>$18 million</h4>
                    <p>total commitment</p>
                </div>
            </div>
        </div>
        <div class="carousel-cell">
            <div class="set">
                <div class="top">
                    <h3>khosla ventures</h3>
                </div>
                <div class="middle">
                    <span>Access A68 SCSP investing in</span>
                    <h3>Khosla ventures VIII & Opp 2</h3>
                    <p>The funds will pursue investments in deep tech start-ups operating in large and ....</p>
                    <ul class="mb-3">
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe-americas" viewBox="0 0 16 16">
                            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM2.04 4.326c.325 1.329 2.532 2.54 3.717 3.19.48.263.793.434.743.484-.08.08-.162.158-.242.234-.416.396-.787.749-.758 1.266.035.634.618.824 1.214 1.017.577.188 1.168.38 1.286.983.082.417-.075.988-.22 1.52-.215.782-.406 1.48.22 1.48 1.5-.5 3.798-3.186 4-5 .138-1.243-2-2-3.5-2.5-.478-.16-.755.081-.99.284-.172.15-.322.279-.51.216-.445-.148-2.5-2-1.5-2.5.78-.39.952-.171 1.227.182.078.099.163.208.273.318.609.304.662-.132.723-.633.039-.322.081-.671.277-.867.434-.434 1.265-.791 2.028-1.12.712-.306 1.365-.587 1.579-.88A7 7 0 1 1 2.04 4.327Z"/>
                            </svg> <p>North America</p>
                        </li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase-fill" viewBox="0 0 16 16">
                            <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v1.384l7.614 2.03a1.5 1.5 0 0 0 .772 0L16 5.884V4.5A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5z"/>
                            <path d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85v5.65z"/>
                            </svg><p>venture Capital</p>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <p>Consumer Dictionary</p>
                        <p class="ms-4">More....</p>
                    </div>
                </div>
                <div class="down">
                    <h4>$18 million</h4>
                    <p>total commitment</p>
                </div>
            </div>
        </div>
        <div class="carousel-cell">
            <div class="set">
                <div class="top">
                    <h3>khosla ventures</h3>
                </div>
                <div class="middle">
                    <span>Access A68 SCSP investing in</span>
                    <h3>Khosla ventures VIII & Opp 2</h3>
                    <p>The funds will pursue investments in deep tech start-ups operating in large and ....</p>
                    <ul class="mb-3">
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe-americas" viewBox="0 0 16 16">
                            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM2.04 4.326c.325 1.329 2.532 2.54 3.717 3.19.48.263.793.434.743.484-.08.08-.162.158-.242.234-.416.396-.787.749-.758 1.266.035.634.618.824 1.214 1.017.577.188 1.168.38 1.286.983.082.417-.075.988-.22 1.52-.215.782-.406 1.48.22 1.48 1.5-.5 3.798-3.186 4-5 .138-1.243-2-2-3.5-2.5-.478-.16-.755.081-.99.284-.172.15-.322.279-.51.216-.445-.148-2.5-2-1.5-2.5.78-.39.952-.171 1.227.182.078.099.163.208.273.318.609.304.662-.132.723-.633.039-.322.081-.671.277-.867.434-.434 1.265-.791 2.028-1.12.712-.306 1.365-.587 1.579-.88A7 7 0 1 1 2.04 4.327Z"/>
                            </svg> <p>North America</p>
                        </li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase-fill" viewBox="0 0 16 16">
                            <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v1.384l7.614 2.03a1.5 1.5 0 0 0 .772 0L16 5.884V4.5A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5z"/>
                            <path d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85v5.65z"/>
                            </svg><p>venture Capital</p>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <p>Consumer Dictionary</p>
                        <p class="ms-4">More....</p>
                    </div>
                </div>
                <div class="down">
                    <h4>$18 million</h4>
                    <p>total commitment</p>
                </div>
            </div>
        </div>
        <div class="carousel-cell">
            <div class="set">
                <div class="top">
                    <h3>khosla ventures</h3>
                </div>
                <div class="middle">
                    <span>Access A68 SCSP investing in</span>
                    <h3>Khosla ventures VIII & Opp 2</h3>
                    <p>The funds will pursue investments in deep tech start-ups operating in large and ....</p>
                    <ul class="mb-3">
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe-americas" viewBox="0 0 16 16">
                            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM2.04 4.326c.325 1.329 2.532 2.54 3.717 3.19.48.263.793.434.743.484-.08.08-.162.158-.242.234-.416.396-.787.749-.758 1.266.035.634.618.824 1.214 1.017.577.188 1.168.38 1.286.983.082.417-.075.988-.22 1.52-.215.782-.406 1.48.22 1.48 1.5-.5 3.798-3.186 4-5 .138-1.243-2-2-3.5-2.5-.478-.16-.755.081-.99.284-.172.15-.322.279-.51.216-.445-.148-2.5-2-1.5-2.5.78-.39.952-.171 1.227.182.078.099.163.208.273.318.609.304.662-.132.723-.633.039-.322.081-.671.277-.867.434-.434 1.265-.791 2.028-1.12.712-.306 1.365-.587 1.579-.88A7 7 0 1 1 2.04 4.327Z"/>
                            </svg> <p>North America</p>
                        </li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase-fill" viewBox="0 0 16 16">
                            <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v1.384l7.614 2.03a1.5 1.5 0 0 0 .772 0L16 5.884V4.5A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5z"/>
                            <path d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85v5.65z"/>
                            </svg><p>venture Capital</p>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <p>Consumer Dictionary</p>
                        <p class="ms-4">More....</p>
                    </div>
                </div>
                <div class="down">
                    <h4>$18 million</h4>
                    <p>total commitment</p>
                </div>
            </div>
        </div>
        <div class="carousel-cell">
            <div class="set">
                <div class="top">
                    <h3>khosla ventures</h3>
                </div>
                <div class="middle">
                    <span>Access A68 SCSP investing in</span>
                    <h3>Khosla ventures VIII & Opp 2</h3>
                    <p>The funds will pursue investments in deep tech start-ups operating in large and ....</p>
                    <ul class="mb-3">
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe-americas" viewBox="0 0 16 16">
                            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM2.04 4.326c.325 1.329 2.532 2.54 3.717 3.19.48.263.793.434.743.484-.08.08-.162.158-.242.234-.416.396-.787.749-.758 1.266.035.634.618.824 1.214 1.017.577.188 1.168.38 1.286.983.082.417-.075.988-.22 1.52-.215.782-.406 1.48.22 1.48 1.5-.5 3.798-3.186 4-5 .138-1.243-2-2-3.5-2.5-.478-.16-.755.081-.99.284-.172.15-.322.279-.51.216-.445-.148-2.5-2-1.5-2.5.78-.39.952-.171 1.227.182.078.099.163.208.273.318.609.304.662-.132.723-.633.039-.322.081-.671.277-.867.434-.434 1.265-.791 2.028-1.12.712-.306 1.365-.587 1.579-.88A7 7 0 1 1 2.04 4.327Z"/>
                            </svg> <p>North America</p>
                        </li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase-fill" viewBox="0 0 16 16">
                            <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v1.384l7.614 2.03a1.5 1.5 0 0 0 .772 0L16 5.884V4.5A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5z"/>
                            <path d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85v5.65z"/>
                            </svg><p>venture Capital</p>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <p>Consumer Dictionary</p>
                        <p class="ms-4">More....</p>
                    </div>
                </div>
                <div class="down">
                    <h4>$18 million</h4>
                    <p>total commitment</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="How margin50">
    <div class="">
        <div class="first">
            <div class="text">
                <h2 class="m-0">How it Works</h2>
                <p>Learn how Moonfare gives you access to top tier funds</p>
            </div>
            <div class="second">
                <button class="btn btn-brand-02">Learn How</button>
            </div>
        </div>
    </div>
     
</div>
</div>

@endsection

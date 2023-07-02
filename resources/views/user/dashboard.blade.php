@extends('templates.main-user')

@section('content')
<div class="content content-fixed">
    <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-30">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cryptocurrency</li>
                    </ol>
                </nav>
                <h4 class="mg-b-0 tx-spacing--1">Welcome to Dashboard</h4>
            </div>
            <div class="d-none d-md-flex">
                <button class="btn btn-sm btn-primary btn-uppercase pd-x-20">BTC</button>
                <button class="btn btn-sm btn-white btn-uppercase pd-x-20 mg-l-5">ETH</button>
                <button class="btn btn-sm btn-white btn-uppercase pd-x-20 mg-l-5">LTC</button>
                <button class="btn btn-sm btn-white btn-uppercase pd-x-20 mg-l-5">BTG</button>
                <button class="btn btn-sm btn-icon btn-white btn-uppercase mg-l-5"><i data-feather="more-vertical"></i></button>
            </div>
        </div>

        <div class="row row-xs">
            <div class="col-12">
                <div class="card card-body">
                    <div class="d-md-flex align-items-center justify-content-between">
                        <div class="media align-sm-items-center">
                            <div class="tx-40 tx-lg-60 lh-0 tx-orange"><i class="fab fa-bitcoin"></i></div>
                            <div class="media-body mg-l-15">
                                <h6 class="tx-12 tx-lg-14 tx-semibold tx-uppercase tx-spacing-1 mg-b-5">Bitcoin Price <span class="tx-normal tx-color-03">(BTC)</span></h6>
                                <div class="d-flex align-items-baseline">
                                    <h2 class="tx-20 tx-lg-28 tx-normal tx-rubik tx-spacing--2 lh-2 mg-b-0">$3,972.87</h2>
                                    <h6 class="tx-11 tx-lg-16 tx-normal tx-rubik tx-danger mg-l-5 lh-2 mg-b-0">-$7.98(0.2006%)</h6>
                                </div>
                            </div><!-- media-body -->
                        </div><!-- media -->
                        <div class="d-flex flex-column flex-sm-row mg-t-20 mg-md-t-0">
                            <button class="btn btn-sm btn-white btn-uppercase pd-x-15"><i data-feather="download" class="mg-r-5"></i> Export CSV</button>
                            <button class="btn btn-sm btn-white btn-uppercase pd-x-15 mg-t-5 mg-sm-t-0 mg-sm-l-5"><i data-feather="share-2" class="mg-r-5"></i> Share</button>
                            <button class="btn btn-sm btn-white btn-uppercase pd-x-15 mg-t-5 mg-sm-t-0  mg-sm-l-5"><i data-feather="eye" class="mg-r-5"></i> Watch</button>
                        </div>
                    </div>
                </div>
            </div><!-- col -->
            <div class="col-lg-9 mg-t-10">
                <div class="card card-crypto">
                    <div class="card-header pd-y-8 d-sm-flex align-items-center justify-content-between">
                        <nav class="nav nav-line">
                            <a href="" class="nav-link">Hour</a>
                            <a href="" class="nav-link active">Day</a>
                            <a href="" class="nav-link">Week</a>
                            <a href="" class="nav-link">Month</a>
                            <a href="" class="nav-link">Year</a>
                            <a href="" class="nav-link">All</a>
                        </nav>
                        <div class="tx-12 tx-color-03 align-items-center d-none d-sm-flex">
                            <a href="" class="link-01 tx-spacing-1 tx-rubik d-flex align-items-center">03/01/2023 <ion-icon name="chevron-down-outline"></ion-icon></a>
                            <span class="mg-x-10">to</span>
                            <a href="" class="link-01 tx-spacing-1 tx-rubik d-flex align-items-center">03/02/2023 <ion-icon name="chevron-down-outline"></ion-icon></a>
                        </div>
                    </div><!-- card-header -->
                    <div class="card-body pd-10 pd-sm-20">
                        <div class="chart-eleven">
                            <div id="flotChart1" class="flot-chart"></div>
                        </div><!-- chart-eleven -->
                    </div><!-- card-body -->
                    <div class="card-footer pd-20">
                        <div class="row row-sm">
                            <div class="col-6 col-sm-4 col-md">
                                <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-03 mg-b-10">Market Cap</h6>
                                <h5 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">$14.5B</h5>
                            </div><!-- col -->
                            <div class="col-6 col-sm-4 col-md">
                                <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-03 mg-b-10">Volume (24h)</h6>
                                <h5 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">$4.6B</h5>
                            </div><!-- col -->
                            <div class="col-6 col-sm-4 col-md mg-t-20 mg-sm-t-0">
                                <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-03 mg-b-10">Change</h6>
                                <h5 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1 d-flex align-items-center">-$7.98 <small class="tx-danger position-relative t-1">
                                        <ion-icon name="arrow-down-outline"></ion-icon>
                                    </small></h5>
                            </div><!-- col -->
                            <div class="col-6 col-sm-4 col-md-3 col-xl mg-t-20 mg-md-t-0">
                                <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-03 mg-b-10"><span class="d-none d-sm-inline">Circulating </span>Supply</h6>
                                <h5 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">17.59M</h5>
                            </div><!-- col -->
                            <div class="col-6 col-sm-4 col-md mg-t-20 mg-md-t-0">
                                <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-03 mg-b-10">All Time High</h6>
                                <h5 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">$18.4K</h5>
                            </div><!-- col -->
                        </div><!-- row -->
                    </div><!-- card-footer -->
                </div><!-- card -->
            </div><!-- col -->
            <div class="col-lg-3 mg-t-10">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mg-b-0">Cryptocurrencies</h6>
                    </div><!-- card-header -->
                    <div class="card-body pd-10">
                        <div class="table-responsive">
                            <table class="table table-borderless tx-13 mg-b-0">
                                <thead>
                                    <tr class="tx-uppercase tx-10 tx-spacing-1 tx-semibold tx-color-03">
                                        <th>Asset</th>
                                        <th class="text-end">Last Price</th>
                                        <th class="text-end">% Change</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>BCH</strong></td>
                                        <td class="text-end tx-rubik">$160.43</td>
                                        <td class="text-end tx-rubik"><span class="tx-success d-inline-flex align-items-center">4.34% <ion-icon name="arrow-up-outline"></ion-icon></span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>ETH</strong></td>
                                        <td class="text-end tx-rubik">$136.99</td>
                                        <td class="text-end tx-rubik"><span class="tx-danger d-inline-flex align-items-center">0.77% <ion-icon name="arrow-down-outline"></ion-icon></span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>DASH</strong></td>
                                        <td class="text-end tx-rubik">$90.53</td>
                                        <td class="text-end tx-rubik"><span class="tx-danger d-inline-flex align-items-center">0.80% <ion-icon name="arrow-down-outline"></ion-icon></span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>BSV</strong></td>
                                        <td class="text-end tx-rubik">$66.34</td>
                                        <td class="text-end tx-rubik"><span class="tx-danger d-inline-flex align-items-center">1.61% <ion-icon name="arrow-down-outline"></ion-icon></span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>LTC</strong></td>
                                        <td class="text-end tx-rubik">$58.91</td>
                                        <td class="text-end tx-rubik"><span class="tx-danger d-inline-flex align-items-center">2.17% <ion-icon name="arrow-down-outline"></ion-icon></span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>ZEC</strong></td>
                                        <td class="text-end tx-rubik">$53.57</td>
                                        <td class="text-end tx-rubik"><span class="tx-success d-inline-flex align-items-center">0.59% <ion-icon name="arrow-up-outline"></ion-icon></span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>XMR</strong></td>
                                        <td class="text-end tx-rubik">$52.36</td>
                                        <td class="text-end tx-rubik"><span class="tx-success d-inline-flex align-items-center">0.42% <ion-icon name="arrow-up-outline"></ion-icon></span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>BTG</strong></td>
                                        <td class="text-end tx-rubik">$13.09</td>
                                        <td class="text-end tx-rubik"><span class="tx-danger d-inline-flex align-items-center">0.56% <ion-icon name="arrow-down-outline"></ion-icon></span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>NEO</strong></td>
                                        <td class="text-end tx-rubik">$9.06</td>
                                        <td class="text-end tx-rubik"><span class="tx-danger d-inline-flex align-items-center">0.83% <ion-icon name="arrow-down-outline"></ion-icon></span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>ETC</strong></td>
                                        <td class="text-end tx-rubik">$4.37</td>
                                        <td class="text-end tx-rubik"><span class="tx-danger d-inline-flex align-items-center">0.53% <ion-icon name="arrow-down-outline"></ion-icon></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!-- table-responsive -->
                    </div><!-- card-body -->
                </div><!-- card -->
            </div><!-- col -->
            <div class="col-12 mg-t-10">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mg-b-0">Cryptocurrency Watchlist</h6>
                    </div><!-- card-header -->
                    <div class="card-body pd-0">
                        <div class="row no-gutters">
                            <div class="col col-sm-6 col-lg">
                                <div class="crypto">
                                    <div class="media mg-b-10">
                                        <div class="crypto-icon bg-secondary">
                                            <i class="cf cf-eth"></i>
                                        </div><!-- crypto-icon -->
                                        <div class="media-body pd-l-8">
                                            <h6 class="tx-11 tx-spacing-1 tx-uppercase tx-semibold mg-b-5">Ethereum <span class="tx-color-03 tx-normal">(ETH)</span></h6>
                                            <div class="d-flex align-items-baseline tx-rubik">
                                                <h5 class="tx-20 mg-b-0">$136.99</h5>
                                                <p class="mg-b-0 tx-11 tx-danger mg-l-3 d-flex align-items-center">
                                                    <ion-icon name="arrow-down-outline"></ion-icon> 0.77%
                                                </p>
                                            </div>
                                        </div><!-- media-body -->
                                    </div><!-- media -->

                                    <div class="chart-twelve">
                                        <div id="flotChart2" class="flot-chart"></div>
                                    </div><!-- chart-twelve -->

                                    <div class="pos-absolute b-5 l-20 tx-medium">
                                        <label class="tx-9 tx-uppercase tx-sans tx-color-03">
                                            <a href="" class="link-01 tx-semibold">12</a> USD Markets
                                        </label>
                                        <label class="tx-9 tx-uppercase tx-sans tx-color-03 mg-l-10">
                                            <a href="" class="link-01 tx-semibold">81</a> ETH Markets
                                        </label>
                                    </div>
                                </div><!-- crypto -->
                            </div>
                            <div class="col col-sm-6 col-lg bd-t bd-sm-t-0 bd-sm-l">
                                <div class="crypto">
                                    <div class="media mg-b-10">
                                        <div class="crypto-bitcoin-cash"><i class="fab fa-bitcoin tx-success tx-42"></i></div>
                                        <div class="media-body pd-l-8">
                                            <h6 class="tx-11 tx-spacing-1 tx-uppercase tx-semibold mg-b-5">Bitcoin Cash <span class="tx-color-03 tx-normal">(BCH)</span></h6>
                                            <div class="d-flex align-items-baseline tx-rubik">
                                                <h5 class="tx-20 mg-b-0">$160.43</h5>
                                                <p class="mg-b-0 tx-11 tx-success mg-l-3 d-flex align-items-center">
                                                    <ion-icon name="arrow-up-outline"></ion-icon> 4.34%
                                                </p>
                                            </div>
                                        </div><!-- media-body -->
                                    </div><!-- media -->

                                    <div class="chart-twelve">
                                        <div id="flotChart3" class="flot-chart"></div>
                                    </div><!-- chart-twelve -->

                                    <div class="pos-absolute b-5 l-20 tx-medium">
                                        <label class="tx-9 tx-uppercase tx-sans tx-color-03">
                                            <a href="" class="link-01 tx-semibold">11</a> USD Markets
                                        </label>
                                        <label class="tx-9 tx-uppercase tx-sans tx-color-03 mg-l-10">
                                            <a href="" class="link-01 tx-semibold">74</a> BCH Markets
                                        </label>
                                    </div>
                                </div><!-- crypto -->
                            </div>
                            <div class="col col-sm-6 col-lg bd-t bd-lg-t-0 bd-lg-l">
                                <div class="crypto">
                                    <div class="media mg-b-10">
                                        <div class="crypto-icon bg-litecoin">
                                            <i class="cf cf-ltc"></i>
                                        </div><!-- crypto-icon -->
                                        <div class="media-body pd-l-8">
                                            <h6 class="tx-11 tx-spacing-1 tx-uppercase tx-semibold mg-b-5">Litecoin <span class="tx-color-03 tx-normal">(LTC)</span></h6>
                                            <div class="d-flex align-items-baseline tx-rubik">
                                                <h5 class="tx-20 mg-b-0">$58.91</h5>
                                                <p class="mg-b-0 tx-11 tx-danger mg-l-3 d-flex align-items-center">
                                                    <ion-icon name="arrow-down-outline"></ion-icon> 2.17%
                                                </p>
                                            </div>
                                        </div><!-- media-body -->
                                    </div><!-- media -->

                                    <div class="chart-twelve">
                                        <div id="flotChart4" class="flot-chart"></div>
                                    </div><!-- chart-twelve -->

                                    <div class="pos-absolute b-5 l-20 tx-medium">
                                        <label class="tx-9 tx-uppercase tx-sans tx-color-03">
                                            <a href="" class="link-01 tx-semibold">6</a> USD Markets
                                        </label>
                                        <label class="tx-9 tx-uppercase tx-sans tx-color-03 mg-l-10">
                                            <a href="" class="link-01 tx-semibold">42</a> LTC Markets
                                        </label>
                                    </div>
                                </div><!-- crypto -->
                            </div>
                            <div class="col col-sm-6 col-lg bd-t bd-lg-t-0 bd-sm-l">
                                <div class="crypto">
                                    <div class="media mg-b-10">
                                        <div class="crypto-icon bg-primary">
                                            <i class="cf cf-dash"></i>
                                        </div><!-- crypto-icon -->
                                        <div class="media-body pd-l-8">
                                            <h6 class="tx-11 tx-spacing-1 tx-uppercase tx-semibold mg-b-5">Dash <span class="tx-color-03 tx-normal">(DASH)</span></h6>
                                            <div class="d-flex align-items-baseline tx-rubik">
                                                <h5 class="tx-20 mg-b-0">$90.53</h5>
                                                <p class="mg-b-0 tx-11 tx-danger mg-l-3 d-flex align-items-center">
                                                    <ion-icon name="arrow-down-outline"></ion-icon> 0.80%
                                                </p>
                                            </div>
                                        </div><!-- media-body -->
                                    </div><!-- media -->

                                    <div class="chart-twelve">
                                        <div id="flotChart5" class="flot-chart"></div>
                                    </div><!-- chart-twelve -->

                                    <div class="pos-absolute b-5 l-20 tx-medium">
                                        <label class="tx-9 tx-uppercase tx-sans tx-color-03">
                                            <a href="" class="link-01 tx-semibold">6</a> USD Markets
                                        </label>
                                        <label class="tx-9 tx-uppercase tx-sans tx-color-03 mg-l-10">
                                            <a href="" class="link-01 tx-semibold">31</a> DASH Markets
                                        </label>
                                    </div>
                                </div><!-- crypto -->
                            </div>
                        </div><!-- row -->
                    </div><!-- card-body -->
                </div><!-- card -->
            </div><!-- col -->
            <div class="col-sm-6 col-lg-4 mg-t-10">
                <div class="card ht-md-100p">
                    <div class="card-header d-flex justify-content-between">
                        <h6 class="lh-5 mg-b-0">Transactions</h6>
                        <a href="" class="tx-12 link-03">View All Transactions <i data-feather="arrow-right" class="wd-15 ht-15"></i></a>
                    </div><!-- card-header -->
                    <div class="card-body pd-0">
                        <ul class="list-unstyled mg-b-0">
                            <li class="list-label">Today, Mar 20</li>
                            <li class="list-item">
                                <div class="media align-items-center">
                                    <div class="wd-35 ht-35 bd bd-2 bd-info tx-info rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex">
                                        <i data-feather="download" class="wd-20 ht-20"></i>
                                    </div>
                                    <div class="media-body mg-sm-l-15">
                                        <p class="tx-medium mg-b-0">Received Bitcoin</p>
                                        <p class="tx-12 mg-b-0 tx-color-03">Received via PayPal</p>
                                    </div><!-- media-body -->
                                </div><!-- media -->
                                <div class="text-end tx-rubik">
                                    <p class="mg-b-0">+0.0108 BTC</p>
                                    <p class="tx-12 mg-b-0 tx-success">+$25.00 USD</p>
                                </div><!-- media-body -->
                            </li>
                            <li class="list-item">
                                <div class="media align-items-center">
                                    <div class="wd-35 ht-35 bd bd-2 bd-primary tx-primary rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex">
                                        <i data-feather="upload" class="wd-20 ht-20"></i>
                                    </div>
                                    <div class="media-body mg-sm-l-15">
                                        <p class="tx-medium mg-b-0">Sent Bitcoin</p>
                                        <p class="tx-12 mg-b-0 tx-color-03">To Bitcoin address</p>
                                    </div><!-- media-body -->
                                </div><!-- media -->
                                <div class="text-end tx-rubik">
                                    <p class="tx-normal mg-b-2">-0.0157 BTC</p>
                                    <p class="tx-12 mg-b-0 tx-danger">-$289.00 USD</p>
                                </div><!-- media-body -->
                            </li>
                            <li class="list-label">Yesterday, Mar 19</li>
                            <li class="list-item">
                                <div class="media align-items-center">
                                    <div class="wd-35 ht-35 bd bd-2 bd-success tx-success rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex">
                                        <i data-feather="shopping-bag" class="wd-20 ht-20"></i>
                                    </div>
                                    <div class="media-body mg-sm-l-15">
                                        <p class="tx-medium mg-b-0">Bought Ethereum</p>
                                        <p class="tx-12 mg-b-0 tx-color-03">Using PayPal account</p>
                                    </div><!-- media-body -->
                                </div><!-- media -->
                                <div class="text-end tx-rubik">
                                    <p class="mg-b-0">+2.0157 ETH</p>
                                    <p class="tx-12 mg-b-0 tx-success">+$21.50 USD</p>
                                </div>
                            </li>
                            <li class="list-item">
                                <div class="media align-items-center">
                                    <div class="wd-35 ht-35 bd bd-2 bd-success tx-success rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex">
                                        <i data-feather="shopping-bag" class="wd-20 ht-20"></i>
                                    </div>
                                    <div class="media-body mg-sm-l-15">
                                        <p class="tx-medium mg-b-0">Bought Bitcoin</p>
                                        <p class="tx-12 mg-b-0 tx-color-03">Using visa <span class="d-lg-none d-xl-inline">debit</span> ***1146</p>
                                    </div><!-- media-body -->
                                </div><!-- media -->
                                <div class="text-end tx-rubik">
                                    <p class="mg-b-0">+0.004 BTC</p>
                                    <p class="tx-12 mg-b-0 tx-success">+$18.50 USD</p>
                                </div>
                            </li>
                            <li class="list-item">
                                <div class="media align-items-center">
                                    <div class="wd-35 ht-35 bd bd-2 bd-primary tx-primary rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex">
                                        <i data-feather="upload" class="wd-20 ht-20"></i>
                                    </div>
                                    <div class="media-body mg-sm-l-15">
                                        <p class="tx-medium mg-b-0">Sent Bitcoin</p>
                                        <p class="tx-12 mg-b-0 tx-color-03">To Bitcoin address</p>
                                    </div><!-- media-body -->
                                </div><!-- media -->
                                <div class="text-end tx-rubik">
                                    <p class="mg-b-0">-0.0025 BTC</p>
                                    <p class="tx-12 mg-b-0 tx-danger">-$289.00 USD</p>
                                </div>
                            </li>
                            <li class="list-item">
                                <div class="media align-items-center">
                                    <div class="wd-35 ht-35 bd bd-2 bd-primary tx-primary rounded-circle align-items-center justify-content-center op-6 d-none d-sm-flex">
                                        <i data-feather="upload" class="wd-20 ht-20"></i>
                                    </div>
                                    <div class="media-body mg-sm-l-15">
                                        <p class="tx-medium mg-b-0">Sent Bitcoin</p>
                                        <p class="tx-12 mg-b-0 tx-color-03">To Bitcoin address</p>
                                    </div><!-- media-body -->
                                </div><!-- media -->
                                <div class="text-end tx-rubik">
                                    <p class="mg-b-0">-0.0025 BTC</p>
                                    <p class="tx-12 mg-b-0 tx-danger">-$289.00 USD</p>
                                </div>
                            </li>
                        </ul>
                    </div><!-- card-body -->
                </div><!-- card -->
            </div><!-- col -->
            <div class="col-sm-6 col-lg-4 mg-t-10">
                <div class="card">
                    <div class="card-header bd-b-0 d-flex align-items-center justify-content-between">
                        <h6 class="lh-5 mg-b-0">Price Indexes</h6>
                        <a href="" class="link-03 tx-12 d-flex align-items-center">USD <ion-icon name="chevron-down-outline" class="mg-l-2 tx-12"></ion-icon></a>
                    </div><!-- card-header -->
                    <div class="card-body pd-0">
                        <ul class="list-unstyled mg-b-0">
                            <li class="list-item">
                                <div class="media">
                                    <div class="crypto-icon crypto-icon-sm bg-orange">
                                        <i class="cf cf-btc"></i>
                                    </div>
                                    <div class="media-body mg-l-15">
                                        <p class="tx-medium mg-b-0">Bitcoin</p>
                                        <p class="mg-b-0 tx-11 tx-color-03 tx-medium">BTC/USD</p>
                                    </div>
                                </div><!-- media -->
                                <div class="text-end">
                                    <p class="tx-normal tx-rubik mg-b-0">$4,000.19</p>
                                    <p class="mg-b-0 tx-12 tx-rubik tx-success">0.27%</p>
                                </div>
                            </li>
                            <li class="list-item">
                                <div class="media">
                                    <div class="crypto-icon crypto-icon-sm bg-secondary">
                                        <i class="cf cf-eth"></i>
                                    </div>
                                    <div class="media-body mg-l-15">
                                        <p class="tx-medium mg-b-0">Ethereum</p>
                                        <p class="mg-b-0 tx-11 tx-color-03 tx-medium tx-spacing-1 tx-sans">ETH/USD</p>
                                    </div>
                                </div><!-- media -->
                                <div class="text-end">
                                    <p class="tx-normal tx-rubik mg-b-0">$138.90</p>
                                    <p class="mg-b-0 tx-12 tx-rubik tx-success">0.35%</p>
                                </div>
                            </li>
                            <li class="list-item">
                                <div class="media">
                                    <div class="crypto-icon crypto-icon-sm bg-litecoin">
                                        <i class="cf cf-ltc"></i>
                                    </div>
                                    <div class="media-body mg-l-15">
                                        <p class="tx-medium mg-b-0">Litecoin</p>
                                        <p class="mg-b-0 tx-11 tx-color-03 tx-medium tx-spacing-1 tx-sans">LTC/USD</p>
                                    </div>
                                </div><!-- media -->
                                <div class="text-end">
                                    <p class="tx-normal tx-rubik mg-b-0">$59.95</p>
                                    <p class="mg-b-0 tx-12 tx-rubik tx-success">0.05%</p>
                                </div>
                            </li>
                            <li class="list-item">
                                <div class="media">
                                    <div class="crypto-icon crypto-icon-sm bg-success">
                                        <i class="cf cf-btc"></i>
                                    </div>
                                    <div class="media-body mg-l-15">
                                        <p class="tx-medium mg-b-0">Bitcoin Cash</p>
                                        <p class="mg-b-0 tx-11 tx-color-03 tx-medium tx-spacing-1 tx-sans">BCH/USD</p>
                                    </div>
                                </div><!-- media -->
                                <div class="text-end">
                                    <p class="tx-normal tx-rubik mg-b-0">$160.28</p>
                                    <p class="mg-b-0 tx-12 tx-rubik tx-success">-0.19%</p>
                                </div>
                            </li>
                            <li class="list-item">
                                <div class="media">
                                    <div class="crypto-icon crypto-icon-sm bg-primary">
                                        <i class="cf cf-dash"></i>
                                    </div>
                                    <div class="media-body mg-l-15">
                                        <p class="tx-medium mg-b-0">Dash</p>
                                        <p class="mg-b-0 tx-11 tx-color-03 tx-medium tx-spacing-1 tx-sans">DASH/USD</p>
                                    </div>
                                </div><!-- media -->
                                <div class="text-end">
                                    <p class="tx-normal tx-rubik mg-b-0">$92.19</p>
                                    <p class="mg-b-0 tx-12 tx-rubik tx-success">-0.21%</p>
                                </div>
                            </li>
                            <li class="list-item">
                                <div class="media">
                                    <div class="crypto-icon crypto-icon-sm bg-primary op-7">
                                        <i class="cf cf-bsd"></i>
                                    </div>
                                    <div class="media-body mg-l-15">
                                        <p class="tx-medium mg-b-0">BitSend</p>
                                        <p class="mg-b-0 tx-11 tx-color-03 tx-medium tx-spacing-1 tx-sans">BSD/USD</p>
                                    </div>
                                </div><!-- media -->
                                <div class="text-end">
                                    <p class="tx-normal tx-rubik mg-b-0">$56.53</p>
                                    <p class="mg-b-0 tx-12 tx-rubik tx-success">2.86%</p>
                                </div>
                            </li>
                            <li class="list-item">
                                <div class="media">
                                    <div class="crypto-icon crypto-icon-sm bg-pink">
                                        <i class="cf cf-bcn"></i>
                                    </div>
                                    <div class="media-body mg-l-15">
                                        <p class="tx-medium mg-b-0">ByteCoin</p>
                                        <p class="mg-b-0 tx-11 tx-color-03 tx-medium tx-spacing-1 tx-sans">BCN/USD</p>
                                    </div>
                                </div><!-- media -->
                                <div class="text-end">
                                    <p class="tx-normal tx-rubik mg-b-0">$0.000776</p>
                                    <p class="mg-b-0 tx-12 tx-rubik tx-success">-1.32%</p>
                                </div>
                            </li>
                        </ul>
                    </div><!-- card-body -->
                </div><!-- card -->
            </div><!-- col -->
            <div class="col-sm-6 col-lg-4 mg-t-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h6 class="lh-5 mg-b-0">BTC Wallet</h6>
                        <a href="" class="tx-11 link-03"><i data-feather="more-horizontal" class="wd-20 ht-20"></i></a>
                    </div><!-- card-header -->
                    <div class="card-body pd-x-20 pd-b-10">
                        <p class="tx-uppercase tx-11 tx-spacing-1 tx-color-03 tx-medium mg-b-5">Available Balance</p>
                        <h3 class="tx-26 tx-normal tx-rubik tx-spacing--2 mg-b-5">26.00453100 <small class="text-muted tx-light">BTC</small></h3>
                        <div class="d-flex mg-b-25">
                            <p class="tx-12 tx-rubik mg-b-0"><span class="tx-medium tx-success mg-r-5">USD</span> $103,342.50</p>
                            <p class="tx-12 tx-rubik mg-b-0 mg-l-10"><span class="tx-medium tx-primary mg-r-5">EUR</span> $91,105.00</p>
                        </div>
                        <div class="d-flex mg-b-25">
                            <button class="btn btn-sm btn-uppercase btn-white flex-fill tx-spacing-1">Send</button>
                            <button class="btn btn-sm btn-uppercase btn-primary flex-fill tx-spacing-1 mg-l-10">Receive</button>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mg-b-10">
                            <p class="tx-uppercase tx-11 tx-spacing-1 tx-color-03 tx-medium mg-b-0">Recent Transactions</p>
                            <a href="" class="tx-uppercase tx-11 tx-medium mg-b-0">Show All</a>
                        </div>
                        <ul class="list-group list-group-flush mg-b-0 tx-13">
                            <li class="list-group-item pd-x-0 d-flex justify-content-between">
                                <span class="tx-medium">Received Bitcoin</span>
                                <span class="tx-rubik">+0.00003998 BTC</span>
                            </li>
                            <li class="list-group-item pd-x-0 d-flex justify-content-between">
                                <span class="tx-medium">Sent Bitcoin</span>
                                <span class="tx-rubik">-0.01570525 BTC</span>
                            </li>
                            <li class="list-group-item pd-x-0 d-flex justify-content-between">
                                <span class="tx-medium">Bought Ethereum</span>
                                <span class="tx-rubik">+2.0157 ETH</span>
                            </li>
                            <li class="list-group-item pd-x-0 d-flex justify-content-between">
                                <span class="tx-medium">Bought Bitcoin</span>
                                <span class="tx-rubik">+0.000033420 BTC</span>
                            </li>
                            <li class="list-group-item pd-x-0 d-flex justify-content-between">
                                <span class="tx-medium">Sent Bitcoin</span>
                                <span class="tx-rubik">-0.01570525 BTC</span>
                            </li>
                        </ul>
                    </div><!-- card-body -->
                </div><!-- card -->
            </div><!-- col -->
            <div class="col-sm-6 col-lg-5 col-xl-3 mg-t-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h6 class="lh-5 mg-b-0">BTC Volume By Currency</h6>
                        <a href="" class="tx-13 link-03"><i data-feather="more-horizontal" class="wd-20 ht-20"></i></a>
                    </div><!-- card-header -->
                    <div class="card-body pd-y-25">
                        <div class="row">
                            <div class="col-12">
                                <div class="chart-thirteen"><canvas id="chartDonut"></canvas></div>
                            </div>
                            <div class="col-12 tx-12 mg-t-40">
                                <div class="d-flex align-items-center">
                                    <div class="wd-10 ht-10 bg-primary rounded-circle pos-relative t--1"></div>
                                    <span class="tx-medium mg-l-10">USD</span>
                                    <span class="tx-rubik mg-l-auto">4,024.52</span>
                                    <span class="wd-60 tx-rubik mg-l-5 tx-success d-flex align-items-center justify-content-end">0.96% <ion-icon name="arrow-up-outline"></ion-icon></span>
                                </div>
                                <div class="d-flex align-items-center mg-t-10">
                                    <div class="wd-10 ht-10 bg-teal rounded-circle pos-relative t--1"></div>
                                    <span class="tx-medium mg-l-10">EUR</span>
                                    <span class="tx-rubik mg-l-auto">3,539.23</span>
                                    <span class="wd-60 tx-rubik mg-l-5 tx-success d-flex align-items-center justify-content-end">0.75% <ion-icon name="arrow-up-outline"></ion-icon></span>
                                </div>
                                <div class="d-flex align-items-center mg-t-10">
                                    <div class="wd-10 ht-10 bg-warning rounded-circle pos-relative t--1"></div>
                                    <span class="tx-medium mg-l-10">CNY</span>
                                    <span class="tx-rubik mg-l-auto">27,499.4</span>
                                    <span class="wd-60 tx-rubik mg-l-5 tx-danger d-flex align-items-center justify-content-end">-0.58% <ion-icon name="arrow-down-outline"></ion-icon></span>
                                </div>
                                <div class="d-flex align-items-center mg-t-10">
                                    <div class="wd-10 ht-10 bg-pink rounded-circle pos-relative t--1"></div>
                                    <span class="tx-medium mg-l-10">GBP</span>
                                    <span class="tx-rubik mg-l-auto">3,022.90</span>
                                    <span class="wd-60 tx-rubik mg-l-5 tx-danger d-flex align-items-center justify-content-end">-0.69% <ion-icon name="arrow-down-outline"></ion-icon></span>
                                </div>
                                <div class="d-flex align-items-center mg-t-10">
                                    <div class="wd-10 ht-10 bg-success rounded-circle pos-relative t--1"></div>
                                    <span class="tx-medium mg-l-10">JPY</span>
                                    <span class="tx-rubik mg-l-auto">444,814.7</span>
                                    <span class="wd-60 tx-rubik mg-l-5 tx-success d-flex align-items-center justify-content-end">0.82% <ion-icon name="arrow-up-outline"></ion-icon></span>
                                </div>
                                <div class="d-flex align-items-center mg-t-10">
                                    <div class="wd-10 ht-10 bg-lightblue rounded-circle pos-relative t--1"></div>
                                    <span class="tx-medium mg-l-10">KRW</span>
                                    <span class="tx-rubik mg-l-auto">4,491,099.6</span>
                                    <span class="wd-60 tx-rubik mg-l-5 tx-danger d-flex align-items-center justify-content-end">-1.11% <ion-icon name="arrow-down-outline"></ion-icon></span>
                                </div>
                                <div class="d-flex align-items-center mg-t-10">
                                    <div class="wd-10 ht-10 bg-brand-02 op-2 rounded-circle pos-relative t--1"></div>
                                    <span class="tx-medium mg-l-10">SGD</span>
                                    <span class="tx-rubik mg-l-auto">5,393.0</span>
                                    <span class="wd-60 tx-rubik mg-l-5 tx-success d-flex align-items-center justify-content-end">0.66% <ion-icon name="arrow-up-outline"></ion-icon></span>
                                </div>
                            </div>
                        </div>
                    </div><!-- card-body -->
                </div><!-- card -->
            </div><!-- col -->
            <div class="col-sm-6 col-lg-7 col-xl mg-t-10 order-md-1 order-lg-0">
                <div class="card ht-100p">
                    <div class="card-header d-flex justify-content-between">
                        <h6 class="lh-5 mg-b-0">Latest Crypto News</h6>
                        <a href="" class="tx-13 link-03"><i data-feather="more-horizontal" class="wd-20 ht-20"></i></a>
                    </div><!-- card-header -->
                    <div class="card-body pd-0">
                        <div class="media-list">
                            <div class="d-sm-flex pd-20">
                                <a href="" class="wd-100 wd-md-50 wd-lg-100 ht-60 ht-md-40 ht-lg-60">
                                    <img src="https://placehold.co/640x426" class="img-fit-cover" alt="">
                                </a>
                                <div class="media-body mg-t-20 mg-sm-t-0 mg-sm-l-20">
                                    <a href="" class="d-block tx-uppercase tx-11 tx-medium mg-b-5">CryptoNinja</a>
                                    <h6><a href="" class="link-01">Dow Futures, Bitcoin Teeter as Markets Wait for FOMC Bounce</a></h6>
                                    <p class="tx-color-03 tx-13 mg-b-0">As the unwelcome bearish momentum returns to all top cryptocurrency markets, most of this morning’s excitement...</p>
                                </div><!-- media-body -->
                            </div>
                            <hr class="mg-0">
                            <div class="d-sm-flex pd-20">
                                <a href="" class="wd-100 wd-md-50 wd-lg-100 ht-60 ht-md-40 ht-lg-60">
                                    <img src="https://placehold.co/640x427" class="img-fit-cover" alt="">
                                </a>
                                <div class="media-body mg-t-20 mg-sm-t-0 mg-sm-l-20">
                                    <a href="" class="d-block tx-uppercase tx-11 tx-medium mg-b-5">CNN</a>
                                    <h6><a href="" class="link-01">XRP Price Remains Bearish as XRP/BTC Drops Below 7,800 Satoshi</a></h6>
                                    <p class="tx-color-03 tx-13 mg-b-0">Liquidity has shifted away from the top gaining crypto assets, with only six of the week’s 30 top performing markets...</p>
                                </div><!-- media-body -->
                            </div>
                            <hr class="mg-0">
                            <div class="d-sm-flex pd-20">
                                <a href="" class="wd-100 wd-md-50 wd-lg-100 ht-60 ht-md-40 ht-lg-60">
                                    <img src="https://placehold.co/640x418" class="img-fit-cover" alt="">
                                </a>
                                <div class="media-body mg-t-20 mg-sm-t-0 mg-sm-l-20">
                                    <a href="" class="d-block tx-uppercase tx-11 tx-medium mg-b-5">Bitcoin.com</a>
                                    <h6><a href="" class="link-01">Bitcoin Price to $4500 soon? BTC Price Analysis</a></h6>
                                    <p class="tx-color-03 tx-13 mg-b-0">Published on CoinnounceTechnical Indicators: Support Level: $3900 Resistance Levels: $4100, $4200 Bitcoin Price Analysis...</p>
                                </div><!-- media-body -->
                            </div>
                        </div>
                    </div><!-- card-body -->
                </div><!-- card -->
            </div><!-- col -->
            <div class="col-sm-6 col-lg-5 col-xl-4 mg-t-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h6 class="lh-5 mg-b-0">Portfolio</h6>
                        <nav class="nav nav-row-xs align-items-center">
                            <a href="" class="nav-link">1D</a>
                            <a href="" class="nav-link active">1W</a>
                            <a href="" class="nav-link">1M</a>
                            <a href="" class="nav-link">1Y</a>
                        </nav>
                    </div><!-- card-header -->
                    <div class="card-body pd-0 pos-relative">
                        <div class="pos-absolute t-20 l-20">
                            <p class="tx-uppercase tx-11 tx-spacing-1 tx-color-03 tx-medium mg-b-0">Total Balance</p>
                            <div class="d-flex align-items-baseline">
                                <h2 class="tx-normal tx-rubik tx-spacing--2 mg-b-0"><small class="tx-color-03">$</small> 7,429.97</h2>
                                <span class="tx-rubik tx-success mg-l-5 d-flex align-items-center">
                                    <ion-icon name="arrow-up-outline"></ion-icon> 60 (2.45%)
                                </span>
                            </div>
                        </div>
                        <div class="chart-fourteen">
                            <div id="flotChart6" class="flot-chart"></div>
                        </div><!-- chart-fourteen -->
                        <ul class="list-group list-group-flush mg-t-15">
                            <li class="list-group-item d-flex align-items-center">
                                <div class="crypto-icon crypto-icon-sm bg-orange">
                                    <i class="cf cf-btc"></i>
                                </div>
                                <div class="mg-l-15">
                                    <h6 class="lh-5 mg-b-0">Bitcoin</h6>
                                    <span class="d-block tx-color-03 tx-uppercase tx-11 tx-medium">btc/usd</span>
                                </div>
                                <div class="mg-l-auto text-end">
                                    <p class="mg-b-0 tx-rubik">0.7200 BTC</p>
                                    <span class="d-block tx-color-03 tx-uppercase tx-11 tx-rubik">$2,907.71 USD</span>
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <div class="crypto-icon crypto-icon-sm bg-secondary">
                                    <i class="cf cf-eth"></i>
                                </div>
                                <div class="mg-l-15">
                                    <h6 class="lh-5 mg-b-0">Ethereum</h6>
                                    <span class="d-block tx-color-03 tx-uppercase tx-11 tx-medium">eth/usd</span>
                                </div>
                                <div class="mg-l-auto text-end">
                                    <p class="mg-b-0 tx-rubik">15.0030 ETH</p>
                                    <span class="d-block tx-color-03 tx-uppercase tx-11 tx-rubik">$2,083.62 USD</span>
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <div class="crypto-icon crypto-icon-sm bg-litecoin">
                                    <i class="cf cf-ltc"></i>
                                </div>
                                <div class="mg-l-15">
                                    <h6 class="lh-5 mg-b-0">Litecoin</h6>
                                    <span class="d-block tx-color-03 tx-uppercase tx-11 tx-medium">ltc/usd</span>
                                </div>
                                <div class="mg-l-auto text-end">
                                    <p class="mg-b-0 tx-rubik">12.5021 LTC</p>
                                    <span class="d-block tx-color-03 tx-uppercase tx-11 tx-rubik">$748.88 USD</span>
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <div class="crypto-icon crypto-icon-sm bg-success">
                                    <i class="cf cf-btc"></i>
                                </div>
                                <div class="mg-l-15">
                                    <h6 class="lh-5 mg-b-0">Bitcoin Cash`</h6>
                                    <span class="d-block tx-color-03 tx-uppercase tx-11 tx-medium">bch/usd</span>
                                </div>
                                <div class="mg-l-auto text-end">
                                    <p class="mg-b-0 tx-rubik">5.8120 BCH</p>
                                    <span class="d-block tx-color-03 tx-uppercase tx-11 tx-rubik">$916.67 USD</span>
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <div class="crypto-icon crypto-icon-sm bg-primary">
                                    <i class="cf cf-dash"></i>
                                </div>
                                <div class="mg-l-15">
                                    <h6 class="lh-5 mg-b-0">Dash`</h6>
                                    <span class="d-block tx-color-03 tx-uppercase tx-11 tx-medium">dash/usd</span>
                                </div>
                                <div class="mg-l-auto text-end">
                                    <p class="mg-b-0 tx-rubik">16.5019 DASH</p>
                                    <span class="d-block tx-color-03 tx-uppercase tx-11 tx-rubik">$1,521.97 USD</span>
                                </div>
                            </li>
                        </ul>
                    </div><!-- card-body -->
                </div><!-- card -->
            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->
</div><!-- content -->

<script>
    $(function() {
        'use strict'

        var flotChart1 = $.plot('#flotChart1', [{
            data: df3
            , color: '#e1e5ed'
            , lines: {
                lineWidth: 1
            }
        }, {
            data: df3
            , color: '#69b2f8'
            , lines: {
                lineWidth: 1
            }
        }, {
            data: df3
            , color: '#0168fa'
        }], {
            series: {
                stack: 0
                , shadowSize: 0
                , lines: {
                    show: true
                    , lineWidth: 1.7
                    , fill: true
                    , fillColor: {
                        colors: [{
                            opacity: 0
                        }, {
                            opacity: 0.2
                        }]
                    }
                }
            }
            , grid: {
                borderWidth: 0
                , labelMargin: 5
                , hoverable: true
            }
            , yaxis: {
                show: true
                , color: 'rgba(72, 94, 144, .1)'
                , min: 0
                , max: 160
                , font: {
                    size: 10
                    , color: '#8392a5'
                }
            }
            , xaxis: {
                show: true
                , color: 'rgba(72, 94, 144, .1)'
                , ticks: [
                    [0, '08:00']
                    , [20, '09:00']
                    , [40, '10:00']
                    , [60, '11:00']
                    , [80, '12:00']
                    , [100, '13:00']
                    , [120, '14:00']
                    , [140, '15:00']
                ]
                , font: {
                    size: 10
                    , family: 'Arial, sans-serif'
                    , color: '#8392a5'
                }
                , reserveSpace: false
            }
        });

        function flotOption(min, max) {
            return {
                series: {
                    stack: 0
                    , shadowSize: 0
                    , lines: {
                        show: true
                        , lineWidth: 1.5
                        , fill: true
                        , fillColor: {
                            colors: [{
                                opacity: 0
                            }, {
                                opacity: 0.2
                            }]
                        }
                    }
                }
                , grid: {
                    borderWidth: 0
                }
                , yaxis: {
                    show: false
                }
                , xaxis: {
                    show: false
                    , min: min
                    , max: max
                }
            }
        }

        // Ethereum
        $.plot('#flotChart2', [{
            data: df3
            , color: '#c0ccda'
            , lines: {
                lineWidth: 1
            }
        }, {
            data: df3
            , color: '#a0aabc'
        }], flotOption(0, 50));

        // Bitcoin Cash
        $.plot('#flotChart3', [{
            data: df3
            , color: '#b8eace'
            , lines: {
                lineWidth: 1
            }
        }, {
            data: df3
            , color: '#58cd8b'
        }], flotOption(20, 70));

        // Litecoin
        $.plot('#flotChart4', [{
            data: df3
            , color: '#c0ccdf'
            , lines: {
                lineWidth: 1
            }
        }, {
            data: df3
            , color: '#6e8ab6'
        }], flotOption(90, 140));

        // Dash
        $.plot('#flotChart5', [{
            data: df3
            , color: '#b1d0fd'
            , lines: {
                lineWidth: 1
            }
        }, {
            data: df3
            , color: '#4c94fb'
        }], flotOption(80, 130));



        // Markets
        $.plot('#flotChart6', [{
            data: df1
            , color: '#00cccc'
            , lines: {
                lineWidth: 1.7
                , fill: true
                , fillColor: {
                    colors: [{
                        opacity: 0
                    }, {
                        opacity: 0.4
                    }]
                }
            }
        }, {
            data: df2
            , color: '#e1e5ed'
            , lines: {
                lineWidth: 1
                , fill: true
                , fillColor: {
                    colors: [{
                        opacity: 0
                    }, {
                        opacity: 0.2
                    }]
                }
            }
        }], {
            series: {
                shadowSize: 0
                , lines: {
                    show: true
                , }
            }
            , grid: {
                borderWidth: 0
                , labelMargin: 10
                , aboveData: true
            }
            , yaxis: {
                show: false
                , max: 150
            }
            , xaxis: {
                show: true
                , tickColor: 'rgba(72,94,144, 0.07)'
                , ticks: [
                    [25, 'mar 10']
                    , [50, 'mar 11']
                    , [75, 'mar 12']
                    , [100, 'mar 13']
                    , [125, 'mar 14']
                ],
                //min: 35,
                //max: 125
            }
        });


        /** PIE CHART **/
        var datapie = {
            labels: ['USD', 'EUR', 'CNY', 'GBP', 'JPY', 'KRW', 'SGD']
            , datasets: [{
                data: [25, 15, 10, 12, 9, 13, 16]
                , backgroundColor: ['#66a4fb', '#4cebb5', '#fec85e', '#ff7c8f', '#a4e063', '#a5d7fd', '#b2bece']
            }]
        };

        var optionpie = {
            maintainAspectRatio: false
            , responsive: true
            , legend: {
                display: false
            , }
            , animation: {
                animateScale: true
                , animateRotate: true
            }
        };

        // For a pie chart
        var ctx2 = document.getElementById('chartDonut');
        var myDonutChart = new Chart(ctx2, {
            type: 'doughnut'
            , data: datapie
            , options: optionpie
        });



        window.darkMode = function() {
            $('.btn-white').addClass('btn-dark').removeClass('btn-white');

            myDonutChart.options.elements.arc.borderColor = '#141c2b';
            myDonutChart.update();
        }

        window.lightMode = function() {
            $('.btn-dark').addClass('btn-white').removeClass('btn-dark');

            myDonutChart.options.elements.arc.borderColor = '#fff';
            myDonutChart.update();
        }

        var hasMode = Cookies.get('df-mode');
        if (hasMode === 'dark') {
            darkMode();
        } else {
            lightMode();
        }

    })

</script>
@endsection

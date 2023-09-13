@extends('templates.main-user')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-30" id="upHeader">
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/user/make-investment">Make Investment</a></li>
                <li class="breadcrumb-item active" aria-current="page">View Investment</li>
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
                        <h1>Investment Objectives</h1>
                        <img src="http://127.0.0.1:8000/main-user-assets/img/MVP-Inv-Objectives.png" alt="">
                        <div class="margin40 row">
                            <div class="col-md-4">
                                <div class="intro">
                                    <h3>Intro to MCF</h3>
    
                                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem est nam velit.</p>
    
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis necessitatibus vel ratione dolorum aspernatur officia corrupti, sit qui ad odit iste molestias placeat est aliquid magni vero quis beatae accusantium.</p>
    
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos animi magnam non molestias, est sit!</p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="intro">
                                    <h3>Benefits to Investors</h3>
    
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis necessitatibus vel ratione dolorum aspernatur officia corrupti, sit qui ad odit iste molestias placeat est aliquid magni vero quis beatae accusantium.</p>
    
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos animi magnam non molestias, est sit!</p>
    
                                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem est nam velit.</p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="intro">
                                    <h3>Team</h3>
    
                                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem est nam velit.</p>
    
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos animi magnam non molestias, est sit!</p>
    
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis necessitatibus vel ratione dolorum aspernatur officia corrupti, sit qui ad odit iste molestias placeat est aliquid magni vero quis beatae accusantium.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="set5 margin50">
                        <h1> Highlights</h1>
                        <div class="margin40">
                            <div class="mb-3 opt1">
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem est nam velit.Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis necessitatibus vel ratione dolorum aspernatur officia corrupti, sit qui ad odit iste molestias placeat est aliquid magni vero quis beatae accusantium.</p>
                            </div>

                            <div class="mb-3 opt1">
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem est nam velit.Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis necessitatibus vel ratione dolorum aspernatur officia corrupti, sit qui ad odit iste molestias placeat est aliquid magni vero quis beatae accusantium.</p>
                            </div>

                            <div class="mb-3 opt1">
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem est nam velit.Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis necessitatibus vel ratione dolorum aspernatur officia corrupti, sit qui ad odit iste molestias placeat est aliquid magni vero quis beatae accusantium.</p>
                            </div>

                            <div class="mb-3 opt1">
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem est nam velit.Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis necessitatibus vel ratione dolorum aspernatur officia corrupti, sit qui ad odit iste molestias placeat est aliquid magni vero quis beatae accusantium.</p>
                            </div>
                        </div>


                    </div>
                    <div class="set6 margin50">
                        <h1>Investment structure </h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis necessitatibus vel ratione dolorum aspernatur officia corrupti, sit qui ad odit iste molestias placeat est aliquid magni vero quis beatae accusantium.Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos animi magnam non molestias, est sit!</p>

                        <div class="margin40 row">
                            <div class="col-md-4">
                               <div class="seek">
                                <h3>Seeking to outperform public markets</h3>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem est nam velit.</p>
                               </div>
                            </div>

                            <div class="col-md-4">
                               <div class="seek">
                                <h3>Investing in top-performing buyout manager</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis necessitatibus vel ratione dolorum aspernatur officia corrupti, sit qui ad odit iste molestias placeat est aliquid magni vero quis beatae accusantium.</p>
                               </div>
                            </div>

                            <div class="col-md-4">
                               <div class="seek">
                                <h3>Providing diversified investment focus</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos animi magnam non molestias, est sit!</p>
                               </div>
                            </div>
                        </div>

                        <div class="margin40 row">
                            <div class="col-md-4">
                               <div class="seek">
                                <h3>Seeking to outperform public markets</h3>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem est nam velit.</p>
                               </div>
                            </div>

                            <div class="col-md-4">
                               <div class="seek">
                                <h3>Investing in top-performing buyout manager</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis necessitatibus vel ratione dolorum aspernatur officia corrupti, sit qui ad odit iste molestias placeat est aliquid magni vero quis beatae accusantium.</p>
                               </div>
                            </div>

                            <div class="col-md-4">
                               <div class="seek">
                                <h3>Providing diversified investment focus</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos animi magnam non molestias, est sit!</p>
                               </div>
                            </div>
                        </div>

                    </div>

                    <div class="set7 margin50">
                        <h1>Illustrative portfolio diversification</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis necessitatibus vel ratione dolorum aspernatur officia corrupti, sit qui ad odit iste molestias placeat est aliquid magni vero quis beatae accusantium.Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos animi magnam non molestias, est sit!</p>

                        <div class="margin40 row">
                            <div class="col-md-4">
                               <div class="seek">
                                <h3>Seeking to outperform public markets</h3>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem est nam velit.</p>
                               </div>
                            </div>

                            <div class="col-md-4">
                               <div class="seek">
                                <h3>Investing in top-performing buyout manager</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis necessitatibus vel ratione dolorum aspernatur officia corrupti, sit qui ad odit iste molestias placeat est aliquid magni vero quis beatae accusantium.</p>
                               </div>
                            </div>

                            <div class="col-md-4">
                               <div class="seek">
                                <h3>Providing diversified investment focus</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos animi magnam non molestias, est sit!</p>
                               </div>
                            </div>
                        </div>
                        <div class="margin40 row">
                            <div class="col-md-4">
                               <div class="seek">
                                <h3>Seeking to outperform public markets</h3>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem est nam velit.</p>
                               </div>
                            </div>

                            <div class="col-md-4">
                               <div class="seek">
                                <h3>Investing in top-performing buyout manager</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis necessitatibus vel ratione dolorum aspernatur officia corrupti, sit qui ad odit iste molestias placeat est aliquid magni vero quis beatae accusantium.</p>
                               </div>
                            </div>

                            <div class="col-md-4">
                               <div class="seek">
                                <h3>Providing diversified investment focus</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos animi magnam non molestias, est sit!</p>
                               </div>
                            </div>
                        </div>

                        <p><a href="https://images.unsplash.com/photo-1689895550279-2e64ee1cb432?ixlib=rb-4.0.3&amp;amp;ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&amp;amp;auto=format&amp;amp;fit=crop&amp;amp;w=2940&amp;amp;q=80" target="_blank"><img alt="" src="https://images.unsplash.com/photo-1689895550279-2e64ee1cb432?ixlib=rb-4.0.3&amp;amp;ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&amp;amp;auto=format&amp;amp;fit=crop&amp;amp;w=2940&amp;amp;q=80" style="height:400px; width:100% object-fit:cover" /></a></p>

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

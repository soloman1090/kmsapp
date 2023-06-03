@extends('templates.main-user')

@section('content')
<style>
    .requestKey {
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.642);
        position: absolute;
        z-index: 1;
    }

    .requestKey .content {
        width: 40%;
        margin: auto;
        margin-top: 100px;
    }

    .show_voyage {
        position: relative
    }

    .mdi {
        font-size: 30px
    }

    @media (max-width:800px) {
        .requestKey {
            width: 100%;
        }

        .requestKey .content {
            width: 100%;
        }
    }

    /*Now the CSS*/
    * {
        margin: 0;
        padding: 0;
    }

    .tree {
        overflow: scroll;
    }

    .tree ul {
        padding-top: 20px;
        position: relative;

        transition: all 0.5s;
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
    }

    .tree li {
        float: left;
        text-align: center;
        list-style-type: none;
        position: relative;
        padding: 20px 5px 0 5px;

        transition: all 0.5s;
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
    }

    /*We will use ::before and ::after to draw the connectors*/

    .tree li::before,
    .tree li::after {
        content: '';
        position: absolute;
        top: 0;
        right: 50%;
        border-top: 1px solid #ccc;
        width: 50%;
        height: 20px;
    }

    .tree li::after {
        right: auto;
        left: 50%;
        border-left: 1px solid #ccc;
    }

    /*We need to remove left-right connectors from elements without 
any siblings*/
    .tree li:only-child::after,
    .tree li:only-child::before {
        display: none;
    }

    /*Remove space from the top of single children*/
    .tree li:only-child {
        padding-top: 0;
    }

    /*Remove left connector from first child and 
right connector from last child*/
    .tree li:first-child::before,
    .tree li:last-child::after {
        border: 0 none;
    }

    /*Adding back the vertical connector to the last nodes*/
    .tree li:last-child::before {
        border-right: 1px solid #ccc;
        border-radius: 0 5px 0 0;
        -webkit-border-radius: 0 5px 0 0;
        -moz-border-radius: 0 5px 0 0;
    }

    .tree li:first-child::after {
        border-radius: 5px 0 0 0;
        -webkit-border-radius: 5px 0 0 0;
        -moz-border-radius: 5px 0 0 0;
    }

    /*Time to add downward connectors from parents*/
    .tree ul ul::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        border-left: 1px solid #ccc;
        width: 0;
        height: 20px;
    }

    .tree li a {
        border: 1px solid #ccc;
        padding: 5px 10px;
        text-decoration: none;
        color: #666;
        font-family: arial, verdana, tahoma;
        font-size: 11px;
        display: inline-block;

        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;

        transition: all 0.5s;
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
    }

    /*Time for some hover effects*/
    /*We will apply the hover effect the the lineage of the element also*/
    .tree li a:hover,
    .tree li a:hover+ul li a {
        background: #c8e4f8;
        color: #000;
        border: 1px solid #94a0b4;
    }

    /*Connector styles on hover*/
    .tree li a:hover+ul li::after,
    .tree li a:hover+ul li::before,
    .tree li a:hover+ul::before,
    .tree li a:hover+ul ul::before {
        border-color: #94a0b4;
    }

</style>




<div class="card">
    <div class="">
        <img src="{{ asset('user-assets/images/widgets/voyage.jpg') }}" alt="" style="width: 100%; border-top-left-radius: 10px;
border-top-right-radius: 10px;" >
        @if($voyager==null || $voyager->status=="pending" )
        <div class="requestKey ">
            <div class="content">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Activate Voyager Program</h4>
                        <p>Please check your email for the Activation Key</p>
                    </div>
                    <div class="card-body text-center">
                        <form id="" action="{{ route('user.voyager-program.update', $user->user_id) }}" method="POST">
                            @csrf
                            @method("put")
                            <div class="form-group">
                                <label for="key">Enter Activation Key</label>
                                <input type="text" placeholder="Enter 12 Digit key e.g 2be8oovec5u9vp9" name="activation_key" class="form-control">
                            </div>
                            <button class="btn btn-primary">Activate Program</button>
                        </form>
                        <div class="m-3 text-center text-muted">
                            <p class="mb-0">Dont have Activation key ? <a href="voyager-program?request" class="text-primary ms-2">Request Key</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @elseif($voyager->status=="revoked")
        <div class="requestKey ">
            <div class="content">
                <div class="card">
                    <div class="card-header text-center">
                        <h1><i class="mdi mdi-account-lock text-danger" style="font-size: 80px"></i></h1>
                        <h4>Your Voyager Account Has been blocked, Please contact support to get it activated</h4>
                    </div>
        
                </div>
            </div>
        </div>
        @endif
        
        <div class="show_voyage">
            <div class="row">
        
                <div class="col">
                    <div class="">
                        <span class="badge badge-outline-primary"><b>Referal Link: </b> <span class="badge  badge-soft-primary p-3"> https://palmalliance.com/register/?refer={{ $referral_code }} </span></span>
                        <input id="refereee" class="form-control" placeholder="show here" />
                    </div>
                </div>
                <div class="col-auto">
                    <div class="text-center m-2">
                        <a class="btn btn-outline-primary" id="referralLink" href="#" referral_id="{{ $referral_code }}">Copy Referral Link</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h1><b>Voyager Program</b> </h1>
                        </div>
                        <div class="card-body">
                            <h4>Summary Of Voyager Clients</h4>
                            <p>This is the total number of partners in your members’ benefit programme and the cumulative invested value through your programme.</p>
                            <div class="row">
                                <div class="col-5">
                                    <label for=""><b>Total Members</b></label>
                                    <h3><i class="mdi mdi-account text-primary"></i><b> {{ $totalReferrals }}</b></h3>
                                </div>
                                <div class="col-7">
                                    <label for=""><b>Total Amount</b></label>
                                    <h3><i class="mdi mdi-wallet text-primary"></i><b> ${{ $accumulatedBonus }}</b></h3>
                                </div>
                            </div>
        
                            <h6>Progress Level: {{$level_descp}}</h6>
                            <div class="progress m-1 pro pl-2" style="height:20px;">
                                <div class="progress-bar pro or" role="progressbar" aria-label="Example with label" style="width: {{$currentPrecentage}}%;  " aria-valuenow="p{{$currentPrecentage}}" aria-valuemin="0" aria-valuemax="100"><b>{{$currentPrecentage}}%</b></div>
                            </div>
                            <br>
                            @if($voyager==null || $voyager->status=="pending" )
                            <div class="card bg-danger p-3 text-white text-center">
                                <h3 class="text-white">Voyager Account </h3>
                                <br>
                                <h4><i class="mdi mdi-reload text-white"></i><span class="text-white">Inactive</b></h4>
        
                            </div>
                            @else
                            <div class="card bg-primary p-3 text-white text-center">
                                <h3 class="text-white">Voyager Bonus </h3>
                                <h1><i class="mdi mdi-wallet text-white"></i><b class="text-white"> ${{ $voyager->amount??"0.00" }}</b></h1>
                                <br>
                                <h5 class="text-white">8 Months Compouding</h5>
                                <div class="progress m-2 pro">
                                    <div class="progress-bar pro or" role="progressbar" aria-label="Example with label" style="width: {{ $daysLeft }}%;" aria-valuenow="p{{ $daysLeft }}" aria-valuemin="0" aria-valuemax="100"><b>{{ $days }} Days Left</b></div>
                                </div>
                            </div>
        
                            @endif
        
        
                        </div>
        
                    </div>
                </div>
        
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card {{ $level=="Level_1" ?"bg-dark" :"bg-white"   }} text-white border-dark">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h3><b class=" {{ $level=="Level_1" ?"text-white" :"text-dark"   }}">Voyager Basic</b></h3>
                                        </div>
                                        <div class="col-auto">
        
                                            <h6>{!! $level=="Level_1" ? '<i class="mdi mdi-account-check text-white"></i> ' : '<i class="mdi mdi-account-lock text-dark"></i> '!!}</h6>
                                        </div>
                                    </div>
                                    <h1 class="{{ $level=="Level_1" ?"text-white" :"text-dark"   }} "><b>$ 100,000.00</b></h1>
                                    <p class="{{ $level=="Level_1" ?"text-white" :"text-dark"   }}">12% - Commission</p>
                                </div>
                            </div>
                        </div>
        
                        <div class="col-md-6">
                            <div class="card {{ $level=="Level_2" ?"bg-dark" :"bg-white"   }} text-white border-dark">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h3><b class="{{ $level=="Level_2" ?"text-white" :"text-dark"   }}">Voyager Inter</b></h3>
                                        </div>
                                        <div class="col-auto">
                                            <h6>{!! $level=="Level_2" ? '<i class="mdi mdi-account-check text-white"></i> ' : '<i class="mdi mdi-account-lock text-dark"></i> '!!}</h6>
                                        </div>
                                    </div>
                                    <h1 class="{{ $level=="Level_2" ?"text-white" :"text-dark"   }} "><b>$ 500,000.00</b></h1>
                                    <p class="{{ $level=="Level_2" ?"text-white" :"text-dark"   }}">12% Commission</p>
                                </div>
                            </div>
                        </div>
        
                        <div class="col-md-6">
                            <div class="card {{ $level=="Level_3" ?"bg-dark" :"bg-white"   }} text-white border-dark">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h3><b class="{{ $level=="Level_3" ?"text-white" :"text-dark"   }}">Voyager Pro</b></h3>
                                        </div>
                                        <div class="col-auto">
                                            <h6>{!! $level=="Level_3" ? '<i class="mdi mdi-account-check text-white"></i> ' : '<i class="mdi mdi-account-lock text-dark"></i> '!!}</h6>
                                        </div>
                                    </div>
                                    <h1 class="{{ $level=="Level_3" ?"text-white" :"text-dark"   }} "><b>$ 1,000,000.00</b></h1>
                                    <p class="{{ $level=="Level_3" ?"text-white" :"text-dark"   }}">12% Commission</p>
                                </div>
                            </div>
                        </div>
        
                        <div class="col-md-6">
                            <div class="card {{ $level=="Level_4" ?"bg-dark" :"bg-white"   }} text-white border-dark">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h3><b class="{{ $level=="Level_4" ?"text-white" :"text-dark"   }}">Voyager Silver</b></h3>
                                        </div>
                                        <div class="col-auto">
                                            <h6>{!! $level=="Level_4" ? '<i class="mdi mdi-account-check text-white"></i> ' : '<i class="mdi mdi-account-lock text-dark"></i> '!!}</h6>
                                        </div>
                                    </div>
                                    <h1 class="{{ $level=="Level_4" ?"text-white" :"text-dark"   }} "><b>$ 2,000,000.00</b></h1>
                                    <p class="{{ $level=="Level_4" ?"text-white" :"text-dark"   }}">12% Commission</p>
                                </div>
                            </div>
                        </div>
        
                        <div class="col-md-6">
                            <div class="card {{ $level=="Level_5" ?"bg-dark" :"bg-white"   }} text-white border-dark">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h3><b class="{{ $level=="Level_5" ?"text-white" :"text-dark"   }}">Voyager Bronze</b></h3>
                                        </div>
                                        <div class="col-auto">
                                            <h6>{!! $level=="Level_5" ? '<i class="mdi mdi-account-check text-white"></i> ' : '<i class="mdi mdi-account-lock text-dark"></i> '!!}</h6>
                                        </div>
                                    </div>
                                    <h1 class="{{ $level=="Level_5" ?"text-white" :"text-dark"   }} "><b>$ 5,000,000.00</b></h1>
                                    <p class="{{ $level=="Level_5" ?"text-white" :"text-dark"   }}">12% Commission</p>
                                </div>
                            </div>
                        </div>
        
                        <div class="col-md-6">
                            <div class="card {{ $level=="Level_6" ?"bg-dark" :"bg-white"   }} text-white border-dark">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h3><b class="{{ $level=="Level_6" ?"text-white" :"text-dark"   }}">Voyager Gold</b></h3>
                                        </div>
                                        <div class="col-auto">
                                            <h6>{!! $level=="Level_6" ? '<i class="mdi mdi-account-check text-white"></i>' : '<i class="mdi mdi-account-lock text-dark"></i> '!!}</h6>
                                        </div>
                                    </div>
                                    <h1 class="{{ $level=="Level_6" ?"text-white" :"text-dark"   }}"><b>$ 10,000,000.00</b></h1>
                                    <p class="{{ $level=="Level_6" ?"text-white" :"text-dark"   }}">12% Commission</p>
                                </div>
                            </div>
                        </div>
        
                    </div>
                </div>
            </div>
        
            {{-- <div class="container">
        
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Referral Binary Tree</h2>
                        <p class="text-danger"><b>Hover your mouse on Member to view Highlighted Downlines</b></p>
                    </div>
                    <div class="card-body">
                        <div class="tree zoomTarget" data-scalemode="width" data-nativeanimation="true" id="tree">
                            <ul>
                                <li class="continer-wrap">
                                    <a href="#"><i class="mdi mdi-account text-primary" style="font-size: 50px;"></i>
                                        <div><b>ME</b></div>
                                    </a>
                                    <ul class="row flex-nowrap">
                                        @foreach ($referrals as $key=>$ref )
        
                                        STAGE 1
        
                                        <li class="col-2 continer-wrap">
                                            <a href="#"><i class="mdi mdi-account"></i>
                                                <div><small>{{ $ref->name  }} {{ $ref->last_name  }}</small></div>
                                                <h6>$ {{ $ref->totalInvested }}</h6>
                                            </a>
                                            <ul class="row flex-nowrap">
                                                @foreach ($ref->stage1Users as $key=>$refStage1 )
        
                                                STAGE 2
        
                                                <li class="col-6 continer-wrap">
                                                    <a href="#"><i class="mdi mdi-account"></i>
                                                        <div><small>{{ $refStage1->name  }} {{ $refStage1->last_name  }} </small></div>
                                                        <h6>$ {{ $refStage1->totalInvested }}</h6>
                                                    </a>
        
                                                    <ul class="row flex-nowrap">
                                                        @foreach ($refStage1->stage2Users as $key=>$refStage2 )
        
                                                        STAGE 3
        
                                                        <li class="col-8 continer-wrap">
                                                            <a href="#"><i class="mdi mdi-account"></i>
                                                                <div><small>{{ $refStage2->name  }} {{ $refStage2->last_name  }}</small></div>
                                                                <h6>$ {{ $refStage2->totalInvested }}</h6>
                                                            </a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
        
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <p class="text-danger text-center"><b> 1) Scroll LEFT and RIGHT to view other downlines <br />2) Hover your mouse on Member to view Highlighted Downlines</b></p>
                </div>
            </div> --}}
        
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3>My Partners</h3>
                        </div>
                        <div class="card-body p-2">
                            <div class="chat-message-list" data-simplebar>
                                <div class="pt-3">
            
                                    <ul class="list-unstyled chat-list " id="firstLevel">
            
                                        <div class="text-center">
                                            <i class="mdi mdi-account-group  font-size-30"></i>
                                            <br>
                                            <h4>No Selected Referrals Yet</h4>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 id="firstLevelName"> </h5>
                            <h6>Second Level Partners</h6>
                        </div>
                        <div class="card-body p-2">
                            <div class="chat-message-list" data-simplebar>
                                <div class="pt-3">
            
                                    <ul class="list-unstyled chat-list " id="secondLevel">
            
                                        <div class="text-center">
                                            <i class="mdi mdi-account-group font-size-30"></i>
                                            <br>
                                            <h4>No Selected Referrals Yet</h4>
                                        </div>
                                    </ul>
                                </div>
                            </div>
            
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 id="secondLevelName"> </h5>
                            <h6>Third Level Partners</h6>
                        </div>
                        <div class="card-body p-2">
                            <div class="chat-message-list" data-simplebar>
                                <div class="pt-3">
            
                                    <ul class="list-unstyled chat-list " id="thirdLevel">
            
                                        <div class="text-center">
                                            <i class="mdi mdi-account-group font-size-30"></i>
                                            <br>
                                            <h4>No Referrals Yet</h4>
                                        </div>
                                    </ul>
                                </div>
                            </div>
            
            
                        </div>
                    </div>
                </div>
            
            
            
            
            
            
            </div>
        
        </div>
    </div>
</div>


<script src="{{ asset('user-assets/js/jquery.min.js') }}"></script>

<script>

    
    let referrals = {!!json_encode($referrals) !!}

    let firstLevel = ""
    let selectedIndex ;

    referrals.forEach((ref, index) => {
        firstLevel += `<li class=" firstLevelReferral" data-id="${index}">
                        <a href="#" disabled="disabled">
                            <div class="d-flex align-items-start">

                                <div class="flex-shrink-0 user-img online align-self-center me-3">
                                    <div class="avatar-sm align-self-center">
                                        <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                            <i class="mdi mdi-account "></i>
                                        </span>
                                    </div>

                                </div>

                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="text-truncate font-size-14 mb-1">$${ref['totalInvested'].toLocaleString('en-US')}</h5>
                                    <p class="text-truncate mb-0">${ref['name']} <small>${ref['email']}</small></p>
                                </div>
                                <div class="flex-shrink-0">
                                    ${ref['stage1Users'].length>0?`<div class="font-size-11 text-success">+${ref['stage1Users'].length}-Referrals</div>`:`<div></div>`}
                                    
                                </div>
                                <div class="unread-message">
                                    ${ref['stage1Users'].length>0?` <span class="badge bg-secondary rounded-pill"> <i class="mdi mdi-arrow-right " style="font-size: 14px !important"></i></span>`:`<span></span>`}
                                   
                                </div>
                            </div>
                        </a>
                    </li>`
    });
    $("#firstLevel").html(firstLevel)

    $(".firstLevelReferral").removeClass("active")
    $(".secondLevelReferral").removeClass("active")
    $(".thirdLevelReferral").removeClass("active")

    $("#firstLevel").on('click','.firstLevelReferral', function(e) {
        e.preventDefault();
        $(".firstLevelReferral").removeClass("active")
        $(this).addClass("active")
        let index=$(this).attr("data-id")
        let secLevel=""
        selectedIndex=index
        $("#firstLevelName").html(`${referrals[index]["name"]} - ${referrals[index]["email"]}`)


        referrals[index]["stage1Users"].forEach((ref, index) => {
        secLevel += `<li class=" secondLevelReferral" data-id="${index}">
                        <a href="#" disabled="disabled">
                            <div class="d-flex align-items-start">

                                <div class="flex-shrink-0 user-img online align-self-center me-3">
                                    <div class="avatar-sm align-self-center">
                                        <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                            <i class="mdi mdi-account "></i>
                                        </span>
                                    </div>

                                </div>

                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="text-truncate font-size-14 mb-1">$${ref['totalInvested'].toLocaleString('en-US')}</h5>
                                    <p class="text-truncate mb-0">${ref['name']} <small>${ref['email']}</small></p>
                                </div>
                                <div class="flex-shrink-0">
                                    ${ref['stage2Users'].length>0?`<div class="font-size-11 text-success">+${ref['stage2Users'].length}-Referrals</div>`:`<div></div>`}
                                </div>
                                <div class="unread-message">
                                    ${ref['stage2Users'].length>0?` <span class="badge bg-secondary rounded-pill"> <i class="mdi mdi-arrow-right " style="font-size: 14px !important"></i></span>`:`<span></span>`}
                                </div>
                            </div>
                        </a>
                    </li>`
    });
    $("#secondLevel").html(secLevel)

    })

    $("#secondLevel").on('click','.secondLevelReferral', function(e) {
        $(".secondLevelReferral").removeClass("active")
        e.preventDefault();
        $(this).addClass("active")
        let index=$(this).attr("data-id")
        let thirdLevel=""
        $("#secondLevelName").html(`${referrals[selectedIndex]["stage1Users"][index]["name"]} - ${referrals[selectedIndex]["stage1Users"][index]["email"]}`)

        referrals[selectedIndex]["stage1Users"][index]["stage2Users"].forEach((ref, index) => {
            thirdLevel += `<li class=" secondLevelReferral" data-id="${index}">
                        <a href="#" disabled="disabled">
                            <div class="d-flex align-items-start">

                                <div class="flex-shrink-0 user-img online align-self-center me-3">
                                    <div class="avatar-sm align-self-center">
                                        <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                            <i class="mdi mdi-account "></i>
                                        </span>
                                    </div>

                                </div>

                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="text-truncate font-size-14 mb-1">$${ref['totalInvested'].toLocaleString('en-US')}</h5>
                                    <p class="text-truncate mb-0">${ref['name']} <small>${ref['email']}</small></p>
                                </div>
                                
                            </div>
                        </a>
                    </li>`
    });
    $("#thirdLevel").html(thirdLevel)
    })

    $(".thirdLevelReferral").on('click', function(e) {
        e.preventDefault();
        $(".thirdLevelReferral").removeClass("active")
        $(this).addClass("active")
    })

</script>




@endsection

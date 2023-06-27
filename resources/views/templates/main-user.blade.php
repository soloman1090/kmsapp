<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/minia-symfony/layouts/layouts-horizontal.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 02 Jan 2023 11:16:43 GMT -->
<head>

    <meta charset="utf-8" />
    <title>{{ $page_title }} | Dell Group Member</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Dell Group Members Dashboard" name="description" />
    <meta content="Dell Group" name="Dell Group" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin-assets/img/fav-icon.png') }}">
    <link rel="icon" href="{{ asset('admin-assets/img/fav-icon.png') }}" type="image/x-icon">

    <!-- plugin css -->
    <link href="{{ asset('main-user-assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user-assets/css/circle.css') }}" rel="stylesheet">
    <!-- preloader css -->
    <link rel="stylesheet" href="{{ asset('main-user-assets/css/preloader.min.css') }}" type="text/css" />
    <link href="{{ asset('user-assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="{{ asset('main-user-assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('main-user-assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('main-user-assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    
    <link href="{{ asset('main-user-assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('main-user-assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
 </head>

<body data-layout="horizontal">

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="dashboard" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ asset('admin-assets/img/logo.png') }}" alt="" height="54">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('admin-assets/img/logo.png') }}" alt="" height="54">
                            </span>
                        </a>

                        <a href="index.html" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ asset('admin-assets/img/logo.png') }}" alt="" height="54">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('admin-assets/img/logo.png') }}" alt="" height="54">
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    <!-- App Search-->
                    <div class="dropdown d-none d-sm-inline-block">
                        <button type="button" class="  header-item">
                            <h4 class="page-title">{{ $page_title }}</h4>
                        </button>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="dropdown d-inline-block">
                        @impersonate()
                        <button type="button" class="btn header-item  me-2">
                            <a class=" btn btn-sm btn-success" href="{{ route('admin.impersonate.destroy') }}" role="button"><i class="fas fa-sign-in-alt mr-3"></i> Back to Admin</a>
                        </button>
                        @endimpersonate
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="{{ asset('uploads/'.$user->image ) }}" alt="">
                            <span class="d-none d-xl-inline-block ms-1 fw-medium">{{ $username }}</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="profile"><i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> Profile</a>
                            <a class="dropdown-item" href="profile"><i class="mdi mdi-setting font-size-16 align-middle me-1"></i> Settings</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }} " onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <div class="topnav">
            <div class="container-fluid">
                <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="dashboard" id="topnav-dashboard" role="button">
                                    <i class="mdi mdi-home"></i><span data-key="t-dashboards"> Dashboard</span>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="message" id="topnav-dashboard" role="button">
                                   <i class="mdi mdi-message"></i><span data-key="t-horizontal"> Message</span>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="profile" id="topnav-dashboard" role="button">
                                    <i class="mdi mdi-account"></i><span data-key="t-horizontal">Profile</span>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-Security" role="button">
                                    <i class="mdi mdi-lock"></i><span data-key="t-Security">Security</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-Security">

                                    <a href="change-password" class="dropdown-item" data-key="t-Password">Change Password</a>
                                    <a href="two-factor" class="dropdown-item" data-key="t-2FA">2FA</a>

                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-account" role="button">
                                     <i class="mdi mdi-file-chart"></i><span data-key="t-Account"> Account</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-Account">
                                    <a href="activity" class="dropdown-item" data-key="t-activity">Transaction Activity</a>
                                    <a href="transfer" class="dropdown-item" data-key="t-transfer">Inter Account Transfer</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                     <i class="mdi mdi-briefcase"></i><span data-key="t-apps"> Portfolios</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">
                                    <a href="view-investments-portfolio" class="dropdown-item" data-key="t-chat">Purchase Investment Portfolio</a>
                                    <a href="user-investments" class="dropdown-item" data-key="t-calendar">Active Investment Portfolios</a>
                                    <a href="investment-history" class="dropdown-item" data-key="t-calendar">Investments Portfolio History</a>
                                    {{-- <a href="value-pods" class="dropdown-item" data-key="t-calendar">Unique Value Pods</a> --}}
                                    <a href="short-term-funds" class="dropdown-item" data-key="t-calendar">Short Term Funds</a>
                                    
                                    <a href="investment-calculator" class="dropdown-item" data-key="t-calendar">Investment Calculator</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                      <i class="mdi mdi-account-group"></i><span data-key="t-apps"> Referrals</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">
                                    <a href="referred-users" class="dropdown-item" data-key="t-chat">Referred Members</a>
                                    <a href="referral-bonus" class="dropdown-item" data-key="t-calendar">Members Benefit Commissions</a>
                                    <a href="voyager-program" class="dropdown-item" data-key="t-calendar">Voyager Program</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                     <i class="mdi mdi-wallet"></i><span data-key="t-apps">Withdrawals</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">
                                    <a href="withdrawal-request" class="dropdown-item" data-key="t-chat">Withdrawal Request</a>
                                    <a href="withdrawal-history" class="dropdown-item" data-key="t-calendar">Withdrawal-history</a>
                                </div>
                            </li>


                            {{-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none text-danger" href="{{ route('logout') }} "
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >
                                    
                                    <i class="mdi mdi-logout"></i><span data-key="t-horizontal">Log-Out</span>
                                </a>
                               
                            </li> --}}

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                                @csrf
                            </form>
                            

                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                <!-- Page-Title -->

                <main>

                    @include('partials.user-alerts')
                    @yield('content')
                    <br>
                    <br>
                    <br>
                </main>
            </div>
            </div>
            <!-- End Page-content -->


            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Dell Group.
                        </div>

                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    {{-- <script src="//code.tidio.co/m3tedumpoleevbbgdo0jcfis2q8wynay.js" async></script> --}}

    <script>
        //Set your APP_ID
var APP_ID = "v8g92rpj";

window.intercomSettings = {
 app_id: APP_ID
};
(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/' + APP_ID;var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);};if(document.readyState==='complete'){l();}else if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
      </script>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('main-user-assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('main-user-assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user-assets/js/skippr.min.js') }}"></script>
    <script>
        $("#newsSlider").skippr({
            transition: 'slide'
            , speed: 1000
            , easing: 'easeOutQuart'
            , navType: ''
            , childrenElementType: 'div'
            , arrows: false
            , autoPlay: true
            , autoPlayDuration: 5000
            , keyboardOnAlways: true
            , hidePrevious: false

        });

    </script>
    <script>
        let refData = document.getElementById("refereee")
        refData.style.visibility = "hidden";
        $('#referralLink').on('click', function() {
            refData.style.visibility = "visible";
            $(this).attr('referral_id')
            let link = `https://Dell Group.com/register/?refer=${$(this).attr('referral_id')}`

            refData.value = link;
            refData.select();
            refData.setSelectionRange(0, 99999);

            document.execCommand("copy");


            try {
                alert("Referral Link Copied ");
            } catch (error) {
                alert(`Copy Error: ${error}`)
                console.log(`Copy Error: ${error}`);
            }
            refData.style.visibility = "hidden";
        })

    </script>

    <script src="{{ asset('main-user-assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('main-user-assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('main-user-assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('main-user-assets/libs/feather-icons/feather.min.js') }}"></script>

    <!-- pace js -->
    <script src="{{ asset('main-user-assets/libs/pace-js/pace.min.js')}}"></script>

    <!-- apexcharts -->
    <script src="{{ asset('main-user-assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Required datatable js -->
    <script src="{{ asset('main-user-assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('main-user-assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Plugins js-->
    <script src="{{ asset('main-user-assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('main-user-assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}"></script>

 
    <!-- Responsive examples -->
    <script src="{{ asset('main-user-assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('main-user-assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('main-user-assets/js/pages/datatables.init.js') }}"></script>

    <!-- dashboard init -->
    <script src="{{ asset('main-user-assets/js/pages/dashboard.init.js') }}"></script>
    <script src="{{ asset('main-user-assets/js/app.js') }}"></script>


</body>
</html>

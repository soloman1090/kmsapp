<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from phantom-themes.com/metro/theme/templates/admin1/layout-fixed-sidebar-header.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Sep 2021 11:49:52 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>{{ $page_title }} | Palm User</title>
    <link rel="shortcut icon" href="{{ asset('admin-assets/img/fav-icon.png') }}">
	<link rel="icon" href="{{ asset('admin-assets/img/fav-icon.png') }}" type="image/x-icon">

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="{{ asset('user-assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user-assets/css/metisMenu.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user-assets/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet">
        <!-- DataTables -->
        <link href="{{ asset('user-assets/plugins/datatables/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('user-assets/plugins/datatables/buttons.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="{{ asset('user-assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('user-assets/css/circle.css') }}" rel="stylesheet">

    <!-- Theme Styles -->
    <link href="{{ asset('user-assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('user-assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
      .datatable-buttons thead{background-color:black; color:white;}
       .datatable-buttons tfoot{background-color:black; color:white;}
    </style>
</head>

<body>

    <!-- Left Sidenav -->
    <div class="left-sidenav">
        <!-- LOGO -->
        <div class="brand">
            <a href="/" class="logo">
                <span>
                    <img src="{{ asset('admin-assets/img/logo.png') }}" alt="logo-small" class="logo-sm">
                </span>
                <span>
                </span>
            </a>
        </div>
        <!--end logo-->
        <div class="menu-content h-100" data-simplebar>
            <ul class="metismenu left-sidenav-menu">

                <li class="menu-label mt-0">Main</li>
                                <hr class="hr-dashed hr-menu">

                <li>
                    <a href="dashboard"> <i data-feather="home"
                            class="align-self-center menu-icon"></i><span>Dashboard</span></a>
                </li>
                 <li>
                    <a href="message"> <i data-feather="message-circle"
                            class="align-self-center menu-icon"></i><span>Messages</span></a>
                </li>

                <li class="menu-label my-2">Account</li>
                                <hr class="hr-dashed hr-menu">

                <li>
                    <a href="profile"> <i data-feather="user"
                            class="align-self-center menu-icon"></i><span>Profile</span></a>
                </li>
                {{-- <li>
                    <a href="kyc"> <i data-feather="image" class="align-self-center menu-icon"></i><span>KYC</span><span
                            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                </li>
                <hr class="hr-dashed hr-menu"> --}}
                <li>
                    <a href="javascript: void(0);"><i data-feather="lock"
                            class="align-self-center menu-icon"></i><span>Security</span><span
                            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="change-password"><i class="ti-control-record"></i>Change Password</a></li>
                        <li class="nav-item"><a class="nav-link" href="two-factor"><i class="ti-control-record"></i>2FA</a></li>
                    </ul>
                </li>

                <li class="menu-label my-2">Account Activities</li>

                <hr class="hr-dashed hr-menu">
                <li>
                    <a href="activity"> <i data-feather="activity"
                            class="align-self-center menu-icon"></i><span>Transaction Activity</span></a>
                </li>
                <li>
                    <a href="transfer"> <i data-feather="copy"
                            class="align-self-center menu-icon"></i><span>Inter Account Transfer</span></a>
                </li>

                <li>
                    <a href="javascript: void(0);"><i data-feather="briefcase"
                            class="align-self-center menu-icon"></i><span>Portfolios</span><span
                            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="view-investments-portfolio"><i
                                    class="ti-control-record"></i>Purchase Investment Portfolio</a></li>
                        <li class="nav-item"><a class="nav-link" href="user-investments"><i
                                    class="ti-control-record"></i>Active Investment Portfolios</a></li>
                        <li class="nav-item"><a class="nav-link" href="investment-history"><i
                                    class="ti-control-record"></i>Investments Portfolio History</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);"><i
                            class=" mdi mdi-cash-refund align-self-center menu-icon"></i><span>Withdrawals</span><span
                            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">

                        <li class="nav-item"><a class="nav-link" href="withdrawal-request"><i
                                    class="ti-control-record"></i>Withdrawal Request</a></li>
                        <li class="nav-item"><a class="nav-link" href="withdrawal-history"><i
                                    class="ti-control-record"></i>Withdrawal-history</a></li>
                    </ul>
                </li>

                <li class="menu-label my-2">More </li>
                <hr class="hr-dashed hr-menu">

                <li>
                    <a href="javascript: void(0);"><i data-feather="users"
                            class="align-self-center menu-icon"></i><span>Referrals</span><span
                            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">

                        <li class="nav-item"><a class="nav-link" href="referred-users"><i
                                    class="ti-control-record"></i>Referred Partners</a></li>
                        <li class="nav-item"><a class="nav-link" href="referral-bonus"><i
                                    class="ti-control-record"></i>View Referral Bonus</a></li>
                        {{-- <li class="nav-item"><a class="nav-link" id="referralLink" href="#" referral_id="{{ $user_id }}"  ><i
                                    class="ti-control-record"></i>Copy Referal Link</a></li> --}}
                    </ul>
                </li>



                <li class="menu-label my-2">Exit App</li>
                <div class="update-msg text-center">

                    <a href="{{ route('logout') }} "
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="btn btn-outline-danger btn-sm"> <i data-feather="log-out"
                            class="align-self-center menu-icon"></i> Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                        @csrf
                    </form>
                </div>
            </ul>


        </div>
    </div>

    <div class="page-wrapper">
 <!-- Top Bar Start -->
 <div class="topbar">
    <!-- Navbar -->
    <nav class="navbar-custom">
        <ul class="list-unstyled topbar-nav float-end mb-0">
            @impersonate()
            <li class="creat-btn">
                <div class="nav-link">
                    <a class=" btn btn-sm btn-success" href="{{ route('admin.impersonate.destroy') }}" role="button"><i class="fas fa-sign-in-alt mr-3"></i> Back to Admin</a>
                </div>
            </li>
            @endimpersonate
            <li class="dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-bs-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <span class="ms-1 nav-user-name hidden-sm pr-3">{{ $username }}</span>
                    @if ($user->image=="" || $user->image==null)
                    <img src="{{ asset('user-assets/images/users/default-user.png') }}" alt="profile-user" class="rounded-circle thumb-xs" />
                    @else
                    <img src="{{ asset('uploads/'.$user->image ) }}" alt="profile-user" class="rounded-circle thumb-xs" />
                    @endif

                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="profile"><i data-feather="user" class="align-self-center icon-xs icon-dual me-1"></i> Profile</a>
                    <a class="dropdown-item" href="profile"><i data-feather="settings" class="align-self-center icon-xs icon-dual me-1"></i> Settings</a>
                    <div class="dropdown-divider mb-0"></div>
                    <a class="dropdown-item" href="{{ route('logout') }} "
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i data-feather="power" class="align-self-center icon-xs icon-dual me-1"></i> Logout</a>
                </div>
            </li>

        </ul><!--end topbar-nav-->


        <ul class="list-unstyled topbar-nav mb-0">
            <li>
                <button class="nav-link button-menu-mobile">
                    <i data-feather="menu" class="align-self-center topbar-icon"></i>
                </button>
            </li>


        </ul>
    </nav>
    <!-- end navbar-->
</div>
<!-- Top Bar End -->
 <!-- Page Content-->
 <div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="row">
                        <div class="col">
                            <h4 class="page-title">{{ $page_title }}</h4>

                        </div><!--end col-->

                    </div><!--end row-->
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->
        <main>

            @include('partials.user-alerts')
            @yield('content')
            <br>
            <br>
            <br>
        </main>
    </div>
</div>
</div>




    <!-- Javascripts -->
    <!-- jQuery  -->
    {{-- <script src="//code.tidio.co/m3tedumpoleevbbgdo0jcfis2q8wynay.js" async></script> --}}
   <!-- Start of LiveChat (www.livechat.com) code -->
<script>
    window.__lc = window.__lc || {};
    window.__lc.license = 15255447;
    ;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},get:function(){if(!e._h)throw new Error("[LiveChatWidget] You can't use getters before load.");return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){var n=t.createElement("script");n.async=!0,n.type="text/javascript",n.src="https://cdn.livechatinc.com/tracking.js",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))
</script>
<noscript><a href="https://www.livechat.com/chat-with/15255447/" rel="nofollow">Chat with us</a>, powered by <a href="https://www.livechat.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript>
<!-- End of LiveChat code -->
 
    <script src="{{ asset('user-assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('user-assets/js/skippr.min.js') }}"></script>
        <script>
            $("#newsSlider").skippr({
                transition: 'slide',
                speed: 1000,
                easing: 'easeOutQuart',
                navType: '',
                childrenElementType: 'div',
                arrows: false,
                autoPlay: true,
                autoPlayDuration: 5000,
                keyboardOnAlways: true,
                hidePrevious: false

                });
        </script>
        <script>
         let refData=document.getElementById("refereee")
        refData .style.visibility = "hidden";
         $('#referralLink').on('click', function () {
            refData .style.visibility = "visible";
             $(this).attr('referral_id')
             let link= `https://palmalliance.com/register/?refer=${$(this).attr('referral_id')}`

             refData.value=link;
             refData.select();
             refData.setSelectionRange(0, 99999);

              document.execCommand("copy");


             try {
                alert("Referral Link Copied ");
             } catch (error) {
                 alert(`Copy Error: ${error}`)
                 console.log(`Copy Error: ${error}`);
             }
              refData .style.visibility = "hidden";
         })

        </script>
    <script src="{{ asset('user-assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user-assets/js/metismenu.min.js') }}"></script>
    <script src="{{ asset('user-assets/js/waves.js') }}"></script>
    <script src="{{ asset('user-assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('user-assets/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('user-assets/js/moment.js') }}"></script>


    <script src="{{ asset('user-assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('user-assets/plugins/datatables/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('user-assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('user-assets/plugins/timepicker/bootstrap-material-datetimepicker.js') }}"></script>
    <script src="{{ asset('user-assets/plugins/apex-charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('user-assets/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('user-assets/plugins/jvectormap/jquery-jvectormap-us-aea-en.js') }}"></script>
    <script src="{{ asset('user-assets/pages/jquery.analytics_dashboard.init.js') }}"></script>
    <script src="{{ asset('user-assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('user-assets/pages/jquery.form-upload.init.js') }}"></script>
    {{-- <script src="{{ asset('user-assets/pages/jquery.widgets.init.js') }}"></script> --}}
    <script src="{{ asset('user-assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('user-assets/plugins/datatables/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('user-assets/plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('user-assets/plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('user-assets/plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('user-assets/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('user-assets/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('user-assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('user-assets/pages/jquery.datatable.init.js') }}"></script>
    <script src="{{ asset('user-assets/pages/jquery.forms-advanced.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('user-assets/js/app.js') }}"></script>

    <script src="{{ asset('user-assets/plugins/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ asset('user-assets/pages/jquery.validation.init.js') }}"></script>


</body>

<!-- Mirrored from phantom-themes.com/metro/theme/templates/admin1/layout-fixed-sidebar-header.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Sep 2021 11:49:52 GMT -->

</html>

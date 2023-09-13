<!DOCTYPE html>

<html class="no-js" lang="en">

<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>{{ $page_title }} | Dell Group Admin</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    	<!-- Favicon -->
	<link rel="shortcut icon" href="{{ asset('admin-assets/img/fav-icon.png') }}">
	<link rel="icon" href="{{ asset('admin-assets/img/fav-icon.png') }}" type="image/x-icon">
    <!-- Morris Charts CSS -->
    <link href="{{ asset('admin-assets/vendors/bower_components/morris.js/morris.css') }}" rel="stylesheet" type="text/css"/>
	<!-- Data table CSS -->
	<link href="{{ asset('admin-assets/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>

	<!-- Custom CSS -->
	<link href="{{ asset('admin-assets/dist/css/style.css') }}" rel="stylesheet" type="text/css">



    <!-- Mobile Specific Metas
  ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Font
  ================================================== -->

    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">

    <!-- MAIN STYLE
  ================================================== -->
  <link rel="stylesheet" href="{{ asset('admin-assets/vendors/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" />

  <style>
	@media(max-width:900px){
		.table{
			margin-bottom: 250px !important;
		}
	}
  </style>

<body >
    {{-- <!--Preloader-->
    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>
    <!--/Preloader--> --}}
    <div class="wrapper theme-1-active pimary-color-blue">

         <!-- Top Menu Items -->
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="mobile-only-brand pull-left">
				<div class="nav-header pull-left">
					<div class="logo-wrap">
						<a href="{{ route('admin.dashboard.index') }}">
							<img class="brand-img" src="{{ asset('admin-assets/img/logo.png') }}" alt="brand"/>
						</a>
					</div>
				</div>
				<a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
				<a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-search"></i></a>
				<a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>

			</div>
			<div id="mobile_only_nav" class="mobile-only-nav pull-right">
				<ul class="nav navbar-right top-nav pull-right">



					<li class="dropdown alert-drp">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="zmdi zmdi-notifications top-nav-icon"></i><span class="top-nav-icon-badge">5</span></a>
						<ul  class="dropdown-menu alert-dropdown" data-dropdown-in="bounceIn" data-dropdown-out="bounceOut">
							<li>
								<div class="notification-box-head-wrap">
									<span class="notification-box-head pull-left inline-block">notifications</span>
									<a class="txt-danger pull-right clear-notifications inline-block" href="javascript:void(0)"> clear all </a>
									<div class="clearfix"></div>
									<hr class="light-grey-hr ma-0"/>
								</div>
							</li>
							<li>
								<div class="streamline message-nicescroll-bar">
									<div class="sl-item">
										<a href="javascript:void(0)">
											<div class="icon bg-green">
												<i class="zmdi zmdi-flag"></i>
											</div>
											<div class="sl-content">
												<span class="inline-block capitalize-font  pull-left truncate head-notifications">
												New subscription created</span>
												<span class="inline-block font-11  pull-right notifications-time">2pm</span>
												<div class="clearfix"></div>
												<p class="truncate">Your customer subscribed for the basic plan. The customer will pay $25 per month.</p>
											</div>
										</a>
									</div>
									<hr class="light-grey-hr ma-0"/>
									<div class="sl-item">
										<a href="javascript:void(0)">
											<div class="icon bg-yellow">
												<i class="zmdi zmdi-trending-down"></i>
											</div>
											<div class="sl-content">
												<span class="inline-block capitalize-font  pull-left truncate head-notifications txt-warning">Server #2 not responding</span>
												<span class="inline-block font-11 pull-right notifications-time">1pm</span>
												<div class="clearfix"></div>
												<p class="truncate">Some technical error occurred needs to be resolved.</p>
											</div>
										</a>
									</div>
									<hr class="light-grey-hr ma-0"/>
									<div class="sl-item">
										<a href="javascript:void(0)">
											<div class="icon bg-blue">
												<i class="zmdi zmdi-email"></i>
											</div>
											<div class="sl-content">
												<span class="inline-block capitalize-font  pull-left truncate head-notifications">2 new messages</span>
												<span class="inline-block font-11  pull-right notifications-time">4pm</span>
												<div class="clearfix"></div>
												<p class="truncate"> The last payment for your G Suite Basic subscription failed.</p>
											</div>
										</a>
									</div>
									<hr class="light-grey-hr ma-0"/>
									<div class="sl-item">
										<a href="javascript:void(0)">
											<div class="sl-avatar">
												<img class="img-responsive" src="{{ asset('admin-assets/img/avatar.jpg')}} " alt="avatar"/>
											</div>
											<div class="sl-content">
												<span class="inline-block capitalize-font  pull-left truncate head-notifications">Sandy Doe</span>
												<span class="inline-block font-11  pull-right notifications-time">1pm</span>
												<div class="clearfix"></div>
												<p class="truncate">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
											</div>
										</a>
									</div>
									<hr class="light-grey-hr ma-0"/>
									<div class="sl-item">
										<a href="javascript:void(0)">
											<div class="icon bg-red">
												<i class="zmdi zmdi-storage"></i>
											</div>
											<div class="sl-content">
												<span class="inline-block capitalize-font  pull-left truncate head-notifications txt-danger">99% server space occupied.</span>
												<span class="inline-block font-11  pull-right notifications-time">1pm</span>
												<div class="clearfix"></div>
												<p class="truncate">consectetur, adipisci velit.</p>
											</div>
										</a>
									</div>
								</div>
							</li>
							<li>
								<div class="notification-box-bottom-wrap">
									<hr class="light-grey-hr ma-0"/>
									<a class="block text-center read-all" href="javascript:void(0)"> read all </a>
									<div class="clearfix"></div>
								</div>
							</li>
						</ul>
					</li>
					<li class="dropdown auth-drp">
						<a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="{{ asset('admin-assets/img/user1.png')}}" alt="user_auth" class="user-auth-img img-circle"/><span class="user-online-status"></span></a>
						<ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
							<li>
								<a href="profile.html"><i class="zmdi zmdi-account"></i><span>Profile</span></a>
							</li>
							<li>
								<a href="#"><i class="zmdi zmdi-card"></i><span>my balance</span></a>
							</li>
							<li>
								<a href="inbox.html"><i class="zmdi zmdi-email"></i><span>Inbox</span></a>
							</li>
							<li>
								<a href="#"><i class="zmdi zmdi-settings"></i><span>Settings</span></a>
							</li>
							<li class="divider"></li>
							<li class="sub-menu show-on-hover">
								<a href="#" class="dropdown-toggle pr-0 level-2-drp"><i class="zmdi zmdi-check text-success"></i> available</a>
								<ul class="dropdown-menu open-left-side">
									<li>
										<a href="#"><i class="zmdi zmdi-check text-success"></i><span>available</span></a>
									</li>
									<li>
										<a href="#"><i class="zmdi zmdi-circle-o text-warning"></i><span>busy</span></a>
									</li>
									<li>
										<a href="#"><i class="zmdi zmdi-minus-circle-outline text-danger"></i><span>offline</span></a>
									</li>
								</ul>
							</li>
							<li class="divider"></li>
							<li>
								<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><div class="pull-left"><i class="fa fa-sign-out  mr-20" aria-hidden="true"></i><span class="right-nav-text">Logout</span></div><div class="clearfix"></div></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none">
                        @csrf
                    </form>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
		<!-- /Top Menu Items -->

		<!-- Left Sidebar Menu -->
		<div class="fixed-sidebar-left">
			<ul class="nav navbar-nav side-nav nicescroll-bar">
                <br>
				@if ($priviledge=="admin")
				<li>
					<a href="{{ route('admin.dashboard.index') }}"><div class="pull-left"><i class="zmdi zmdi-apps mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="clearfix"></div></a>
				</li>
                <li><hr class="light-grey-hr mb-10"/></li>
                <li>
					<a href="{{ route('admin.users.index') }}"><div class="pull-left"><i class="fa fa-user mr-20" aria-hidden="true"></i><span class="right-nav-text">Users</span></div><div class="clearfix"></div></a>
				</li>
                <li><hr class="light-grey-hr mb-10"/></li>
                <li>
					<a href="messsages"><div class="pull-left"><i class="fa fa-comment mr-20" aria-hidden="true"></i><span class="right-nav-text">Messages</span></div><div class="clearfix"></div></a>
				</li>
                <li><hr class="light-grey-hr mb-10"/></li>
                <li>
					<a href="javascript:void(0);" data-toggle="collapse" data-target="#contact_dr"><div class="pull-left"><i class="fa fa-btc mr-20" aria-hidden="true"></i><span class="right-nav-text">Investments </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="contact_dr" class="collapse collapse-level-1">
						<li>
							<a href="users-investments">Users Investment</a>
						</li>
                        <li>
							<a href="reinvestments">Reinvestments </a>
						</li>
						<li>
							<a href="investment-packages">Investment Packages</a>
						</li>
						 <li>
							<a href="investment-summary">Investment-Summary </a>
						</li>


					</ul>
				</li>
				<li><hr class="light-grey-hr mb-10"/></li>
				<li>
					<a href="voyagers"><div class="pull-left"><i class="fa fa-ship mr-20" aria-hidden="true"></i><span class="right-nav-text">Voyagers</span></div><div class="clearfix"></div></a>
				</li>
				<li><hr class="light-grey-hr mb-10"/></li>
				<li>
					<a href="activities"><div class="pull-left"><i class="fa fa-area-chart mr-20" aria-hidden="true"></i><span class="right-nav-text">Activities</span></div><div class="clearfix"></div></a>
				</li>
                <li><hr class="light-grey-hr mb-10"/></li>

				<li>
					<a href="surveys"><div class="pull-left"><i class="fa fa-comments mr-20" aria-hidden="true"></i><span class="right-nav-text">Surveys</span></div><div class="clearfix"></div></a>
				</li>
                <li><hr class="light-grey-hr mb-10"/></li>
				<li>
					<a href="content-libary"><div class="pull-left"><i class="fa fa-image mr-20" aria-hidden="true"></i><span class="right-nav-text">Manage Contents</span></div><div class="clearfix"></div></a>
				</li>
				<li><hr class="light-grey-hr mb-10"/></li>
                <li>
					<a href="popups"><div class="pull-left"><i class="fa fa-image mr-20" aria-hidden="true"></i><span class="right-nav-text">Manage Popups</span></div><div class="clearfix"></div></a>
				</li>
				

			  {{--  <li><hr class="light-grey-hr mb-10"/></li>

				<li>
					<a href="javascript:void(0);" data-toggle="collapse" data-target="#ecom_dr"><div class="pull-left"><i class="fa fa-money mr-20"></i><span class="right-nav-text">Payment / Funding </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="ecom_dr" class="collapse collapse-level-1">
						<li>
							<a href="{{ route('admin.payments.index') }}">Payment Request</a>
						</li>
						<li>
							<a href="payment-methods">Payment Methods</a>
						</li>
						<li>
							<a href="payment-history">Payment History</a>
						</li>
					</ul>
				</li> --}}

                <li><hr class="light-grey-hr mb-10"/></li>

				<li>
					<a href="javascript:void(0);" data-toggle="collapse" data-target="#app_dr"><div class="pull-left"><i class="fa fa-hand-lizard-o mr-20" aria-hidden="true"></i><span class="right-nav-text">Withdrawals </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="app_dr" class="collapse collapse-level-1">
						<li>
							<a href="withdrawal-request">Withdrawal Request</a>
						</li>
						<li>
							<a href="withdrawal-history">Withdrawal History</a>
						</li>
						<li>
							<a href="withdrawal-method">Withdrawal Method</a>
						</li>
					</ul>
				</li>

                

                {{-- <li><hr class="light-grey-hr mb-10"/></li>

                <li>
					<a href="javascript:void(0);" data-toggle="collapse" data-target="#ui_dr"><div class="pull-left"><i class="fa fa-usd  mr-20" aria-hidden="true"></i><span class="right-nav-text">Bond </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="ui_dr" class="collapse collapse-level-1">
						<li>
							<a href="users-bond">Users Bond</a>
						</li>
						<li>
							<a href="bond-packages">Bond Packages</a>
						</li>

					</ul>
				</li> --}}
                <li><hr class="light-grey-hr mb-10"/></li>
                <li>
					<a href="sendmail"><div class="pull-left"><i class="fa fa-envelope mr-20" aria-hidden="true"></i><span class="right-nav-text">Send Mail</span></div><div class="clearfix"></div></a>
				</li>
				@else
				<li>
					<a href="{{ route('admin.users.index') }}"><div class="pull-left"><i class="fa fa-user mr-20" aria-hidden="true"></i><span class="right-nav-text">Users</span></div><div class="clearfix"></div></a>
				</li>
				@endif
				
                <li><hr class="light-grey-hr mb-10"/></li>
                <li>
					<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><div class="pull-left"><i class="fa fa-sign-out  mr-20" aria-hidden="true"></i><span class="right-nav-text">Logout</span></div><div class="clearfix"></div></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none">
                        @csrf
                    </form>
                </li>


			</ul>
		</div>
		<!-- /Left Sidebar Menu -->



    <!-- Main Content -->
		<div class="page-wrapper">
            <div class="container-fluid">

				<!-- Title -->
				<div class="row heading-bg">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<h2 class="txt-dark">{{ $page_title }}</h2>
					</div>

				</div>
				<!-- /Title -->

                <main>
                    @include('partials.alert')
                    @yield('content')
                </main>

				<!-- Footer -->
				<footer class="footer container-fluid pl-30 pr-30">
					<div class="row">
						<div class="col-sm-12">
							<p><b>2022 &copy;</b> <b>Dell Group  MANAGEMENT SYSTEM</b></p>
						</div>
					</div>
				</footer>
				<!-- /Footer -->
			</div>
		</div>
        <!-- /Main Content -->


    </div>
    {{-- <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script> --}}


    <script src="{{ asset('admin-assets/vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('admin-assets/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin-assets/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>
    <script src="{{ asset('admin-assets/vendors/bower_components/bootstrap-validator/dist/validator.min.js') }}"></script>

    <!-- Bootstrap Daterangepicker JavaScript -->
	<script src="{{ asset('admin-assets/vendors/bower_components/dropify/dist/js/dropify.min.js') }}"></script>
    	<!-- Fancy Dropdown JS -->
	<script src="{{ asset('admin-assets/dist/js/dropdown-bootstrap-extended.js') }}"></script>

   <!-- Form Flie Upload Data JavaScript -->
	<script src="{{ asset('admin-assets/dist/js/form-file-upload-data.js') }}"></script>

	<!-- Data table JavaScript -->
	<script src="{{ asset('admin-assets/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/js/dataTables-data.js') }}"></script>

	<!-- Slimscroll JavaScript -->
	<script src="{{ asset('admin-assets/dist/js/jquery.slimscroll.js') }}"></script>

	<!-- Progressbar Animation JavaScript -->
	<script src="{{ asset('admin-assets/vendors/bower_components/waypoints/lib/jquery.waypoints.min.js') }}"></script>
	<script src="{{ asset('admin-assets/vendors/bower_components/jquery.counterup/jquery.counterup.min.js') }}"></script>

	<!-- Fancy Dropdown JS -->
	<script src="{{ asset('admin-assets/dist/js/dropdown-bootstrap-extended.js') }}"></script>

    <!-- Sparkline JavaScript -->
	<script src="{{ asset('admin-assets/vendors/jquery.sparkline/dist/jquery.sparkline.min.js') }}"></script>

    	<!-- Owl JavaScript -->
	<script src="{{ asset('admin-assets/vendors/bower_components/owl.carousel/dist/owl.carousel.min.js') }}"></script>

        <!-- ChartJS JavaScript -->
	<script src="{{ asset('admin-assets/vendors/chart.js/Chart.min.js') }}"></script>

	<!-- Morris Charts JavaScript -->
    <script src="{{ asset('admin-assets/vendors/bower_components/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('admin-assets/vendors/bower_components/morris.js/morris.min.js') }}"></script>

    	<!-- Switchery JavaScript -->
	<script src="{{ asset('admin-assets/vendors/bower_components/switchery/dist/switchery.min.js') }}"></script>

	<!-- Init JavaScript -->
    	<script src="{{ asset('admin-assets/dist/js/init.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/js/dashboard-data.js') }}"></script>
</body>

</html>

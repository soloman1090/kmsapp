<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Dell Group">
    <meta name="twitter:description" content="Dell Investment Group">
 
    <!-- Facebook -->
    <meta property="og:title" content="Dell Group">
    <meta property="og:description" content="Dell Investment Group">

      <!-- Favicon -->
      <link rel="shortcut icon" type="image/x-icon" href="../../assets/img/favicon.png">

    
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Dell Investment Group">
    <meta name="author" content="Dell Group">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="main-user-assets/img/favicon.png">

    <title>Dell Investment Group</title>

    <!-- vendor css -->
    <link href="{{asset('main-user-assets/lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('main-user-assets/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('main-user-assets/lib/remixicon/fonts/remixicon.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- DashForge CSS -->
    <link href="{{asset('main-user-assets/lib/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('main-user-assets/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('main-user-assets/css/dashforge.css')}}">
    <link rel="stylesheet" href="{{asset('main-user-assets/css/emma.css')}}">
    <link rel="stylesheet" href="{{asset('main-user-assets/css/dashforge.filemgr.css')}}">
    <link rel="stylesheet" href="{{asset('main-user-assets/css/dashforge.auth.css')}}">
   
  </head>
  <body>
  <header class="navbar navbar-header navbar-header-fixed">
      <a href="#" id="mainMenuOpen" class="burger-menu"><i data-feather="menu"></i></a>
      <div class="navbar-brand">
        <a href="/user/dashboard" class="df-logo">Dell<span> Investment Group</span></a>
      </div><!-- navbar-brand -->
      <div id="navbarMenu" class="navbar-menu-wrapper">
        <div class="navbar-menu-header">
          <a href="../../index.html" class="df-logo">Dell<span> Investment Group</span></a>
          <a id="mainMenuClose" href=""><i data-feather="x"></i></a>
        </div><!-- navbar-menu-header -->
        <ul class="nav navbar-menu">
          <li class="nav-label pd-l-20 pd-lg-l-25 d-lg-none">Main Navigation</li>
          <li class="nav-item with-sub active">
            <a href="/user/make-investment" class="nav"> Invest</a>
            <!-- <ul class="navbar-menu-sub">
              <li class="nav-sub-item"><a href="dashboard-one.html" class="nav-sub-link"><i data-feather="bar-chart-2"></i>Sales Monitoring</a></li>
              <li class="nav-sub-item"><a href="dashboard-two.html" class="nav-sub-link"><i data-feather="bar-chart-2"></i>Website Analytics</a></li>
              <li class="nav-sub-item"><a href="dashboard-three.html" class="nav-sub-link"><i data-feather="bar-chart-2"></i>Cryptocurrency</a></li>
              <li class="nav-sub-item"><a href="dashboard-four.html" class="nav-sub-link"><i data-feather="bar-chart-2"></i>Helpdesk Management</a></li>
            </ul> -->
          </li>
          <li class="nav-item with-sub">
            <a href="/user/user-investments" class="nav"> Portfolio</a>
            <!-- <ul class="navbar-menu-sub">
              <li class="nav-sub-item"><a href="app-calendar.html" class="nav-sub-link"><i data-feather="calendar"></i>Calendar</a></li>
              <li class="nav-sub-item"><a href="app-chat.html" class="nav-sub-link"><i data-feather="message-square"></i>Chat</a></li>
              <li class="nav-sub-item"><a href="app-contacts.html" class="nav-sub-link"><i data-feather="users"></i>Contacts</a></li>
              <li class="nav-sub-item"><a href="app-file-manager.html" class="nav-sub-link"><i data-feather="file-text"></i>File Manager</a></li>
              <li class="nav-sub-item"><a href="app-mail.html" class="nav-sub-link"><i data-feather="mail"></i>Mail</a></li>
            </ul> -->
          </li>
          <!-- <li class="nav-item with-sub">
            <a href="" class="nav">Secondary Market</a> -->
            <!-- <div class="navbar-menu-sub">
              <div class="d-lg-flex">
                <ul>
                  <li class="nav-label">Authentication</li>
                  <li class="nav-sub-item"><a href="page-signin.html" class="nav-sub-link"><i data-feather="log-in"></i> Sign In</a></li>
                  <li class="nav-sub-item"><a href="page-signup.html" class="nav-sub-link"><i data-feather="user-plus"></i> Sign Up</a></li>
                  <li class="nav-sub-item"><a href="page-verify.html" class="nav-sub-link"><i data-feather="user-check"></i> Verify Account</a></li>
                  <li class="nav-sub-item"><a href="page-forgot.html" class="nav-sub-link"><i data-feather="shield-off"></i> Forgot Password</a></li>
                  <li class="nav-label mg-t-20">User Pages</li>
                  <li class="nav-sub-item"><a href="page-profile-view.html" class="nav-sub-link"><i data-feather="user"></i> View Profile</a></li>
                  <li class="nav-sub-item"><a href="page-connections.html" class="nav-sub-link"><i data-feather="users"></i> Connections</a></li>
                  <li class="nav-sub-item"><a href="page-groups.html" class="nav-sub-link"><i data-feather="users"></i> Groups</a></li>
                  <li class="nav-sub-item"><a href="page-events.html" class="nav-sub-link"><i data-feather="calendar"></i> Events</a></li>
                </ul>
                <ul>
                  <li class="nav-label">Error Pages</li>
                  <li class="nav-sub-item"><a href="page-404.html" class="nav-sub-link"><i data-feather="file"></i> 404 Page Not Found</a></li>
                  <li class="nav-sub-item"><a href="page-500.html" class="nav-sub-link"><i data-feather="file"></i> 500 Internal Server</a></li>
                  <li class="nav-sub-item"><a href="page-503.html" class="nav-sub-link"><i data-feather="file"></i> 503 Service Unavailable</a></li>
                  <li class="nav-sub-item"><a href="page-505.html" class="nav-sub-link"><i data-feather="file"></i> 505 Forbidden</a></li>
                  <li class="nav-label mg-t-20">Other Pages</li>
                  <li class="nav-sub-item"><a href="page-timeline.html" class="nav-sub-link"><i data-feather="file-text"></i> Timeline</a></li>
                  <li class="nav-sub-item"><a href="page-pricing.html" class="nav-sub-link"><i data-feather="file-text"></i> Pricing</a></li>
                  <li class="nav-sub-item"><a href="page-help-center.html" class="nav-sub-link"><i data-feather="file-text"></i> Help Center</a></li>
                  <li class="nav-sub-item"><a href="page-invoice.html" class="nav-sub-link"><i data-feather="file-text"></i> Invoice</a></li>
                </ul>
              </div>
            </div> -->
          </li>
          <li class="nav-item with-sub">
            <a href="" class="nav-link"><i data-feather="package"></i> Secondary Market</a>
            <ul class="navbar-menu-sub">
              <li class="nav-sub-item"><a href="/user/referred-users" class="nav-sub-link"><i data-feather="users"></i>Friends & Community</a></li>
              <li class="nav-sub-item"><a href="/user/referral-bonus" class="nav-sub-link"><i data-feather="dollar-sign"></i>Community Benefits</a></li>
               <li class="nav-sub-item"><a href="/user/investment-calculator" class="nav-sub-link"><i data-feather="hash"></i>Investment Calculator</a></li>
              <li class="nav-sub-item"><a href="/user/withdrawal-history" class="nav-sub-link"><i data-feather="credit-card"></i>Withdrawals</a></li>
            </ul>
          </li>
          <li class="nav-item with-sub">
            <a href="" class="nav-link"><i data-feather="package"></i> Resources</a>
            <ul class="navbar-menu-sub">
              <li class="nav-sub-item"><a href="/user/pdf" class="nav-sub-link"><i data-feather="calendar"></i>PDF</a></li>
              <li class="nav-sub-item"><a href="/user/video" class="nav-sub-link"><i data-feather="message-square"></i>Videos</a></li>
              <li class="nav-sub-item"><a href="/user/fq" class="nav-sub-link"><i data-feather="users"></i>F & Q</a></li>
              <li class="nav-sub-item"><a href="/user/contact" class="nav-sub-link"><i data-feather="file-text"></i>Contact Us</a></li>
              <li class="nav-sub-item"><a href="/user/howto" class="nav-sub-link"><i data-feather="mail"></i>How To</a></li>
              <li class="nav-sub-item"><a href="/user/news" class="nav-sub-link"><i data-feather="mail"></i>News</a></li>
            </ul>
          </li>
        </ul>
      </div><!-- navbar-menu-wrapper -->
      <div class="navbar-right">
          @impersonate()
         <a class=" btn btn-sm btn-success" href="{{ route('admin.impersonate.destroy') }}" role="button">Admin</a>
            @endimpersonate
        <!-- <div class="dropdown dropdown-message">
          <a href="" class="dropdown-link new-indicator" data-bs-toggle="dropdown">
            <i data-feather="message-square"></i>
            <span>5</span>
          </a>
          <div class="dropdown-menu dropdown-menu-end">
            <div class="dropdown-header">New Messages</div>
            <a href="" class="dropdown-item">
              <div class="media">
                <div class="avatar avatar-sm avatar-online"><img src="https://placehold.co/500" class="rounded-circle" alt=""></div>
                <div class="media-body mg-l-15">
                  <strong>Socrates Itumay</strong>
                  <p>nam libero tempore cum so...</p>
                  <span>Mar 15 12:32pm</span>
                </div>
              </div>
            </a>
            <a href="" class="dropdown-item">
              <div class="media">
                <div class="avatar avatar-sm avatar-online"><img src="https://placehold.co/500" class="rounded-circle" alt=""></div>
                <div class="media-body mg-l-15">
                  <strong>Joyce Chua</strong>
                  <p>on the other hand we denounce...</p>
                  <span>Mar 13 04:16am</span>
                </div>
              </div>
            </a>
            <a href="" class="dropdown-item">
              <div class="media">
                <div class="avatar avatar-sm avatar-online"><img src="https://placehold.co/500" class="rounded-circle" alt=""></div>
                <div class="media-body mg-l-15">
                  <strong>Althea Cabardo</strong>
                  <p>is there anyone who loves...</p>
                  <span>Mar 13 02:56am</span>
                </div>
              </div>
            </a>
            <a href="" class="dropdown-item">
              <div class="media">
                <div class="avatar avatar-sm avatar-online"><img src="https://placehold.co/500" class="rounded-circle" alt=""></div>
                <div class="media-body mg-l-15">
                  <strong>Adrian Monino</strong>
                  <p>duis aute irure dolor in repre...</p>
                  <span>Mar 12 10:40pm</span>
                </div>
              </div>
            </a>
            <div class="dropdown-footer"><a href="">View all Messages</a></div>
          </div>
        </div> -->
    
        <!-- <div class="dropdown dropdown-notification">
          <a href="" class="dropdown-link new-indicator" data-bs-toggle="dropdown">
            <i data-feather="bell"></i>
            <span>2</span>
          </a>
          <div class="dropdown-menu dropdown-menu-end">
            <div class="dropdown-header">Notifications</div>
            <a href="" class="dropdown-item">
              <div class="media">
                <div class="avatar avatar-sm avatar-online"><img src="https://placehold.co/500" class="rounded-circle" alt=""></div>
                <div class="media-body mg-l-15">
                  <p>Congratulate <strong>Socrates Itumay</strong> for work anniversaries</p>
                  <span>Mar 15 12:32pm</span>
                </div>
              </div>
            </a>
            <a href="" class="dropdown-item">
              <div class="media">
                <div class="avatar avatar-sm avatar-online"><img src="https://placehold.co/500" class="rounded-circle" alt=""></div>
                <div class="media-body mg-l-15">
                  <p><strong>Joyce Chua</strong> just created a new blog post</p>
                  <span>Mar 13 04:16am</span>
                </div>
              </div>
            </a>
            <a href="" class="dropdown-item">
              <div class="media">
                <div class="avatar avatar-sm avatar-online"><img src="https://placehold.co/500" class="rounded-circle" alt=""></div>
                <div class="media-body mg-l-15">
                  <p><strong>Althea Cabardo</strong> just created a new blog post</p>
                  <span>Mar 13 02:56am</span>
                </div>
              </div>
            </a>
            <a href="" class="dropdown-item">
              <div class="media">
                <div class="avatar avatar-sm avatar-online"><img src="https://placehold.co/500" class="rounded-circle" alt=""></div>
                <div class="media-body mg-l-15">
                  <p><strong>Adrian Monino</strong> added new comment on your photo</p>
                  <span>Mar 12 10:40pm</span>
                </div>
              </div>
            </a>
            <div class="dropdown-footer"><a href="">View all Notifications</a></div>
          </div>
        </div> -->
        <div class="dropdown dropdown-profile">
          <a href="" class="dropdown-link" data-bs-toggle="dropdown" data-display="static">
            <div class="avatar avatar-sm">
              @if ($user->image=="" || $user->image==null)
              <img src="https://placehold.co/387" class="rounded-circle" alt="">
               @else
               <img src="{{ asset('uploads/'.$user->image ) }}" class="rounded-circle" alt="">
               @endif
            </div>
          </a><!-- dropdown-link -->
          <div class="dropdown-menu dropdown-menu-end tx-13">
            <div class="avatar avatar-lg mg-b-15">
              @if ($user->image=="" || $user->image==null)
              <img src="https://placehold.co/387" class="rounded-circle" alt="">
               @else
               <img src="{{ asset('uploads/'.$user->image ) }}" class="rounded-circle" alt="">
               @endif
             
            </div>
            <h6 class="tx-semibold mg-b-5">{{ auth()->user()->name }} {{ $user->last_name }}</h6>
 
             <a href="profile" class="dropdown-item"><i data-feather="user"></i> View Profile</a>
            <div class="dropdown-divider"></div>
            <a href="my-account" class="dropdown-item"><i data-feather="settings"></i>Account Settings</a>
             <a href="page-signin.html" class="dropdown-item"><i data-feather="log-out"></i>Sign Out</a>
          </div><!-- dropdown-menu -->
        </div><!-- dropdown -->
      </div><!-- navbar-right -->
      <div class="navbar-search">
        <div class="navbar-search-header">
          <input type="search" class="form-control" placeholder="Type and hit enter to search...">
          <button class="btn"><i data-feather="search"></i></button>
          <a id="navbarSearchClose" href="" class="link-03 mg-l-5 mg-lg-l-10"><i data-feather="x"></i></a>
        </div><!-- navbar-search-header -->
        <div class="navbar-search-body">
          <label class="tx-10 tx-medium tx-uppercase tx-spacing-1 tx-color-03 mg-b-10 d-flex align-items-center">Recent Searches</label>
          <ul class="list-unstyled">
            <li><a href="dashboard-one.html">modern dashboard</a></li>
            <li><a href="app-calendar.html">calendar app</a></li>
            <li><a href="../../collections/modal.html">modal examples</a></li>
            <li><a href="../../components/el-avatar.html">avatar</a></li>
          </ul>

          <hr class="mg-y-30 bd-0">

          <label class="tx-10 tx-medium tx-uppercase tx-spacing-1 tx-color-03 mg-b-10 d-flex align-items-center">Search Suggestions</label>

          <ul class="list-unstyled">
            <li><a href="dashboard-one.html">cryptocurrency</a></li>
            <li><a href="app-calendar.html">button groups</a></li>
            <li><a href="../../collections/modal.html">form elements</a></li>
            <li><a href="../../components/el-avatar.html">contact app</a></li>
          </ul>
        </div><!-- navbar-search-body -->
      </div><!-- navbar-search -->
    </header><!-- navbar -->
    <!-- Main Content -->

    <div class="content content-fixed">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
    <main class=" ">
    <div class=" ">
            @include('partials.alert')
        </div>
        @yield('content')
 
    </main>
  </div>
</div>



    <footer class="footer padding50 ">
      <div class="container">
        <div class="row mb-3">
          <div class="col-md-4">
            <ul>
              <li><b>About Dell-Investment Group</b></li>
              <li>Dell-Investment Group is a technology platform that enables individuals and their advisors to invest in top-tier private equity funds.</li>
              <li><div class="d-flex">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
              </svg>
                <p>team@Dell-Investment Group.com</p>
              </div></li>
              <li><div class="d-flex">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
              </svg>
              <p>+49 30 220 560 770</p>
              </div></li>
              <li><div class="">
                <p>Follow Us</p>
                <div class="d-flex">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                  <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                  <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                  <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                  <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                  <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                </svg>
                </div>
              </div></li>
            </ul>
          </div>
          <div class="col-md-3">
            <ul>
              <li>Who we are</li>
              <li>How it works</li>
              <li>Careers</li>
              <li>Contact</li>
              <li>Impressum</li>
              <li>Privacy Policy</li>
              <li>Terms of Service</li>
              <li>Website Data Collection</li>
              <li>Software Licenses</li>
            </ul>
          </div>
          <div class="col-md-3">
            <ul>
              <li>Dell-Investment Group GmbH</li>
              <li>Schlesische Str.33/34, 2.OG <br>
                10997 Berlin <br>
                Germany <br>
                team@Dell-Investment Group.com
              </li>
            </ul>
          </div>
        </div>
        <p>All the data contained within this webpage is as March 31, 2023 otherwise noted. The material on this website is intended for informational purposes only, does not constitute investment advice or analysis, or a recommendation, or an offer of solicitation, and is not the basis for any contract or other agreement to make any investment, or for Delle Investment group to enter into or arrange any type of transaction. Assets under management (AUM) refers to the fair market value of real assets-related investments with respect to which Delle Investment group provides, on a global basis, oversight, investment management services and other advice and which generally consist of investments in real assets; equity in funds and joint ventures; securities portfolios; operating companies and real assets-related loans. This AUM is intended principally to reflect the extent of Delle Investment group’s presence in the global real assets market, and its calculation of AUM may differ from the calculations of other asset managers and from its calculation of regulatory assets under management for purposes of certain regulatory filings.
       <br>  <br>  Past Performance: Any performance data or comments expressed on this website are an indication of past performance. Past performance is not indicative of future results, and no representation is being made that any investment will or is likely to achieve profits or losses similar to those achieved in the past, or that significant losses will be avoided.
      </p>
          <p>Forward-Looking Statements: The contents of this website may contain forward -looking statements that are based on management’s beliefs, assumptions, current expectations, estimates, and projections about the real assets industry, the financial industry, the economy, Delle Investment group itself or its investments. These statements are not guarantees of future performance and involve certain risks, uncertainties and assumptions that are difficult to predict with regard to timing, extent, likelihood and degree of occurrence. Therefore, actual results and outcomes may materially differ from what may be expressed or forecasted in such forward- looking statements. Furthermore, Delle Investment group undertakes no obligation to update, amend or clarify forward- looking statements, whether as a result of new information, future events or otherwise..</p>
      </div>
      <!-- <div>
        <span>&copy; 2023 DashForge v1.0.0. </span>
        <span>Created by <a href="http://themepixels.me">ThemePixels</a></span>
      </div>
      <div>
        <nav class="nav">
          <a href="https://themeforest.net/licenses/standard" class="nav-link">Licenses</a>
          <a href="../../change-log.html" class="nav-link">Change Log</a>
          <a href="https://discordapp.com/invite/RYqkVuw" class="nav-link">Get Help</a>
        </nav>
      </div> -->
    </footer>

    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="{{asset('main-user-assets/lib/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('main-user-assets/js/skippr.min.js') }}"></script>
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
    <script src="{{asset('main-user-assets/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('main-user-assets/lib/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('main-user-assets/lib/ionicons/ionicons/ionicons.esm.js')}}" type="module"></script>
    <script src="{{asset('main-user-assets/lib/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('main-user-assets/lib/jquery.flot/jquery.flot.js')}}"></script>
    <script src="{{asset('main-user-assets/lib/jquery.flot/jquery.flot.stack.js')}}"></script>
    <script src="{{asset('main-user-assets/lib/jquery.flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('main-user-assets/lib/chart.js/Chart.bundle.min.js')}}"></script>

    <script src="{{asset('main-user-assets/js/dashforge.js')}}"></script>
    <script src="{{asset('main-user-assets/js/dashboard-one.js')}}"></script>
    <script src="{{asset('main-user-assets/js/dashboard-two.js')}}"></script>
    <script src="{{asset('main-user-assets/js/dashforge.sampledata.js')}}"></script>
    <script src="{{asset('assets/js/emma.js')}}"></script>
    <script src="{{asset('main-user-assets/lib/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('main-user-assets/lib/datatables.net-dt/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{asset('main-user-assets/lib/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>

    <!-- append theme customizer -->
    <script src="{{asset('main-user-assets/lib/js-cookie/js.cookie.js')}}"></script>
    <script src="{{asset('main-user-assets/js/dashforge.settings.js')}}"></script>
    <script>
      $(function(){
        'use script'

        window.darkMode = function(){
          $('.btn-white').addClass('btn-dark').removeClass('btn-white');
        }

        window.lightMode = function() {
          $('.btn-dark').addClass('btn-white').removeClass('btn-dark');
        }

        var hasMode = Cookies.get('df-mode');
        if(hasMode === 'dark') {
          darkMode();
        } else {
          lightMode();
        }
        
      })

      $('#example1').DataTable({
        language: {
          searchPlaceholder: 'Search...',
          sSearch: '',
          lengthMenu: '_MENU_ items/page',
        }
      });
     
      // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
    </script>

    <script>
      $('#example2').DataTable({
          language: {
              searchPlaceholder: 'Search...'
              , sSearch: ''
              , lengthMenu: '_MENU_ items/page'
          , }
      });
  
  </script>

  <script>
    $(function(){
      'use strict'

      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
      const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))


      $('.df-example .btn-primary').tooltip({
        template: '<div class="tooltip tooltip-primary" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
      })

      $('.df-example .btn-secondary').tooltip({
        template: '<div class="tooltip tooltip-secondary" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
      })

      $('.df-example .btn-success').tooltip({
        template: '<div class="tooltip tooltip-success" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
      })

      $('.df-example .btn-danger').tooltip({
        template: '<div class="tooltip tooltip-danger" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
      })


    });
  </script>
  </body>
</html>

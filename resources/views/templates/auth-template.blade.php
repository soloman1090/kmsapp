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

    <title>Auth-Account</title>

    <!-- vendor css -->
    <link href="{{asset('main-user-assets/lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('main-user-assets/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('main-user-assets/lib/remixicon/fonts/remixicon.css')}}" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="{{asset('main-user-assets/css/dashforge.css')}}">
    <link rel="stylesheet" href="{{asset('main-user-assets/css/emma.css')}}">
    <link rel="stylesheet" href="{{asset('main-user-assets/css/dashforge.auth.css')}}">
  </head>
  <body>
    <!-- Main Content -->

    <main class=" ">
    <div class=" ">
            @include('partials.alert')
        </div>
        @yield('content')
 
    </main>



    <footer class="footer">
      <div>
        <span>&copy; 2023 DashForge v1.0.0. </span>
        <span>Created by <a href="http://themepixels.me">ThemePixels</a></span>
      </div>
      <div>
        <nav class="nav">
          <a href="https://themeforest.net/licenses/standard" class="nav-link">Licenses</a>
          <a href="../../change-log.html" class="nav-link">Change Log</a>
          <a href="https://discordapp.com/invite/RYqkVuw" class="nav-link">Get Help</a>
        </nav>
      </div>
    </footer>

    <script src="../../lib/jquery/jquery.min.js"></script>
    <script src="../../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../lib/feather-icons/feather.min.js"></script>
    <script src="../../lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="../../assets/js/dashforge.js"></script>
    <!-- <script src="assets/js/emma.js"></script> -->

    <!-- append theme customizer -->
    <script src="../../lib/js-cookie/js.cookie.js"></script>
    <script src="../../assets/js/dashforge.settings.js"></script>
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
    </script>
  </body>
</html>

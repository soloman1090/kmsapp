<!DOCTYPE html>

<html class="no-js" lang="en">

<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>Palm Auth</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('admin-assets/img/fav-icon.png') }}">
    <link rel="icon" href="{{ asset('admin-assets/img/fav-icon.png') }}" type="image/x-icon">

    <!-- Data table CSS -->
    <!-- Mobile Specific Metas
  ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Font
  ================================================== -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link href="{{ asset('user-assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">

    <!-- MAIN STYLE
  ================================================== -->
    <link rel="stylesheet" href="{{ asset('user-assets/css/bootstrap.min.css') }}" />
    <!-- Custom CSS -->
    <link href="{{ asset('user-assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .card-top {
            border-top-right-radius: 10px;
            border-top-left-radius: 10px;
        }

        .card-bottom {
            border-bottom-right-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        .fw-bold {
            line-height: 35px;
        }

        i {
            font-size: 20px;
        }
        .regMargin{margin:100px;}

        .footer-side{height: 650px; width: 100%;background-image: url('{{ asset('assets/images/Footer/footer-bg.png ') }}'); background-repeat: no-repeat; background-size: 100%; background-position: center;}
        .footer-side h1{padding-top: 200px; color: White; font-size: 60px; margin-bottom: 2px; line-height:70px;}
        .footer-side p{padding-top: 25px; color: White; font-size: 30px; line-height: 45px; margin-bottom: 20px;}
        .footer-side a{padding: 15px 40px 15px 40px; color: #375D7C; background-color: white; font-size: 25px; border-radius: 100px; }
        .invalid-feedback{font-size: 18px;}

    </style>
</head>

<body>
    <!-- Main Content -->

    <main class="account-body accountbg">
        <div class="container">
            @include('partials.alert')
        </div>
        @yield('content')
        <div class="footer-side">
            <div class="container">
               <div class="row">
                   <div class="col-md-1"></div>
                   <div class="col-md-10">
                    <h1>Palm Alliance Management is where you belong</h1>
                    <p>Wonderful people. Exception results. Now is a great time to join Palm Alliance Community</p>
                    <br>
                   </div>
                   <div class="col-md-1"></div>
               </div>
            </div>
        </div>
        <div class="bg-black">
            <div class="container text-white">
                <div class="row pt-5">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="footer-row">
                            <div class="row text1">
                                <div class="col-md-2">
                                    <a href="/"><img src="{{ asset('assets/images/Header/logo.png') }}" class="img-responsive " style="width: 100%"
                                            alt="Image"></a>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-9">
                                    <h2 class="text-white">Palm Alliance Management</h2>
                                    <p>PAM is a forward thinking independent, privately-owned wealth management firm
                                        offering family office, goals-based planning and investment management services to
                                        high-net-worth individuals and families, practice professionals, and business
                                        owners.</p>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="row text1">
                                <div class="col-md-3">

                                </div>
                                <div class="col-md-3">
                                    <p>(302) 389-5302</p>
                                    <p>support@palmalliance.com</p>
                                </div>
                                <div class="col-md-3">
                                    <a href="privacy-policy" class="text-white">Privacy-Policy</a>
                                </div>
                                <div class="col-md-3">

                                </div>
                            </div>



                        </div> <!-- End footer row -->
                        <div class="col-md-12 footer-link">
                            <hr>
                            <p> How PAM calculates "better returns". Unless otherwise specified, all return figures shown
                                above are for illustrative purposes only, and are not actual customer or model returns.
                                Actual returns will vary greatly and depend on personal and market conditions. The
                                information on this site is intended solely for the benefit of firms and companies seeking
                                private equity investment capital by providing general information on our services and
                                philosophy. The material on this site is for informational purposes only and does not
                                constitute an offer or solicitation to purchase any investment solutions or a recommendation
                                to buy or sell a security nor is it to be construed as legal, tax or investment advice.
                                Unless otherwise indicated, any information available through this site is as of the date
                                indicated therein and may not be updated or otherwise revised to reflect information that
                                subsequently becomes available. PAM is under no obligation to update the information
                                contained on this site. Additionally, the material on this site does not constitute a
                                representation that the solutions described therein are suitable or appropriate for any
                                person and PAM does not accept any liability with respect to the information. By using this
                                site you agree to the Terms of Use.</p>

                            <p>Copyright  Palm Alliance ©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script></span> All rights reserved.</p>

                        </div>
                    </div>
                    <div class="col-md-1"></div>

                </div><!-- End Row -->

            </div><!-- End container -->
        </div>
    </main>




    <!-- Footer -->



    {{-- <script src="//code.tidio.co/m3tedumpoleevbbgdo0jcfis2q8wynay.js" async></script> --}}
    <script>
        //Set your APP_ID
var APP_ID = "v8g92rpj";

window.intercomSettings = {
 app_id: APP_ID
};
(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/' + APP_ID;var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);};if(document.readyState==='complete'){l();}else if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
      </script>


    <script src="{{ asset('user-assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('user-assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user-assets/js/waves.js') }}"></script>
    <script src="{{ asset('user-assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('user-assets/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('user-assets/plugins/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ asset('user-assets/pages/jquery.validation.init.js') }}"></script>
    <script src="{{ asset('user-assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('user-assets/pages/jquery.form-upload.init.js') }}"></script>
    <script>
        $('.recoveryBtn').click(function() {
            $(this).text("")
            $('.codeForm').html(`
            <label for="code" class="form-label">Recovery Code</label>
            <input type="text" class="form-control" name="recovery_code" placeholder="Enter One Recovery Code">`)
            $('.btn-auth').text('Submit Code')
            $('.formTitle').text('Recovery Code Required')
            $('.formSubTitle').text('Please enter your recovery code to login')
        })
    </script>
</body>

</html>

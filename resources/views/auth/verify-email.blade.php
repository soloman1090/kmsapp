@extends('templates.auth-template')

@section('content')

        <!-- Log In page -->
        <div class="container">
            <div class="row vh-100 d-flex justify-content-center">
                <div class="col-12 align-self-center">
                    <div class="row">
                        <div class="col-lg-4 mx-auto">
                            <div class="card">
                                <div class="card-body p-0 ">
                                    <div class="col md-3">
                                        <a href="/"><i data-feather="home"></i></a>
                                    </div>
                                    <div class="text-center p-3">
                                        <h4 class="mt-3 mb-1 fw-bold  font-30">Verify Email Address</h4>
                                        <p class="font-20  mb-0">You must verify your email address to access your account</p>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="tab-pane active p-3" id="LogIn_Tab" role="tabpanel">
                                     <!-- Tab panes -->
                                    <form action="{{ route('verification.send') }}" method="post">
                                        @csrf
                                        <div class="tab-content">
                                            <div class="form-group mb-0 row">
                                                <div class="col-2"></div>
                                                <div class="col-8">
                                                    <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Resend verification email <i class="fas fa-sign-in-alt ms-1"></i></button>
                                                </div><!--end col-->
                                                <div class="col-2"></div>
                                            </div> <!--end form-group-->
                                        </div>
                                    </form>
                                    <div class="m-3 text-center text-muted">

                                        <p class="mb-0">Do you want to switch account ?  <a href="{{ route('logout') }} "
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-primary ms-2">Sign-In</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none">
                                                @csrf
                                            </form>
                                        </p>

                                    </div>
                                    </div>
                                </div><!--end card-body-->
                                <div class="card-body bg-light-alt text-center">
                                    <span class="text-muted d-none d-sm-inline-block">Palm Alliance © <script>
                                        document.write(new Date().getFullYear())
                                    </script></span>
                                </div>
                            </div><!--end card-->
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
        <!-- End Log In page -->

@endsection

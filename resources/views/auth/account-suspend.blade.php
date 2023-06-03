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
                                    <div class="text-center p-3">
                                        <img src="{{ asset('user-assets/images/suspended.png') }}" alt="" style="width: 100%; " >
                                        <br>
                                        <h4 class="mt-3 mb-1 fw-bold  font-30">Account Suspended</h4>
                                        <p class="font-16  mb-0">Contact Palm Customer care to resolve this issue</p>
                                        <br>
                                        <div class="form-group mb-0 row">
                                            <div class="col-6">
                                                <a class="btn btn-primary w-100 waves-effect waves-light" href="/contact" >Contact Customer Care</i></a>
                                            </div><!--end col-->
                                            <div class="col-6">
                                                <a class="btn btn-primary w-100 waves-effect waves-light" href="/user/dashboard" >Check Account</i></a>
                                            </div><!--end col-->
                                            <
                                        </div> <!--end form-group-->
                                    </div>
                                    <div class="m-3 text-center text-muted">

                                        <p class="mb-0">Do you want to switch account ?  <a href="{{ route('logout') }} "
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-primary ms-2">Sign-In</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none">
                                                @csrf
                                            </form>
                                        </p>

                                    </div>
                                </div>

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

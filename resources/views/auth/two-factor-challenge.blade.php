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
                                    <h4 class="mt-3 mb-1 fw-bold  font-30">Authentication Code Required</h4>
                                    <p class="font-20  mb-0">Please enter your authentication code to login</p>
                                </div>
                            </div>

                            <div class="card-body p-0">

                                <!-- Tab panes -->
                                <div class="tab-content">

                                    <div class="tab-pane active p-3" id="LogIn_Tab" role="tabpanel">
                                        <form  action="{{ url('/two-factor-challenge') }}" method="POST">
                                            @csrf
                                            <div class="mb-1 codeForm">
                                                <label for="code" class="form-label">Authentication Code</label>
                                                <input type="text" class="form-control" name="code" placeholder="Enter Authentication Code">
                                            </div>
                                            <br>
                                            <br>
                                            <div class="row text-center">
                                                <div class="col-md-4"></div>
                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-primary btn-auth">Submit Code
                                                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                                                </div>
                                                <div class="col-md-4">
                                                </div>
                                            </div>
                                        </form>
                                        <div class="m-3 text-center text-muted">
                                            <p class="mb-0 recoveryBtn">Cant remember authentication code ? <a
                                                    href="#" class="text-primary ms-2 "> Recovery Code!</a></p>
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


                                </div>
                            </div>
                            <!--end card-body-->
                            <div class="card-body bg-light-alt text-center">
                                Palm Alliance ©   <script>
                                    document.write(new Date().getFullYear())
                                </script></span>
                            </div>
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->
    <!-- End Log In page -->



@endsection

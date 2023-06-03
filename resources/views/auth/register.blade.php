@extends('templates.auth-template')

@section('content')

    <!-- Log In page -->
    <div class="container">
        <div class="row  d-flex justify-content-center vh-100" >
            <div class="col-12 align-self-center">
                <div class="row">
                    <div class="col-lg-7 mx-auto">
                        <div class="card card-top">
                            <div class="card-body p-0 ">
                                <div class="row">
                                    <div class=" col text-center p-3">
                                        <h4 class="mt-3 mb-1 fw-bold font-20">Let's Get Started With Palm
                                            Alliance</h4>
                                    <p class="font-18  mb-0">Where do you want to start?</p>
                                </div>
                                <div class="col-auto">
                                    <a href="/" class=""><i class=" fas fa-home  p-4"></i></a>
                                </div>
                                </div>
                            </div>
                            <div class="card-body p-0">

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active px-3 pt-3" id="Register_Tab" role="tabpanel">
                                        <div class="row text-left">
                                            <div class="col-md-6">
                                                <hr>
                                                <br>
                                                <div style="padding-left:30px;">
                                                   <i class="fas fa-building font-40 " ></i>
                                                    <br>
                                                    <h3>Business</h3>
                                                    <p>Grow your money over the long term in a diversified portfolio designed to help lower the taxes you pay.</p>
                                                    <br>
                                                    <a href="register/business-name" class="btn btn-primary btn-lg">Start Business</a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <hr>
                                                <br>
                                                <div style="padding-left:30px;">
                                                    <i class="fas fa-user-tie font-40 " ></i>
                                                    <br>
                                                    <h3>Personal/ Individual</h3>
                                                    <p>Grow your money over the long term in a diversified portfolio designed to help lower the taxes you pay.</p>
                                                    <br>
                                                    <a href="register/user-email" class="btn btn-primary btn-lg">Start Personal</a>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <hr>
                                        <p class="my-3  text-center font-18">Already have an account ?
                                            @if (Route::has('login'))
                                                <a href="{{ route('login') }}" class="text-primary ms-2 ">Login</a>
                                            @endif
                                        </p>
                                    </div>


                                </div>
                            </div>
                            <!--end card-body-->

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

<script>

var params = new URLSearchParams(window.location.search);
if(params.get('refer')){
   localStorage.setItem("referral_id", params.get('refer'))
}

</script>
@endsection

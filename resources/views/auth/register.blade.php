@extends('templates.auth-template')

@section('content')

<!-- Log In page -->
<div class="Intro">
    <div class="row  d-flex  vh-100">
        <div class="col-12 ">
            <div class="row">
                <div class="col-md-6 ">
                    <div class="">
                        <div class=" p-0 ">
                            <div class="row">
                                <div class=" col text-center p-3">
                                    <h4 class="mb-1 fw-bold font-20 light">Let's Get Started With Palm
                                        Alliance</h4>
                                    <p class="font-18  mb-0">Where do you want to start?</p>
                                </div>
                                <div class="col-auto">
                                    <a href="/" class=""><i class=" fas fa-home  p-4"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class=" p-0">

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active px-3 pt-3" id="Register_Tab" role="tabpanel">
                                    <div class="">
                                        <button class="accordion">
                                            <h4>Corporate Entity</h4><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-bar-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1 3.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5zM8 6a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 .708-.708L7.5 12.293V6.5A.5.5 0 0 1 8 6z"/>
</svg>
                                        </button>
                                        <div class="panel ">
                                            <div style="padding-left:30px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                    fill="currentColor" class="bi bi-building-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3 0a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h3v-3.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V16h3a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H3Zm1 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5ZM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM7.5 5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5Zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM4.5 8h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5Zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5Z" />
                                                </svg>
                                                <br>
                                                <p>Grow your money over the long term in a diversified portfolio
                                                    designed to help lower the taxes you pay.</p>
                                                <br>
                                                <a href="register/business-name" class="btn btn-primary btn-lg mb-3">Start
                                                    Business</a>
                                            </div>
                                        </div>

                                        <button class="accordion line">
                                            <h4>Personal / Individual</h4>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-bar-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1 3.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5zM8 6a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 .708-.708L7.5 12.293V6.5A.5.5 0 0 1 8 6z"/>
</svg>
                                        </button>
                                        <div class="panel">
                                            <div style="padding-left:30px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                    fill="currentColor" class="bi bi-person-workspace"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H4Zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                                    <path
                                                        d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.373 5.373 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2H2Z" />
                                                </svg>
                                                <br>
                                                <p>Grow your money over the long term in a diversified portfolio
                                                    designed to help lower the taxes you pay.</p>
                                                <br>
                                                <a href="register/user-email" class="btn btn-primary btn-lg">Start
                                                    Personal</a>
                                            </div>
                                        </div>
                                    </div>
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
                <div class="col-md-6 ">
                    <div class="bg1">
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
if (params.get('refer')) {
    localStorage.setItem("referral_id", params.get('refer'))
}
</script>
@endsection
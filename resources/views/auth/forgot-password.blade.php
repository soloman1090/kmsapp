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
                                        <h4 class="mt-3 mb-1 fw-bold  font-30">Reset Password For Palm Account</h4>
                                        <p class="font-20  mb-0"> Enter your Email and instructions will be sent to you!</p>
                                    </div>
                                </div>
                               
                                <div class="card-body p-0">

                                     <!-- Tab panes -->
                                    <div class="tab-content">



                                        <div class="tab-pane active p-3" id="LogIn_Tab" role="tabpanel">
                                            <form class="form-horizontal auth-form" action="{{ route('password.email') }}" method="POST">
                                                @csrf
                                                <div class="form-group mb-2">
                                                    <label class="form-label" for="email">Email Address</label>
                                                    <div class="input-group">
                                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                                        aria-describedby="emailHelp" placeholder="Enter Email" value="{{ old('email') }}">
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                    </div>
                                                </div><!--end form-group-->
                                                <div class="form-group mb-0 row">
                                                    <div class="col-12">
                                                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Send Email <i class="fas fa-sign-in-alt ms-1"></i></button>
                                                    </div><!--end col-->
                                                </div> <!--end form-group-->
                                            </form><!--end form-->
                                            <div class="m-3 text-center text-muted">
                                                <p class="mb-0">Remember It ?  <a href="{{ route('login') }}" class="text-primary ms-2">Sign in here</a></p>
                                            </div>


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

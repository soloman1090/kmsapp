@extends('templates.auth-template')

@section('content')

<!-- Log In page -->
<div class="Login">
    <div class=" vh-100 >
        <div class="col-md-12 ">
            <div class="row">
                <div class="col-md-7">
                    <div class="bg2"></div>
                </div>
                <div class="col-md-5 p-5">
                    <div class="">
                        <div class=" p-0 ">
                            <div class="text-left p-3">
                                <h1 class="mt-3 mb-1 fw-bold  font-30">Hello there !</h1>
                                <p class="font-20  mb-0">Sign in to Dell Group Account</p>
                            </div>
                        </div>
                        <div class=" p-0">
                            <!-- Tab panes -->
                            <div class="tab-content">

                                <div class="tab-pane active p-3" id="LogIn_Tab" role="tabpanel">
                                    <form class="form-horizontal auth-form" action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="email">Email</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter email address" value="{{ old('email') }}">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end form-group-->

                                        <div class="form-group mb-2">
                                            <label class="form-label" for="userpassword">Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" placeholder="Enter Password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end form-group-->

                                        <div class="form-group row my-3">
                                            <div class="col-sm-6">
                                                <div class="custom-control custom-switch switch-success">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitchSuccess">
                                                    <label class="form-label text-muted" for="customSwitchSuccess">Remember me</label>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-sm-6 text-end">
                                                <a href="{{ route('password.request') }}" class="text-muted font-13"><i class="dripicons-lock"></i> Forgot password?</a>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end form-group-->

                                        <div class="form-group mb-0 row">
                                            <div class="col-12">
                                                <button class="btn btn-brand-02 w-100" type="submit">Sign In To Account </button>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end form-group-->
                                    </form>
                                   
                                    <div class="m-3 text-center text-muted">
                                        <p class="mb-0">Create Dell Group Account ? <a href="{{ route('register') }}" class="text-primary ms-2">Register</a></p>
                                    </div>


                                </div>


                            </div>
                        </div>
                        <!--end card-body-->
                        <div class="card-body bg-light-alt text-center">
                            <span class="text-muted d-none d-sm-inline-block">Dell Group  © <script>
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

<div class="modal fade" id="loadPopUp" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!--end modal-header-->
            <div class="modal-body">
                <img src="{{ asset('main-user-assets/images/login-pop.jpg') }}" alt="" style="width: 100%; height:100%;">
            </div>
            <!--end modal-body-->
            <div class="modal-footer">
                <button type="button" class="btn btn-soft-primary " data-bs-dismiss="modal">Close</button>
            </div>
            <!--end modal-footer-->

        </div>
        <!--end modal-content-->
    </div>
    <!--end modal-dialog-->
</div>

<script src="{{ asset('user-assets/js/jquery.min.js') }}"></script>
<script>
    $(window).on('load', function() {
        $('#loadPopUp').modal('show');
    });

</script>
@endsection

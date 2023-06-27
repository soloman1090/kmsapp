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
                                    <h4 class="mt-3 mb-1 fw-bold  font-30">Confirm Password</h4>
                                    <p class="font-20  mb-0">Provide password to authenticate your Dell Group Account</p>
                                </div>
                            </div>
                            <div class="card-body p-0">

                                 <!-- Tab panes -->
                                <div class="tab-content">

                                    <div class="tab-pane active p-3" id="LogIn_Tab" role="tabpanel">
                                        <form action="{{ url('user/confirm-password') }}" method="POST">
                                            @csrf

                                            <div class="mb-1">
                                              <label for="password" class="form-label">Password</label>
                                              <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" placeholder="Enter password">
                                              @error('password')
                                              <span class="invalid-feedback" role="alert">
                                                  {{ $message }}
                                              </span>
                                             @enderror
                                            </div>

                                        <br>
                                        <br>

                                            <div class="row text-center">

                                                <div class="col-md-4"></div>
                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-primary btn-auth">Confirm Password <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                                                </div>
                                                <div class="col-md-4">

                                                </div>
                                            </div>
                                          </form>



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
                            </div><!--end card-body-->
                            <div class="card-body bg-light-alt text-center">
                                <span class="text-muted d-none d-sm-inline-block">Dell Group  © <script>
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

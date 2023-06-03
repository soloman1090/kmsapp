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
                                        <h4 class="mt-3 mb-1 fw-bold  font-30">Reset Password</h4>
                                        <p class="font-20  mb-0"> Enter new password!</p>
                                    </div>
                                </div>

                                <div class="card-body p-0">

                                     <!-- Tab panes -->
                                    <div class="tab-content">



                                        <div class="tab-pane active p-3" id="LogIn_Tab" role="tabpanel">
                                            <form class="form-horizontal auth-form" action="{{ url('reset-password') }}" method="POST">
                                                @csrf
                                                 <input type="hidden" name="token" value="{{ $request->token }}">
                                               <div class="mb-3">
                                                  {{-- <label for="email" class="form-label">Email address</label> --}}
                                                  <input type="hidden" class="form-control @error('email') is-invalid @enderror" id="email" name="email"  aria-describedby="emailHelp" value="{{ $request->email }}">
                                                  @error('email')
                                                  <span class="invalid-feedback" role="alert">
                                                      {{ $message }}
                                                  </span>
                                                 @enderror
                                                </div>
                                                <div class="mb-3">
                                                  <label for="password" class="form-label">Password</label>
                                                  <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}">
                                                  @error('password')
                                                  <span class="invalid-feedback" role="alert">
                                                      {{ $message }}
                                                  </span>
                                                 @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="password_confirmation" class="form-label">Comfirm Password</label>
                                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" >

                                                  </div>
                                                <div class="form-group mb-0 row">
                                                    <div class="col-12">
                                                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Reset Pasword <i class="fas fa-sign-in-alt ms-1"></i></button>
                                                    </div><!--end col-->
                                                </div> <!--end form-group-->
                                            </form><!--end form-->



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

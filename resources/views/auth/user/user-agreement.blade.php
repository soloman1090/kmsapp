@extends('templates.auth-template')

@section('content')
<style>
    input{padding: 20px !important;}
</style>
<link href="{{ asset('user-assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">
    <!-- Log In page -->
    <div class="">
       <div class=" vh-100" >
            <div class="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="">
                            <div class="p-0">
                                <div class="row">
                                    <div class="col-md-2 text-center">
                                        <a href="user-phone" class=""><i class=" fas fa-arrow-left  pt-4"></i></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="text-center p-2">
                                            <h4 class="mt-3 mb-1 fw-semibold  font-17">3/3</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <a href="/register" class=""><i class=" fas fa-home  pt-4"></i></a>
                                    </div>
                                </div>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active px-3 pt-3" id="Register_Tab" role="tabpanel">
                                        <br>
                                        <div class="row ">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-10">
                                                <h4 class="mt-3 mb-1 fw-bold  font-30">Lastly, there are agreements</h4>
                                                <p class="font-20  mb-0">Please read the following terms.</p>
                                                <br>
                                                <form class="form-parsley" action="{{ route('register') }}" onsubmit="saveData()"  enctype="multipart/form-data"  method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input type="hidden" id="firstNameTxt" name="name" class="@error('name') is-invalid @enderror">
                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                        @enderror
                                                        <input type="hidden" id="phoneTxt" name="phone" class="@error('phone') is-invalid @enderror">
                                                        @error('phone')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                        @enderror
                                                        <input type="hidden" id="eamilTxt" name="email" class="@error('email') is-invalid @enderror">
                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                        @enderror

                                                        <input type="hidden" id="passwordTxt" name="password" class="@error('password') is-invalid @enderror">
                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                        @enderror
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="hidden" id="lastNameTxt" name="lastName">
                                                            <input type="hidden" id="passwordConfirmTxt" name="password_confirmation">
                                                            <input type="hidden" id="referral_id" name="referral_id">

                                                            <div class="mb-3">
                                                                <label for="formFile" class="form-label">Please upload a valid means of Identification</label>
                                                                <input type="file" id="input-file-now formFile" name="image" class="dropify form-control " data-height="100" />
                                                            </div>
                                                              <br>
                                                                <div class="d-flex">
                                                                <input type="checkbox" class="custom-control-input me-3" required id="customCheck1" data-parsley-multiple="groups"
                                                                    data-parsley-mincheck="1">
                                                            <label class="custom-control-label" style="font-size:12px !important;"  for="customCheck1">By checking this box, you agree to our Limited Scope Advisory Agreement,
                                                                consent to eletronic delivery of communications and our Privacy Policy, and acknowledge that
                                                            </label>
                                                                </div>
                                                        </div>
                                                    </div><!--end form-group-->


                                                    <button type="submit" id="btnNext" class="btn btn-brand-02"> Create Account </button>
                                                </form>
                                            </div>
                                            <div class="col-md-1"></div>
                                        </div>
                                        <br>
                                        <br>

                                    </div>


                                </div>
                            </div>
                            <!--end card-body-->
                            <div class="card-body bg-light-alt text-center">

                                <span class="text-muted d-none d-sm-inline-block">Palm Alliance © <script>
                                    document.write(new Date().getFullYear())
                                </script></span>
                            </div>
                        </div>
                        <!--end card-->
                    </div>
                    <div class="col-md-6">
                        <div class="bg2"></div>
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
        let phoneTxt=document.getElementById('phoneTxt');

        let lData={};
        if(localStorage.getItem("reg_data")!=null){
            lData =JSON.parse(localStorage.getItem("reg_data"))
            firstNameTxt.value=lData.firstName
            lastNameTxt.value=lData.lastName
            eamilTxt.value=lData.email
            phoneTxt.value=lData.phone
            passwordTxt.value=lData.password
            passwordConfirmTxt.value=lData.password
            if(localStorage.getItem("referral_id")!=null){

                if(localStorage.getItem("referral_id").length < 6){
                    referral_id.value = parseInt(localStorage.getItem("referral_id"))
                }else{
                    referral_id.value = localStorage.getItem("referral_id")
                }

            }

        }
        console.log(lData)


        </script>
@endsection

@extends('templates.auth-template')

@section('content')
<style>
    input{padding: 20px !important;}
</style>
    <!-- Log In page -->
    <div class="Phone">
        <div class=" vh-100" >
            <div class="">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="">

                            <div class=" p-0">
                                <div class="row">
                                    <div class="col-md-2 text-center">
                                        <a href="user-email" class=""><i class=" fas fa-arrow-left  pt-4"></i></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="text-center p-2">
                                            <h4 class="mt-3 mb-1 fw-semibold  font-17">2/3</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <a href="/register" class=""><i class=" fas fa-home  pt-4"></i></a>
                                    </div>
                                </div>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active px-3 " id="Register_Tab" role="tabpanel">
                                 
                                        <div class="row ">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-10">
                                               
                                                <br>
                                                <form class="form-parsley" action="user-agreement"  onsubmit="saveData()">
                                                <div class="form-group">
                                                    <h5 class="mt-3 mb-1 fw-bold  font-30">Almost there. Next, we need your phone number.</h5>
                                                    <p class="font-20  mb-3">We use this to secure your account with two-factor authentication. We'll never sell your info or spam you.</p>
                                                        <label class="form-label text-dark">Phone</label>
                                                        <div>
                                                            <input type="number" id="phoneTxt" class="form-control pt-3 pb-3" required
                                                                    parsley-type="name" placeholder="Enter Phone number"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                    <h5 class="mt-3 mb-1 fw-bold  font-30">Next create a strong password</h5>
                                                    <p class="font-20  mb-3">To make this extra secure, please use symbols, uncommon words, and at least 8 characters.</p>
                                                        <label class="form-label text-dark">Password</label>
                                                        <div>
                                                            <input type="password" id="passTxt" class="form-control pt-3 pb-3" required
                                                            parsley-type="password"  placeholder="Enter a password"/>
                                                            <div class="mt-2">
                                                                <label class="form-label text-dark">Confirm Password</label>
                                                                <input type="password" class="form-control pt-3 pb-3" required
                                                                        data-parsley-equalto="#passTxt"
                                                                        placeholder="Confirm Password"/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="submit" id="btnNext" class="btn btn-brand-02"> Continue </button>
                                                </form>
                                            </div>
                                            <div class="col-md-1"></div>
                                        </div>
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
                        <div class="bg1"></div>
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
            if(lData.phone!=null){
                phoneTxt.value=lData.phone;
            }
        }
        console.log(lData)

       function saveData(){
        lData.phone=phoneTxt.value

        localStorage.setItem("reg_data",JSON.stringify(lData))
        // ={"firstName":"", "lastName":"", "phone":"", "password":""}
       }
        </script>
    <script>
        let passTxt=document.getElementById('passTxt');

        let lData={};
        if(localStorage.getItem("reg_data")!=null){
            lData =JSON.parse(localStorage.getItem("reg_data"))
            if(lData.password!=null){
                passTxt.value=lData.password;
            }
        }
        console.log(lData)

       function saveData(){
        lData.password=passTxt.value
        console.log(lData);
        localStorage.setItem("reg_data",JSON.stringify(lData))
        // ={"firstName":"", "lastName":"", "phone":"", "password":""}
       }
        </script>
@endsection

@extends('templates.auth-template')

@section('content')
    <style>
        input {
            padding: 20px !important;
        }
    </style>
    <!-- Log In page -->
    <div class="Email">
        <div class="vh-100" >
            <div class="">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="">

                            <div class=" p-0">
                                <div class="row">
                                    <div class="col-md-2 text-center">
                                        <a href="business-location" class=""><i class=" fas fa-arrow-left  pt-4"></i></a>
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
                                    <div class="tab-pane active " id="Register_Tab" role="tabpanel">
                                       
                                        <div class="row ">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-10">
                                                <div class="mb-3">
                                                   
                                                    <br>
                                                    <form class="form-parsley" id="form" onsubmit="saveData()"
                                                        action="business-upload">
                                                        <div class="form-group">
                                                        <h5 class="fw-bold  font-30">What Email address can we reach you at?</h5>
                                                        <p class="font-20  mb-3">Please provide your business email address</p>
                                                            <label class="form-label text-dark">Business Email Address</label>
                                                            <div>
                                                                <input type="email" id="bssEmailTxt" class="form-control  pt-2 pb-2"
                                                                    required parsley-type="email"
                                                                    placeholder="Enter your business email address " />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                        <h5 class=" fw-bold  font-30">What phone number can we reach you at?</h5>
                                                        <p class="font-20  mb-3">Please provide your business contact details</p>
                                                            <label class="form-label text-dark">Phone Number</label>
                                                            <div>
                                                                <input type="number" id="bssPhoneTxt" class="form-control  pt-2 pb-2"
                                                                    required parsley-type="name"
                                                                    placeholder="Enter your business phone number" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                    <h5 class="mt-3 fw-bold  font-30">Next create a strong password</h5>
                                                    <p class="font-20  mb-3">To make this unique and secure, please use symbols, uncommon words, and at least 8 characters.</p>
                                                        <label class="form-label text-dark">Password</label>
                                                        <div>
                                                            <input type="password" id="passTxt" class="form-control  pt-2 pb-2" required
                                                              placeholder="Enter password"/>
                                                             <div class="mt-2">
                                                        <input type="password" class="form-control  pt-2 pb-2" required
                                                                data-parsley-equalto="#passTxt" id="confirmTxt"
                                                                placeholder="Confirm Password"/>
                                                    </div>
                                                        </div>
                                                    </div><!--end form-group-->
                                                        <!--end form-group-->
                                                        <button type="submit" id="btnNext" class="btn btn-brand-02"> Continue </button>
                                                    </form>
                                                </div>
                                                <div class="mb-3">

                                                </div>
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
        let bssEmailTxt = document.getElementById('bssEmailTxt');

        let lData = {};
        if (localStorage.getItem("reg_data") != null) {
            lData = JSON.parse(localStorage.getItem("reg_data"))
            if (lData.businessEmail != null) {
                bssEmailTxt.value = lData.businessEmail;
            }

        }

        console.log(lData)

        function saveData() {
            lData.businessEmail = bssEmailTxt.value
            console.log(lData);
            localStorage.setItem("reg_data", JSON.stringify(lData))
        }
    </script>
        <script>
        let bssPhoneTxt = document.getElementById('bssPhoneTxt');

        let lData = {};
        if (localStorage.getItem("reg_data") != null) {
            lData = JSON.parse(localStorage.getItem("reg_data"))
            if (lData.businessPhone != null) {
                bssPhoneTxt.value = lData.businessPhone;
            }
        }

        console.log(lData)

        function saveData() {
            lData.businessPhone = bssPhoneTxt.value
            console.log(lData);
            localStorage.setItem("reg_data", JSON.stringify(lData))
        }
    </script>
        <script>
        let passTxt=document.getElementById('passTxt');

        let lData={};
        if(localStorage.getItem("reg_data")!=null){
            lData =JSON.parse(localStorage.getItem("reg_data"))
            if(lData.businessPassword!=null){
                passTxt.value=lData.businessPassword;
                confirmTxt.value=lData.businessPassword;
            }
        }
        console.log(lData)

       function saveData(){
        lData.businessPassword=passTxt.value
        console.log(lData);
        localStorage.setItem("reg_data",JSON.stringify(lData))
        // ={"firstName":"", "lastName":"", "phone":"", "password":""}
       }
        </script>
@endsection

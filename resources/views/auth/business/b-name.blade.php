@extends('templates.auth-template')

@section('content')
    <style>
        input {
            padding: 20px !important;
        }
    </style>
    <!-- Log In page -->
    <div class="Business">
        <div class="  vh-100" >
            <div class="col-12 ">
                <div class="row">
                    <div class="col-md-6">
                        <div class="">

                            <div class=" p-0">
                                <div class="row">
                                    <div class="col-md-2 text-center">
                                        <a href="/register" class=""><i class=" fas fa-arrow-left  pt-4"></i></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="text-center p-2 pb-3">
                                            <h4 class="mt-2  fw-semibold  font-17">1/3</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <a href="/register" class=""><i class=" fas fa-home  pt-4"></i></a>
                                    </div>
                                </div>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active " id="Register_Tab" role="tabpanel">
                                        
                                        <!-- <h3 class="text-center"></h3> -->
                                        <div class="row ">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-10">
                                                <div class="mb-3">
                                                   
                                                    <br>
                                                    <form class="form-parsley" id="form" onsubmit="saveData()"
                                                        action="business-email">
                                                        <div class="form-group">
                                                        <h5 class=" fw-bold  font-30">Sign up as a Business</h5>
                                                         <p class="font-20  mb-3">Let's Start with your Business name</p>
                                                            <label class="form-label text-dark">Business Name</label>
                                                            <div>
                                                                <input type="text" id="bssNameTxt" class="form-control pt-3 pb-3"
                                                                    required parsley-type="name"
                                                                    placeholder="Enter your business name" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                        <h5 class=" fw-bold  font-30">Where is your business located?</h5>
                                                        <p class="font-20  mb-3">Please provide your business current address</p>
                                                            <label class="form-label text-dark">Business Location</label>
                                                            <div>
                                                                <input type="text" id="bssLocationTxt" class="form-control pt-3 pb-3"
                                                                    required parsley-type="name"
                                                                    placeholder="Enter your address " />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                        <h5 class=" fw-bold  font-30">What is your business  registration number</h5>
                                                        <p class="font-20  mb-3">Please provide your business registration details</p>
                                                            <label class="form-label text-dark">Registration Number</label>
                                                            <div>
                                                                <input type="text" id="bssRegNoTxt" class="form-control pt-3 pb-3"
                                                                    required parsley-type="name"
                                                                    placeholder="Enter your business registration number" />
                                                            </div>
                                                        </div>
                                                        <!--end form-group-->
                                                        <button type="submit" id="btnNext" class="btn btn-brand-02"> Let's
                                                            get started </button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-1"></div>
                                        </div>

                                    </div>


                                </div>
                            </div>
                            <!--end card-body-->
                            <div class="card-body bg-light-alt text-center">

                            </div>
                        </div>
                        <!--end card-->
                    </div>
                    <div class="col-md-6 p-0">
                        <div class="bg3"></div>
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
        let bssNameTxt = document.getElementById('bssNameTxt');

        let lData = {};
        if (localStorage.getItem("reg_data") != null) {
            lData = JSON.parse(localStorage.getItem("reg_data"))
            if (lData.businessName != null) {
                bssNameTxt.value = lData.businessName;
            }

        }

        console.log(lData)

        function saveData() {
            lData.businessName = bssNameTxt.value
            console.log(lData);
            localStorage.setItem("reg_data", JSON.stringify(lData))
        }
    </script>
       <script>
        let bssLocationTxt = document.getElementById('bssLocationTxt');

        let lData = {};
        if (localStorage.getItem("reg_data") != null) {
            lData = JSON.parse(localStorage.getItem("reg_data"))
            if (lData.businessLocation != null) {
                bssLocationTxt.value = lData.businessLocation;
            }

        }

        console.log(lData)

        function saveData() {
            lData.businessLocation = bssLocationTxt.value
            console.log(lData);
            localStorage.setItem("reg_data", JSON.stringify(lData))
        }
    </script>
        <script>
        let bssRegNoTxt = document.getElementById('bssRegNoTxt');

        let lData = {};
        if (localStorage.getItem("reg_data") != null) {
            lData = JSON.parse(localStorage.getItem("reg_data"))
            if (lData.businessRegNo != null) {
                bssRegNoTxt.value = lData.businessRegNo;
            }

        }

        console.log(lData)

        function saveData() {
            lData.businessRegNo = bssRegNoTxt.value
            console.log(lData);
            localStorage.setItem("reg_data", JSON.stringify(lData))
        }
    </script>
@endsection

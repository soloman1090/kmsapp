@extends('templates.auth-template')

@section('content')
    <style>
        input {
            padding: 20px !important;
        }
    </style>
    <!-- Log In page -->
    <div class="container">
        <div class="row  d-flex justify-content-center vh-100" >
            <div class="col-12 align-self-center">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="card card-top">

                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-md-2 text-center">
                                        <a href="business-reg-no" class=""><i class=" fas fa-arrow-left  pt-4"></i></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="text-center p-2">
                                            <h4 class="mt-3 mb-1 fw-semibold  font-17">5/7</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <a href="/register" class=""><i class=" fas fa-home  pt-4"></i></a>
                                    </div>
                                </div>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active " id="Register_Tab" role="tabpanel">
                                        <br>
                                        <h3 class="text-center"></h3>
                                        <div class="row ">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-10">
                                                <h4 class="mb-2 fw-bold  font-30">What phone number can we reach you at?</h4>
                                                <p class="font-20  mb-0">Please provide your business contact details</p>
                                                <br>
                                                <form class="form-parsley" id="form" onsubmit="saveData()"
                                                    action="business-password">
                                                    <div class="form-group">
                                                        <label class="form-label text-dark">Phone Number</label>
                                                        <div>
                                                            <input type="number" id="bssPhoneTxt" class="form-control"
                                                                required parsley-type="name"
                                                                placeholder="Enter your business phone number" />
                                                        </div>
                                                    </div>
                                                    <!--end form-group-->
                                                    <button type="submit" id="btnNext" class="btn btn-primary btn-lg"> Continue</button>
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
@endsection

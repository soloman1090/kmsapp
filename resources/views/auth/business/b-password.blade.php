@extends('templates.auth-template')

@section('content')
<style>
    input{padding: 20px !important;}
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
                                        <a href="business-phone" class=""><i class=" fas fa-arrow-left  pt-4"></i></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="text-center p-2">
                                            <h4 class="mt-3 mb-1 fw-semibold  font-17">6/7</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <a href="register" class=""><i class=" fas fa-home  pt-4"></i></a>
                                    </div>
                                </div>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active px-3 pt-3" id="Register_Tab" role="tabpanel">
                                        <br>

                                        <div class="row ">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-10">
                                                <h4 class="mt-3 mb-1 fw-bold  font-30">Next create a strong password</h4>
                                                <p class="font-20  mb-0">To make this unique and secure, please use symbols, uncommon words, and at least 8 characters.</p>
                                                <br>
                                                <form class="form-parsley" action="business-upload" onsubmit="saveData()">
                                                    <div class="form-group">
                                                        <label class="form-label text-dark">Password</label>
                                                        <div>
                                                            <input type="password" id="passTxt" class="form-control" required
                                                              placeholder="Enter password"/>
                                                             <div class="mt-2">
                                                        <input type="password" class="form-control" required
                                                                data-parsley-equalto="#passTxt" id="confirmTxt"
                                                                placeholder="Confirm Password"/>
                                                    </div>
                                                        </div>
                                                    </div><!--end form-group-->
                                                    <button type="submit" id="btnNext" class="btn btn-primary btn-lg"> Continue </button>
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
                            <div class="card-body bg-light-alt text-center card-bottom">

                                <span class="text-muted d-none d-sm-inline-block">Palm Alliance © <script>
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

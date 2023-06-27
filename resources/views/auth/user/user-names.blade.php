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
                                        <a href="user-password" class=""><i class=" fas fa-arrow-left  pt-4"></i></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="text-center p-2">
                                            <h4 class="mt-3 mb-1 fw-semibold  font-17">3/5</h4>
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
                                               
                                                <br>
                                                <form class="form-parsley" action="user-phone" onsubmit="saveData()">
                                                    <div class="form-group">
                                                    <h4 class="mt-3 mb-1 fw-bold  font-30">Nice. Now, What's your name?</h4>
                                                <p class="font-20  mb-0">We're required to get your full legal first and last name. If the name you go by is different, please enter both below</p>
                                                        <label class="form-label text-dark">Legal First Name</label>
                                                        <div>
                                                            <input type="text" class="form-control" required
                                                                    parsley-type="name" id="firstName" placeholder="Enter legal first name"/>
                                                        </div>
                                                    </div><!--end form-group-->
                                                    <div class="form-group">
                                                        <label class="form-label">Legal Last Name</label>
                                                        <div>
                                                            <input type="text" class="form-control" required
                                                                    parsley-type="name" id="lastName" placeholder="Enter legal last name"/>
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

    <script>


        let firstName=document.getElementById('firstName');
        let lastName=document.getElementById('lastName');

        let lData={};
        if(localStorage.getItem("reg_data")!=null){
            lData =JSON.parse(localStorage.getItem("reg_data"))
           if(lData.firstName!=null && lData.lastName!=null){
            firstName.value=lData.firstName;
            lastName.value=lData.lastName;
           }
        }
        console.log(lData)

       function saveData(){
        lData.firstName=firstName.value
        lData.lastName=lastName.value
        console.log(lData);
        localStorage.setItem("reg_data",JSON.stringify(lData))
        // ={"firstName":"", "lastName":"", "phone":"", "password":""}
       }
        </script>
@endsection

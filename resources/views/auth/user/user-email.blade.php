@extends('templates.auth-template')

@section('content')
    <style>
        input {
            padding: 20px !important;
        }
    </style>
    <!-- Log In page -->
    <div class="UserS">
         <div class=" vh-100" >
            <div class="">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="">

                            <div class=" p-0">
                                <div class="row">
                                    <div class="col-md-2 text-center">
                                        <a href="/register" class=""><i class=" fas fa-arrow-left  pt-4 "></i></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="text-center p-2">
                                            <h4 class="mt-3 mb-1 fw-semibold  font-17">1/3</h4>
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
                                               
                                                <br>
                                                <form class="form-parsley" id="form" onsubmit="saveData()"
                                                    action="user-phone">
                                                    <div class="form-group">
                                                    <h5 class=" fw-bold  font-30">Let's Get Started With Your Email
                                                    Address</h5>
                                                    <p class="font-20  mb-3">You will use this as your login.</p>
                                                        <label class="form-label text-dark">E-Mail Address</label>
                                                        <div>
                                                            <input type="email" id="emailTxt" class="form-control pt-3 pb-3"
                                                                required parsley-type="email"
                                                                placeholder="Enter a valid e-mail address" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                    <h5 class="mt-3 mb-1 fw-bold  font-30">Nice. Now, What's your name?</h3>
                                                    <p class="font-20  mb-3">We're required to get your full legal first and last name. If the name you go by is different, please enter both below</p>
                                                        <label class="form-label text-dark">Legal First Name</label>
                                                        <div>
                                                            <input type="text" class="form-control pt-3 pb-3" required
                                                                    parsley-type="name" id="firstName" placeholder="Enter legal first name"/>
                                                        </div>
                                                    </div><!--end form-group-->
                                                    <div class="form-group">
                                                        <label class="form-label">Legal Last Name</label>
                                                        <div>
                                                            <input type="text" class="form-control pt-3 pb-3" required
                                                                    parsley-type="name" id="lastName" placeholder="Enter legal last name"/>
                                                        </div>
                                                    </div>
                                                    
                                                    <!--end form-group-->
                                                    <button type="submit" id="btnNext" class="btn btn-brand-02"> Let's
                                                        get started </button>
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


        let lData = {};
        if (localStorage.getItem("reg_data") != null) {
            lData = JSON.parse(localStorage.getItem("reg_data"))
            if (lData.email != null) {
                emailTxt.value = lData.email;
            }

        }

        console.log(lData)

        function saveData() {
            lData.email = emailTxt.value
            console.log(lData);
            localStorage.setItem("reg_data", JSON.stringify(lData))
        }


    </script>
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

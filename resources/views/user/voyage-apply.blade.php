<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/minia-symfony/layouts/layouts-horizontal.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 02 Jan 2023 11:16:43 GMT -->
<head>

    <meta charset="utf-8" />
    <title>{{ $page_title }} | Palm Member</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Palmalliance Members Dashboard" name="description" />
    <meta content="PalmAlliance" name="Palm" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin-assets/img/fav-icon.png') }}">
    <link rel="icon" href="{{ asset('admin-assets/img/fav-icon.png') }}" type="image/x-icon">

    <!-- plugin css -->
    <link href="{{ asset('main-user-assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user-assets/css/circle.css') }}" rel="stylesheet">
    <!-- preloader css -->
    <link rel="stylesheet" href="{{ asset('main-user-assets/css/preloader.min.css') }}" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="{{ asset('main-user-assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('main-user-assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->

</head>
<body>
    <!-- Begin page -->
    <div id="layout-wrapper">

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 ">
                            <br><br>

                            <div class="logo-lg text-center">
                                <img src="{{ asset('admin-assets/img/logo.png') }}" alt="" height="84">
                            </div>
                            <br><br>
                            <div class="card">
                                <div class="card-header text-center">
                                    <h2>VOYAGER CLIENT APPLICATION</h2>
                                    </p>
                                </div>
                                <div class="card-body p-4 ">
                                    <form action="{{ route('user.voyager-program.store') }}" method="post">
                                        @csrf
                                        <p>To apply for the Voyager Client with us, please fill the following form accurately. We’ll then review your data to make sure it complies with the related rules and regulations. </p>

                                        <h4>Contact Information</h4>
                                        <br><br>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formrow-firstname-input">Full name</label>
                                                    <input type="text" name="full_name" required class="form-control" value="{{ $user->name }} {{ $user->last_name }}" placeholder="Enter Full Name">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formrow-firstname-input"> Email Address</label>
                                                    <input type="email" name="email"  required class="form-control" placeholder="Enter Palm Registered Email Address" value="{{ $user->email }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="formCheckBusiness" >
                                            <label class="form-check-label" for="formCheckBusiness">
                                                <b>I Have a Business</b>
                                            </label>
                                        </div>
                                        <br>

                                        <div class="row ">
                                            <div class="birth_view">
                                                <h5 class="font-size-14 mb-4"><i class="mdi mdi-calendar text-primary me-1"></i> Date Of Birth</h5>
                                                <div class=" row ">
                                                    <div class="col-sm-4">
                                                        <label class="" for="specificSizeInputName">Day</label>
                                                        <input type="number" class="form-control" name="day" id="specificSizeInputName" placeholder="Enter Day">
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <label class=" " for="specificSizeInputName">Name</label>
                                                        <select name="month" id="" class="form-control">
                                                            <option value="">Select Month</option>

                                                            <option value="1" data-reactid="105">January</option>
                                                            <option value="2" data-reactid="106">February</option>
                                                            <option value="3" data-reactid="107">March</option>
                                                            <option value="4" data-reactid="108">April</option>
                                                            <option value="5" data-reactid="109">May</option>
                                                            <option value="6" data-reactid="110">June</option>
                                                            <option value="7" data-reactid="111">July</option>
                                                            <option value="8" data-reactid="112">August</option>
                                                            <option value="9" data-reactid="113">September</option>
                                                            <option value="10" data-reactid="114">October</option>
                                                            <option value="11" data-reactid="115">November</option>
                                                            <option value="12" data-reactid="116">December</option>

                                                        </select>
                                                    </div>

                                                    <div class="col-sm-4 mb-3">
                                                        <label class=" " for="specificSizeInputName">Year</label>
                                                        <input type="number" name="year" class="form-control" id="specificSizeInputName" placeholder="Enter Year">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="company-view">
                                                <h5 class="font-size-14 mb-4"><i class="mdi mdi-home text-primary me-1"></i> Business Information</h5>
                                                <div class="row ">
                                                    <div class="col-sm-6 mb-3">
                                                        <label class=" ">Business Name</label>
                                                        <input type="text" name="business_name" class="form-control" id="specificSizeInputName" placeholder="Enter Name of your Business">
                                                    </div>
                                                    <div class="col-sm-6 mb-3">
                                                        <label class=" ">Company Registration Number</label>
                                                        <input type="text" name="business_reg" class="form-control" id="specificSizeInputName" placeholder="Enter Business Registration Number">
                                                    </div>
                                                    <div class="col-sm-12 mb-3">
                                                        <label class=" ">Position In Business </label>
                                                        <input type="text" name="business_position" class="form-control" id="specificSizeInputName" placeholder="Enter Your Position">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="formrow-firstname-input">ID or Passport Number</label>
                                                        <input type="number" name="passport_no" required class="form-control" placeholder="Enter Number">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="formrow-firstname-input"> Phone Number</label>
                                                        <input type="number" name="phone" required class="form-control" placeholder="Enter Phone Number" value="{{ $user->phone }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="formrow-firstname-input">Street</label>
                                                        <input type="text" name="street" required class="form-control" placeholder="Enter Street ">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="formrow-firstname-input"> City</label>
                                                        <input type="text" name="city" required class="form-control" placeholder="Enter City" value="{{ $user->city }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="formrow-firstname-input">Zip Code</label>
                                                        <input type="text" name="zip" required class="form-control" placeholder="Enter Zip Code ">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="formrow-firstname-input"> Country</label>
                                                        <select id="country" name="country" required class="form-control" data-reactid="448">
                                                            <option value="" data-reactid="">Select Country</option>
                                                            <option value="Afghanistan" data-reactid="449">Afghanistan</option>
                                                            <option value="Albania" data-reactid="450">Albania</option>
                                                            <option value="Algeria" data-reactid="451">Algeria</option>
                                                            <option value="American Samoa" data-reactid="452">American Samoa</option>
                                                            <option value="Andorra" data-reactid="453">Andorra</option>
                                                            <option value="Angola" data-reactid="454">Angola</option>
                                                            <option value="Anguilla" data-reactid="455">Anguilla</option>
                                                            <option value="Antarctica" data-reactid="456">Antarctica</option>
                                                            <option value="Antigua and Barbuda" data-reactid="457">Antigua and Barbuda</option>
                                                            <option value="Argentina" data-reactid="458">Argentina</option>
                                                            <option value="Armenia" data-reactid="459">Armenia</option>
                                                            <option value="Aruba" data-reactid="460">Aruba</option>
                                                            <option value="Australia" data-reactid="461">Australia</option>
                                                            <option value="Austria" data-reactid="462">Austria</option>
                                                            <option value="Azerbaijan" data-reactid="463">Azerbaijan</option>
                                                            <option value="Bahamas" data-reactid="464">Bahamas</option>
                                                            <option value="Bahrain" data-reactid="465">Bahrain</option>
                                                            <option value="Bangladesh" data-reactid="466">Bangladesh</option>
                                                            <option value="Barbados" data-reactid="467">Barbados</option>
                                                            <option value="Belarus" data-reactid="468">Belarus</option>
                                                            <option value="Belgium" data-reactid="469">Belgium</option>
                                                            <option value="Belize" data-reactid="470">Belize</option>
                                                            <option value="Benin" data-reactid="471">Benin</option>
                                                            <option value="Bermuda" data-reactid="472">Bermuda</option>
                                                            <option value="Bhutan" data-reactid="473">Bhutan</option>
                                                            <option value="Bolivia" data-reactid="474">Bolivia</option>
                                                            <option value="Bonaire, Sint Eustatius and Saba" data-reactid="475">Bonaire, Sint Eustatius and Saba</option>
                                                            <option value="Bosnia and Herzegovina" data-reactid="476">Bosnia and Herzegovina</option>
                                                            <option value="Botswana" data-reactid="477">Botswana</option>
                                                            <option value="Bouvet Island" data-reactid="478">Bouvet Island</option>
                                                            <option value="Brazil" data-reactid="479">Brazil</option>
                                                            <option value="British Indian Ocean Territory" data-reactid="480">British Indian Ocean Territory</option>
                                                            <option value="Brunei Darussalam" data-reactid="481">Brunei Darussalam</option>
                                                            <option value="Bulgaria" data-reactid="482">Bulgaria</option>
                                                            <option value="Burkina Faso" data-reactid="483">Burkina Faso</option>
                                                            <option value="Burundi" data-reactid="484">Burundi</option>
                                                            <option value="Cambodia" data-reactid="485">Cambodia</option>
                                                            <option value="Cameroon" data-reactid="486">Cameroon</option>
                                                            <option value="Canada" data-reactid="487">Canada</option>
                                                            <option value="Cape Verde" data-reactid="488">Cape Verde</option>
                                                            <option value="Cayman Islands" data-reactid="489">Cayman Islands</option>
                                                            <option value="Central African Republic" data-reactid="490">Central African Republic</option>
                                                            <option value="Chad" data-reactid="491">Chad</option>
                                                            <option value="Chile" data-reactid="492">Chile</option>
                                                            <option value="China" data-reactid="493">China</option>
                                                            <option value="Christmas Island" data-reactid="494">Christmas Island</option>
                                                            <option value="Cocos (Keeling) Islands" data-reactid="495">Cocos (Keeling) Islands</option>
                                                            <option value="Colombia" data-reactid="496">Colombia</option>
                                                            <option value="Comoros" data-reactid="497">Comoros</option>
                                                            <option value="Congo" data-reactid="498">Congo</option>
                                                            <option value="Congo, the Democratic Republic of the" data-reactid="499">Congo, the Democratic Republic of the</option>
                                                            <option value="Cook Islands" data-reactid="500">Cook Islands</option>
                                                            <option value="Costa Rica" data-reactid="501">Costa Rica</option>
                                                            <option value="Cote D'Ivoire" data-reactid="502">Cote D'Ivoire</option>
                                                            <option value="Croatia" data-reactid="503">Croatia</option>
                                                            <option value="Cuba" data-reactid="504">Cuba</option>
                                                            <option value="Curaçao" data-reactid="505">Curaçao</option>
                                                            <option value="Cyprus" data-reactid="506">Cyprus</option>
                                                            <option value="Czech Republic" data-reactid="507">Czech Republic</option>
                                                            <option value="Denmark" data-reactid="508">Denmark</option>
                                                            <option value="Djibouti" data-reactid="509">Djibouti</option>
                                                            <option value="Dominica" data-reactid="510">Dominica</option>
                                                            <option value="Dominican Republic" data-reactid="511">Dominican Republic</option>
                                                            <option value="Ecuador" data-reactid="512">Ecuador</option>
                                                            <option value="Egypt" data-reactid="513">Egypt</option>
                                                            <option value="El Salvador" data-reactid="514">El Salvador</option>
                                                            <option value="Equatorial Guinea" data-reactid="515">Equatorial Guinea</option>
                                                            <option value="Eritrea" data-reactid="516">Eritrea</option>
                                                            <option value="Estonia" data-reactid="517">Estonia</option>
                                                            <option value="Ethiopia" data-reactid="518">Ethiopia</option>
                                                            <option value="Falkland Islands (Malvinas)" data-reactid="519">Falkland Islands (Malvinas)</option>
                                                            <option value="Faroe Islands" data-reactid="520">Faroe Islands</option>
                                                            <option value="Fiji" data-reactid="521">Fiji</option>
                                                            <option value="Finland" data-reactid="522">Finland</option>
                                                            <option value="France" data-reactid="523">France</option>
                                                            <option value="French Guiana" data-reactid="524">French Guiana</option>
                                                            <option value="French Polynesia" data-reactid="525">French Polynesia</option>
                                                            <option value="French Southern Territories" data-reactid="526">French Southern Territories</option>
                                                            <option value="Gabon" data-reactid="527">Gabon</option>
                                                            <option value="Gambia" data-reactid="528">Gambia</option>
                                                            <option value="Georgia" data-reactid="529">Georgia</option>
                                                            <option value="Germany" data-reactid="530">Germany</option>
                                                            <option value="Ghana" data-reactid="531">Ghana</option>
                                                            <option value="Gibraltar" data-reactid="532">Gibraltar</option>
                                                            <option value="Greece" data-reactid="533">Greece</option>
                                                            <option value="Greenland" data-reactid="534">Greenland</option>
                                                            <option value="Grenada" data-reactid="535">Grenada</option>
                                                            <option value="Guadeloupe" data-reactid="536">Guadeloupe</option>
                                                            <option value="Guam" data-reactid="537">Guam</option>
                                                            <option value="Guatemala" data-reactid="538">Guatemala</option>
                                                            <option value="Guernsey" data-reactid="539">Guernsey</option>
                                                            <option value="Guinea" data-reactid="540">Guinea</option>
                                                            <option value="Guinea-Bissau" data-reactid="541">Guinea-Bissau</option>
                                                            <option value="Guyana" data-reactid="542">Guyana</option>
                                                            <option value="Haiti" data-reactid="543">Haiti</option>
                                                            <option value="Heard Island and Mcdonald Islands" data-reactid="544">Heard Island and Mcdonald Islands</option>
                                                            <option value="Holy See (Vatican City State)" data-reactid="545">Holy See (Vatican City State)</option>
                                                            <option value="Honduras" data-reactid="546">Honduras</option>
                                                            <option value="Hong Kong" data-reactid="547">Hong Kong</option>
                                                            <option value="Hungary" data-reactid="548">Hungary</option>
                                                            <option value="Iceland" data-reactid="549">Iceland</option>
                                                            <option value="India" data-reactid="550">India</option>
                                                            <option value="Indonesia" data-reactid="551">Indonesia</option>
                                                            <option value="Iran, Islamic Republic of" data-reactid="552">Iran, Islamic Republic of</option>
                                                            <option value="Iraq" data-reactid="553">Iraq</option>
                                                            <option value="Ireland" data-reactid="554">Ireland</option>
                                                            <option value="Isle of Man" data-reactid="555">Isle of Man</option>
                                                            <option value="Israel" data-reactid="556">Israel</option>
                                                            <option value="Italy" data-reactid="557">Italy</option>
                                                            <option value="Jamaica" data-reactid="558">Jamaica</option>
                                                            <option value="Japan" data-reactid="559">Japan</option>
                                                            <option value="Jersey" data-reactid="560">Jersey</option>
                                                            <option value="Jordan" data-reactid="561">Jordan</option>
                                                            <option value="Kazakhstan" data-reactid="562">Kazakhstan</option>
                                                            <option value="Kenya" data-reactid="563">Kenya</option>
                                                            <option value="Kiribati" data-reactid="564">Kiribati</option>
                                                            <option value="Korea, Democratic People's Republic of" data-reactid="565">Korea, Democratic People's Republic of</option>
                                                            <option value="Korea, Republic of" data-reactid="566">Korea, Republic of</option>
                                                            <option value="Kosovo" data-reactid="567">Kosovo</option>
                                                            <option value="Kuwait" data-reactid="568">Kuwait</option>
                                                            <option value="Kyrgyzstan" data-reactid="569">Kyrgyzstan</option>
                                                            <option value="Lao People's Democratic Republic" data-reactid="570">Lao People's Democratic Republic</option>
                                                            <option value="Latvia" data-reactid="571">Latvia</option>
                                                            <option value="Lebanon" data-reactid="572">Lebanon</option>
                                                            <option value="Lesotho" data-reactid="573">Lesotho</option>
                                                            <option value="Liberia" data-reactid="574">Liberia</option>
                                                            <option value="Libyan Arab Jamahiriya" data-reactid="575">Libyan Arab Jamahiriya</option>
                                                            <option value="Liechtenstein" data-reactid="576">Liechtenstein</option>
                                                            <option value="Lithuania" data-reactid="577">Lithuania</option>
                                                            <option value="Luxembourg" data-reactid="578">Luxembourg</option>
                                                            <option value="Macao" data-reactid="579">Macao</option>
                                                            <option value="Macedonia, the Former Yugoslav Republic of" data-reactid="580">Macedonia, the Former Yugoslav Republic of</option>
                                                            <option value="Madagascar" data-reactid="581">Madagascar</option>
                                                            <option value="Malawi" data-reactid="582">Malawi</option>
                                                            <option value="Malaysia" data-reactid="583">Malaysia</option>
                                                            <option value="Maldives" data-reactid="584">Maldives</option>
                                                            <option value="Mali" data-reactid="585">Mali</option>
                                                            <option value="Malta" data-reactid="586">Malta</option>
                                                            <option value="Marshall Islands" data-reactid="587">Marshall Islands</option>
                                                            <option value="Martinique" data-reactid="588">Martinique</option>
                                                            <option value="Mauritania" data-reactid="589">Mauritania</option>
                                                            <option value="Mauritius" data-reactid="590">Mauritius</option>
                                                            <option value="Mayotte" data-reactid="591">Mayotte</option>
                                                            <option value="Mexico" data-reactid="592">Mexico</option>
                                                            <option value="Micronesia, Federated States of" data-reactid="593">Micronesia, Federated States of</option>
                                                            <option value="Moldova, Republic of" data-reactid="594">Moldova, Republic of</option>
                                                            <option value="Monaco" data-reactid="595">Monaco</option>
                                                            <option value="Mongolia" data-reactid="596">Mongolia</option>
                                                            <option value="Montenegro" data-reactid="597">Montenegro</option>
                                                            <option value="Montserrat" data-reactid="598">Montserrat</option>
                                                            <option value="Morocco" data-reactid="599">Morocco</option>
                                                            <option value="Mozambique" data-reactid="600">Mozambique</option>
                                                            <option value="Myanmar" data-reactid="601">Myanmar</option>
                                                            <option value="Namibia" data-reactid="602">Namibia</option>
                                                            <option value="Nauru" data-reactid="603">Nauru</option>
                                                            <option value="Nepal" data-reactid="604">Nepal</option>
                                                            <option value="Netherlands" data-reactid="605">Netherlands</option>
                                                            <option value="New Caledonia" data-reactid="606">New Caledonia</option>
                                                            <option value="New Zealand" data-reactid="607">New Zealand</option>
                                                            <option value="Nicaragua" data-reactid="608">Nicaragua</option>
                                                            <option value="Niger" data-reactid="609">Niger</option>
                                                            <option value="Nigeria" data-reactid="610">Nigeria</option>
                                                            <option value="Niue" data-reactid="611">Niue</option>
                                                            <option value="Norfolk Island" data-reactid="612">Norfolk Island</option>
                                                            <option value="Northern Mariana Islands" data-reactid="613">Northern Mariana Islands</option>
                                                            <option value="Norway" data-reactid="614">Norway</option>
                                                            <option value="Oman" data-reactid="615">Oman</option>
                                                            <option value="Pakistan" data-reactid="616">Pakistan</option>
                                                            <option value="Palau" data-reactid="617">Palau</option>
                                                            <option value="Palestinian Territory, Occupied" data-reactid="618">Palestinian Territory, Occupied</option>
                                                            <option value="Panama" data-reactid="619">Panama</option>
                                                            <option value="Papua New Guinea" data-reactid="620">Papua New Guinea</option>
                                                            <option value="Paraguay" data-reactid="621">Paraguay</option>
                                                            <option value="Peru" data-reactid="622">Peru</option>
                                                            <option value="Philippines" data-reactid="623">Philippines</option>
                                                            <option value="Pitcairn" data-reactid="624">Pitcairn</option>
                                                            <option value="Poland" data-reactid="625">Poland</option>
                                                            <option value="Portugal" data-reactid="626">Portugal</option>
                                                            <option value="Puerto Rico" data-reactid="627">Puerto Rico</option>
                                                            <option value="Qatar" data-reactid="628">Qatar</option>
                                                            <option value="Reunion" data-reactid="629">Reunion</option>
                                                            <option value="Romania" data-reactid="630">Romania</option>
                                                            <option value="Russian Federation" data-reactid="631">Russian Federation</option>
                                                            <option value="Rwanda" data-reactid="632">Rwanda</option>
                                                            <option value="Saint Barthélemy" data-reactid="633">Saint Barthélemy</option>
                                                            <option value="Saint Helena" data-reactid="634">Saint Helena</option>
                                                            <option value="Saint Kitts and Nevis" data-reactid="635">Saint Kitts and Nevis</option>
                                                            <option value="Saint Lucia" data-reactid="636">Saint Lucia</option>
                                                            <option value="Saint Martin (French part)" data-reactid="637">Saint Martin (French part)</option>
                                                            <option value="Saint Pierre and Miquelon" data-reactid="638">Saint Pierre and Miquelon</option>
                                                            <option value="Saint Vincent and the Grenadines" data-reactid="639">Saint Vincent and the Grenadines</option>
                                                            <option value="Samoa" data-reactid="640">Samoa</option>
                                                            <option value="San Marino" data-reactid="641">San Marino</option>
                                                            <option value="Sao Tome and Principe" data-reactid="642">Sao Tome and Principe</option>
                                                            <option value="Saudi Arabia" data-reactid="643">Saudi Arabia</option>
                                                            <option value="Senegal" data-reactid="644">Senegal</option>
                                                            <option value="Serbia" data-reactid="645">Serbia</option>
                                                            <option value="Seychelles" data-reactid="646">Seychelles</option>
                                                            <option value="Sierra Leone" data-reactid="647">Sierra Leone</option>
                                                            <option value="Singapore" data-reactid="648">Singapore</option>
                                                            <option value="Sint Maarten (Dutch part)" data-reactid="649">Sint Maarten (Dutch part)</option>
                                                            <option value="Slovakia" data-reactid="650">Slovakia</option>
                                                            <option value="Slovenia" data-reactid="651">Slovenia</option>
                                                            <option value="Solomon Islands" data-reactid="652">Solomon Islands</option>
                                                            <option value="Somalia" data-reactid="653">Somalia</option>
                                                            <option value="South Africa" data-reactid="654">South Africa</option>
                                                            <option value="South Georgia and the South Sandwich Islands" data-reactid="655">South Georgia and the South Sandwich Islands</option>
                                                            <option value="South Sudan" data-reactid="656">South Sudan</option>
                                                            <option value="Spain" data-reactid="657">Spain</option>
                                                            <option value="Sri Lanka" data-reactid="658">Sri Lanka</option>
                                                            <option value="Sudan" data-reactid="659">Sudan</option>
                                                            <option value="Suriname" data-reactid="660">Suriname</option>
                                                            <option value="Svalbard and Jan Mayen" data-reactid="661">Svalbard and Jan Mayen</option>
                                                            <option value="Swaziland" data-reactid="662">Swaziland</option>
                                                            <option value="Sweden" data-reactid="663">Sweden</option>
                                                            <option value="Switzerland" data-reactid="664">Switzerland</option>
                                                            <option value="Syrian Arab Republic" data-reactid="665">Syrian Arab Republic</option>
                                                            <option value="Taiwan" data-reactid="666">Taiwan</option>
                                                            <option value="Tajikistan" data-reactid="667">Tajikistan</option>
                                                            <option value="Tanzania, United Republic of" data-reactid="668">Tanzania, United Republic of</option>
                                                            <option value="Thailand" data-reactid="669">Thailand</option>
                                                            <option value="Timor-Leste" data-reactid="670">Timor-Leste</option>
                                                            <option value="Togo" data-reactid="671">Togo</option>
                                                            <option value="Tokelau" data-reactid="672">Tokelau</option>
                                                            <option value="Tonga" data-reactid="673">Tonga</option>
                                                            <option value="Trinidad and Tobago" data-reactid="674">Trinidad and Tobago</option>
                                                            <option value="Tunisia" data-reactid="675">Tunisia</option>
                                                            <option value="Turkey" data-reactid="676">Turkey</option>
                                                            <option value="Turkmenistan" data-reactid="677">Turkmenistan</option>
                                                            <option value="Turks and Caicos Islands" data-reactid="678">Turks and Caicos Islands</option>
                                                            <option value="Tuvalu" data-reactid="679">Tuvalu</option>
                                                            <option value="Uganda" data-reactid="680">Uganda</option>
                                                            <option value="Ukraine" data-reactid="681">Ukraine</option>
                                                            <option value="United Arab Emirates" data-reactid="682">United Arab Emirates</option>
                                                            <option value="United Kingdom" data-reactid="683">United Kingdom</option>
                                                            <option value="United States Minor Outlying Islands" data-reactid="684">United States Minor Outlying Islands</option>
                                                            <option value="United States of America" data-reactid="685">United States of America</option>
                                                            <option value="Uruguay" data-reactid="686">Uruguay</option>
                                                            <option value="Uzbekistan" data-reactid="687">Uzbekistan</option>
                                                            <option value="Vanuatu" data-reactid="688">Vanuatu</option>
                                                            <option value="Venezuela" data-reactid="689">Venezuela</option>
                                                            <option value="Viet Nam" data-reactid="690">Viet Nam</option>
                                                            <option value="Virgin Islands, British" data-reactid="691">Virgin Islands, British</option>
                                                            <option value="Virgin Islands, U.S." data-reactid="692">Virgin Islands, U.S.</option>
                                                            <option value="Wallis and Futuna" data-reactid="693">Wallis and Futuna</option>
                                                            <option value="Western Sahara" data-reactid="694">Western Sahara</option>
                                                            <option value="Yemen" data-reactid="695">Yemen</option>
                                                            <option value="Zambia" data-reactid="696">Zambia</option>
                                                            <option value="Zimbabwe" data-reactid="697">Zimbabwe</option>
                                                            <option value="Åland Islands" data-reactid="698">Åland Islands</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <h4>Palm Account Details </h4>
                                            <br><br>
                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="formrow-firstname-input">Account Full Name</label>
                                                        <input type="text" name="account_name" required class="form-control" placeholder="Enter First & Last Name ">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="formrow-firstname-input"> Referral Code</label>
                                                        <input type="text" name="referral_code" required class="form-control" placeholder="Enter Referral Code">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <h4>Information About Palmalliance </h4>
                                            <br><br>
                                            <p>We strive to continuously improve our services and the brand awareness and we would therefore like to know you better as you are going to introduce our company. Please reply to the following questions and please note the answers to these questions are also part of the Voyager Client application and will be reviewed appropriately. </p>
                                            <div class="mb-3">
                                                <label class="form-label" for="formrow-firstname-input"><b>What will be the way of communication with clients ?</b></label>
                                                <input type="text" name="communication" class="form-control" required placeholder="oral, written, etc ">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="formrow-firstname-input"><b>Who are your target clients? Please describe their financial situation, education, experience with forex and/or CFD trading and other information that could be relevant to us.</b>
                                                </label>
                                                <input type="text" name="target_clients" class="form-control" required placeholder="Target Clients ">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="formrow-firstname-input"><b>How are you going to promote Palmalliance brand to potential clients? Will it be via face to face meetings, Palmalliance website and its marketing material, or through your own website, materials, webinars, etc?
                                                    </b>
                                                </label>
                                                <input type="text" name="promotion_materials" class="form-control" required placeholder="Promotion Materials ">
                                                <small>Please note that you may only use your own materials or website after prior approval by our Compliance team.</small>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="formrow-firstname-input"><b>What specific marketing materials for promotion of Palmalliance are you going to use? (any website, own presentation, printed materials, etc)
                                                    </b>
                                                </label>
                                                <input type="text" name="marketing_materials" class="form-control" required placeholder="Marketing Materials ">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="formrow-firstname-input"><b>What brokers or other financial institutions have you worked with in the past and for how many years?</b>
                                                </label>
                                                <input type="text" name="financial_institution" class="form-control" required placeholder="Brokers and Years ">
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="formCheck2" required>
                                                <label class="form-check-label" for="formCheck2">
                                                    <b>I acknowledge and accept the <a href="#" target="_blank" class="text-primary">Terms and Conditions</a> </b>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="formCheck2" required>
                                                <label class="form-check-label" for="formCheck2">
                                                    <b>I acknowledge and accept that my personal data shall be processed in accordance with <a href="/privacy-policy" target="_blank" class="text-primary">Privacy Policy</a> </b>
                                                </label>
                                            </div>
                                            <hr>
                                            <button class="btn btn-primary">Submit Application</button>
                                            <hr>
                                            <br>
                                            <h3 class="text-center">Questions? <a href="palmalliance.com/contact" target="blank">Contact</a> | <a href="palmalliance.com/faq" target="blank">FAQs</a></h3>
                                            <hr>
                                            <small>Your statements, confirmations, and activity history are available securely at <a href="Palmalliance.com">Palmalliance.com</a> . This serves as notice that prospectuses for any securities purchased in these transactions are available inside your account, under the portfolio tab, along with other important disclosures. Expanding a category of your portfolio shows its respective positions, and each links to the most recent prospectus. <br><br>

                                                How PAM calculates "better returns". Unless otherwise specified, all return figures shown above are for illustrative purposes only, and are not actual customer or model returns. Actual returns will vary greatly and depend on personal and market conditions. <br><br>
                                                The information on this site is intended solely for the benefit of firms and companies seeking private equity investment capital by providing general information on our services and philosophy. The material on this site is for informational purposes only and does not constitute an offer or solicitation to purchase any investment solutions or a recommendation to buy or sell a security nor is it to be construed as legal, tax or investment advice.<br><br>

                                                Unless otherwise indicated, any information available through this site is as of the date indicated therein and may not be updated or otherwise revised to reflect information that subsequently becomes available. PAM is under no obligation to update the information contained on this site. Additionally, the material on this site does not constitute a representation that the solutions described therein are suitable or appropriate for any person and PAM does not accept any liability with respect to the information. By using this site you agree to the Terms of Use. <br><br>

                                                This email was sent by: Palm Alliance Management <br>
                                                1201 N Orange St, Midtown Ste 100</small><br>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
            <!-- End Page-content -->



        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    <script src="//code.tidio.co/m3tedumpoleevbbgdo0jcfis2q8wynay.js" async></script>
    <!-- JAVASCRIPT -->
    <script src="{{ asset('main-user-assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('main-user-assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user-assets/js/skippr.min.js') }}"></script>

    <script>
        $(".birth_view").show();
        $(".company-view").hide();

        $("#formCheckBusiness").on('change', function() {

            if ($(this).is(":checked")) {
                $(".birth_view").hide();
                $(".company-view").show();
            } else {
                $(".birth_view").show();
                $(".company-view").hide();
            }
        })

    </script>
    <script>
        $("#newsSlider").skippr({
            transition: 'slide'
            , speed: 1000
            , easing: 'easeOutQuart'
            , navType: ''
            , childrenElementType: 'div'
            , arrows: false
            , autoPlay: true
            , autoPlayDuration: 5000
            , keyboardOnAlways: true
            , hidePrevious: false

        });

    </script>
    <script>
        let refData = document.getElementById("refereee")
        refData.style.visibility = "hidden";
        $('#referralLink').on('click', function() {
            refData.style.visibility = "visible";
            $(this).attr('referral_id')
            let link = `https://palmalliance.com/register/?refer=${$(this).attr('referral_id')}`

            refData.value = link;
            refData.select();
            refData.setSelectionRange(0, 99999);

            document.execCommand("copy");


            try {
                alert("Referral Link Copied ");
            } catch (error) {
                alert(`Copy Error: ${error}`)
                console.log(`Copy Error: ${error}`);
            }
            refData.style.visibility = "hidden";
        })

    </script>

    <script src="{{ asset('main-user-assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('main-user-assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('main-user-assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('main-user-assets/libs/feather-icons/feather.min.js') }}"></script>

    <!-- pace js -->
    <script src="{{ asset('main-user-assets/libs/pace-js/pace.min.js')}}"></script>

    <!-- apexcharts -->
    <script src="{{ asset('main-user-assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Required datatable js -->
    <script src="{{ asset('main-user-assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('main-user-assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Plugins js-->
    <script src="{{ asset('main-user-assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('main-user-assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}"></script>


    <!-- Responsive examples -->
    <script src="{{ asset('main-user-assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('main-user-assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('main-user-assets/js/pages/datatables.init.js') }}"></script>

    <!-- dashboard init -->
    <script src="{{ asset('main-user-assets/js/pages/dashboard.init.js') }}"></script>
    <script src="{{ asset('main-user-assets/js/app.js') }}"></script>


</body>
</html>

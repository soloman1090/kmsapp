@extends('templates.public')

@section('content')
<div class="contact-welcome text-center">
    <h1>Contact Us</h1>
    <h4>Let's Talk—</h4>
    <p>We will like to know more about you.</p>
</div>
<br>
<div class="line"></div>
<!-- Section form contact -->
<section class="padding-top:50px;">
    <div class="container">
        <div class="row">
            <div class="col-md-8 left-contact">
                <h4> Send Us a Message</h4>
                <form class="form-inline form-contact-finance" name="contact" method="post" action="http://templates.thememodern.com/finance/send_form_email.php">
                    <div class="row">
                        <div class="form-group col-sm-12  col-md-4">
                            <input type="text" class="form-control" name="yourName" id="yourName" placeholder="Your Name">
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                            <input type="email" class="form-control" name="yourEmail" id="yourEmail" placeholder="Your Email">
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                            <input type="text" class="form-control" name="yourPhone" id="phoneNumber" placeholder="Phone Number">
                        </div>
                    </div>
                    <div class="input-content">
                        <div class="form-group form-textarea">
                            <textarea id="textarea" class="form-control" name="comments" rows="6" placeholder="Your Messages"></textarea>
                        </div>
                    </div>
                    <button class="ot-btn large-btn btn-rounded  btn-main-color btn-submit" style="background-color:#1A7BB7;">Send Mail</button>
                </form> <!-- End Form -->
            </div> <!-- End col -->
            <div class="col-md-4 right-contact">
                <h4>Contact Info</h4>

                <ul class="address">
                    <li>
                        <p><i class="fa fa-home" aria-hidden="true"></i>&nbsp;&nbsp; 1201 N Orange St, Midtown Ste 100, Wilmington, Delaware</p>
                    </li>
                    <li>
                        <p><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;&nbsp; (302) 389-5302</p>
                    </li>
                    <li>
                        <p><i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp;&nbsp; support@palmalliance.com</p>
                    </li>
                    <li>
                        <p><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;&nbsp; Mon-Fri 09:00 - 17:00</p>
                    </li>
                </ul>
            </div> <!-- End col -->
        </div>
    </div>
</section>
<!-- End Section -->
<!-- Section Google Map -->
<div class="">
    <div class="row">
        <div style="width:100%; height:400px;">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3067.6235660814987!2d-75.55022568462431!3d39.74810587944846!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c6fd3f0aa1acff%3A0x347a23c4ec55b556!2s1201%20N%20Orange%20St%20%23100%2C%20Wilmington%2C%20DE%2019801%2C%20USA!5e0!3m2!1sen!2sng!4v1633804673434!5m2!1sen!2sng" style="border:0; width:100%;height:400px;" allowfullscreen="true" loading="lazy"></iframe>
        </div>
    </div>
</div>
<!-- End Section -->
@endsection

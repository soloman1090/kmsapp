@extends('templates.main-user')

@section('content')

<link href="{{ asset('user-assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">KYC NOTICE</h4>
                <p class="text-muted mb-0">Picture holding your valid ID</p>
            </div><!--end card-header-->
            <div class="card-body">
                <ul>
                    <li>Make sure the light is coming from in front of you, not behind you, such that your face is clearly visible without backlighting</li>
                    <li>Face the camera directly and include from your shoulders to the top of your head, similar to a passport or ID photo</li>
                    <li>Use a plain wall as a background if possible</li>
                    <li>Do not wear sunglasses or hats</li>
                    <li>If you're wearing glasses in your ID photo, wear them in your selfie photo. If you are not wearing glasses in your ID photo, remove them for your selfie photo</li>
                </ul>
            </div><!--end card-body-->
        </div><!--end card-->

    </div>
    <div class="col-md-6">

                <form action="{{ route('user.kyc.store',$user_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Upload your ID</h4>
                            <p class="text-muted mb-0">Click or drag your file here</p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <input type="file" id="input-file-now" name="image" class="dropify" />
                            <br>
                            <div class="row text-center">
                                <div class="col-md-12">
                                    <button type="submit" class=" btn btn-primary btn-auth">Update KYC <i
                                            class="fa fa-upload" aria-hidden="true"></i></button>
                                </div>

                            </div>
                        </div><!--end card-body-->
                    </div><!--end card-->

                </form>


    </div>


</div><!-- Row -->

@endsection


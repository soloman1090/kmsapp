@extends('templates.main-user')

@section('content')
<img src="{{ asset('user-assets/images/widgets/security.jpg') }}" alt="" style="width: 100%; border-top-left-radius: 10px;
border-top-right-radius: 10px;" >
<br><br>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <p class="text-muted mb-0">Please provide your <b>Current Password</b> to update your password</p>
                </div><!--end card-header-->
                <div class="card-body">
                    <form action="{{ route('user-password.update') }}" method="post" id="wizardForm" data-toggle="validator" role="form">
                        @csrf
                        @method('put')
                        <div class="form-group col-md-12">
                            <label for="current_password">Current Password</label>
                            <input id="current_password" type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" name="current_password" required placeholder="Enter your current password" >
                                @error('current_password', 'updatePassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="password">New Password</label>
                            <input id="password" type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter new password">

                            @error('password', 'updatePassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="password-confirm">Confirm New Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" class="btn btn-primary" value="Update Password">
                        </div>
                    </form>
                </div><!--end card-body-->
            </div><!--end card-->

        </div>



    </div><!-- Row -->
@endsection

<script src="{{ asset('user-assets/plugins/bootstrap-validator/dist/validator.min.js') }}"></script>

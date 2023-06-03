@extends('templates.main-user')

@section('content')
    <div class="card">
        <img src="{{ asset('user-assets/images/widgets/security.jpg') }}" alt="" style="width: 100%; border-top-left-radius: 10px;
        border-top-right-radius: 10px;" >
<br><br>
        <div class="card-header">
            <h4 class="card-title">Authenticate your account</h4>
        </div>
        <div class="card-body text-center">
            @if (auth()->user()->two_factor_secret)
                <h4>You have enabled 2FA, Please scan the following QR Code into your phones authenticator application.</h4>
            @endif
            <br>
            <br>
            @if (!auth()->user()->two_factor_secret)
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <img src="{{ asset('user-assets/images/2_Step_Logo_Full.png') }}" width="300" alt="">
                        <br>
                        <br>
                        <h4>Enable two-factor authentication</h4>
                        <p>Whenever you sigin to your account, you'll need to enter both you password and a security code
                            from
                            your mobile device</p>
                        <hr class="hr-dashed hr-menu">
                        <form class="form-horizontal auth-form" action="{{ url('user/two-factor-authentication') }}"
                            method="POST">
                            @csrf
                            <div class="col-12">
                                <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Enable Two
                                    Factor <i class="fas fa-sign-in-alt ms-1"></i></button>
                            </div>
                            <!--end col-->
                        </form>
                        <hr class="hr-dashed hr-menu">
                    </div>
                    <div class="col-md-3"></div>
                </div>
            @else
                <div class="row">

                    <div class="col-md-2">
                        <h3>QR CODE</h3>

                        {!! auth()->user()->twoFactorQrCodeSvg() !!}


                    </div>
                    <div class="col-md-6">
                        <h3>RECOVERY CODES</h3>
                        <p class="font-18">Please store these codes in a secure location.</p>
                        <div class=" row text-left">
                            @foreach ( json_decode(decrypt(auth()->user()->two_factor_recovery_codes, true)) as $code )
                            <div class="col-md-6 "><p class="m-2"><b class="p-2  bg-soft-primary m"> {{ trim($code) }}</b></p></div>
            @endforeach
        </div>

    </div>
    <div class="col-md-4">
        <img src="{{ asset('user-assets/images/2_Step_Logo_Full.png') }}" width="300" alt="">
        <br>
        <br>
        <h4>Disable two-factor authentication</h4>

        <hr class="hr-dashed hr-menu">
        <form class="form-horizontal auth-form" action="{{ url('user/two-factor-authentication') }}"
            method="POST">
            @csrf
            @method('DELETE')
            <div class="col-12">
                <button class="btn btn-danger w-100 waves-effect waves-light" type="submit">Disbale Two
                    Factor <i class="fas fa-sign-in-alt ms-1"></i></button>
            </div>
            <!--end col-->
        </form>
        <hr class="hr-dashed hr-menu">
    </div>
    </div>
    @endif
    </div>
    </div>
@endsection

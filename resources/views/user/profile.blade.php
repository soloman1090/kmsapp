@extends('templates.main-user')

@section('content')
<style>
    .overs {
        content: "";
        height: 260px;
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        opacity: .9;
        background: #b39838;
        background: -webkit-gradient(linear, left bottom, left top, from(#221a52), to(#b39838));
        background: linear-gradient(to top, #221a52, #b39838);
    }



    .img-hh {
        height: 40%;
        opacity: 0.10;
        width: 100%;

        object-position: top;
        object-fit: cover;
    }

</style>

<br><br>
<div class="back overs">
    <img src="{{ asset('assets/img/New-City-Rises_Preview_1100x600.webp') }}" alt="" class="img-hh">
</div>
<div class="card">
    <div class="row">


        <div class="col-md-4">
            <div class="text-center m-3">
                @if ($user->image=="" || $user->image==null)
                <img src="https://placehold.co/387" class="user-profile-image img-circle" alt="" style=" width:120px; height:120px ;object-fit:cover; border-radius:300px; border:2px solid #1A7BB7; margin:auto; ">
                @else
                <img src="{{ asset('uploads/'.$user->image ) }}" class="user-profile-image img-circle" alt="" style=" width:100%; height:400px;  object-position:top;object-fit:cover; border-radius: 20px !important;   margin:auto; ">
                @endif
            </div>

            
            <div class="col-md-12">
                <form action="{{ route('user.profile.store',$user_id) }}" method="POST" enctype="multipart/form-data" class="p-3">
                    @csrf
                    <h6 class="card-title">Upload Profile Picture</h6>
                    <input class="form-control" type="file" id="formFile" name="image">
                   <br>

                </form>


            </div>
        </div>


        <div class="col-md-7">

            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-md">
                        <h4 class="card-title">My Account</h4>
                    </div>
                    <div class="col-md-auto">
                        <div class="demo-modal-btn bd-t-0">
                            <a href="#modal1" class="btn btn-primary" data-bs-toggle="modal">Edit Profile</a>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!--end card-header-->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <li class="list-group-item d-flex align-items-center">
                            <div>
                                <h5 class="tx-20 tx-inverse tx-semibold mg-b-0">{{ auth()->user()->name }} {{ $user->last_name }}</h5>
                                <span class="d-block tx-11 text-muted">Full Name</span>
                            </div>
                        </li>
                    </div>
                    <div class="col-md-6">
                        <li class="list-group-item d-flex align-items-center">
                            <div>
                                <h5 class="tx-20 tx-inverse tx-semibold mg-b-0">{{ auth()->user()->email }}</h5>
                                <span class="d-block tx-11 text-muted">Email Address</span>
                            </div>
                        </li>
                    </div>
                </div>
                <div class="divider-text"></div>
                <div class="row">
                    <div class="col-md-6">
                        <li class="list-group-item d-flex align-items-center">
                            <div>
                                <h5 class="tx-20 tx-inverse tx-semibold mg-b-0">{{ $user->phone }}</h5>
                                <span class="d-block tx-11 text-muted">Phone</span>
                            </div>
                        </li>
                    </div>
                   
                    <div class="col-md-6">
                        <li class="list-group-item d-flex align-items-center">
                            <div>
                                <h5 class="tx-20 tx-inverse tx-semibold mg-b-0">{{ $user->state }}</h5>
                                <span class="d-block tx-11 text-muted">State</span>
                            </div>
                        </li>
                    </div>
                </div>
                <div class="divider-text"></div>
                <div class="row">
                    <div class="col-md-6">
                        <li class="list-group-item d-flex align-items-center">
                            <div>
                                <h5 class="tx-20 tx-inverse tx-semibold mg-b-0">{{ $user->city }}</h5>
                                <span class="d-block tx-11 text-muted">City</span>
                            </div>
                        </li>
                    </div>
                    <div class="col-md-6">
                        <li class="list-group-item d-flex align-items-center">
                            <div>
                                <h5 class="tx-20 tx-inverse tx-semibold mg-b-0">{{ $user->zip_code }}</h5>
                                <span class="d-block tx-11 text-muted">Zip Code</span>
                            </div>
                        </li>
                    </div>
                </div>
                <div class="divider-text"></div>
                <div class="row">
                  
                    <div class="col-md-12">
                        <li class="list-group-item d-flex align-items-center">
                            <div>
                                <h5 class="tx-20 tx-inverse tx-semibold mg-b-0">{{ $user->address }}</h5>
                                <span class="d-block tx-11 text-muted">Address</span>
                            </div>
                        </li>
                    </div>
                </div>

                <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered " role="document">
                        <div class="modal-content tx-14">
                            <form action="{{ route('user.profile.update', $user_id) }}" method="POST">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLabel">Modal Title</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @csrf
                                    @method("PUT")
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">First Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" aria-describedby="emailHelp" value="{{ auth()->user()->name }}">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <br>
                                        <div class="mb-3 col-md-6">
                                            <label for="last_name" class="form-label">Last Name</label>
                                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" aria-describedby="emailHelp" value="{{ $user->last_name }}">
                                            @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <br>
                                        <br>
                                        <h4 class="text-muted">CONTACT INFO</h4>
                                        <hr>
                                        <div class="mb-3 col-md-6">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" aria-describedby="emailHelp" value="{{ $user->phone }}">
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <br>


                                        <div class="mb-3 col-md-6">
                                            <label for="city" class="form-label">City</label>
                                            <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" aria-describedby="emailHelp" value="{{ $user->city }}">
                                            @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <br>
                                        <div class="mb-3 col-md-6">
                                            <label for="state" class="form-label">State</label>
                                            <input type="text" class="form-control @error('state') is-invalid @enderror" id="state" name="state" aria-describedby="emailHelp" value="{{ $user->state }}">
                                            @error('state')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <br>
                                        <div class="mb-3 col-md-6">
                                            <label for="zip_code" class="form-label">Zip Code</label>
                                            <input type="text" class="form-control @error('zip_code') is-invalid @enderror" id="zip_code" name="zip_code" aria-describedby="emailHelp" value="{{ $user->zip_code }}">
                                            @error('zip_code')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <br>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" aria-describedby="emailHelp" value="{{ $user->address }}">
                                            @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <br>


                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary tx-13" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary tx-13">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>





            </div>




        </div>
    </div>
</div>


@endsection

@extends('templates.main-user')

@section('content')

<link href="{{ asset('user-assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">
<img src="{{ asset('user-assets/images/widgets/profile.jpg') }}" alt="" style="width: 100%; border-top-left-radius: 10px;
border-top-right-radius: 10px;" >
<br><br>
<div class="row">


    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title">My Profile</h4>
                    </div><!--end col-->
                </div>  <!--end row-->
            </div><!--end card-header-->
            <div class="panel-body user-profile-panel">
                <div class="text-center m-3">
                    @if ($user->image=="" || $user->image==null)
                    <img src="{{ asset('user-assets/images/users/default-user.png') }}" class="user-profile-image img-circle"
                    alt="" style=" width:120px; height:120px ;object-fit:cover; border-radius:300px; border:2px solid #1A7BB7; margin:auto; ">
                    @else
                    <img src="{{ asset('uploads/'.$user->image ) }}" class="user-profile-image img-circle"
                    alt="" style=" width:120px; height:120px ;object-fit:cover; border-radius:300px; border:2px solid #1A7BB7; margin:auto; ">
                    @endif



                </div>
                <h4 class="text-center m-t-lg">{{ auth()->user()->name }} {{ $user->last_name }}</h4>
                <hr>
                <ul class="list-unstyled text-center">
                    <li>
                        <p><i class="fa fa-map-marker m-r-xs"></i>{{ $user->city }}, {{ $user->state }}</p>
                    </li>
                    <li>
                        <p><i class="fa fa-paper-plane-o m-r-xs"></i><a href="#">{{ auth()->user()->email }}</a></p>
                    </li>
                    <li>
                        <p><i class="fa fa-phone m-r-xs"></i><a href="#">{{ $user->phone }}</a></p>
                    </li>
                </ul>
                <hr>
                {{-- <button class="btn btn-info btn-block">Follow</button> --}}
            </div>
            <div class="col-md-12">

                <form action="{{ route('user.profile.store',$user_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Upload Profile Picture</h4>
                            <p class="text-muted mb-0">Click or drag your file here</p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <input type="file" id="input-file-now" name="image" class="dropify" />
                            <br>
                            <div class="row text-center">
                                <div class="col-md-12">
                                    <button type="submit" class=" btn btn-primary btn-auth">Update Profile image <i
                                            class="fa fa-upload" aria-hidden="true"></i></button>
                                </div>

                            </div>
                        </div><!--end card-body-->
                    </div><!--end card-->

                </form>


    </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title">Personal Information</h4>
                    </div><!--end col-->
                </div>  <!--end row-->
            </div><!--end card-header-->
            <div class="card-body">

                <form action="{{ route('user.profile.update', $user_id) }}" method="POST" >
                    @csrf
                    @method("PUT")
                    <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">First Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" aria-describedby="emailHelp" value="{{ auth()->user()->name }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <br>
                            <div class="mb-3 col-md-6">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                    id="last_name" name="last_name" aria-describedby="emailHelp"
                                    value="{{ $user->last_name }}">
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <br>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" disabled
                                    name="email" aria-describedby="emailHelp" value="{{ auth()->user()->email }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <br>
                            <br>
                            <br>
                            <h4 class="text-muted">CONTACT INFO</h4>
                            <hr>
                            <div class="mb-3 col-md-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                    name="phone" aria-describedby="emailHelp" value="{{ $user->phone }}">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <br>


                            <div class="mb-3 col-md-6">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city"
                                    name="city" aria-describedby="emailHelp" value="{{ $user->city }}">
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <br>
                            <div class="mb-3 col-md-6">
                                <label for="state" class="form-label">State</label>
                                <input type="text" class="form-control @error('state') is-invalid @enderror" id="state"
                                    name="state" aria-describedby="emailHelp" value="{{ $user->state }}">
                                @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <br>
                            <div class="mb-3 col-md-6">
                                <label for="zip_code" class="form-label">Zip Code</label>
                                <input type="text" class="form-control @error('zip_code') is-invalid @enderror"
                                    id="zip_code" name="zip_code" aria-describedby="emailHelp"
                                    value="{{ $user->zip_code }}">
                                @error('zip_code')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <br>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                                    name="address" aria-describedby="emailHelp" value="{{ $user->address }}">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <br>

                            <div class="row text-center">
                                <div class="col-md-12">
                                    <button type="submit" class=" btn btn-primary btn-auth">Update Profile <i
                                            class="fa fa-long-arrow-up" aria-hidden="true"></i></button>
                                </div>

                            </div>
                        </div>




                    </div>


                </form>
            </div>
        </div>
    </div>



@endsection

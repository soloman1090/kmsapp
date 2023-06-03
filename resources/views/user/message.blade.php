@extends('templates.main-user')

@section('content')

<div class="card">
    <img src="{{ asset('user-assets/images/widgets/message.jpg') }}" alt="" style="width: 100%; border-top-left-radius: 10px;
    border-top-right-radius: 10px;" >
    <div class="card-body pb-0">
        <div class="row">
            <div class="col">
                <p class="text-dark fw-semibold mb-0">Messages ({{ count($messages) }})</p>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end card-body-->
    <div class="card-body border-bottom-dashed">
        
        <ul class="list-unstyled mb-">
            @foreach ( $messages as $key=> $mess )
            @if ($key % 2)
            <li class="m-2">
                <div class="row">
                    <div class="col-auto">
                        <img src="{{ asset('admin-assets/img/fav-icon.png') }}" alt="" class="thumb-md rounded-circle" style="object-fit: cover; object-position:left;">
                    </div><!--end col-->
                    <div class="col-10">
                        <div class="card ms-n2 bg-white p-3">
                            <div class="row">
                                <div class="col">
                                    <p class="text-dark fw-semibold mb-2">{{ $mess->title }}</p>
                                </div><!--end col-->
                                <div class="col-auto">
                                    <span class="text-muted"><i class="far fa-clock me-1"></i>{{ $mess->date}}</span>
                                </div><!--end col-->
                            </div><!--end row-->
                            <p>{{ $mess->descp }}</p>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->

            </li>
            @else
            <li class="m-2">
                <div class="row">
                    <div class="col-auto">
                        <img src="{{ asset('admin-assets/img/fav-icon.png') }}" alt="" class="thumb-md rounded-circle" style="object-fit: cover; object-position:left;">
                    </div><!--end col-->
                    <div class="col-10">
                        <div class="card ms-n2 bg-primary p-3">
                            <div class="row">
                                <div class="col">
                                    <p class="text-white fw-semibold mb-2">{{ $mess->title }}</p>
                                </div><!--end col-->
                                <div class="col-auto">
                                    <span class="text-white"><i class="far fa-clock me-1"></i>{{ $mess->date}}</span>
                                </div><!--end col-->
                            </div><!--end row-->
                            <p class="text-white">{{ $mess->descp }}</p>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->

            </li>
            @endif
            @endforeach


        </ul>
    </div><!--end card-body-->


</div> <!--end card-->
@endsection

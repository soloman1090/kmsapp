@extends('templates.main-user')

@section('content')

<div class="container">
    <video   autoplay="true" muted> 
        <source src="{{ asset('main-user-assets/img/how-it-works.mp4') }}" type=video/mp4>
        </video>
</div>
@endsection
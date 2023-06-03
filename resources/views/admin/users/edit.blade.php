@extends('templates.admin')

@section('content')
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 ">
        <div class="mar-20 ">
            <div class="site-card bg-white">
            <h1 class="text-center admin-title" >Update New User</h1>
            <div class="row d-flex justify-content-center">
                    <div class="card pad-20">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @method('patch')
                   @include('admin.users.partials.form')
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<div class="col-md-3"></div>
</div>
@endsection

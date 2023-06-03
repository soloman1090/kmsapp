<div class="row text-center">
    <div class="col-md-3"></div>
    <div class="col-md-6">

        @if(session('success'))

        <div class="alert alert-primary alert-dismissible fade show border-0 b-round" role="alert">
            <strong>Success </strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 b-round" role="alert">
            <strong>Error </strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show border-0 b-round" role="alert">
            <strong>Success </strong> {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('warning'))
        <div class="alert alert-warning alert-dismissible fade show border-0 b-round" role="alert">
            <strong>Notification: </strong> {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        </div>
        <div class="col-md-3"></div>

</div>

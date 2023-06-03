
@if(session('success'))
<div class="alert alert-success alert-dismissable txt-light">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> {{ session('success') }}
</div>
@endif



@if(session('error'))
<div class="alert alert-danger alert-dismissable txt-light">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> {{ session('error') }}
</div>
@endif

@if(session('status'))
<div class="alert alert-success alert-dismissable txt-light">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> {{ session('status') }}
</div>
@endif



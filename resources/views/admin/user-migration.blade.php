@extends('templates.admin')

@section('content')

<div class="row">
    <aside class="col-lg-12 col-md-12 p-2">
        <div class="panel panel-refresh pa-0">
            <form action="{{ route('admin.user-data-migration.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <label class="control-label">Old Email Address</label>
                                <input type="text" placeholder="Enter the old email address" name="email1"  class="form-control" required>
                            </div>
                        </div>
                        <br><br><br>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <label class="control-label">New Email Address</label>
                                <input type="text" placeholder="Enter the new email address" name="email2"  class="form-control" required>
                            </div>
                        </div>
                        <br><br><br><br>
                        <div class="form-group">
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-success" type="submit">Migrate Account</button>
                                </div>
                            </div>
                        </div>
                        <br><br>
                    </div>
                </div>
            </form>
        </div>
    </aside>
</div>

@endsection
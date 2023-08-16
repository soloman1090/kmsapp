@extends('templates.main-user')

@section('content')
<!-- DataTables -->


<div class="PDF ">
    <div class="filemgr-content-body">
        <div class="pd-20 pd-lg-25 pd-xl-30">
          <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-30">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                        <li class="breadcrumb-item"><a href="/user/dashboard">Dashboard</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Documents</li>
                    </ol>
                </nav>
            </div>
          </div>
            <h3 class="mg-b-0 ">{{ $page_title }}</h3>
            <label class="d-block tx-medium tx-10 tx-uppercase tx-sans tx-spacing-1 tx-color-03 mg-b-15">Click on any file to access the document</label>
            <div class="row row-xs">
                @foreach ($documents as $doc )

                @if ($doc->status=="offline")
                <div class="col-6 col-sm-4 col-md-3 col-xl-3">
                    <div class="card card-file">
                        <a href="{{ asset('uploads/'.$doc['resource_link'] ) }}" target="_blank">
                            <div class="card-file-thumb tx-danger">
                                <i class="far fa-file-pdf"></i>
                            </div>
                        </a>
                        <div class="card-body">
                            <a href="{{ asset('uploads/'.$doc['resource_link'] ) }}" target="_blank">
                                <h6><a href="" class="link-02">{{ $doc->description }}</a></h6>
                                <span> View Document</span>
                            </a>
                        </div>
                    </div>
                </div><!-- col -->

                @else
                <div class="col-6 col-sm-4 col-md-3 col-xl-3">
                    <div class="card card-file">
                        <a href="{{ $doc['resource_link'] }}" target="_blank">
                            <div class="card-file-thumb tx-danger">
                                <i class="far fa-file-pdf"></i>
                            </div>
                        </a>
                        <div class="card-body">
                            <a href="{{ $doc['resource_link'] }}" target="_blank">
                                <h6><a href="" class="link-02">{{ $doc->description }}</a></h6>
                                <span> View Document</span>
                            </a>
                        </div>
                    </div>
                </div><!-- col -->
                @endif

                @endforeach
            </div><!-- row -->

        </div>
    </div><!-- filemgr-content-body -->
</div>


@endsection

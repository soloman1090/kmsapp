@extends('templates.admin')

@section('content')
<link href="{{ asset('admin-assets/vendors/bower_components/dropify/dist/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    a {
        text-decoration: none
    }

    .icon {
        height: 150px !important;
    }

    .icon img {
        height: 130px;
        width: 100%;
        object-fit: cover;
    }

    hr{
        margin-top: 5px;
        margin-bottom: 5px;
        border-top: 1px solid #e0e0e0;
    }

</style>

<div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary txt-light">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title font-20">Upload Content </h5>
            </div>
            <form action="{{ route('admin.content-libary.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group image-file" id="">
                                <div class="panel-wrapper collapse in">
                                    <div class="panel-body">
                                        <label for="resource_link" class="control-label mb-10">Attach File </label>
                                        <div class="mt-10">
                                            <input type="file" id="input-file-now" multiple name="resource_link[]" class="dropify"  />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group online-link" id="">
                                <label for="resource_url" class="control-label mb-10">File Link:</label>
                                <input type="text" class="form-control" name="resource_url" placeholder="Enter Url " id="resource_url" >
                                <br>
                                <label for="status" class="control-label mb-10">Extention </label>
                                <select name="extention" id="extention" class="form-control"  >
                                    <option value="">Choose extention</option>
                                    <option value="jpg">.JPG</option>
                                    <option value="png">.PNG</option>
                                    <option value="pdf">.PDF</option>
                                    <option value="doc">.DOC</option>
                                    <option value="mp3">.MP3</option>
                                    <option value="mp4">.MP4</option>
                                </select>
                            </div>

                            <div class="form-group youtube-frame" id="">
                                <label for="resource_url" class="control-label mb-10">Paste Youtube Html Code:</label>
                                 <textarea name="youtube_frame" id="" placeholder="Embeded Code " class="form-control" cols="50" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="status" class="control-label mb-10">Origin </label>
                                <select name="status" id="status" class="form-control status" required>
                                    <option value="">Choose Origin</option>
                                    <option value="offline">Local</option>
                                    <option value="online">Online</option>
                                    <option value="youtube">Youtube</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="category" class="control-label mb-10">Libary Categoy </label>
                                <select name="category" id="category" class="form-control" required>
                                    <option value="">Choose Category</option>
                                    <option value="document">Document</option>
                                    <option value="image">Image</option>
                                    <option value="video">Video</option>
                                    <option value="audio">Audio</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="body" class="control-label mb-10">Page Link / Slug (Optional)</label>
                                <input type="text" class="form-control" name="slug" id="slug" placeholder="photo-gallery" required>
                            </div>



                            <div class="form-group">
                                <label for="body" class="control-label mb-10">Description</label>
                                <textarea type="text" class="form-control" name="description" id="description" required> </textarea>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-rounded">Upload File</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Row -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default card-view pa-0">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="">
                        <div class="col-lg-3 col-md-4 file-directory pa-0">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                    <div class="file-manager">
                                        <div class="mt-20 mb-20 ml-15 mr-15">
                                            <div class="fileupload btn btn-success btn-anim btn-block" data-toggle="modal" data-target="#responsive-modal"><i class="fa fa-upload"></i><span class="btn-text">Upload files</span>

                                            </div>
                                        </div>
                                        <div class="mt-20 mb-20 ml-15 mr-15">

                                            <label for="">Search Contents</label>
                                            <form action="{{ route('admin.content-libary.index') }}" method="get">
                                                <div class="row">
                                                    <div class="col-md-12 ">
                                                        <input type="text" name="search" placeholder="Descp..,Slug..., online, offline" class="form-control">
                                                    </div>

                                                </div>
                                            </form>

                                        </div>

                                        <h6 class="mb-10 pl-15">Libary Category</h6>
                                        <ul class="folder-list mb-30">
                                            <li><a href="/admin/content-libary"><i class="zmdi zmdi-folder"></i> All Files</a></li>
                                            <li><a href="/admin/content-libary?search=document"><i class="zmdi zmdi-folder"></i> Documents</a></li>
                                            <li><a href="/admin/content-libary?search=image"><i class="zmdi zmdi-folder"></i> Images</a></li>
                                            <li><a href="/admin/content-libary?search=video"><i class="zmdi zmdi-folder"></i> Videos</a></li>
                                            <li><a href="/admin/content-libary?search=audio"><i class="zmdi zmdi-folder"></i> Audios</a></li>
                                        </ul>

                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-8 file-sec pt-20">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">


                                        @foreach ($contents as $cont )
                                        @if($cont->extention=="jpg" || $cont->extention=="pmg" || $cont->extention=="webp")
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12  file-box">
                                            <div class="file">

                                                <div class="icon">
                                                    @if ($cont->status=="offline")
                                                    <a href="{{ asset('uploads/'.$cont['resource_link'] ) }}" target="_blank">
                                                        <img src="{{ asset('uploads/'.$cont['resource_link'] ) }} " alt="">
                                                    </a>
                                                    @else
                                                    <a href="{{  $cont['resource_link']  }}" target="_blank">
                                                        <img src="{{  $cont['resource_link'] }} " alt="">
                                                    </a>
                                                    @endif
                                                </div>
                                                <div class="file-name">
                                                    {{ $cont->description }}
                                                    <br>

                                                    <span>Status: {{ $cont->status }} </span><br><span>Slug: {{ $cont->slug }} </span><br>
                                                    <hr>
                                                    <div class="col-md-6"> <a href="#" class="txt-dark btn-sm" data-toggle="modal"
                                                        data-target="#copy-modal{{ $cont['id'] }}" >Copy</a></div>
                                                    <div class="col-md-6"> <a href="#" class="txt-danger btn-sm" data-toggle="modal"
                                                        data-target="#delete-active-modal{{ $cont['id'] }}">Delete</a></div>
                                                    <br>
                                                </div>

                                            </div>
                                        </div>


                                        @else
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12  file-box">
                                            <div class="file">
                                                @if ($cont->status=="offline")
                                                <a href="{{ asset('uploads/'.$cont['resource_link'] ) }}" target="_blank">
                                                    <div class="icon">
                                                        <i class="zmdi zmdi-file-text"></i>
                                                    </div>
                                                </a>
                                                @else
                                                <a href="{{  $cont['resource_link'] }}" target="_blank">
                                                    <div class="icon">
                                                        <i class="zmdi zmdi-file-text"></i>
                                                    </div>
                                                </a>
                                                @endif
                                                <div class="file-name">
                                                    {{ $cont->description }}
                                                    <br>
                                                    <span>Status: {{ $cont->status }} </span><br> <span>Slug: {{ $cont->slug }} </span><br>
                                                    <hr>
                                                    <div class="col-md-6"> <a href="#" class="txt-dark btn-sm" data-toggle="modal"
                                                        data-target="#copy-modal{{ $cont['id'] }}" >Copy</a></div>
                                                    <div class="col-md-6"> <a href="#" class="txt-danger btn-sm" data-toggle="modal"
                                                        data-target="#delete-active-modal{{ $cont['id'] }}">Delete</a></div>
                                                    <br>
                                                </div>



                                            </div>
                                        </div>


                                        @endif

                                        <div id="delete-active-modal{{ $cont['id'] }}" class="modal fade"
                                        tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                        style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning txt-light"
                                                    style="background-color: #EE826D">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                    <h5 class="modal-title font-20">Delete Content?</h5>
                                                </div>
                                                <form id=""
                                                    action="{{ route('admin.content-libary.destroy', $cont['id']) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <div class="modal-body">
                                                       <input type="hidden" value="{{ $cont['id'] }}" name="id"/>
                                                        <h4>Are you sure you want to delete this Content?</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default btn-rounded"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger btn-rounded">Delete

                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="copy-modal{{ $cont['id'] }}" class="modal fade"
                                        tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                        style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning txt-light"
                                                    style="background-color: #180cff">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                    <h5 class="modal-title font-20">Copy File Link</h5>
                                                </div>
                                                    <div class="modal-body">
                                                        <p>Copy the link on the field</p>
                                                        @if ($cont->status=="offline")
                                                            <input type="text" value="{{ asset('uploads/'.$cont['resource_link'] ) }}" class="form-control"/>
                                                        @else
                                                        <input type="text" value="{{ $cont['resource_link'] }}" class="form-control"/>
                                                        @endif
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default btn-rounded"
                                                            data-dismiss="modal">Close</button>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                        @endforeach





                                    </div>
                                </div>
                            </div>
                            {{ $contents->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Row -->

<script src="{{ asset('admin-assets/vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script>
    $(".image-file").show()
    $(".online-link").hide()
    $(".youtube-frame").hide()

    $(".status").on('change', function() {
        if ($(this).val() == "online") {
            $(".image-file").hide()
            $(".youtube-frame").hide()
            $(".online-link").show()
        }else if ($(this).val() == "youtube") {
            $(".image-file").hide()
            $(".youtube-frame").show()
            $(".online-link").hide()
        } else {
            $(".image-file").show()
            $(".online-link").hide()
            $(".youtube-frame").hide()
        }


    })

</script>


@endsection

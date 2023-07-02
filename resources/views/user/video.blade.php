@extends('templates.main-user')

@section('content')
 <!-- DataTables -->
 <br><br><br>
 <div class="Video">
 <div class="filemgr-content-body">
              <div class="pd-20 pd-lg-25 pd-xl-30">
              <h3 class="mg-b-0 ">All Files</h3>
                <label class="d-block tx-medium tx-10 tx-uppercase tx-sans tx-spacing-1 tx-color-03 mg-b-15">Recently Accessed Files</label>
                <div class="row row-xs">
                  <div class="col-6 col-sm-4 col-md-3 col-xl">
                    <div class="card card-file">
                      <div class="dropdown-file">
                        <a href="" class="dropdown-link" data-bs-toggle="dropdown"><i data-feather="more-vertical"></i></a>
                        <div class="dropdown-menu dropdown-menu-end">
                          <a href="#modalViewDetails" data-bs-toggle="modal" class="dropdown-item details"><i data-feather="info"></i>View Details</a>
                          <a href="" class="dropdown-item important"><i data-feather="star"></i>Mark as Important</a>
                          <a href="#modalShare" data-bs-toggle="modal" class="dropdown-item share"><i data-feather="share"></i>Share</a>
                          <a href="" class="dropdown-item download"><i data-feather="download"></i>Download</a>
                          <a href="#modalCopy" data-bs-toggle="modal" class="dropdown-item copy"><i data-feather="copy"></i>Copy to</a>
                          <a href="#modalMove" data-bs-toggle="modal" class="dropdown-item move"><i data-feather="folder"></i>Move to</a>
                          <a href="#" class="dropdown-item rename"><i data-feather="edit"></i>Rename</a>
                          <a href="#" class="dropdown-item delete"><i data-feather="trash"></i>Delete</a>
                        </div>
                      </div><!-- dropdown -->
                      <div class="card-file-thumb tx-danger">
                      <i class="far fa-file-video"></i>
                      </div>
                      <div class="card-body">
                        <h6><a href="" class="link-02">Medical Certificate.mp4</a></h6>
                        <span>10.45kb</span>
                      </div>
                      <div class="card-footer"><span class="d-none d-sm-inline">Last accessed: </span>2 hours ago</div>
                    </div>
                  </div><!-- col -->
                  <div class="col-6 col-sm-4 col-md-3 col-xl">
                    <div class="card card-file">
                      <div class="dropdown-file">
                        <a href="" class="dropdown-link" data-bs-toggle="dropdown"><i data-feather="more-vertical"></i></a>
                        <div class="dropdown-menu dropdown-menu-end">
                          <a href="#modalViewDetails" data-bs-toggle="modal" class="dropdown-item details"><i data-feather="info"></i>View Details</a>
                          <a href="" class="dropdown-item important"><i data-feather="star"></i>Mark as Important</a>
                          <a href="#modalShare" data-bs-toggle="modal" class="dropdown-item share"><i data-feather="share"></i>Share</a>
                          <a href="" class="dropdown-item download"><i data-feather="download"></i>Download</a>
                          <a href="#modalCopy" data-bs-toggle="modal" class="dropdown-item copy"><i data-feather="copy"></i>Copy to</a>
                          <a href="#modalMove" data-bs-toggle="modal" class="dropdown-item move"><i data-feather="folder"></i>Move to</a>
                          <a href="#" class="dropdown-item rename"><i data-feather="edit"></i>Rename</a>
                          <a href="#" class="dropdown-item delete"><i data-feather="trash"></i>Delete</a>
                        </div>
                      </div><!-- dropdown -->
                      <div class="card-file-thumb tx-primary">
                      <i class="far fa-file-video"></i>
                      </div>
                      <div class="card-body">
                        <h6><a href="" class="link-02">Job Contract.mp4</a></h6>
                        <span>22.67kb</span>
                      </div>
                      <div class="card-footer"><span class="d-none d-sm-inline">Last accessed: </span>5 hours ago</div>
                    </div>
                  </div><!-- col -->
                  <div class="col-6 col-sm-4 col-md-3 col-xl mg-t-10 mg-sm-t-0">
                    <div class="card card-file">
                      <div class="dropdown-file">
                        <a href="" class="dropdown-link" data-bs-toggle="dropdown"><i data-feather="more-vertical"></i></a>
                        <div class="dropdown-menu dropdown-menu-end">
                          <a href="#modalViewDetails" data-bs-toggle="modal" class="dropdown-item details"><i data-feather="info"></i>View Details</a>
                          <a href="" class="dropdown-item important"><i data-feather="star"></i>Mark as Important</a>
                          <a href="#modalShare" data-bs-toggle="modal" class="dropdown-item share"><i data-feather="share"></i>Share</a>
                          <a href="" class="dropdown-item download"><i data-feather="download"></i>Download</a>
                          <a href="#modalCopy" data-bs-toggle="modal" class="dropdown-item copy"><i data-feather="copy"></i>Copy to</a>
                          <a href="#modalMove" data-bs-toggle="modal" class="dropdown-item move"><i data-feather="folder"></i>Move to</a>
                          <a href="#" class="dropdown-item rename"><i data-feather="edit"></i>Rename</a>
                          <a href="#" class="dropdown-item delete"><i data-feather="trash"></i>Delete</a>
                        </div>
                      </div><!-- dropdown -->
                      <div class="card-file-thumb tx-indigo">
                      <i class="far fa-file-video"></i>
                      </div>
                      <div class="card-body">
                        <h6><a href="" class="link-02">IMG_063037.mp4</a></h6>
                        <span>4.1mb</span>
                      </div>
                      <div class="tx-11 tx-color-04 mg-t-10"><span class="d-none d-sm-inline">Last accessed: </span>6 hours ago</div>
                    </div>
                  </div><!-- col -->
                  <div class="col-6 col-sm-4 col-md-3 col-xl mg-t-10 mg-md-t-0">
                    <div class="card card-file">
                      <div class="dropdown-file">
                        <a href="" class="dropdown-link" data-bs-toggle="dropdown"><i data-feather="more-vertical"></i></a>
                        <div class="dropdown-menu dropdown-menu-end">
                          <a href="#modalViewDetails" data-bs-toggle="modal" class="dropdown-item details"><i data-feather="info"></i>View Details</a>
                          <a href="" class="dropdown-item important"><i data-feather="star"></i>Mark as Important</a>
                          <a href="#modalShare" data-bs-toggle="modal" class="dropdown-item share"><i data-feather="share"></i>Share</a>
                          <a href="" class="dropdown-item download"><i data-feather="download"></i>Download</a>
                          <a href="#modalCopy" data-bs-toggle="modal" class="dropdown-item copy"><i data-feather="copy"></i>Copy to</a>
                          <a href="#modalMove" data-bs-toggle="modal" class="dropdown-item move"><i data-feather="folder"></i>Move to</a>
                          <a href="#" class="dropdown-item rename"><i data-feather="edit"></i>Rename</a>
                          <a href="#" class="dropdown-item delete"><i data-feather="trash"></i>Delete</a>
                        </div>
                      </div><!-- dropdown -->
                      <div class="card-file-thumb tx-info">
                      <i class="far fa-file-video"></i>
                      </div>
                      <div class="card-body">
                        <h6><a href="" class="link-02">Music_One.mp4</a></h6>
                        <span>3.40mb</span>
                      </div>
                      <div class="card-footer"><span class="d-none d-sm-inline">Last accessed: </span>6 hours ago</div>
                    </div>
                  </div><!-- col -->
                  <div class="col-6 col-sm-4 col-md-3 col-xl mg-t-10 mg-xl-t-0">
                    <div class="card card-file">
                      <div class="dropdown-file">
                        <a href="" class="dropdown-link" data-bs-toggle="dropdown"><i data-feather="more-vertical"></i></a>
                        <div class="dropdown-menu dropdown-menu-end">
                          <a href="#modalViewDetails" data-bs-toggle="modal" class="dropdown-item details"><i data-feather="info"></i>View Details</a>
                          <a href="" class="dropdown-item important"><i data-feather="star"></i>Mark as Important</a>
                          <a href="#modalShare" data-bs-toggle="modal" class="dropdown-item share"><i data-feather="share"></i>Share</a>
                          <a href="" class="dropdown-item download"><i data-feather="download"></i>Download</a>
                          <a href="#modalCopy" data-bs-toggle="modal" class="dropdown-item copy"><i data-feather="copy"></i>Copy to</a>
                          <a href="#modalMove" data-bs-toggle="modal" class="dropdown-item move"><i data-feather="folder"></i>Move to</a>
                          <a href="#" class="dropdown-item rename"><i data-feather="edit"></i>Rename</a>
                          <a href="#" class="dropdown-item delete"><i data-feather="trash"></i>Delete</a>
                        </div>
                      </div><!-- dropdown -->
                      <div class="card-file-thumb tx-primary">
                      <i class="far fa-file-video"></i>
                      </div>
                      <div class="card-body">
                        <h6><a href="" class="link-02">Job Requirements.mp4</a></h6>
                        <span>17.19kb</span>
                      </div>
                      <div class="card-footer"><span class="d-none d-sm-inline">Last accessed: </span>7 hours ago</div>
                    </div>
                  </div><!-- col -->
                </div><!-- row -->

                <hr class="mg-y-40 bd-0">
                <label class="d-block tx-medium tx-10 tx-uppercase tx-sans tx-spacing-1 tx-color-03 mg-b-15">Folders</label>
                <div class="row row-xs">
                  <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="media media-folder">
                      <i data-feather="folder"></i>
                      <div class="media-body">
                        <h6><a href="" class="link-02">Downloads</a></h6>
                        <span>2 files, 14.05mb</span>
                      </div><!-- media-body -->
                      <div class="dropdown-file">
                        <a href="" class="dropdown-link" data-bs-toggle="dropdown"><i data-feather="more-vertical"></i></a>
                        <div class="dropdown-menu dropdown-menu-end">
                          <a href="#modalViewDetails" data-bs-toggle="modal" class="dropdown-item details"><i data-feather="info"></i>View Details</a>
                          <a href="" class="dropdown-item important"><i data-feather="star"></i>Mark as Important</a>
                          <a href="#modalShare" data-bs-toggle="modal" class="dropdown-item share"><i data-feather="share"></i>Share</a>
                          <a href="" class="dropdown-item download"><i data-feather="download"></i>Download</a>
                          <a href="#modalCopy" data-bs-toggle="modal" class="dropdown-item copy"><i data-feather="copy"></i>Copy to</a>
                          <a href="#modalMove" data-bs-toggle="modal" class="dropdown-item move"><i data-feather="folder"></i>Move to</a>
                          <a href="#" class="dropdown-item rename"><i data-feather="edit"></i>Rename</a>
                          <a href="#" class="dropdown-item delete"><i data-feather="trash"></i>Delete</a>
                        </div>
                      </div><!-- dropdown -->
                    </div><!-- media -->
                  </div><!-- col -->
                  <div class="col-sm-6 col-lg-4 col-xl-3 mg-t-10 mg-sm-t-0">
                    <div class="media media-folder">
                      <i data-feather="folder"></i>
                      <div class="media-body">
                        <h6><a href="" class="link-02">Personal Stuff</a></h6>
                        <span>8 files, 76.3mb</span>
                      </div><!-- media-body -->
                      <div class="dropdown-file">
                        <a href="" class="dropdown-link" data-bs-toggle="dropdown"><i data-feather="more-vertical"></i></a>
                        <div class="dropdown-menu dropdown-menu-end">
                          <a href="#modalViewDetails" data-bs-toggle="modal" class="dropdown-item details"><i data-feather="info"></i>View Details</a>
                          <a href="" class="dropdown-item important"><i data-feather="star"></i>Mark as Important</a>
                          <a href="#modalShare" data-bs-toggle="modal" class="dropdown-item share"><i data-feather="share"></i>Share</a>
                          <a href="" class="dropdown-item download"><i data-feather="download"></i>Download</a>
                          <a href="#modalCopy" data-bs-toggle="modal" class="dropdown-item copy"><i data-feather="copy"></i>Copy to</a>
                          <a href="#modalMove" data-bs-toggle="modal" class="dropdown-item move"><i data-feather="folder"></i>Move to</a>
                          <a href="#" class="dropdown-item rename"><i data-feather="edit"></i>Rename</a>
                          <a href="#" class="dropdown-item delete"><i data-feather="trash"></i>Delete</a>
                        </div>
                      </div><!-- dropdown -->
                    </div><!-- media -->
                  </div><!-- col -->
                  <div class="col-sm-6 col-lg-4 col-xl-3 mg-t-10 mg-lg-t-0">
                    <div class="media media-folder">
                      <i data-feather="folder"></i>
                      <div class="media-body">
                        <h6><a href="" class="link-02">3D Objects</a></h6>
                        <span>5 files, 126.3mb</span>
                      </div><!-- media-body -->
                      <div class="dropdown-file">
                        <a href="" class="dropdown-link" data-bs-toggle="dropdown"><i data-feather="more-vertical"></i></a>
                        <div class="dropdown-menu dropdown-menu-end">
                          <a href="#modalViewDetails" data-bs-toggle="modal" class="dropdown-item details"><i data-feather="info"></i>View Details</a>
                          <a href="" class="dropdown-item important"><i data-feather="star"></i>Mark as Important</a>
                          <a href="#modalShare" data-bs-toggle="modal" class="dropdown-item share"><i data-feather="share"></i>Share</a>
                          <a href="" class="dropdown-item download"><i data-feather="download"></i>Download</a>
                          <a href="#modalCopy" data-bs-toggle="modal" class="dropdown-item copy"><i data-feather="copy"></i>Copy to</a>
                          <a href="#modalMove" data-bs-toggle="modal" class="dropdown-item move"><i data-feather="folder"></i>Move to</a>
                          <a href="#" class="dropdown-item rename"><i data-feather="edit"></i>Rename</a>
                          <a href="#" class="dropdown-item delete"><i data-feather="trash"></i>Delete</a>
                        </div>
                      </div><!-- dropdown -->
                    </div><!-- media -->
                  </div><!-- col -->
                  <div class="col-sm-6 col-lg-4 col-xl-3 mg-t-10 mg-xl-t-0">
                    <div class="media media-folder">
                      <i data-feather="folder"></i>
                      <div class="media-body">
                        <h6><a href="" class="link-02">Recordings</a></h6>
                        <span>0 files</span>
                      </div><!-- media-body -->
                      <div class="dropdown-file">
                        <a href="" class="dropdown-link" data-bs-toggle="dropdown"><i data-feather="more-vertical"></i></a>
                        <div class="dropdown-menu dropdown-menu-end">
                          <a href="#modalViewDetails" data-bs-toggle="modal" class="dropdown-item details"><i data-feather="info"></i>View Details</a>
                          <a href="" class="dropdown-item important"><i data-feather="star"></i>Mark as Important</a>
                          <a href="#modalShare" data-bs-toggle="modal" class="dropdown-item share"><i data-feather="share"></i>Share</a>
                          <a href="" class="dropdown-item download"><i data-feather="download"></i>Download</a>
                          <a href="#modalCopy" data-bs-toggle="modal" class="dropdown-item copy"><i data-feather="copy"></i>Copy to</a>
                          <a href="#modalMove" data-bs-toggle="modal" class="dropdown-item move"><i data-feather="folder"></i>Move to</a>
                          <a href="#" class="dropdown-item rename"><i data-feather="edit"></i>Rename</a>
                          <a href="#" class="dropdown-item delete"><i data-feather="trash"></i>Delete</a>
                        </div>
                      </div><!-- dropdown -->
                    </div><!-- media -->
                  </div><!-- col -->
                  <div class="col-sm-6 col-lg-4 col-xl-3 mg-t-10">
                    <div class="media media-folder">
                      <i data-feather="folder"></i>
                      <div class="media-body">
                        <h6><a href="" class="link-02">Support</a></h6>
                        <span>1 file, 20mb</span>
                      </div><!-- media-body -->
                      <div class="dropdown-file">
                        <a href="" class="dropdown-link" data-bs-toggle="dropdown"><i data-feather="more-vertical"></i></a>
                        <div class="dropdown-menu dropdown-menu-end">
                          <a href="#modalViewDetails" data-bs-toggle="modal" class="dropdown-item details"><i data-feather="info"></i>View Details</a>
                          <a href="" class="dropdown-item important"><i data-feather="star"></i>Mark as Important</a>
                          <a href="#modalShare" data-bs-toggle="modal" class="dropdown-item share"><i data-feather="share"></i>Share</a>
                          <a href="" class="dropdown-item download"><i data-feather="download"></i>Download</a>
                          <a href="#modalCopy" data-bs-toggle="modal" class="dropdown-item copy"><i data-feather="copy"></i>Copy to</a>
                          <a href="#modalMove" data-bs-toggle="modal" class="dropdown-item move"><i data-feather="folder"></i>Move to</a>
                          <a href="#" class="dropdown-item rename"><i data-feather="edit"></i>Rename</a>
                          <a href="#" class="dropdown-item delete"><i data-feather="trash"></i>Delete</a>
                        </div>
                      </div><!-- dropdown -->
                    </div><!-- media -->
                  </div><!-- col -->
                </div><!-- row -->
              </div>
            </div><!-- filemgr-content-body -->
</div>

</div>


 @endsection

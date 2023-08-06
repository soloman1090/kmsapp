@extends('templates.main-user')

@section('content')
 <!-- DataTables -->
<div class="">
    <div class="set1">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3 p-3">
                    <p>Portfolio Fund Trgets</p>
                    <h1>~ 10</h1>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3 p-3">
                    <p>Strategy Focus</p>
                    <h1>Growth Equity</h1>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3 p-3">
                    <p>Target Size</p>
                    <h1>$95m</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <form>
            <div class="row">
                <div class="form-group col-md-6">
                  <label>Birthday</label>
                  <select class="form-select">
                    ...
                  </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                  </div>
                <div class="form-group col-md-6 d-flex align-items-end">
                  <select class="form-select">
                    ...
                  </select>
                </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">Password</label>
                <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
              </div>
            </div>
          
            {{-- <center> --}}
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="customCheck1">
                      <label class="custom-control-label" for="customCheck1">Agree with Terms of Use and Privacy Policy</label>
                    </div>
                  </div>
               
                  <div class="col-md-6">
                   
                      <button type="submit" class="btn btn-primary w-100">  <a href="/user/investment-receipt" class="sub">Submit Form</a></button>
                    
                </div>
            {{-- </center> --}}
          </form>
    </div>
</div>


 @endsection

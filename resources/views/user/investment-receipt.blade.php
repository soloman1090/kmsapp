@extends('templates.main-user')

@section('content')
 <!-- DataTables -->

<div class="">
    <div class="content content-fixed bd-b mt-0">
        <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
          <div class="d-sm-flex align-items-center justify-content-between">
            <div>
              <h4 class="mg-b-5">Invoice #{{ $receipt_no }}</h4>
              <p class="mg-b-0 tx-color-03">Date: {{ $receipt_date }}</p>
            </div>
            <div class="mg-t-20 mg-sm-t-0">
              <button class="btn btn-white" onclick="window.print()"><i data-feather="printer" class="mg-r-5"></i> Print</button> 
               
            </div>
          </div>
        </div><!-- container -->
      </div><!-- content -->
  
      <div class="content tx-13">
        <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
          <div class="row">
            <div class="col-sm-6">
              <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Billed From</label>
              <h6 class="tx-15 mg-b-10">DellInvestment Group</h6>
              <p class="mg-b-0">1201 N Orange St, Midtown Ste 100, Wilmington, Delaware</p>
              <p class="mg-b-0">Tel No: (302) 389-5302</p>
              <p class="mg-b-0">Email: info@dellgroup.com</p>
            </div><!-- col -->
            <div class="col-sm-6 tx-right d-none d-md-block">
              <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Invoice Number</label>
              <h1 class="tx-normal tx-color-04 mg-b-10 tx-spacing--2">#{{ $receipt_no }}</h1>
            </div><!-- col -->
            <div class="col-sm-6 col-lg-8 mg-t-40 mg-sm-t-0 mg-md-t-40">
              <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Billed To</label>
              <h6 class="tx-15 mg-b-10">{{ $user->name }} {{ $user->last_name }}</h6>
              <p class="mg-b-0">{{ $user->address }} {{ $user->city }}, <br>  {{ $user->zip_code }}, {{ $user->state }}</p>
              <p class="mg-b-0">Tel-No:<a href="tel:{{ $user->phone }}">{{ $user->phone }}</a></p>
              <p class="mg-b-0">Email:<a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
            </div><!-- col -->
            <div class="col-sm-6 col-lg-4 mg-t-40">
              <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Invoice Information</label>
              <ul class="list-unstyled lh-7">
                <li class="d-flex justify-content-between">
                  <span>Invoice Number</span>
                  <span>{{ $receipt_no }}</span>
                </li>
                <li class="d-flex justify-content-between">
                  <span>Investment Name</span>
                  <span>{{ $package->name }}</span>
                </li>
                <li class="d-flex justify-content-between">
                  <span>Issue Date</span>
                  <span>{{ $receipt_date }}</span>
                </li>
                <li class="d-flex justify-content-between">
                  <span>Due Date</span>
                  <span>{{ $package->investment_end_date }}</span>
                </li>
                 
                
              </ul>
            </div><!-- col -->
          </div><!-- row -->
  
          <div class="table-responsive mg-t-40">
            <table class="table table-invoice bd-b">
              <thead>
                <tr>
                  <th class="wd-20p">Package</th>
                  <th class="wd-40p d-none d-sm-table-cell">Description</th>
                  <th class="tx-center">Quantity</th>
                  <th class="tx-center">Duration</th>
                  <th class="tx-center">Interest Payout</th>
                  <th class="tx-right">Paying Amount</th>
                 </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="tx-nowrap">{{ $package->name }}</td>
                  <td class="d-none d-sm-table-cell tx-color-03">{{ $package->info_detail_1 }}</td>
                  <td class="tx-center">1</td>
                  <td class="tx-center">{{ $package->duration }} Months</td>
                  <td class="tx-center">{{ $req->formatted_payout }}</td>
                  <td class="tx-right">${{ $req->formatted_amount }}</td>
                 </tr>
              
              </tbody>
            </table>
          </div>
  
          <div class="row justify-content-between">
            <div class="col-sm-6 col-lg-6 order-2 order-sm-0 mg-t-40 mg-sm-t-0">
              <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Notes</label>
              <p>This receipt will also be sent you your email address once payment is completed. <br> Invoice was created on a computer and is valid without the signature and seal. </p>
            </div><!-- col -->
            <div class="col-sm-6 col-lg-4 order-1 order-sm-0">
              <ul class="list-unstyled lh-7 pd-r-10">
                {{-- <li class="d-flex justify-content-between">
                  <span>Sub-Total</span>
                  <span>$5,750.00</span>
                </li>
                <li class="d-flex justify-content-between">
                  <span>Tax (5%)</span>
                  <span>$287.50</span>
                </li>
                <li class="d-flex justify-content-between">
                  <span>Discount</span>
                  <span>-$50.00</span>
                </li> --}}
                <li class="d-flex justify-content-between">
                  <strong>Total Due</strong>
                  <strong>${{ $req->formatted_amount }}</strong>
                </li>
              </ul>

              <form action="{{ route('user.make-investment.store') }}" method="post" class="form-parsley">
                @csrf
                <div class="row">
                  <input type="hidden" name="page_url" value="/user/make-investment/{{ $package->id }}/edit">
                    <input type="hidden" name="user_id" value="{{ $user_id }}">
                    <input type="hidden" name="investment_packages_id" value="{{ $req->package_id}}">
                    <input type="hidden" name="amount" id="amount" value="{{ $req->amount }}">
                    <input type="hidden" name="payment_method" id="payment_method" value="{{ $req->payment_method }}">
                    <input type="hidden" name="currency" id="currency" value="{{ $req->currency }}">
                    <input type="hidden" name="payout" id="payout" value="{{ $req->payout }}">
                    <input type="hidden" name="duration" id="duration" value="{{ $package->duration }}"> 
                    <input type="hidden" name="funding_source" id="duration" value="{{ $req->funding_source }}"> 
                </div>
                <button class="btn btn-primary w-100">Pay Now</button>
            </form>
  
             
            </div><!-- col -->
          </div><!-- row -->
        </div><!-- container -->
      </div><!-- content -->
</div>


 @endsection

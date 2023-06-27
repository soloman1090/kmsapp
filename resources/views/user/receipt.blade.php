<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Receipt</title>
    <link rel="shortcut icon" href="{{ asset('admin-assets/img/fav-icon.png') }}">
	<link rel="icon" href="{{ asset('admin-assets/img/fav-icon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('user-assets/css/receipt.css') }}" media="all" />
    <link  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css" />
     
  </head>
  <body>

    <header class="clearfix">
      <div id="logo">
        <img src="{{ asset('admin-assets/img/logo.png')  }}">
      </div>
      <div id="company">
        <h2 class="name"><b>Dell Group  Management</b></h2>
        <div>1201 N Orange St, Midtown Ste 100, Wilmington, Delaware</div>
        <div>(302) 389-5302</div>
        <div><a href="mailto:support@Dell Group.com">support@Dell Group.com</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">INVOICE TO:</div>
          <h2 class="name">{{ $user->name }} {{ $user->last_name }}</h2>
          <div class="address">{{ $user->address }} {{ $user->city }}, <br>  {{ $user->zip_code }}, {{ $user->state }}</div>
          <div class="email"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></div>
        </div>
        <div id="invoice">
          <h1>INVOICE</h1>
          <div class="date">Date of Invoice:{{$date}}</div>
          <div class="date">Mon-Fri 09:00 - 17:00</div>
         </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no"><b>#</b></th>
            <th class="desc"><b>SUMMARY</b></th>
            <th class="unit"><b>PAYMENT METHOD</b></th>
            <th class="qty"><b>QUANTITY</b></th>
            <th class="total"><b>PRICE</b></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="no">01</td>
            <td class="desc"><h3>{{ $packageName }} </h3></td>
            @if ($payment_method=="direct_deposit")
            <td class="unit">{{ $currency }}</td>
            @elseif ($payment_method=="main_wallet")
            <td class="unit">Main Wallet</td>
            @elseif ($payment_method=="compound_wallet")
            <td class="unit">Compound Wallet</td>
            @endif
            <td class="qty">1</td>
            <td class="total amount1"  amount="{{$amount}}">${{ $amount }} </td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">TOTAL</td>
            <td class="amount2" amount="{{$amount}}">${{ $amount }}</td>
          </tr>
          
          <tr>
              <td colspan="2"></td>
              <td colspan="2"><button class="btn btn-warning" onclick="window.print()">Print <i class="bi bi-printer"></i></button></td>
              <td>
                  <form action="{{ route('user.view-investments-portfolio.store') }}" method="post" class="form-parsley">
                      @csrf
                      <div class="row">
                          <input type="hidden" name="user_id" value="{{ $user_id }}">
                          <input type="hidden" name="investment_packages_id" value="{{ $investment_packages_id}}">
                          <input type="hidden" name="amount" id="amount" value="{{ $amount }}">
                          <input type="hidden" name="payment_method" id="payment_method" value="{{ $payment_method }}">
                          <input type="hidden" name="currency" id="currency" value="{{ $currency }}">
                          <input type="hidden" name="payout" id="payout" value="{{ $payout }}">
                          <input type="hidden" name="duration" id="duration" value="{{ $duration }}">
                          <input type="hidden" name="returns" id="returns" value="23.4">
                      </div>
                      <button type="submit" class="btn btn-primary">Make Payment <i class="bi bi-credit-card-2-back"></i></button>
                  </form>
              </td>
          </tr>

        </tfoot>
      </table>
      

      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice"><i>This receipt will also be sent you your email address once payment is completed</i> .</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
    

    <script src="{{ asset('user-assets/js/jquery.min.js') }}"></script>

    <script>
       let amount1 = parseFloat($(".amount1").attr("amount"))
    $(".amount1").text(`$${amount1.toLocaleString('en-US')}`)

    let amount2 = parseFloat($(".amount2").attr("amount"))
    $(".amount2").text(`$${amount2.toLocaleString('en-US')}`)
    </script>
  </body>
</html>
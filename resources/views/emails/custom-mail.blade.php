@component('mail::message')
<img src="{{ asset('assets/images/emails/verification-banner.jpg') }}" alt="" class="banner">
<h1 class="mailTitle">{{ $details['title'] }}</h1>
<div class="smallLine"></div>
<br>
@if ($details['img-event']!="")
<img src="/uploads/{{$details['img-event']}}" alt="" class="banner">
@endif
<br>
{{ $details['descp'] }}
<br>
<br>
{{ $details['descp2'] }}
<br>
<br>
{{ $details['descp3'] }}
<br>
<br>
@if ($details['action-text']!="" && $details['url']!="")
@component('mail::button', ['url' => $details['url']])
{{ $details['action-text'] }}
<br>
<br>
@endcomponent
@endif


{{ $details['end_text'] }}<br>
The {{ config('app.name') }} Team
@endcomponent

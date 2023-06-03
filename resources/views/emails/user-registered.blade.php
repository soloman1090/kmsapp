@component('mail::message')
<img src="{{ asset($details['img'] ) }}" alt="" class="banner">
<h1 class="mailTitle">{{ $details['title'] }}</h1>
<div class="smallLine"></div>
<br>
{!! $details['descp'] !!}

@component('mail::button', ['url' => $details['url']])
{{ $details['action-text'] }}
@endcomponent

Thanks for being a customer<br>
The {{ config('app.name') }} Team
@endcomponent

@component('mail::message')
<img src="{{ asset('assets/images/emails/verification-banner.jpg') }}" alt="" class="banner">
<h1 class="mailTitle">{{ $details['user'] }}</h1>

<img src="{{ asset('assets/images/emails/FAMILY.jpg') }}" alt="" >
<br>
<br>
<h1 class="mailTitle">Client Appreciation Week:</h1>
<div class="smallLine"></div>
<br>
<p>We would like to recognize the active contributions of all our invested partners in the growth and successes of Palm Alliance Management. Over the years, Palm Alliance has built a reputation for continued success and exponential growth in major economic cycles. This could have only been possible through the active participation and contributions of all our invested partners.</p>
<br>
<p>In this scheduled client appreciation week, we would like to show our heartfelt appreciation for your commitment and confidence in our business processes. We would be matching your capital dividends for the entirety of this week. What this means is, that if your expected daily yield is $100, we would be matching your daily yield with an extra $100. Your contribution is invaluable and this is regarded as a token of appreciation. You’re at the heart of all we do. So, on client appreciation week, all of us at Palm Alliance Management want to express our heartfelt thanks. </p>

<p>We wish you a blissful week ahead!</p>

For support or assistance please visit our customer fulfilment centre.<br>
The {{ config('app.name') }} Team
@endcomponent

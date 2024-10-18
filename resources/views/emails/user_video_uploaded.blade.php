@component('mail::message')
# Video Uploaded Successfully

Hi {{ $userName }}!

- **Video Title**:{{ $videoTitle }}

We will review your video and notify you once it is qualified or disqualified for the next round.

Thanks,  
{{ config('app.name') }}

@endcomponent

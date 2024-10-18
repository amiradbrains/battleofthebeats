@component('mail::message')
# Contestent Uploaded a Video

Hi Admin,

Contestent has uploaded video. Here are the details:

- **Name**:  {{ $userName }}
- **Email**: {{ $userEmail }}
- **Video Title**:{{ $videoTitle }} 

Please review the video and take the necessary actions.

Thanks,  
{{ config('app.name') }}

@endcomponent

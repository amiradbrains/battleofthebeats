@component('mail::message')
# New Contestent Registered

Hi Admin,

A new contestent has registered on the platform. Here are the details:

- **Name**: {{ $user->name }}
- **Email**: {{ $user->email }}

Please take any necessary actions.

Thanks,  
{{ config('app.name') }}

@endcomponent

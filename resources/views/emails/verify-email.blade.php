@component('mail::message')
# Verify Your Email Address

Hi there!

Thank you for registering with us. Please verify your email address by clicking the button below:

@component('mail::button', ['url' => $url])
Verify Email
@endcomponent

If you did not create an account, no further action is required.

Thanks,  
{{ config('app.name') }}

@endcomponent

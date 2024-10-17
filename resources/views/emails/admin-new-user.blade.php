@component('mail::message')

Hi Admin,

A new contestant has registered on the platform. Here are the details:

<table style="width: 100%; border-collapse: collapse;">
    <tr>
        <th style="text-align: left; padding: 8px; border-bottom: 1px solid #ddd;">Name</th>
        <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $user->name }}</td>
    </tr>
    <tr>
        <th style="text-align: left; padding: 8px; border-bottom: 1px solid #ddd;">Email</th>
        <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $user->email }}</td>
    </tr>
</table>

Please take any necessary actions.

Thanks,
{{ config('app.name') }}

@endcomponent

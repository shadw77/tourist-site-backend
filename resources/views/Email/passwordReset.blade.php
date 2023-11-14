<x-mail::message>
# Change Password Request

Clicl On the Button Below To Change password

<x-mail::button :url="'http://localhost:4200/response-password-reset?token='.$token">
Reset Password
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
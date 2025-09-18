@component('mail::message')
    Добро пожаловать, {{ $user->login }}!

    Спасибо за регистрацию на нашем сайте.

    С уважением, {{ config('app.name') }}
@endcomponent

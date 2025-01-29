@component('mail:message')

    Hi <b>{{ $user->name }}</b>,

    <p>We understand it happens.</p>

    @component('mail:button', ['url' => url('reset/' . $user->remember_token)])
        Reset Your Password
    @endcomponent

    <p>In case you have an issues recovering your password, please contact us.</p>

    Thanks, <br>
    {{ config('app.name') }}
@endcomponent

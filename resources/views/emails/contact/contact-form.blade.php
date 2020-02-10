@component('mail::message')
    Thank you <strong>{{ $data['name'] }}</strong> for contacting with us. <br>
    <br>
    <strong>Email:</strong> {{ $data['email'] }} <br>
    <br>
    <strong>Message:</strong> <br>
    {{ $data['message'] }}
@endcomponent

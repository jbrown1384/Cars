@component('mail::message')
# Hello Guy Smiley, you have a new message from {{ $from_name }}.

{{ $body }}

Sincerely,<br>
{{ $from_name }}<br>
email: {{ $from_email }}<br>
@if($from_phone)
    phone #: {{ $from_phone }}
@endif
@endcomponent
@component('mail::message')
#  New Inquiry

New Inquiry From {{$record->name}} Check it.

Thanks,<br>
{{ config('constants.APP_NAME') }}
@endcomponent

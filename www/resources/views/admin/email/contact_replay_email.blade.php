@component('mail::message')
#  Dear  {{$contact_data->name}}

{{$contact_data->replay}}

Thanks,<br>
{{ config('constants.APP_NAME') }}
@endcomponent

<p>Hello,</p>

<p>You have received a new contact form submission from your website. Below are the details:</p>

<p>
Name: {{$contact_data->name}}<br>
Email: {{$contact_data->email}}<br>
Phone number: {{$contact_data->phone}}<br>
Message: {{$contact_data->comment}}<br>
Product type: {{$contact_data->product_type}}
</p>

<br>
Thanks,<br>
{{ config('constants.APP_NAME') }}

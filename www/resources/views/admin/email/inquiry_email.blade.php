

<p>Hello,</p>

<p>I hope this email finds you well. you received one inquiry form Nutra-care website and bellow is the details: </p>

<p>Name: {{$inquiry->name}}<br>
Email: {{$inquiry->email}}<br>
Contact number: {{$inquiry->phone}}<br>
Message: {{$inquiry->message}}</p>

<p>I am particularly interested in obtaining more information about the following:</p>
@php
    $displayedCategories = [];
@endphp


<table border="1" width="600">
    @php
        $productsByCategory = collect($product_list)->groupBy('value.cat_title');
    @endphp

    @foreach($productsByCategory as $category => $products)
        <tr>
            <td>
                <b>{{ $category }}</b>
            </td>
        </tr>
        <tr>
            <td  >
                @php
                    $index = 1;
                @endphp
                @foreach($products as $product)
                    {{$index++}}. {{ $product['value']['product_title'] }}<br>
                @endforeach
            </td>
        </tr>
    @endforeach
</table>

<br>
Thanks,<br>
{{ config('constants.APP_NAME') }}

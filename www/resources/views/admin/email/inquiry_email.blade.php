@component('mail::message')
# New Inquiry From {{$record->name}} Check it.

@component('mail::table')
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Attribute</th>
            </tr>
            </thead>
            <tbody>
            @php
                $index = 0;
            @endphp
            @forelse($record->inquiry_product_links as $value)
                <tr>
                    <td>{{++$index}}</td>
                    <td>{{$value->products->title}}</td>
                    @if($value->attribute_id != 0)
                        <td>{{$value->attributes->attribute_name}}</td>
                    @else
                        <td>Not Specified</td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="2" align="center">Record not found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

@endcomponent

Thanks,<br>
{{ config('constants.APP_NAME') }}
@endcomponent

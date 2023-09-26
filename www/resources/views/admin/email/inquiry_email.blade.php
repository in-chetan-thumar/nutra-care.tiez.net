@php
    $index = 0;
@endphp
        <table border="1">
            <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
            </tr>
            </thead>
            <tbody>

            @forelse($record->inquiry_product_links as $value)

                <tr>
                    <td>{{++$index}}</td>
                    <td>{{$value->products->title}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" align="center">Record not found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>


Thanks,<br>
{{ config('constants.APP_NAME') }}

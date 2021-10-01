<div class="table-responsive">
    <table class="table usertable table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Category</th>
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
                <td>
                    @if(!empty($value->products->category_product_links))
                        @foreach($value->products->category_product_links as $category)
                            {{$category->categories->title}},
                        @endforeach
                    @endif
                </td>
                <td width="20%">{{$value->products->title}}</td>
                @if($value->attribute_id != 0)
                    <td  width="20%">{{$value->attributes->attribute_name}}</td>
                @else
                    <td  width="20%">-</td>
                @endif
            </tr>
        @empty
            <tr>
                <td colspan="5" align="center">Record not found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>



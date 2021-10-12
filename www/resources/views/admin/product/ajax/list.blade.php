<div class="table-responsive">
    <table class="table usertable table-striped">
        <thead>
        <tr>
            <th>Photo</th>
            <th>Title</th>
            <th>Category</th>
            <!--th>Description</th>
            <th>Slug</th-->
            <th class="action-icon">Action</th>
        </tr>
        </thead>
        <tbody>
        @php
            $index = 0;
        @endphp
        @forelse($records as $value)
            <tr>
                @if($value->photo_ur != null)
                    <td><img src="{{$value->photo_url}}" width="100px"/></td>

                @else
                    <td>No Image.</td>
                @endif
                <td>{{$value->title}}</td>
                <td>
                    @foreach($value->category_product_links as $list)
                        {{$list->categories->title}}
                    @endforeach
                </td>
                <!--td>{{$value->description}}</td>
                <td>{{$value->slug}}</td-->
                <td class="action-icon">
                    <a href="javascript:;" class="edit_record theme_icon" data-url="{{route('products.edit', $value->id)}}" data-toggle="modal" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
                    <a href="javascript:;" class="delete_record theme_icon" data-url="{{route('products.destroy', $value->id)}}" data-toggle="m-tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" align="center">Record not found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
{{$records->links()}}



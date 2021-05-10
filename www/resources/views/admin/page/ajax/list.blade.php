<div class="table-responsive">
    <table class="table usertable table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Page Title</th>
            <th>Page Slug</th>
            <th>Meta Tag</th>
            <th>Meta Description</th>
            <th>Page Text</th>
            <th class="action-icon">Action</th>
        </tr>
        </thead>
        <tbody>
        @php
            $index = 0;
        @endphp
        @forelse($records as $value)
            <tr>
                <td>{{++$index}}</td>
                <td>{{$value->page_title}}</td>
                <td>{{$value->page_slug}}</td>
                <td>{{$value->meta_tag}}</td>
                <td>{{$value->meta_description}}</td>
                <td>{{$value->page_text}}</td>
                <td class="action-icon">
                    <a href="javascript:;" class="edit_record theme_icon" data-url="{{route('pages.edit', $value->id)}}" data-toggle="modal" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
                    <a href="javascript:;" class="delete_record theme_icon" data-url="{{route('pages.destroy', $value->id)}}" data-toggle="m-tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" align="center">Record not found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
{{$records->links()}}



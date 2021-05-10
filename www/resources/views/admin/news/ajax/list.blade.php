<div class="table-responsive">
<table class="table usertable table-striped">
<thead>
    <tr>
        <th>#</th>
        <th>Category</th>
        <th>Titel</th>
        <th>Doc</th>
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
        <td>{{$value->category->category}}</td>
        <td>{{$value->title}}</td>
        <td>{{$value->news_doc}}</td>
        <td class="action-icon">
            <a href="javascript:;" class="edit_record theme_icon" data-url = "{{route('news.edit', $value->id)}}" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
            <a href="javascript:;" class="delete_record  theme_icon" data-url="{{route('news.destroy', $value->id)}}" data-toggle="m-tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5" align="center">Record not found.</td>
    </tr>
    @endforelse
</tbody>
</table>

</div>
{{$records->links()}}

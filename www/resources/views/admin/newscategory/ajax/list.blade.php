<div class="table-responsive">
<table class="table usertable table-striped">
<thead>
    <tr>
        <th>#</th>
        <th>Category</th>
        <th>Created</th>
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
        <td>{{$value->category}}</td>
        <td>{{$value->created_at}}</td>
        <td class="action-icon">
            <a href="javascript:;" class="edit_record theme_icon" data-url = "{{route('newscategory.edit', $value->id)}}" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
            <a href="javascript:;" class="delete_record  theme_icon" data-url="{{route('newscategory.destroy', $value->id)}}" data-toggle="m-tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
        </td>
    </tr>    
    @empty
    <tr>
        <td colspan="8" align="center">Record not found.</td>
    </tr>
    @endforelse
</tbody>
</table>
    
</div>
{{$records->links()}}
<div class="table-responsive">
<table class="table usertable table-striped">
<thead>
    <tr>
        <th>#</th>
        <th>Role</th>
        <th>Name</th>
        <th>Username</th>
        <th>Mobile</th>
        <th>Email</th>
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
        <td>{{$value->role->title}}</td>
        <td>{{$value->name}}</td>
        <td>{{$value->username}}</td>
        <td>{{$value->mobile}}</td> 
        <td>{{$value->email}}</td>
        <td class="action-icon">
            <a href="javascript:;" class="edit_record theme_icon" data-url = "{{route('users.edit', $value->id)}}" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
            <a href="javascript:;" class="delete_record  theme_icon" data-url="{{route('users.destroy', $value->id)}}" data-toggle="m-tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
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
<div class="table-responsive">
<table class="table usertable table-striped">
<thead>
    <tr>
        <th>#</th>
        <th>Message</th>
        <!--th>Image</th-->
        <th>Date</th>
    </tr>
</thead>
<tbody>
    @php
    $index = 0;
    @endphp
    @forelse($records as $value)
    <tr>
        <td>{{++$index}}</td>
        <td>{{$value->notification_text}}</td>
        <!--td>{{$value->notification_doc}}</td-->
        <td>{{$value->created_at}}</td>
    </tr>    
    @empty
    <tr>
        <td colspan="4" align="center">Record not found.</td>
    </tr>
    @endforelse
</tbody>
</table>
    
</div>
{{$records->links()}}
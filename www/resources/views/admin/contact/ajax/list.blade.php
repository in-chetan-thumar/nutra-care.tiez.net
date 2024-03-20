<div class="table-responsive">
    <table class="table usertable table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Comment</th>
            <th>Product type</th>
{{--            <th>Replay</th>--}}
{{--            <th class="action-icon">Action</th>--}}
        </tr>
        </thead>
        <tbody>
        @php
            $index = 0;
        @endphp
        @forelse($records as $value)
            <tr>
                <td>{{++$index}}</td>
                <td>{{$value->name}}</td>
                <td>{{$value->phone}}</td>
                <td>{{$value->email}}</td>
                <td>{{$value->comment}}</td>
                <td>{{$value->product_type}}</td>
{{--                <td>{{$value->replay}}</td>--}}
{{--                <td class="action-icon">--}}
{{--                    <a href="javascript:;" class="form-contact-form theme_icon replay_model" data-url="{{route('contacts.update', $value->id)}}" data-toggle="modal" data-placement="top" title="Replay"><i class="fa fa-reply"></i></a>&nbsp;--}}
{{--                    --}}{{--<a href="javascript:;" class="delete_record  theme_icon" data-url="{{route('contacts.destroy', $value->id)}}" data-toggle="m-tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>--}}
{{--                </td>--}}
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



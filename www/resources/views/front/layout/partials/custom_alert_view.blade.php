@if(!$data['success'])
    <div class="alert alert-success" role="alert">
        {{ $data['message'] }}
    </div>
@else
    <div class="alert alert-danger" role="alert">
        {{ $data['message'] }}
    </div>
@endif

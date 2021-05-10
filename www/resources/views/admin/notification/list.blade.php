@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="dashbordreoirt">
                <p><i class="m-menu__link-icon fas fa-bell"></i>Notification</p>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">

        <div class="col-md-12">
            <div class="userlist">
                <div class="text-right">
                    <a href="javascript:;" class="theme-btn mb-3 add_record"><i class="fas fa-share-square mr-2"></i>Send Notification</a>
                </div>

                <div id="data-list">

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add user mddal -->
<div class="modal fade" id="addNotificationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Send Notification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div>
                {{ Form::open(array('route' => 'notification.store', 'id'=>'add-notification-form', 'files' => true)) }}
                <div class="modal-body row">
                    <div class="form-group col-md-12">
                        {{ Form::label('notification_text', 'Please enter a notification message', array('class'=>'form-control-label')) }}
                        {{ Form::text('notification_text', '', array('class' => 'form-control', 'id' => 'notification_text')) }}
                    </div>
                    <!--div class="form-group col-md-12">
                        {{ Form::label('notification_doc', 'Image', array('class'=>'form-control-label')) }}
                        {{ Form::file('notification_doc', array('class' => 'form-control', 'id' => 'notification_doc')) }}
                    </div-->
                </div>
                <div class="modal-footer">
                    <button class="btn theme-btn">Submit</button>
                    <button type="button" class="btn theme-btn-white" data-dismiss="modal">Close</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
    var index_url = "{{route('notification.index')}}";
</script>
<script src="{{ URL::asset('js/admin/notification.js') }}" type="text/javascript"></script>
{!! JsValidator::formRequest('App\Http\Requests\NotificationRequest','#add-notification-form') !!}
@endsection

@extends('admin.layouts.app')
@section('content')
<div class="container">
   @include('admin.common.alert-messages')
   <div class="row">
      <div class="col-md-12">
         <div>
            <div class="dashbordreoirt">
               <p><i class="fas fa-bell"></i>Notification</p>
            </div>
         </div>
      </div>
   </div>
   <div class="row mb-2">
      <div class="col-md-12">
         <div class="text-left">
            <a href="javascript:;" class="theme-btn mb-3 add_record"><i class="fas fa-share-square mr-2"></i>Send Notification</a>
         </div>
      </div>
   </div>
   <div class="table-responsive">
      <table class="table usertable table-striped">
         <thead>
            <tr>
               <th>Notification</th>
               <th>Send Date</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>New photo has been uploaded.</td>
               <td>05/07/2020</td>
            </tr>
            <tr>
               <td>New photo has been uploaded.</td>
               <td>05/07/2020</td>
            </tr>
            <tr>
               <td>New photo has been uploaded.</td>
               <td>05/07/2020</td>
            </tr>
         </tbody>
      </table>
   </div>
</div>

<!-- Add user mddal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                {{ Form::open(array('route' => 'users.store', 'id'=>'add-user-form')) }}
                <div class="modal-body row">
                    <div class="form-group col-md-12">
                        <label class="form-control-label">Please enter a notification:</label>
                        <input type="text" placeholder="" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn theme-btn">Send</button>
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
    var index_url = "{{route('users.index')}}";
</script>
<script src="{{ URL::asset('js/admin/users.js') }}" type="text/javascript"></script>
{!! JsValidator::formRequest('App\Http\Requests\UserRequest','#add-user-form') !!}
@endsection

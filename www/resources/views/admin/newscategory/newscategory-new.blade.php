@extends('admin.layouts.app')
@section('content')
<div class="container">
   @include('admin.common.alert-messages')
   <div class="row">
      <div class="col-md-12">
         <div>
            <div class="dashbordreoirt">
               <p> <i class="m-menu__link-icon fas fa-newspaper"></i>News Category</p>
            </div>
         </div>
      </div>
   </div>
   <div class="row mb-2">
      <div class="col-md-12">
         <div class="text-left">
            <a href="javascript:;" class="theme-btn mb-3 add_record"><i class="fas fa-plus mr-2"></i>Add News Category</a>
         </div>
      </div>
   </div>
   <div class="table-responsive">
      <table class="table usertable table-striped">
         <thead>
            <tr>
               <th>Category Name</th>
               <th>Created</th>
               <th class="action-icon">Action</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>Politics</td>
               <td>5th July</td>
               <td class="action-icon">
                  <a href="javascript:;" class="edit_record theme_icon" data-url="#" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
                  <a href="javascript:;" class="user_panchayat_list theme_icon" data-url="#" data-toggle="m-tooltip" data-placement="top"  title="Delete"><i class="fas fa-trash-alt"></i></a>
               </td>
            </tr>
            <tr>
               <td>Politics</td>
               <td>5th July</td>
               <td class="action-icon">
                  <a href="javascript:;" class="edit_record theme_icon" data-url="#" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
                  <a href="javascript:;" class="user_panchayat_list theme_icon" data-url="#" data-toggle="m-tooltip" data-placement="top"  title="Delete"><i class="fas fa-trash-alt"></i></a>
               </td>
            </tr>
            <tr>
               <td>Politics</td>
               <td>5th July</td>
               <td class="action-icon">
                  <a href="javascript:;" class="edit_record theme_icon" data-url="#" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
                  <a href="javascript:;" class="user_panchayat_list theme_icon" data-url="#" data-toggle="m-tooltip" data-placement="top"  title="Delete"><i class="fas fa-trash-alt"></i></a>
               </td>
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
                <h5 class="modal-title">Add News Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div>
                {{ Form::open(array('route' => 'users.store', 'id'=>'add-user-form')) }}
                <div class="modal-body row">
                    <div class="form-group col-md-12">
                        <label class="form-control-label">Enter a news category name</label>
                        <input type="text" placeholder="" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn theme-btn">Create</button>
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

@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="dashbordreoirt">
                <p><i class="m-menu__link-icon fas fa-user"></i>Users</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <form class="form-group row filters">
                <div class="col-md-12 col-lg-12">
                    <div class="search_button d-flex">
                        <div class="search_label">
                            <input type="text" name="filters[search]" class="form-control"
                                placeholder="Search By Name / Email / Mobile / Username" id="search"
                                value="{{request('filters.search')}}">
                        </div>
                        <div class="search_iconbtn d-flex">
                            <button type="button" class="btn search-btn ml-3" id="search-btn">
                                <i class="flaticon-search-1"></i>
                            </button>
                        </div>

                        <div class="search_iconbtn d-flex" data-toggle="m-tooltip" data-placement="top" title="Reset Search">
                            <button type="button" class="btn search-btn ml-3" onclick="reset_search();">
                                <i class="flaticon-refresh"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <div class="userlist">
                <div class="text-right">
                    <a href="javascript:;" class="theme-btn mb-3 add_record"><i class="fas fa-plus mr-2"></i>Add User</a>
                </div>

            </div>
        </div>
    </div>


                <!-- Filter form -->
                {{ Form::open(array('route' => 'users.index', 'id'=>'filter-form')) }}
                {{Form::hidden('filters[search]', request('filters.search'))}}
                {{Form::hidden('filters[role]', request('filters.role') ?? 1)}}
                {{ Form::close() }}

                <div id="data-list">

                </div>

</div>

<!-- Add user mddal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div>
                {{ Form::open(array('route' => 'users.store', 'id'=>'add-user-form')) }}
                <div class="modal-body row">
                    <div class="form-group col-md-12">
                        {{ Form::label('role_id', 'Role:', array('class'=>'form-control-label')) }}
                        {{ Form::select('role_id', $user_roles->prepend('Select role', ''), null, array('class' => 'form-control', 'id' => 'role_id')) }}
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('name', 'Name:', array('class'=>'form-control-label')) }}
                        {{ Form::text('name', '', array('class' => 'form-control', 'id' => 'name')) }}
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('email', 'Email:', array('class'=>'form-control-label')) }}
                        {{ Form::text('email', '', array('class' => 'form-control', 'id' => 'email')) }}
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('mobile', 'Mobile:', array('class'=>'form-control-label')) }}
                        {{ Form::text('mobile', '', array('class' => 'form-control', 'id' => 'mobile')) }}
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('username', 'Username:', array('class'=>'form-control-label')) }}
                        {{ Form::text('username', '', array('class' => 'form-control', 'id' => 'username')) }}
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('password', 'Password', array('class'=>'form-control-label')) }}
                        {{ Form::password('password', array('class'=>'form-control', 'autocomplete'=>'off', 'id'=>'password', 'autofocus') ) }}
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('password_confirmation', 'Confirm Password', array('class'=>'form-control-label')) }}
                        {{ Form::password('password_confirmation', array('class'=>'form-control', 'autocomplete'=>'off', 'id'=>'password_confirmation', 'autofocus') ) }}
                    </div>
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

<!-- Edit user mddal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="editModalContent">

            </div>
        </div>
    </div>
</div>

<!-- Panchayat list mddal -->
<div class="modal fade" id="userPanchayatListModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Panchayat List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="userPanchayatListModalContent">

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

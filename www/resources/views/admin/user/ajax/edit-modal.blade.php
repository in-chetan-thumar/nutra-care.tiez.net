{{ Form::model($record, array('route' => ['users.update', $record->id],'name' => 'edit-user-form', 'id'=>'edit-user-form')) }}
<div class="modal-body row">
    <div class="form-group col-md-12">
        {{ Form::label('role_id', 'Role:', array('class'=>'form-control-label')) }}
        {{ Form::select('role_id', $user_roles->prepend('Select role', ''), null, array('class' => 'form-control', 'id' => 'role_id', 'disabled' => 'true')) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('name', 'Name:', array('class'=>'form-control-label')) }}
        {{ Form::text('name', null, array('class' => 'form-control', 'id' => 'name')) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('email', 'Email:', array('class'=>'form-control-label')) }}
        {{ Form::text('email', null, array('class' => 'form-control', 'id' => 'email')) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('mobile', 'Mobile:', array('class'=>'form-control-label')) }}
        {{ Form::text('mobile', null, array('class' => 'form-control', 'id' => 'mobile')) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('username', 'Username:', array('class'=>'form-control-label')) }}
        {{ Form::text('username', null, array('class' => 'form-control', 'id' => 'username')) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('password', 'Password', array('class'=>'form-control-label')) }}
        {{ Form::password('password', array('class'=>'form-control', 'autocomplete'=>'off', 'id'=>'password', 'autofocus') ) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('password_confirmation', 'Confirm Password', array('class'=>'form-control-label')) }}
        {{ Form::password('password_confirmation', array('class'=>'form-control', 'autocomplete'=>'off', 'id'=>'password_confirmation', 'autofocus') ) }}
    </div>
    <div class="form-group col-md-12">
        {{ Form::label('is_active', 'Status:', array('class'=>'form-control-label')) }}
        {{ Form::select('is_active', ['Y' => 'Active', 'N' => 'In-Active'], null, array('class' => 'form-control', 'id' => 'is_active')) }}
    </div>
</div>
<div class="modal-footer">
    <button class="btn theme-btn">Submit</button>
    <button type="button" class="btn theme-btn-white" data-dismiss="modal">Close</button>
</div>
{{ Form::close() }}
{!! $validator !!}
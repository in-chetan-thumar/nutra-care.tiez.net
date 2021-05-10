<!-- Edit user mddal -->
<div class="modal fade" id="updateProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('labels.Update Profile')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="updateProfileModalContent">

            </div>
        </div>
    </div>
</div>

<!-- Change password mddal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('labels.Change Password')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div>
                {{ Form::open(array('route' => 'change-password', 'id'=>'change-password-form')) }}
                <div class="modal-body">
                    <div class="form-group">
                        {{ Form::label('current_password', __('labels.Current Password'), array('class'=>'form-control-label')) }}
                        {{ Form::password('current_password', array('class'=>'form-control', 'autocomplete'=>'off', 'id'=>'current_password', 'autofocus') ) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('password', __('labels.New Password'), array('class'=>'form-control-label')) }}
                        {{ Form::password('password', array('class'=>'form-control', 'autocomplete'=>'off', 'id'=>'password', 'autofocus') ) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('password_confirmation', __('labels.Confirm Password'), array('class'=>'form-control-label')) }}
                        {{ Form::password('password_confirmation', array('class'=>'form-control', 'autocomplete'=>'off', 'id'=>'password_confirmation', 'autofocus') ) }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn theme-btn">{{__('labels.Submit')}}</button>
                    <button type="button" class="btn theme-btn-white" data-dismiss="modal">{{__('labels.Close')}}</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@extends('admin.layouts.auth')

@section('content')
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2 userbglogin"
    id="m_login">
    <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
        <div class="m-login__container user_m-login__container">
            <div class="m-login__logo">
                <h1 class="loginhead">{{ __('Reset Password') }}</h1>
            </div>
            <div class="m-login__signin">
                <form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}"
                    id="reset-password-form">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group m-form__group">
                        <input id="email" type="email"
                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                            value="{{ $email ?? old('email') }}" placeholder="Email" required autofocus>
                        @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group m-form__group">
                        <input id="password" type="password"
                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                            placeholder="Password" required>
                        @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group m-form__group">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            placeholder="Confirm Password" required>
                    </div>
                    <div class="m-login__form-action">
                        <button type="submit" class="theme-btn add_record">{{ __('Reset Password') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        //Forgot password
        $(document).on('submit', '#reset-password-form', function (e) {
            if ($(this).valid()) {
                mApp.blockPage({
                    overlayColor: "#000000",
                    type: "loader",
                    state: "success",
                    message: "Please wait..."
                });
            }
        });
    });
</script>
<script type="text/javascript" src="{{ URL::asset('assets/vendor/jsvalidation/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\ResetPasswordRequest','#reset-password-form') !!}
@endsection

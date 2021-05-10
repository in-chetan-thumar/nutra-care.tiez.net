@extends('admin.layouts.auth')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2 userbglogin" id="m_login">
	<div class="m-grid__item m-grid__item--fluid m-login__wrapper">
		<div class="m-login__container user_m-login__container">
			<div class="m-login__logo">
				<a href="#">
				<!-- <h1 class="loginhead">Mehsul</h1> -->
				</a>
				<div class="loginimg">
					<img src="{{asset('images/logo-icon.png')}}" alt="">
				</div>
			</div>
			<div class="m-login__signin">
				@include('admin.common.error')
				@include('admin.common.alert-messages')
				<form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}" id="login_frm">
                    @csrf
					<div class="form-group m-form__group">
						<input class="form-control m-input" type="text" placeholder="Username" name="username" value="{{old('username') }}" autocomplete="off">
					</div>
					<div class="form-group m-form__group">
						<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" name="password">
					</div>
					<div class="row m-login__form-sub">
						<div class="col m--align-right m-login__form-right">
							<a href="javascript:;" id="m_login_forget_password" class="m-link text-dark">Forgot Password ?</a>
						</div>
					</div>
					<div class="m-login__form-action">
						{{-- <button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">Sign In</button> --}}
						<button id="m_login_signin_submit" class="theme-btn add_record">Sign In</button>
					</div>
				</form>
			</div>
			<div class="m-login__forget-password">
				@include('admin.common.error')
				<div class="m-login__head">
					<h3 class="m-login__title">Forgotten Password ?</h3>
					<div class="m-login__desc">Enter your email to reset your password:</div>
				</div>
					<form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}" class="mt-5" id="forgot-password-form">
					@csrf
					<div class="form-group m-form__group">
						<input id="email" type="email" class="form-control m-input" name="email" value="{{ old('email') }}" placeholder="Email" autocomplete="off">
					</div>

					<div class="m-login__form-action">
						<button id="m_login_forget_password_submit" class="theme-btn add_record">Send Password Reset Link</button>

						<button type="button" id="m_login_forget_password_cancel" class="theme-btn add_record">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script src="{{ URL::asset('/assets/vendor/js/login.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ URL::asset('assets/vendor/jsvalidation/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\LoginRequest','#login_frm') !!}
{!! JsValidator::formRequest('App\Http\Requests\ForgotPasswordLoginRequest','#forgot-password-form') !!}
@endsection

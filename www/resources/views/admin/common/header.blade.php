<!-- BEGIN: Header -->
<header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">

	<div class="m-container m-container--fluid m-container--full-height">
		<div class="m-stack m-stack--ver m-stack--desktop custdesktop">

			<!-- BEGIN: Brand -->
			<div class="m-stack__item m-brand  m-brand--skin-dark ">
				<div class="m-stack m-stack--ver m-stack--general">
					<div class="m-stack__item m-stack__item--middle m-brand__logo">
						<a href="{{ route('dashboard') }}" class="m-brand__logo-wrapper">
							<h1 class="text-white">Nutra Care</h1>
						</a>
					</div>
					<div class="m-stack__item m-stack__item--middle m-brand__tools">
						<!-- BEGIN: Left Aside Minimize Toggle -->
						<a href="javascript:;" id="m_aside_left_minimize_toggle"
							class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block  ">
							<span></span>
						</a>
						<!-- END -->
						<!-- BEGIN: Responsive Aside Left Menu Toggler -->
						<a href="javascript:;" id="m_aside_left_offcanvas_toggle"
							class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
							<span></span>
						</a>
						<!-- END -->
						<!-- BEGIN: Responsive Header Menu Toggler -->
						<a id="m_aside_header_menu_mobile_toggle" href="javascript:;"
							class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
							<span></span>
						</a>
						<!-- END -->
						<!-- BEGIN: Topbar Toggler -->
						<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;"
							class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
							<i class="flaticon-more"></i>
						</a>
						<!-- BEGIN: Topbar Toggler -->
					</div>
				</div>
			</div>
			<!-- END: Brand -->
			<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
				<!-- BEGIN: Horizontal Menu -->
				<button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark"
					id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
				<div id="m_header_menu"
					class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark financial-menu">

				</div>
				<!-- END: Horizontal Menu -->
				<!-- BEGIN: Topbar -->
				<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
					<div class="m-stack__item m-topbar__nav-wrapper">
						<ul class="m-topbar__nav m-nav m-nav--inline">
							<li class="m-nav__item m-topbar__user-profile  m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
								m-dropdown-toggle="click">
								<a href="#" class="m-nav__link m-dropdown__toggle">
									<span class="m-topbar__userpic">
										<img src="{{asset('images/user4.jpg')}}"
											class="m--img-rounded m--marginless m--img-centered" alt="" />
									</span>
									<span class="m-nav__link-icon m-topbar__usericon  m--hide">
										<span class="m-nav__link-icon-wrapper"><i class="flaticon-user-ok"></i></span>
									</span>
								</a>
								<div class="m-dropdown__wrapper">
									<span
										class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
									<div class="m-dropdown__inner">
										<div class="m-dropdown__header m--align-center">
											<div class="m-card-user m-card-user--skin-light">
												<div class="m-card-user__pic">
													<img src="{{asset('images/user4.jpg')}}"
														class="m--img-rounded m--marginless" alt="" />
												</div>
												<div class="m-card-user__details">
													<span
														class="m-card-user__name m--font-weight-500">{{Auth::user()->name}}</span>
													<a href="javascript:;"
														class="m-card-user__email m--font-weight-300 m-link">{{Auth::user()->email}}</a>
												</div>
											</div>
										</div>
										<div class="m-dropdown__body">
											<div class="m-dropdown__content">
												<ul class="m-nav m-nav--skin-light">
													<li class="m-nav__item">
														<a href="javascript:;" class="m-nav__link update_profile"
															data-url="{{route('update-profile.save')}}">
															<i class="m-nav__link-icon flaticon-profile-1"></i>
															<span class="m-nav__link-title">
																<span class="m-nav__link-wrap">
																	<span class="m-nav__link-text">My Profile</span>
																</span>
															</span>
														</a>
													</li>
													<li class="m-nav__item">
														<a href="javascript:;" class="m-nav__link change_password">
															<i class="m-nav__link-icon flaticon-share"></i>
															<span class="m-nav__link-text">Change Password</span>
														</a>
													</li>
													<li class="m-nav__separator m-nav__separator--fit">
													</li>
													<li class="m-nav__item">
														<a href="{{route('logout')}}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Logout</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<!-- END: Topbar -->
			</div>
		</div>
	</div>

	<!-- START: Change financial year form -->
	@if(!\Auth::user()->isAdmin())
    {{ Form::open(array('route' => 'change-financial-years.store', 'id'=>'change-financial-year-form', 'style' => 'display:none')) }}
        {{Form::hidden('action', '')}}
        {{Form::hidden('financial_year_id', '')}}
    {{ Form::close() }}
	@endif
	<!-- END: Change financial year form -->
</header>
<!-- END: Header -->

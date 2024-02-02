<header class="header">
    <div class="container">
        <div class="header_main">
            <div class="brand">
                <a href="{{route('front.home')}}">
                    <img src="{{asset('assets/images/logo.png')}}" alt="Nutra Care" title="Nutra Care"/>
                </a>
            </div>
            <div class="header_right">
                <nav>
                    <div class="nav-mobile"><a id="navbar-toggle" href="javascript:void(0);"><span></span></a></div>
                    <ul class="nav-list">
                        <li>
                            <a href="{{route('front.about.us')}}">{{trans('labels.menu_about_us')}}</a>
                        </li>
                        <li>
                            <a href="{{route('front.research.development')}}">{{trans('labels.menu_r_d')}}</a>
                        </li>
                        <li>
                            <a href="{{route('front.front.products.list')}}">{{trans('labels.menu_products')}}</a>
                        </li>
                        <li>
                            <a href="{{route('front.contact.us')}}">{{trans('labels.menu_contact_us')}}</a>
                        </li>
                    </ul>
                </nav>
                <div class="lang_block">
                    <div class="custom-select-wrapper">
                        <div class="custom-select">
                            <div class="custom-select__trigger">
                                <span>{{App::isLocale('en') ? 'English':'Spanish'}}</span>
                                <div class="arrow"></div>
                            </div>
                            <div class="custom-options">
                                <span class="custom-option {{App::isLocale('en') ? 'selected':''}}"
                                      data-value="{{route('locale.lang','en')}}"
                                      onclick="language(event)">English</span>
                                <span class="custom-option {{App::isLocale('sp') ? 'selected':''}}"
                                      data-value="{{route('locale.lang','sp')}}"
                                      onclick="language(event)">Spanish</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

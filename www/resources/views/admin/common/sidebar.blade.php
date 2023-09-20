@php
    $route_name = \Route::currentRouteName();
    $masters_wallpaper_menu_class =
    $masters_news_menu_class = '';
    if(in_array($route_name, ['news.index', 'newscategory.index'])){
        $masters_news_menu_class = 'm-menu__item--expanded m-menu__item--open';
    }
    if(in_array($route_name, ['wallpaper.index', 'wallpapercategory.index'])){
        $masters_wallpaper_menu_class = 'm-menu__item--expanded m-menu__item--open';
    }
@endphp
<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i
        class="la la-close"></i></button>
<div id="m_aside_left" class="m-grid__item  m-aside-left  m-aside-left--skin-dark custsidebar">
    <!-- BEGIN: Aside Menu -->
    <div
        id="m_ver_menu"
        class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
        m-menu-vertical="1"
        m-menu-scrollable="0" m-menu-dropdown-timeout="500"
    >
        <ul class="m-menu__nav ">
            <li class="m-menu__item {{($route_name == 'dashboard')?'m-menu__item--active':''}}" aria-haspopup="true" m-menu-link-redirect="1">
                <a href="{{route('dashboard')}}" class="m-menu__link "><span class="m-menu__item-here"></span><i
                        class="m-menu__link-icon fas fa-tachometer-alt"></i><span
                        class="m-menu__link-text">Dashboard</span></a>
            </li>

            {{--        <li class="m-menu__item m-menu__item--submenu {{$masters_news_menu_class}}" aria-haspopup="true"  m-menu-link-redirect="1">--}}
            {{--                <a  href="#" class="m-menu__link m-menu__toggle"><span class="m-menu__item-here"></span><i class="m-menu__link-icon fas fa-newspaper"></i><span class="m-menu__link-text">News & Article</span>--}}
            {{--                    <i class="m-menu__ver-arrow la la-angle-right"></i>--}}
            {{--                </a>--}}
            {{--                <div class="m-menu__submenu ">--}}
            {{--                    <span class="m-menu__arrow"></span>--}}
            {{--                    <ul class="m-menu__subnav">--}}
            {{--                        <li class="m-menu__item {{($route_name == 'newscategory.index')?'m-menu__item--active':''}}" aria-haspopup="true"  m-menu-link-redirect="1">--}}
            {{--                            <a  href="{{route('newscategory.store')}}" class="m-menu__link ">--}}
            {{--                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">--}}
            {{--                                    <span></span>--}}
            {{--                                </i>--}}
            {{--                                <span class="m-menu__link-text">Category</span>--}}
            {{--                            </a>--}}
            {{--                        </li>--}}

            {{--                        <li class="m-menu__item {{($route_name == 'news.index')?'m-menu__item--active':''}}" aria-haspopup="true"  m-menu-link-redirect="1"><a  href="{{route('news.index')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Manage News</span></a></li>--}}

            {{--                    </ul>--}}
            {{--                </div>--}}
            {{--            </li>--}}

            <li class="m-menu__item {{($route_name == 'inquiry.index')?'m-menu__item--active':''}}" aria-haspopup="true"
                m-menu-link-redirect="1">
                <a href="{{route('inquiry.index')}}" class="m-menu__link ">
                    <span class="m-menu__item-here"></span>
                    <i class="m-menu__link-icon fas fa-info"></i>
                    <span class="m-menu__link-text">Product Inquiry</span>
                </a>
            </li>

            <li class="m-menu__item {{($route_name == 'contact.index')?'m-menu__item--active':''}}" aria-haspopup="true"
                m-menu-link-redirect="1">
                <a href="{{route('contact.index')}}" class="m-menu__link ">
                    <span class="m-menu__item-here"></span>
                    <i class="m-menu__link-icon fas fa-phone"></i>
                    <span class="m-menu__link-text">Contact us</span>
                </a>
            </li>

            {{--            <li class="m-menu__item {{($route_name == 'page.index')?'m-menu__item--active':''}}" aria-haspopup="true"--}}
            {{--                m-menu-link-redirect="1">--}}
            {{--                <a href="{{route('page.index')}}" class="m-menu__link ">--}}
            {{--                    <span class="m-menu__item-here"></span>--}}
            {{--                    <i class="m-menu__link-icon fas fa-book"></i>--}}
            {{--                    <span class="m-menu__link-text">Page</span>--}}
            {{--                </a>--}}
            {{--            </li>--}}
            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true">
                <a href="javascript:;" class="m-menu__link m-menu__toggle"><span class="m-menu__item-here"></span>
                    <i class="m-menu__link-icon fas fa-image"></i>
                    <span class="m-menu__link-text">Product Management</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i></a>
                <div class="m-menu__submenu ">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item {{($route_name == 'category.index')?'m-menu__item--active':''}}"
                            aria-haspopup="true" m-menu-link-redirect="1">
                            <a href="{{route('category.index')}}" class="m-menu__link ">
                                <span class="m-menu__item-here"></span>
                                <span class="m-menu__link-text">Category</span>
                            </a>
                        </li>

{{--                        <li class="m-menu__item {{($route_name == 'attribute.index')?'m-menu__item--active':''}}"--}}
{{--                            aria-haspopup="true" m-menu-link-redirect="1">--}}
{{--                            <a href="{{route('attribute.index')}}" class="m-menu__link ">--}}
{{--                                <span class="m-menu__item-here"></span>--}}
{{--                                <span class="m-menu__link-text">Attribute</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}

                        <li class="m-menu__item {{($route_name == 'product.index')?'m-menu__item--active':''}}"
                            aria-haspopup="true" m-menu-link-redirect="1">
                            <a href="{{route('product.index')}}" class="m-menu__link ">
                                <span class="m-menu__item-here"></span>
                                <span class="m-menu__link-text">Product</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            {{--            <li class="m-menu__item {{($route_name == 'notification.index')?'m-menu__item--active':''}}"--}}
            {{--                aria-haspopup="true" m-menu-link-redirect="1">--}}
            {{--                <a href="{{route('notification.index')}}" class="m-menu__link ">--}}
            {{--                    <span class="m-menu__item-here"></span>--}}
            {{--                    <i class="m-menu__link-icon fas fa-bell"></i>--}}
            {{--                    <span class="m-menu__link-text">Notification</span>--}}
            {{--                </a>--}}
            {{--            </li>--}}

            {{--            <li class="m-menu__item {{($route_name == 'users.index')?'m-menu__item--active':''}}" aria-haspopup="true"--}}
            {{--                m-menu-link-redirect="1">--}}
            {{--                <a href="{{route('users.index')}}" class="m-menu__link ">--}}
            {{--                    <span class="m-menu__item-here"></span>--}}
            {{--                    <i class="m-menu__link-icon fas fa-user"></i>--}}
            {{--                    <span class="m-menu__link-text">User Management</span>--}}
            {{--                </a>--}}
            {{--            </li>--}}

            <li class="m-menu__item {{($route_name == 'setting.index')?'m-menu__item--active':''}}" aria-haspopup="true"
                m-menu-link-redirect="1">
                <a href="{{route('setting.index')}}" class="m-menu__link ">
                    <span class="m-menu__item-here"></span>
                    <i class="m-menu__link-icon fas fa-cogs"></i>
                    <span class="m-menu__link-text">Setting</span>
                </a>
            </li>

            <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="{{route('logout')}}"
                                                                                       class="m-menu__link "><span
                        class="m-menu__item-here"></span><i class="m-menu__link-icon fas fa-sign-out-alt"></i><span
                        class="m-menu__link-text">Logout</span></a></li>
        </ul>
    </div>
    <!-- END: Aside Menu -->
</div>
<!-- END: Left Aside -->
<div class="m-grid__item m-grid__item--fluid m-wrapper mb-0">

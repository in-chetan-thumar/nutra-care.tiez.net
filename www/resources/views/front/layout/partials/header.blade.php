<header class="header">
    <div class="container">
      <div class="header_main">
        <div class="brand">
          <a href="{{route('front.home')}}">
            <img src="assets/images/logo.png" alt="Salvi Chemical" title="Salvi Chemical" />
          </a>
        </div>
        <div class="header_right">
          <nav>
            <div class="nav-mobile"><a id="navbar-toggle" href="javascript:void(0);"><span></span></a></div>
            <ul class="nav-list">
              <li>
                <a href="{{route('front.about.us')}}">About Us</a>
              </li>
              <li>
                <a href="{{route('front.research.development')}}">Research and Development</a>
              </li>
              <li>
                <a href="{{route('front.front.products')}}">Products</a>
              </li>
              <li>
                <a href="{{route('front.contact.us')}}">Contact Us</a>
              </li>
            </ul>
          </nav>
              <div class="lang_block">
                  <div class="custom-select-wrapper">
                    <div class="custom-select">
                        <div class="custom-select__trigger"><span>English</span>
                            <div class="arrow"></div>
                        </div>
                        <div class="custom-options">
                           <span class="custom-option selected" data-value="english">English</span>
                          <span class="custom-option" data-value="spanish">Spanish</span>
                        </div>
                    </div>
                  </div>
              </div>
        </div>
      </div>
    </div>
</header>

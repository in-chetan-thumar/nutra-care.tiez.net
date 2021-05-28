<footer class="footer">
    <div class="container">
        <div class="footer_block">
            <div class="row">
                <div class="col-md-6 col-lg-5">
                    <div class="footer_logo">
                        <a href="{{route('front.home')}}">
                            <img src="assets/images/logo.png" alt="Nutra Care" title="Nutra Care" / >
                        </a>
                    </div>
                    <div class="footer_social_links">
                        <ul>
                            <li>
                                <a href="#" target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <ul>
                        <li>
                            <a href="{{route('front.about.us')}}">{{trans('labels.menu_about_us')}}</a>
                        </li>
                        <li>
                            <a href="{{route('front.research.development')}}">{{trans('labels.menu_r_d')}}</a>
                        </li>
                        <li>
                            <a href="{{route('front.front.products')}}">{{trans('labels.menu_products')}}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 col-lg-3">
                    <h6>{{trans('labels.footer_contact_us')}}</h6>
                    <p>{{trans('labels.footer_tel')}} <a href="tel: +91-22-28065292">91-22-28065292</a></p>
                    <p>{{trans('labels.footer_fax')}} <a href="tel: +91-22-28059274">91-22-28059274</a></p>
                    <p>{{trans('labels.footer_email')}} <br/><a href="mailto:info@nutracareintl.com">info@nutracareintl.com</a> <a href="mailto:nutracare@yahoo.com"> nutracare@yahoo.com</a></p>
                </div>
            </div>
        </div>
        <div class="copyright_sec">
            <div class="copyright_left">
                <p>{{trans('labels.copyright_text')}}</p>
            </div>
        </div>
    </div>
</footer>
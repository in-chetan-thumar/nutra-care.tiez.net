<html lang="en" >
    <!-- begin::Head -->
    <head>
        <meta charset="utf-8" />
        <title>Salvi Chemical Industries Ltd.</title>
        <meta name="description" content="Salvi Chemical Industries">
        <meta name="tag" content="Salvi Chemical Industries">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
		<!--begin::Base Styles -->
			<link href="{{ URL::asset('/assets/vendor/css/vendors.bundle.css') }}" rel="stylesheet" type="text/css" /><!--RTL version:<link href="../../../assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
			<link href="{{ URL::asset('/assets/vendor/css/style.bundle.css') }}" rel="stylesheet" type="text/css" /><!--RTL version:<link href="../../../assets/demo/default/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
        <!--end::Base Styles -->
        <!--begin::Web font -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
        <script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>
        <!--end::Web font -->
    </head>
    <!-- end::Head -->
    <!-- begin::Body -->
    <body  class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
        <!-- begin:: Page -->
        <div class="m-grid m-grid--hor m-grid--root m-page">
            @yield('content')
        </div>
        <!-- end:: Page -->
        <!--begin::Base Scripts -->
    	    	<script  src="{{ URL::asset('/assets/vendor/js/vendors.bundle.js') }}" type="text/javascript"></script>
		    	<script src="{{ URL::asset('/assets/vendor/js/scripts.bundle.js') }}" type="text/javascript"></script>
		<!--end::Base Scripts -->
        <!--begin::Page Snippets -->
        <!--end::Page Snippets -->
    </body>
    @yield('plugin_script')
    @yield('scripts')
    <!-- end::Body -->
</html>

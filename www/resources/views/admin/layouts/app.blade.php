<html lang="en">
<!-- begin::Head -->

<head>
    <meta charset="utf-8" />
    <title>Actress Wallpaper</title>
    <meta name="description" content="Mehsul">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <!--begin::Page Vendors Styles -->

    <!-- 16-4-2020
    <link href="{{ URL::asset('/assets/vendor/fullcalendar/fullcalendar.bundle.css') }} rel=" stylesheet"
        type="text/css" /> -->

    <!--end::Page Vendors Styles -->
    <!--begin::Base Styles -->
    <link href="{{ URL::asset('/assets/vendor/css/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/vendor/css/style_demo_12.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/vendor/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!-- <link href="{{ URL::asset('/css/language.css') }}" rel="stylesheet" type="text/css" /> -->
    <link href="{{ URL::asset('/css/custom-style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/css/theme.css') }}" rel="stylesheet" type="text/css" />

    <!--end::Base Styles -->
    <link rel="shortcut icon" href="assets/demo/demo12/media/img/logo/favicon.ico" />

    <style>
        /* Chrome, Safari, Edge, Opera */
        input.allow_only_amount::-webkit-outer-spin-button,
        input.allow_only_amount::-webkit-inner-spin-button,
        input.allow_gt_zero_number::-webkit-outer-spin-button,
        input.allow_gt_zero_number::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input.allow_only_amount,
        input.allow_gt_zero_number {
            -moz-appearance: textfield;
        }
    </style>

    @yield('styles')
</head>
<!-- end::Head -->
<!-- begin::Body -->

<body
    class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
    @include('admin.common.header')
    <!-- begin:: Page -->
    <div class="m-content">
        <div class="m-grid m-grid--hor m-grid--root m-page">
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
                @if(\Auth::user()->isAdmin())
                @include('admin.common.sidebar')
                @else
                @include('admin.common.usersidebar')
                @endif
                <!-- <main class="py-4"> 2-4-2020 -->
                <main class="py-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
    @include('admin.common.modals')
    @include('admin.common.footer')
    <script>
        var confirm_delete = "{{$confirm_delete}}";
        var dont_revert_deleted_record = "{{$dont_revert_deleted_record}}";
        var select2_no_record = "{{__('messages.record_not_found')}}";
        var record_not_found = "{{$record_not_found}}";
        var please_wait = "{{$please_wait}}";
        var class_select2 = "{{ Session::get('language_class','') }}";
    </script>
    <!--begin::Base Scripts -->
    <!-- 16-4-2020 <script src="https://code.jquery.com/jquery-3.4.1.min.js" type="text/javascript"></script> -->

    <!-- 16-4-2020 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

    <script src="{{ URL::asset('/assets/vendor/js/vendors.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('/assets/vendor/js/scripts_demo_12.bundle.js') }}" type="text/javascript"></script>
    <!--end::Base Scripts -->
    <!--begin::Page Vendors Scripts -->

    <!-- 16-4-2020 <script src="{{ URL::asset('/assets/vendor/fullcalendar/fullcalendar.bundle.js') }}" type="text/javascript"> -->

    </script>
    <!--end::Page Vendors Scripts -->
    <!--begin::Page Snippets -->

    <!-- 16-4-2020 <script src="{{ URL::asset('/assets/vendor/js/dashboard.js') }}" type="text/javascript"></script> -->
    <!--end::Page Snippets -->

    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ URL::asset('assets/vendor/jsvalidation/jsvalidation.js')}}"></script>
    <script src="{{ URL::asset('js/common.js') }}" type="text/javascript"></script>

    @if(!\Auth::user()->isAdmin())
    <script type="text/javascript">
        $('document').ready(function() {
    // $('#change_panchayat').change(function (e) {
    //     e.preventDefault();
    //     mApp.blockPage({
    //         overlayColor: "#000000",
    //         type: "loader",
    //         state: "success",
    //         message: please_wait
    //     });
    //     $('#change-panchayat-form').submit();
    // });

    //Set default financial year
    // $(document).on('change', '.change_finaacial_year', function (e) {
    //     var selected_option = $('option:selected', $(this));
    //     var action = selected_option.data('action');
    //     var financial_year_id = selected_option.data('financial_year_id');
    //     $('#change-financial-year-form').find('input[name="action"]').val(action);
    //     $('#change-financial-year-form').find('input[name="financial_year_id"]').val(financial_year_id);

    //     mApp.blockPage({
    //         overlayColor: "#000000",
    //         type: "loader",
    //         state: "success",
    //         message: please_wait
    //     });

    //     $('#change-financial-year-form').submit();
    // });
});
    </script>
    @endif
    @yield('plugin_script')

    <script type="text/javascript">
        $(document).ready(function () {

            //Disable up, down arrow, minus, plus key for number input
            $(document).on("focus",'input.allow_only_amount', function () {
                $(this).on("keydown", function (event) {
                    var keys = ['0','1','2','3','4','5','6','7','8','9'];
                    var disabled_keyboard_keys = [38, 40, 69, 107, 109, 187, 189];
                    if(disabled_keyboard_keys.includes(event.keyCode) || (keys.includes(event.key) && $(this).val().length >= 10)){
                        event.preventDefault();
                    }

                    //Disable more than one decimal
                    var disabled_decimal_keys = [190, 110];
                    if(disabled_decimal_keys.includes(event.keyCode) && $(this).val().indexOf('.') != -1){
                        event.preventDefault();
                    }

                    //Disable more than two digits after decimal
                    if(keys.includes(event.key) && $(this).val().indexOf('.') != -1 && $(this).val().split('.')[1].length > 1){
                        event.preventDefault();
                    }
                });
            });

            //Disable decimal
            $(document).on("focus",'input.disable_decimal', function () {
                $(this).on("keydown", function (event) {
                    var disabled_decimal_keys = [190, 110];
                    if(disabled_decimal_keys.includes(event.keyCode)){
                        event.preventDefault();
                    }
                });
            });

            //Allow only 0-9 number
            $(document).on("focus",'input.allow_only_year', function () {
                $(this).on("keydown", function (event) {
                    var keys = ['0','1','2','3','4','5','6','7','8','9'];
                    var other_keys = ['Tab', 'Backspace'];
                    if((!keys.includes(event.key) && !other_keys.includes(event.key)) || (keys.includes(event.key) && $(this).val().length >= 4)){
                        event.preventDefault();
                    }
                });
            });
        });
    </script>
    @yield('scripts')

    {!! JsValidator::formRequest('App\Http\Requests\ChangePasswordRequest','#change-password-form') !!}
</body>

</html>

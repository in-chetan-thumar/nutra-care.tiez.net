@extends('front.layout.mainlayout')
@section('content')

    <section class="about_history">
        <div class="container">
            <div class="about_description">
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div class="about_left">
                            <h3>{{trans('labels.about_us_title')}}</h3>
                            <p>{{trans('labels.about_us_subtitle')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="world_sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-3">
                    <img src="assets/images/world.png" alt="World" title="World"/>
                </div>
                <div class="col-md-12 col-lg-9">
                    <h3>{{trans('labels.about_para1')}}</h3>
                    <p>{{trans('labels.about_para2')}}</p>
                </div>
            </div>
        </div>

    </section>

    <section class="value_block">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-4">
                    <div class="value_left">
                        <h3>{{trans('labels.value_title')}}</h3>
                        <div class="value_img">
                            <img src="assets/images/value.jpg" alt="Value" title="Value" id="img_other"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-8">
                    <div class="value_right">
                        <div class="value_box" data-img-url="assets/images/value.jpg">
                            <h4 class="title">{!!trans('labels.value_info_title1')!!}</h4>
                            <p>{{trans('labels.value_info_para1')}}</p>
                        </div>
                        <div class="value_box" data-img-url="assets/images/quality.jpg">
                            <h4 class="title">{!!trans('labels.value_info_title2')!!}</h4>
                            <p>{{trans('labels.value_info_para2')}}</p>
                        </div>
                        <div class="value_box" data-img-url="assets/images/research.jpg">
                            <h4 class="title">{!!trans('labels.value_info_title3')!!}</h4>
                            <p>{{trans('labels.value_info_para3')}}</p>
                        </div>
                        <div class="value_box" data-img-url="assets/images/resource.jpg">
                            <h4 class="title">{!!trans('labels.value_info_title4')!!}</h4>
                            <p>{{trans('labels.value_info_para4')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('script')

    <script type="text/javascript">

        $(".value_right").scroll(function () {

            if ($(this)[0].scrollTop != 0) {
                var result2 = "";
                $.each($(".value_box"), function (i, e) {
                    console.log(i)
                    if (checkInView($(e), true)) {
                        $("#img_other").attr('src', $(this).data('img-url'));
                        $("#img_other").delay(1000).fadeIn(3000);
                        result2 += " " + checkInView($(e), true);
                    }
                });

            } else {
                $("#img_other").attr('src', "assets/images/value.jpg");
                $("#img_other").delay(1000).fadeIn(3000);
            }

            console.log(result2)
        });

        function checkInView(elem, partial) {
            var container = $(".value_right");
            var contHeight = container.height();
            var contTop = container.scrollTop();
            var contBottom = contTop + contHeight;
            var elemTop = $(elem).offset().top - container.offset().top;
            var elemBottom = elemTop + $(elem).height();
            console.log("TOP",elemTop)
            console.log("elemBottom",elemBottom)
            console.log("container",container.height())
            var isPart = ((elemTop < 0 && elemBottom > 0) || (elemTop > 0 && elemTop <= container.height())) && partial;

            return isPart;
        }

    </script>

@endsection

@extends('front.layout.mainlayout')
@section('content')
<style>
    #sticky {
        padding: 0.5ex;
        font-size: 2em;
        border-radius: 0.5ex;
        float: left;
        position: sticky;
        width: 100%;
    }

    #sticky.stick {
        position: sticky;
        top: 80px;
        z-index: 10;
        border-radius: 0 0 0.5em 0.5em;
        max-width: 100%;
    }

    .content-holder {
        /* margin-left: 225px; */
    }

    .content-holder .value_right {
        height: auto;
    }
        </style>
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
                    <div class="col-md-12 col-lg-6">
                        <img src="assets/images/nutra_2nd.png" alt="World" title="" width="80%"/>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="world_sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-3">
                    <img src="assets/images/world.png" alt="World" title="World" />
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
            <div id="sticky-anchor"></div>
            <div class="row">
                <div class="col-md-12 col-lg-4">
                    <div class="value_left" id="sticky">
                        <h3>{{trans('labels.value_title')}}</h3>
                        <div class="value_img">
                            <img src="assets/images/nutra_7th.png" alt="Value" title="Value" id="img_other" />
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-8">
                    <div class="content-holder">
                        <div class="value_right">
                            <div class="value_box" data-id="vision-1" id="vision-1" data-img-url="assets/images/nutra_7th.png">
                                <h4 class="title">{!!trans('labels.value_info_title1')!!}</h4>
                                <p>{{trans('labels.value_info_para1')}}</p>
                            </div>
                            <div class="value_box" data-id="vision-2" id="vision-2" data-img-url="assets/images/nutra_3rd.png">
                                <h4 class="title">{!!trans('labels.value_info_title2')!!}</h4>
                                <p>{{trans('labels.value_info_para2')}}</p>
                            </div>
                            <div class="value_box" data-id="vision-3" id="vision-3" data-img-url="assets/images/nutra_4th.png">
                                <h4 class="title">{!!trans('labels.value_info_title3')!!}</h4>
                                <p>{{trans('labels.value_info_para3')}}</p>
                            </div>
                            <div class="value_box" data-id="vision-4" id="vision-4" data-img-url="assets/images/nutra_3rd.png">
                                <h4 class="title">{!!trans('labels.value_info_title4')!!}</h4>
                                <p>{{trans('labels.value_info_para4')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('script')
    <script src="assets/js/about-sticky.js"></script>
@endsection

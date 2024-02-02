@extends('front.layout.mainlayout')
@section('css')
    <style>
        input[type=checkbox] {
            accent-color: #ffffff;
        }
    </style>
    <link href="https://kendo.cdn.telerik.com/themes/6.7.0/default/default-main.css" rel="stylesheet" />
@endsection
@section('content')
    <section class="category_sec">
        <div class="container">
            {{--            <h3>{{trans('labels.category_title')}}</h3> --}}
            <div class="category_main">

                @foreach ($categories as $category)
                    <div class="row category_box">
                        <div class="col-12">

                            <div class="row category_box_center ">
                                <h5>{{ $category->title }}</h5>

                                @foreach ($category->childs as $child)
                                    <div class="category_size">
                                        <a class="text-decoration-none"
                                            href="{{ route('front.front.products.filter', [$category->id, $child->id]) }}">
                                            <div class="category_block">
                                                <img src="{{ asset("storage/category/$child->photo") }}"
                                                    alt="{{ $child->title }}" title="{{ $child->title }}" height="50px" />
                                                <h4>{{ $child->title }}</h4>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\InquiryRequest', '#form-inquiry') !!}
    <script src="https://www.google.com/recaptcha/api.js?render=explicit&amp;onload=recaptchaCallback&amp;hl=fr" async=""
        defer=""></script>
    {{--        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    {{--    <script src="https://kendo.cdn.telerik.com/2023.2.829/js/jquery.min.js"></script> --}}
    <script src="https://kendo.cdn.telerik.com/2023.2.829/js/kendo.all.min.js"></script>

    <script src="{{ URL::asset('js/admin/fronted_product.js') }}" type="text/javascript"></script>
@endsection

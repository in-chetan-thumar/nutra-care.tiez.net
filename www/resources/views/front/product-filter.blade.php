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
    <section class="contact_us_sec">
        <div class="container ">
            <div class="catalogue_main">
                <div class="row" style="--bs-gutter-x:0 !important;display: inline-flex; min-width: 100%;">
                    <div class="sidenav col-lg-3 ">
                        <div class="col-md-12">
                            <h4>PRODUCT CATEGORIES</h4>
                        </div>
                        <div class="sidenav_link">
                            <div id="treeview">
                                <form action="{{ route('front.front.products.filter') }}" method="post">
                                    @csrf
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        @foreach ($categories as $val)
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="home-tab" data-bs-toggle="tab"
                                                    data-bs-target="#{{ $val->title }}" type="button" role="tab"><a
                                                        class="nav-link" aria-current="page"
                                                        href="#">{{ $val->title }}</a></button>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content" id="nav-tabContent">
                                        @foreach ($categories as $val)
                                            <div class="tab-pane fade show" id="{{ $val->title }}" role="tabpanel"
                                                aria-labelledby="nav-home-tab">
                                                @if ($val->subSubCategory->count())
                                                    @foreach ($val->subSubCategory as $subCat)
                                                        <div class="form-check">
                                                            <input class="form-check-input main-checkbox" type="checkbox"
                                                                name="subcategories[]" value="{{ $subCat->id }}"
                                                                id="child_{{ $subCat->title }}"
                                                                {{ in_array($subCat->id, $selectedCat) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="flexCheckDefault">
                                                                {{ $subCat->title }}
                                                            </label>
                                                            <div class="subcategories">
                                                                @foreach ($subCat->subSubCategory as $subSubCat)
                                                                    <div class="form-check">
                                                                        <input class="form-check-input child-checkbox"
                                                                            name="subsubcategories[]" type="checkbox"
                                                                            value="{{ $subSubCat->id }}"
                                                                            id="child_{{ $subSubCat->title }}"
                                                                            {{ in_array($subSubCat->id, $selectedCat) ? 'checked' : '' }}>
                                                                        <label class="form-check-label"
                                                                            for="child_{{ $subSubCat->title }}">
                                                                            {{ $subSubCat->title }}
                                                                            <span>({{ app('common')->getAllProductCount($subSubCat) }})</span>
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="btn btn-primary" type="submit">Apply</button>
                                    <button class="btn btn-secondary" type="reset">Reset</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-9">
                        <div class="main" style="min-width: 100%">
                            <div class="top-banner">
                                <p>At Nutra Care we believe in</p>
                                <h3>Quality, Quantity & Quick Service</h3>
                            </div>
                            <div class="row mb-2">
                                <form class="form-group  filters">
                                    <div class="input-group rounded">
                                        <div class="col-lg-6">
                                            <h3>Select Products </h3>
                                        </div>
                                        <div class="col-lg-3 filter-input">
                                            {!! Form::select('search_by', config('constants.SEARCH_BY'), request()->query('search_by'), [
                                                'class' => 'form-select',
                                                'id' => 'search_by',
                                                'placeholder' => 'Sort by',
                                            ]) !!}
                                        </div>
                                        <div class="col-lg-3">
                                            <input type="search" class="form-control rounded" name="filters[filter]"
                                                placeholder="Search" aria-label="Search" aria-describedby="search-addon"
                                                onkeyup="filterRecoard(event)" />
                                            <input type="hidden" id="result" name="category"
                                                value="{{ isset(request()->sub_category_id) ? request()->sub_category_id : '' }}"
                                                class=" form-control result">
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="row product-data" id="productDisplayBox">
                                @include('front.layout.partials.product_list_via_form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <button type="submit" name="submit" value="upload" id="send_inquiry" class="btn product-button "
                        data-bs-toggle="modal" data-bs-target="#inquiryModal">
                        {{--                        <span class="productCount">(0)</span> --}}
                        Send Inquiry
                    </button>

                    <button type="submit" name="submit" id="deselect-all" value="upload"
                        class="btn product-button clearFilter" onclick="deselectAll()">Deselect All
                    </button>
                    <button type="submit" name="submit" id="show-all-selected" value="upload" class="btn product-button"
                        onclick="showAllProducts()" hidden>Show all product
                    </button>
                    <button type="submit" name="submit" id="show-only-selected" value="upload"
                        class="btn product-button" onclick="onlySelectShow()">Show only selected
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade product_modal" id="inquiryModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Send Inquiry</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="erroInquiry">

                </div>
                <p><span class="productCount">0</span> <span class="productText"></span> Selected</p>
                {{ Form::open(['url' => route('submit.product.inquiry'), 'name' => 'form-inquiry', 'id' => 'form-inquiry']) }}
                @csrf

                <div class="modal-body">
                    <div class="contact_form modal-form">

                        <div class="col-lg-12">
                            <div class="mb-3">
                                {!! Form::text('name', null, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Full Name',
                                ]) !!}

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                {!! Form::text('email', null, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Email Address',
                                ]) !!}

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                {!! Form::number('phone', null, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Phone Number',
                                    'oninput' =>
                                        'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);',
                                    'maxlength' => '10',
                                ]) !!}

                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="mb-3">
                                {!! Form::textarea('message', null, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Message',
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="mb-3">
                                {!! app('captcha')->display() !!}
                                {{--                                {!! NoCaptcha::display(['data-theme' => 'light' ]) !!} --}}

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3 contact_btn">
                                <button type="submit" class="btn btn-primary btnInquiry " data-bs-toggle="modal">Send
                                    Inquiry
                                </button>
                            </div>


                        </div>
                    </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade product_modal success_modal" id="exampleModal1" tabindex="-1"
        aria-labelledby="exampleModal1Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header model-line">
                    <h5 class="modal-title" id="exampleModal1Label"><span class="productCount">0</span> Products Inquiry
                        <br> Submitted Succeefully!
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body paper-plane">
                    <img src="{{ asset('assets/images/paper-plane.svg') }}" alt="Paper Plane" title="Paper Plane" />
                </div>
                <!-- <div class="modal-footer">
                                                                                                                                                                                  <button type="button" class="btn btn-primary">Send Inquiry</button>
                                                                                                                                                                                </div> -->
            </div>
        </div>
    </div>
@endsection
@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\InquiryRequest', '#form-inquiry') !!}
    <script src="https://www.google.com/recaptcha/api.js?render=explicit&amp;onload=recaptchaCallback&amp;hl=fr" async=""
        defer=""></script>
    {{--        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    {{--    <script src="https://kendo.cdn.telerik.com/2023.2.829/js/jquery.min.js"></script> --}}
    <script src="https://kendo.cdn.telerik.com/2023.2.829/js/kendo.all.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.child-checkbox').change(function() {
                var mainCheckbox = $(this).closest('.form-check').find('.main-checkbox');
                var childCheckboxes = $(this).closest('.subcategories').find('.child-checkbox');

                // Check or uncheck the main-checkbox based on whether any child-checkbox is checked
                mainCheckbox.prop('checked', childCheckboxes.is(':checked'));
            });

            $('.main-checkbox').change(function() {
                var subcategories = $(this).closest('.form-check').find('.subcategories');
                var childCheckboxes = subcategories.find('.child-checkbox');

                // Set the state of all child-checkboxes based on the main-checkbox
                childCheckboxes.prop('checked', $(this).prop('checked'));
            });


        });
    </script>

    <script src="{{ URL::asset('js/admin/fronted_product.js') }}" type="text/javascript"></script>
@endsection

@extends('front.layout.mainlayout')
@section('css')
    <style>
        input[type=checkbox] {
            accent-color: #ffffff;
        }

        .confBtn {
            margin-right: 1rem;
        }

        @media only screen and (max-width: 800px) {
            #submitButton {
                display: inline;
            }
        }

        @media only screen and (min-width: 801px) {
            #submitButton {
                display: none;
            }
        }
    </style>
    <link href="https://kendo.cdn.telerik.com/themes/6.7.0/default/default-main.css" rel="stylesheet" />
    <link href="{{ asset('assets/css/sweetalert2.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <section class="contact_us_sec application_page">
        <div class="container ">
            <div class="row">
                <div class="col-lg-3">
                    <div class="sidenav">
                        <div class="mobile_show">
                            <div class="d-flex align-items-center justify-content-between">
                                <h2>Filter</h2>
                                <div>
                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#profilter">
                                        <svg width="20" height="18" viewBox="0 0 20 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <line y1="2.5" x2="20" y2="2.5" stroke="black" />
                                            <line y1="8.5" x2="20" y2="8.5" stroke="black" />
                                            <line y1="14.5" x2="20" y2="14.5" stroke="black" />
                                            <circle cx="11.5" cy="2.9209" r="2" fill="white" stroke="black" />
                                            <circle cx="6.5" cy="8.9209" r="2" fill="white" stroke="black" />
                                            <circle cx="12.5" cy="14.9209" r="2" fill="white" stroke="black" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade product_modal" id="profilter" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                    <ul class="nav nav-tabs" role="tablist">
                                        @foreach ($categoriesForFilterArray as $key => $val)
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link <?= (isset(request()->category_id) && request()->category_id == $val['id']) || (!isset(request()->category_id) && $key == 0) ? 'active' : '' ?>"
                                                    id="acat{{ $val['id'] }}" data-bs-toggle="tab"
                                                    href="#cat{{ $val['id'] }}" role="tab"
                                                    aria-controls="{{ $val['text'] }}"
                                                    aria-selected="false">{{ $val['text'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <div class="tab-content" id="tab-content">
                                        @foreach ($categoriesForFilterArray as $key => $val)
                                            <div class="tab-pane <?= (isset(request()->category_id) && request()->category_id == $val['id']) || (!isset(request()->category_id) && $key == 0) ? 'active' : '' ?>"
                                                id="cat{{ $val['id'] }}" role="tabpanel" aria-labelledby="simple-tab-0">
                                                <div id="subCat{{ $val['id'] }}"></div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="filter_buttons">
                                        <ul>
                                            <li><button type="submit" class="btn product-button" id="submitButton"
                                                    data-bs-dismiss="modal" aria-label="Close">Apply</button></li>
                                            <li><button type="button" class="btn product-button send-inquiry"
                                                    onclick="window.location.href='{{ route('front.front.products.filter') }}'">Reset</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class=" col-lg-9">
                    <div class="main_rgt">
                        <div class="top-banner">
                            <p>At Nutra Care we believe in</p>
                            <h3>Quality, Quantity &amp; Quick Service</h3>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <form class="form-group  filters">
                            <div class="row g-4 align-items-center justify-content-between">
                                <div class="col-lg-4">
                                    <input type="search" class="form-control rounded"
                                        <?= count($newArrayOfProduct) > 0 ? '' : 'style="display: none"' ?>
                                        id="search_product" name="filters[filter]" placeholder="Search Product"
                                        aria-label="Search Product" aria-describedby="search-addon"
                                        onkeyup="filterRecoard()">
                                    <input type="hidden" id="result" name="category" value=""
                                        class=" form-control result">
                                </div>
                                <div class="col-lg-8">
                                    <div class="d-flex align-items-center justify-content-end btnwrpr">
                                        <div class="links" id="hidden_links">
                                            <ul>
                                                <li><a href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target="#selectedpro"><span class="productCount"></span>
                                                        Product Selected</a></li>
                                                <li><a href="#" onclick="removeAll();">Deselect All</a></li>
                                            </ul>
                                        </div>
                                        <div><button type="button" name="submit" value="upload" id="send_inquiry"
                                                class="btn product-button" data-bs-toggle="modal"
                                                data-bs-target="#inquiryModal">Send Inquiry</button></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row product-data" id="productDisplayBox">
                        @include('front.ajax_product_filter')
                    </div>
                </div>
            </div>
        </div>
        <!-- Selected Product Modal -- Start -->
        <div class="modal fade product_modal" id="selectedpro" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="modal-title" id="exampleModalLabel">Send Inquiry</h5>
                            </div>
                            <div class="d-flex align-items-center"><span class="total productCount"></span><a
                                    class="removebtn" href="#" data-bs-dismiss="modal"
                                    onclick="removeAll()">Remove
                                    All</a></div>
                        </div>
                    </div>
                    <div class="modal_body" id="selectedpro_modal_body"></div>
                </div>
            </div>
        </div>
        <!-- Selected Product Modal -- end -->
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
                                    <button type="submit" class="btn btn-primary btnInquiry "
                                        data-bs-toggle="modal">Send
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
        <div class="modal fade product_modal success_modal" id="exampleModal1" tabindex="-1"
            aria-labelledby="exampleModal1Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header model-line">
                        <h5 class="modal-title" id="exampleModal1Label"><span class="productCount">0</span> Products
                            Inquiry
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
    <script src="{{ URL::asset('js/admin/sweetalert2.min.js') }}" type="text/javascript"></script>

    <script>
        var mainList = @php echo json_encode($dataSubCatList) @endphp;
        // console.log(mainList);
        Object.keys(mainList).forEach(key => {
            // console.log(key, mainList[key]);
            $("#subCat" + key).kendoTreeView({
                checkboxes: {
                    checkChildren: true
                },
                check: onCheck,
                dataSource: mainList[key],
            });

            @if (request()->sub_category_id)
                var treeView = $("#subCat" + key).data("kendoTreeView");
                var get_sub_category = treeView.dataSource.get({{ request()->sub_category_id }});
                if (get_sub_category) {
                    var select_sub_category_item = treeView.findByUid(get_sub_category.uid);
                    treeView.dataItem(select_sub_category_item).set("checked", true);
                    treeView.bind("change");
                    var get_category = treeView.dataSource.get({{ request()->category_id }});
                }
            @endif

        });

        $('#search_by').on('change', function(e) {
            filterRecoard(event)
        });

        // function that gathers IDs of checked nodes
        function checkedNodeIds(nodes, checkedNodes) {
            for (var i = 0; i < nodes.length; i++) {
                if (nodes[i].checked) {
                    checkedNodes.push(nodes[i].id);
                }
                if (nodes[i].hasChildren) {
                    checkedNodeIds(nodes[i].children.view(), checkedNodes);
                }
            }
        } // show checked node IDs on
        // datasource change

        function onCheck() {
            var checkedNodes = [],
                message;
            Object.keys(mainList).forEach(catId => {
                var treeView = $("#subCat" + catId).data("kendoTreeView");
                checkedNodeIds(treeView.dataSource.view(), checkedNodes);
            });

            if (checkedNodes.length > 0) {
                $("#search_product").show();
                message = checkedNodes.join(",");
            } else {
                $("#search_product").hide();
                message = null;
            }
            $("#result").val(message);
        }

        var old_selected_cats = [];
        Object.keys(mainList).forEach(catId => {
            $("#subCat" + catId).on("change", function() {
                getProductCategory(catId);
            });
            checkedNodeIds($("#subCat" + catId).data("kendoTreeView").dataSource.view(), old_selected_cats);
        });
        $(document).ready(function() {
            @if (!empty(request()->sub_category_id))
                $(".catcollapse" + {{ request()->sub_category_id }}).collapse("show");
            @endif
        });

        function getProductCategory(catId) {
            var checkedNodes = [],
                category_ids;

            Object.keys(mainList).forEach(catId => {
                var treeView = $("#subCat" + catId).data("kendoTreeView");
                checkedNodeIds(treeView.dataSource.view(), checkedNodes);
            });

            var url = window.origin + "/products-filter";
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "post", // Replace with the appropriate HTTP method
                url: url, // Replace with your Laravel route

                data: {
                    search_product: $("#search_product").val(),
                    categories: checkedNodes,
                },

                success: function(products) {
                    $("#productDisplayBox").html('');
                    $("#productDisplayBox").html(products);
                    readLoacalstorage();
                    last_selected_cat = checkedNodes.filter(cat => !old_selected_cats.includes(cat));
                    if (last_selected_cat.length > 0) {
                        last_selected_cat.forEach(function(cat) {
                            if ($("#catcollapse" + last_selected_cat).length) {
                                $("#catcollapse" + last_selected_cat).collapse("show");
                            }
                        });
                    }
                    old_selected_cats = checkedNodes;
                }
            });

        }
    </script>

    <script>
        function changeIcon(e) {
            var hasClass = e.currentTarget.classList.contains('active');
            var id = $(e.currentTarget).data('icon');
            if (hasClass) {
                $("#" + id).removeClass('fas fa-chevron-down');
                $("#" + id).addClass('fas fa-chevron-right');
            } else {
                $("#" + id).removeClass('fas fa-chevron-right');
                $("#" + id).addClass('fas fa-chevron-down');
            }
        }

        var index_url = "https://nutracareintl.buzzmakers.in/front-products";
        var product_url = "https://nutracareintl.buzzmakers.in/products";
        $('.dropdown-btn').click(function() {
            $(this).toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
        });
    </script>
@endsection

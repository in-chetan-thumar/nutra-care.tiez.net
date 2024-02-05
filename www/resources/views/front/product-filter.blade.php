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
    <section class="contact_us_sec application_page">
        <div class="container ">
            <div class="row">
                <div class="col-lg-3">
                    <div class="sidenav">
                        <form action="{{ route('front.front.products.filter') }}" method="post">
                            @csrf
                            <ul class="nav nav-tabs" role="tablist">
                                @foreach ($categoriesForFilterArray as $key => $val)
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link <?= $key == 0 ? 'active' : '' ?>" id="acat{{ $val['id'] }}"
                                            data-bs-toggle="tab" href="#cat{{ $val['id'] }}" role="tab"
                                            aria-controls="{{ $val['text'] }}"
                                            aria-selected="false">{{ $val['text'] }}</a>
                                    </li>
                                @endforeach
                            </ul>


                            <div class="tab-content" id="tab-content">
                                @foreach ($categoriesForFilterArray as $key => $val)
                                    <div class="tab-pane <?= $key == 0 ? 'active' : '' ?>" id="cat{{ $val['id'] }}"
                                        role="tabpanel" aria-labelledby="simple-tab-0">
                                        <div id="subCat{{ $val['id'] }}"></div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="filter_buttons">
                                <ul>
                                    <li><button type="button" class="btn product-button send-inquiry" onclick="window.location.href='{{ route('front.front.products.filter') }}'">Reset</button></li>
                                    {{-- <li><button type="button" class="btn product-button">Apply</button></li> --}}
                                </ul>
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
                            <div class="row align-items-center justify-content-between">
                                <div class="col-lg-4">
                                    <input type="search" class="form-control rounded" id="search_product" name="filters[filter]"
                                        placeholder="Search Product" aria-label="Search Product"
                                        aria-describedby="search-addon" onkeyup="filterRecoard()">
                                    <input type="hidden" id="result" name="category" value=""
                                        class=" form-control result">
                                </div>
                                <div class="col-lg-8">
                                    <div class="d-flex align-items-center justify-content-end">
                                        <div class="links">
                                            <ul>
                                                <li><a href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target="#selectedpro"><span class="productCount"></span>
                                                        Product Selected</a></li>
                                                <li><a href="#" onclick="removeAll()">Deselect All</a></li>
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
                                    class="removebtn" href="#" onclick="removeAll()">Remove All</a></div>
                        </div>
                    </div>
                    <div class="modal_body" id="selectedpro_modal_body"></div>

                </div>
            </div>
        </div>
        <!-- Selected Product Modal -- end -->
    </section>
@endsection
@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\InquiryRequest', '#form-inquiry') !!}
    <script src="https://www.google.com/recaptcha/api.js?render=explicit&amp;onload=recaptchaCallback&amp;hl=fr" async=""
        defer=""></script>
    {{--        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    {{--    <script src="https://kendo.cdn.telerik.com/2023.2.829/js/jquery.min.js"></script> --}}
    <script src="https://kendo.cdn.telerik.com/2023.2.829/js/kendo.all.min.js"></script>

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
                message = checkedNodes.join(",");
            } else {
                message = null;
            }
            $("#result").val(message);
        }

        Object.keys(mainList).forEach(catId => {
            $("#subCat" + catId).on("change", function() {
                getProductCategory(catId);
            });
        });

        // var treeView = $("#treeview").data("kendoTreeView");


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
                    categories: checkedNodes
                },

                success: function(products) {
                    $("#productDisplayBox").html('');
                    $("#productDisplayBox").html(products);
                    readLoacalstorage()

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

    <script src="{{ URL::asset('js/admin/fronted_product.js') }}" type="text/javascript"></script>
@endsection

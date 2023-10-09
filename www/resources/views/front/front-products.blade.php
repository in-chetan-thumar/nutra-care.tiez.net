@extends('front.layout.mainlayout')
@section('css')
    <style>
        input[type=checkbox] {
            accent-color: #ffffff;
        }
    </style>
    <link href="https://kendo.cdn.telerik.com/themes/6.7.0/default/default-main.css" rel="stylesheet"/>
@endsection
@section('content')

    <section class="contact_us_sec">
        <div class="container ">
            <div class="catalogue_main">
                <div class="row" style="--bs-gutter-x:0 !important;display: inline-flex; min-width: 100%;">
                    <div class="sidenav col-lg-3 ">
                        <div class="col-md-12">
                            <h4>PRODUCT CATEGORIES <span
                                    style=" float: right; font-size: 15px;cursor: pointer;color: #000"
                                    class="clearFilter"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                             width="20" height="20" viewBox="0 0 50 50"
                                                             style="fill:#40C057;">
<path
    d="M 25 5 C 14.351563 5 5.632813 13.378906 5.054688 23.890625 C 5.007813 24.609375 5.347656 25.296875 5.949219 25.695313 C 6.550781 26.089844 7.320313 26.132813 7.960938 25.804688 C 8.601563 25.476563 9.019531 24.828125 9.046875 24.109375 C 9.511719 15.675781 16.441406 9 25 9 C 29.585938 9 33.699219 10.925781 36.609375 14 L 34 14 C 33.277344 13.988281 32.609375 14.367188 32.246094 14.992188 C 31.878906 15.613281 31.878906 16.386719 32.246094 17.007813 C 32.609375 17.632813 33.277344 18.011719 34 18 L 40.261719 18 C 40.488281 18.039063 40.71875 18.039063 40.949219 18 L 44 18 L 44 8 C 44.007813 7.460938 43.796875 6.941406 43.414063 6.558594 C 43.03125 6.175781 42.511719 5.964844 41.96875 5.972656 C 40.867188 5.988281 39.984375 6.894531 40 8 L 40 11.777344 C 36.332031 7.621094 30.964844 5 25 5 Z M 43.03125 23.972656 C 41.925781 23.925781 40.996094 24.785156 40.953125 25.890625 C 40.488281 34.324219 33.558594 41 25 41 C 20.414063 41 16.304688 39.074219 13.390625 36 L 16 36 C 16.722656 36.011719 17.390625 35.632813 17.753906 35.007813 C 18.121094 34.386719 18.121094 33.613281 17.753906 32.992188 C 17.390625 32.367188 16.722656 31.988281 16 32 L 9.71875 32 C 9.507813 31.96875 9.296875 31.96875 9.085938 32 L 6 32 L 6 42 C 5.988281 42.722656 6.367188 43.390625 6.992188 43.753906 C 7.613281 44.121094 8.386719 44.121094 9.007813 43.753906 C 9.632813 43.390625 10.011719 42.722656 10 42 L 10 38.222656 C 13.667969 42.378906 19.035156 45 25 45 C 35.648438 45 44.367188 36.621094 44.945313 26.109375 C 44.984375 25.570313 44.800781 25.039063 44.441406 24.636719 C 44.078125 24.234375 43.570313 23.996094 43.03125 23.972656 Z"></path>
</svg> </span></h4>
                        </div>

                        <div class="sidenav_link">
                            <div id="treeview"></div>
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
                                                   placeholder="Search" aria-label="Search"
                                                   aria-describedby="search-addon" onkeyup="filterRecoard(event)"/>
                                            <input type="hidden" id="result" name="category" value="{{isset(request()->sub_category_id) ? request()->sub_category_id : ''}}"
                                                   class=" form-control result">
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="row product-data" id="productDisplayBox">
                                @include('front.layout.partials.ajax_product_list')
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

                    <button type="submit" name="submit" value="upload" id="send_inquiry" class="btn product-button " data-bs-toggle="modal"
                            data-bs-target="#inquiryModal">
                        {{--                        <span class="productCount">(0)</span>--}}
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
    <div class="modal fade product_modal" id="inquiryModal" tabindex="-1"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Send Inquiry</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="erroInquiry">

                </div>
                <p><span class="productCount">0</span> <span class="productText"></span> Selected</p>
                {{ Form::open(array('url' =>route('submit.product.inquiry'),'name' => 'form-inquiry', 'id'=>'form-inquiry')) }}
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
                                   'oninput'=>"javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);",'maxlength' => "10",
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
{{--                                {!! NoCaptcha::display(['data-theme' => 'light' ]) !!}--}}

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
                        <br> Submitted Succeefully!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body paper-plane">
                    <img src="{{asset('assets/images/paper-plane.svg')}}" alt="Paper Plane" title="Paper Plane"/>
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
    <script src="https://www.google.com/recaptcha/api.js?render=explicit&amp;onload=recaptchaCallback&amp;hl=fr" async="" defer=""></script>
    {{--        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
    {{--    <script src="https://kendo.cdn.telerik.com/2023.2.829/js/jquery.min.js"></script>--}}
    <script src="https://kendo.cdn.telerik.com/2023.2.829/js/kendo.all.min.js"></script>

    <script>

        $('#search_by').on('change', function (e) {
            filterRecoard(event)
        });
        $("#treeview").kendoTreeView({
            checkboxes: {
                checkChildren: true
            },
            check: onCheck,
            dataSource: <?php echo json_encode($categories); ?>
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
        }


        // show checked node IDs on datasource change
        function onCheck() {
            var checkedNodes = [],
                treeView = $("#treeview").data("kendoTreeView"),
                message;
            checkedNodeIds(treeView.dataSource.view(), checkedNodes);

            if (checkedNodes.length > 0) {
                message = checkedNodes.join(",");
            } else {
                message = null;
            }
            $("#result").val(message);
        }

        $("#treeview").on("change", function () {
            getProductCategory()
        });

        var treeView = $("#treeview").data("kendoTreeView");

            @if(request()->sub_category_id)
        var get_sub_category = treeView.dataSource.get({{request()->sub_category_id}});
        var select_sub_category_item = treeView.findByUid(get_sub_category.uid);
        treeView.dataItem(select_sub_category_item).set("checked", true);
        treeView.bind("change");
        getProductCategory()
        var get_category = treeView.dataSource.get({{request()->category_id}});
        var select_category_item = treeView.findByUid(get_category.uid);
        treeView.expand(select_category_item);
        @endif

        function getProductCategory() {
            var checkedNodes = [],
                treeView = $("#treeview").data("kendoTreeView"),
                category_ids;
            checkedNodeIds(treeView.dataSource.view(), checkedNodes);

            if (checkedNodes.length > 0) {
                category_ids = checkedNodes.join(",");
            }
                var url = window.origin + "/products";
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "post", // Replace with the appropriate HTTP method
                    url: url, // Replace with your Laravel route

                    data: {categories: category_ids},

                    success: function (products) {
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

        var index_url = "{{route('front.front.products')}}";
        var product_url = "{{route('front.product.category')}}";
        $('.dropdown-btn').click(function () {
            $(this).toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
        });
    </script>
    <script src="{{ URL::asset('js/admin/fronted_product.js') }}" type="text/javascript"></script>
@endsection


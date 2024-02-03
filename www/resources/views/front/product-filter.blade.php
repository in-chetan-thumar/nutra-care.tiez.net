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
                                    <li><button type="button" class="btn product-button send-inquiry">Reset</button></li>
                                    <li><button type="button" class="btn product-button">Apply</button></li>
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
                                    <input type="search" class="form-control rounded" name="filters[filter]"
                                        placeholder="Search Product" aria-label="Search Product"
                                        aria-describedby="search-addon" onkeyup="filterRecoard(event)">
                                    <input type="hidden" id="result" name="category" value=""
                                        class=" form-control result">
                                </div>
                                <div class="col-lg-8">
                                    <div class="d-flex align-items-center justify-content-end">
                                        <div class="links">
                                            <ul>
                                                <li><a href="#">24 product Selected</a></li>
                                                <li><a href="#">Deselect All</a></li>
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


                    <div class="accordion_main">
                        <div class="accordion" id="categoryExample">
                            @foreach ($newArrayOfProduct as $mainCat)
                                @if ($mainCat->subSubCategory->count() > 0)
                                    @foreach ($mainCat->subSubCategory as $subCat)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="category{{$subCat->id}}">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#catcollapse{{$subCat->id}}" aria-expanded="true"
                                                    aria-controls="catcollapse{{$subCat->id}}">
                                                    <h2>{{ $mainCat->title }} > {{ $subCat->title }}</h2>
                                                </button>
                                            </h2>
                                            @php
                                                $catWithProds = [];
                                                $is_direct_product = false;
                                                if ($subCat->subSubCategory->count() > 0) {
                                                    $catWithProds = app('common')->getTitleForAccordion($subCat->subSubCategory,$subCat->id);
                                                    // dump($catWithProds);
                                                }else{
                                                    $catWithProds = app('common')->getDirectProducts($subCat);
                                                    $is_direct_product = true;
                                                }
                                               
                                            @endphp
                                            @if(!$is_direct_product)
                                                @foreach ($catWithProds as $catWithProd)
                                                    <?php //dd($catWithProd['id'],$subCat->id); ?>
                                                    <div id="catcollapse{{$subCat->id}}" class="accordion-collapse"
                                                        aria-labelledby="category{{$subCat->id}}" data-bs-parent="#category{{$subCat->id}}">
                                                        <div class="accordion-body">
                                                            <div class="accordion" id="accordionExample">
                                                                <div class="accordion-item">
                                                                    <h2 class="accordion-header" id="headingOne">
                                                                        <button class="accordion-button collapsed" type="button"
                                                                            data-bs-toggle="collapse" data-bs-target="#subSubCat{{$catWithProd['id']}}"
                                                                            aria-expanded="true" aria-controls="subSubCat{{$catWithProd['id']}}">
                                                                            {{$catWithProd['parentTreeTitle']}} ({{count($catWithProd['products'])}} Products)
                                                                        </button>
                                                                    </h2>
                                                                    <div id="subSubCat{{$catWithProd['id']}}" class="accordion-collapse collapse"
                                                                        aria-labelledby="headingOne"
                                                                        data-bs-parent="#accordionExample">
                                                                        <div class="accordion-body">
                                                                            <div class="row product-data" id="productDisplayBox">
                                                                                <?php //dd($catWithProd['id'],$subCat->id); ?>
                                                                                @foreach ($catWithProd['products'] as $prod)
                                                                                    <div class="col-lg-4 ">
                                                                                        <div class="product-box product_background"
                                                                                            id="product-box-1">
                                                                                            <div class="category-font">
                                                                                                <div class="cat_title">
                                                                                                    {{$prod['title']}}
                                                                                                </div>
                                                                                                <input type="checkbox" id="{{$prod['id']}}"
                                                                                                    data-checkbox-id="{{$prod['id']}}"
                                                                                                    name="product" value=""
                                                                                                    class="product-check"
                                                                                                    onclick="getValue(event)"
                                                                                                    data-product-id="{{$prod['id']}}">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                                
                                                                                {{--
                                                                                <div class="col-lg-4 ">
                                                                                    <div class="product-box product_background "
                                                                                        id="product-box-2">
                                                                                        <div class="category-font">
                                                                                            <div class="cat_title">
                                                                                                ENCAPSULATED CALCIUM PROPIONATE
                                                                                                60/70%
                                                                                            </div>
                                                                                            <input type="checkbox" id="2"
                                                                                                data-checkbox-id="2"
                                                                                                name="product" value=""
                                                                                                class="product-check"
                                                                                                onclick="getValue(event)"
                                                                                                data-product-id="2">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-lg-4 ">
                                                                                    <div class="product-box product_background "
                                                                                        id="product-box-3">
                                                                                        <div class="category-font">
                                                                                            <div class="cat_title">
                                                                                                ENCAPSULATED SORBIC ACID
                                                                                                50/60/70/80/85%
                                                                                            </div>
                                                                                            <input type="checkbox" id="3"
                                                                                                data-checkbox-id="3"
                                                                                                name="product" value=""
                                                                                                class="product-check"
                                                                                                onclick="getValue(event)"
                                                                                                data-product-id="3">
                                                                                        </div>
                                                                                    </div>
                                                                                </div> --}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                {{--<div class="accordion-item">
                                                                    <h2 class="accordion-header" id="headingTwo">
                                                                        <button class="accordion-button collapsed" type="button"
                                                                            data-bs-toggle="collapse"
                                                                            data-bs-target="#collapseTwo" aria-expanded="false"
                                                                            aria-controls="collapseTwo">
                                                                            FLOUR FORTIFICATION (8 Products)
                                                                        </button>
                                                                    </h2>
                                                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                                                        aria-labelledby="headingTwo"
                                                                        data-bs-parent="#accordionExample">
                                                                        <div class="accordion-body">
                                                                            <div class="row product-data" id="productDisplayBox">
                                                                                <div class="col-lg-4 ">
                                                                                    <div class="product-box product_background"
                                                                                        id="product-box-4">
                                                                                        <div class="category-font">
                                                                                            <div class="cat_title">
                                                                                                ENCAPSULATED SODIUM PROPIONATE
                                                                                                60/70%
                                                                                            </div>
                                                                                            <input type="checkbox" id="4"
                                                                                                data-checkbox-id="4"
                                                                                                name="product" value=""
                                                                                                class="product-check"
                                                                                                onclick="getValue(event)"
                                                                                                data-product-id="4">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-lg-4 ">
                                                                                    <div class="product-box product_background "
                                                                                        id="product-box-5">
                                                                                        <div class="category-font">
                                                                                            <div class="cat_title">
                                                                                                ENCAPSULATED CALCIUM PROPIONATE
                                                                                                60/70%
                                                                                            </div>
                                                                                            <input type="checkbox" id="5"
                                                                                                data-checkbox-id="5"
                                                                                                name="product" value=""
                                                                                                class="product-check"
                                                                                                onclick="getValue(event)"
                                                                                                data-product-id="5">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-lg-4 ">
                                                                                    <div class="product-box product_background "
                                                                                        id="product-box-6">
                                                                                        <div class="category-font">
                                                                                            <div class="cat_title">
                                                                                                ENCAPSULATED SORBIC ACID
                                                                                                50/60/70/80/85%
                                                                                            </div>
                                                                                            <input type="checkbox" id="6"
                                                                                                data-checkbox-id="6"
                                                                                                name="product" value=""
                                                                                                class="product-check"
                                                                                                onclick="getValue(event)"
                                                                                                data-product-id="6">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>--}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="row product-data" id="productDisplayBox">
                                                    <?php //dd($catWithProd['id'],$subCat->id); ?>
                                                    @foreach ($catWithProds['products'] as $prod)
                                                        <div class="col-lg-4 ">
                                                            <div class="product-box product_background"
                                                                id="product-box-1">
                                                                <div class="category-font">
                                                                    <div class="cat_title">
                                                                        {{$prod['title']}}
                                                                    </div>
                                                                    <input type="checkbox" id="{{$prod['id']}}"
                                                                        data-checkbox-id="{{$prod['id']}}"
                                                                        name="product" value=""
                                                                        class="product-check"
                                                                        onclick="getValue(event)"
                                                                        data-product-id="{{$prod['id']}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach

                            {{--            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="categorytwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#catcollapsetwo" aria-expanded="true"
                                        aria-controls="catcollapsetwo">
                                        <h2>D C GRADES (1/20 Selected)</h2>
                                    </button>
                                </h2>
                                <div id="catcollapsetwo" class="accordion-collapse collapse"
                                    aria-labelledby="categorytwo" data-bs-parent="#categorytwo">
                                    <div class="accordion-body">
                                        <div class="accordion" id="accordionExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingthree">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapsethree"
                                                        aria-expanded="true" aria-controls="collapsethree">
                                                        RICE FORTIFICATION (6 Products)
                                                    </button>
                                                </h2>
                                                <div id="collapsethree" class="accordion-collapse collapse"
                                                    aria-labelledby="headingthree" data-bs-parent="#categorytwo">
                                                    <div class="accordion-body">
                                                        <div class="row product-data" id="productDisplayBox">
                                                            <div class="col-lg-4 ">
                                                                <div class="product-box product_background"
                                                                    id="product-box-1">
                                                                    <div class="category-font">
                                                                        <div class="cat_title">
                                                                            ENCAPSULATED SODIUM PROPIONATE 60/70%
                                                                        </div>
                                                                        <input type="checkbox" id="1"
                                                                            data-checkbox-id="1" name="product"
                                                                            value="" class="product-check"
                                                                            onclick="getValue(event)" data-product-id="1">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 ">
                                                                <div class="product-box product_background "
                                                                    id="product-box-2">
                                                                    <div class="category-font">
                                                                        <div class="cat_title">
                                                                            ENCAPSULATED CALCIUM PROPIONATE 60/70%
                                                                        </div>
                                                                        <input type="checkbox" id="2"
                                                                            data-checkbox-id="2" name="product"
                                                                            value="" class="product-check"
                                                                            onclick="getValue(event)" data-product-id="2">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 ">
                                                                <div class="product-box product_background "
                                                                    id="product-box-3">
                                                                    <div class="category-font">
                                                                        <div class="cat_title">
                                                                            ENCAPSULATED SORBIC ACID 50/60/70/80/85%
                                                                        </div>
                                                                        <input type="checkbox" id="3"
                                                                            data-checkbox-id="3" name="product"
                                                                            value="" class="product-check"
                                                                            onclick="getValue(event)" data-product-id="3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingfour">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapsefour"
                                                        aria-expanded="false" aria-controls="collapsefour">
                                                        FLOUR FORTIFICATION (8 Products)
                                                    </button>
                                                </h2>
                                                <div id="collapsefour" class="accordion-collapse collapse"
                                                    aria-labelledby="headingfour" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row product-data" id="productDisplayBox">
                                                            <div class="col-lg-4 ">
                                                                <div class="product-box product_background"
                                                                    id="product-box-4">
                                                                    <div class="category-font">
                                                                        <div class="cat_title">
                                                                            ENCAPSULATED SODIUM PROPIONATE 60/70%
                                                                        </div>
                                                                        <input type="checkbox" id="4"
                                                                            data-checkbox-id="4" name="product"
                                                                            value="" class="product-check"
                                                                            onclick="getValue(event)" data-product-id="4">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 ">
                                                                <div class="product-box product_background "
                                                                    id="product-box-5">
                                                                    <div class="category-font">
                                                                        <div class="cat_title">
                                                                            ENCAPSULATED CALCIUM PROPIONATE 60/70%
                                                                        </div>
                                                                        <input type="checkbox" id="5"
                                                                            data-checkbox-id="5" name="product"
                                                                            value="" class="product-check"
                                                                            onclick="getValue(event)" data-product-id="5">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 ">
                                                                <div class="product-box product_background "
                                                                    id="product-box-6">
                                                                    <div class="category-font">
                                                                        <div class="cat_title">
                                                                            ENCAPSULATED SORBIC ACID 50/60/70/80/85%
                                                                        </div>
                                                                        <input type="checkbox" id="6"
                                                                            data-checkbox-id="6" name="product"
                                                                            value="" class="product-check"
                                                                            onclick="getValue(event)" data-product-id="6">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            --}}
                        </div>
                    </div>

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

    <script>
        var mainList = @php echo json_encode($dataSubCatList) @endphp;
        // console.log(mainList);

        Object.keys(mainList).forEach(key => {

            console.log(key, mainList[key]);
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
        
        /*
        $("#treeview").kendoTreeView({
            checkboxes: {
                checkChildren: true
            },
            check: onCheck,
            dataSource: [{
                "id": 1,
                "text": "Verticals",
                "expanded": false,
                "items": [{
                    "id": 2,
                    "text": "Human Nutrition",
                    "expanded": false,
                    "items": [{
                        "id": 7,
                        "text": "Micronutrient  Premix",
                        "expanded": false,
                        "items": [{
                            "id": 34,
                            "text": "Rice Fortification",
                            "expanded": false,
                            "items": []
                        }, {
                            "id": 35,
                            "text": "Flour Fortification",
                            "expanded": false,
                            "items": []
                        }, {
                            "id": 36,
                            "text": "Salt Fortification",
                            "expanded": false,
                            "items": []
                        }, {
                            "id": 37,
                            "text": "Milk Fortification",
                            "expanded": false,
                            "items": []
                        }, {
                            "id": 38,
                            "text": "Oil Fortification",
                            "expanded": false,
                            "items": []
                        }, {
                            "id": 39,
                            "text": "Bakery",
                            "expanded": false,
                            "items": []
                        }, {
                            "id": 40,
                            "text": "Ready To Use Therapeutic Food (rutf)",
                            "expanded": false,
                            "items": []
                        }, {
                            "id": 41,
                            "text": "Take Home Ration (thr)",
                            "expanded": false,
                            "items": [{
                                "id": 69,
                                "text": "Children",
                                "expanded": false,
                                "items": []
                            }, {
                                "id": 70,
                                "text": "Pregnant & Lactating Women",
                                "expanded": false,
                                "items": []
                            }]
                        }, {
                            "id": 42,
                            "text": "Extruded Foods",
                            "expanded": false,
                            "items": [{
                                "id": 71,
                                "text": "Breakfast Cereals",
                                "expanded": false,
                                "items": []
                            }, {
                                "id": 72,
                                "text": "Biscuits",
                                "expanded": false,
                                "items": []
                            }, {
                                "id": 73,
                                "text": "Noodles",
                                "expanded": false,
                                "items": []
                            }, {
                                "id": 74,
                                "text": "Confectioneries",
                                "expanded": false,
                                "items": []
                            }]
                        }, {
                            "id": 43,
                            "text": "Beverages",
                            "expanded": false,
                            "items": []
                        }]
                    }, {
                        "id": 8,
                        "text": "Encapsulated Products",
                        "expanded": false,
                        "items": [{
                            "id": 44,
                            "text": "Acids\/ph Reducers",
                            "expanded": false,
                            "items": []
                        }, {
                            "id": 45,
                            "text": "Vitamins",
                            "expanded": false,
                            "items": []
                        }, {
                            "id": 46,
                            "text": "Amino Acids",
                            "expanded": false,
                            "items": []
                        }, {
                            "id": 47,
                            "text": "Beverages",
                            "expanded": false,
                            "items": []
                        }, {
                            "id": 48,
                            "text": "Encapsulated Iron",
                            "expanded": false,
                            "items": []
                        }, {
                            "id": 49,
                            "text": "Magnesium",
                            "expanded": false,
                            "items": []
                        }, {
                            "id": 50,
                            "text": "Iron",
                            "expanded": false,
                            "items": []
                        }, {
                            "id": 51,
                            "text": "Zinc",
                            "expanded": false,
                            "items": []
                        }, {
                            "id": 52,
                            "text": "Copper",
                            "expanded": false,
                            "items": []
                        }, {
                            "id": 53,
                            "text": "Other Products",
                            "expanded": false,
                            "items": []
                        }, {
                            "id": 54,
                            "text": "Choline",
                            "expanded": false,
                            "items": []
                        }]
                    }, {
                        "id": 9,
                        "text": "Trituration",
                        "expanded": false,
                        "items": []
                    }, {
                        "id": 10,
                        "text": "Bakery",
                        "expanded": false,
                        "items": [{
                            "id": 55,
                            "text": "Anti Fungal Agents \/ Ph Reducers",
                            "expanded": false,
                            "items": []
                        }, {
                            "id": 56,
                            "text": "Bread Premix",
                            "expanded": false,
                            "items": []
                        }, {
                            "id": 57,
                            "text": "Cake Premix",
                            "expanded": false,
                            "items": []
                        }, {
                            "id": 58,
                            "text": "Glitters",
                            "expanded": false,
                            "items": []
                        }, {
                            "id": 59,
                            "text": "Sugar Sphere",
                            "expanded": false,
                            "items": []
                        }]
                    }]
                }, {
                    "id": 3,
                    "text": "Cosmetics",
                    "expanded": false,
                    "items": [{
                        "id": 11,
                        "text": "Haircare",
                        "expanded": false,
                        "items": [{
                            "id": 75,
                            "text": "Anti-dandruff",
                            "expanded": false,
                            "items": []
                        }]
                    }, {
                        "id": 12,
                        "text": "Scalp Treatment",
                        "expanded": false,
                        "items": []
                    }]
                }, {
                    "id": 4,
                    "text": "Animal Nutrition",
                    "expanded": false,
                    "items": [{
                        "id": 13,
                        "text": "Premixes",
                        "expanded": false,
                        "items": [{
                            "id": 61,
                            "text": "Mineral Mixtures",
                            "expanded": false,
                            "items": []
                        }, {
                            "id": 62,
                            "text": "Vitamin Ad3",
                            "expanded": false,
                            "items": []
                        }, {
                            "id": 63,
                            "text": "Vitamin & Mineral Mixtures",
                            "expanded": false,
                            "items": []
                        }]
                    }, {
                        "id": 14,
                        "text": "Encapsulated Products",
                        "expanded": false,
                        "items": []
                    }, {
                        "id": 15,
                        "text": "Feed Products",
                        "expanded": false,
                        "items": []
                    }, {
                        "id": 16,
                        "text": "Organic Glycinate",
                        "expanded": false,
                        "items": []
                    }, {
                        "id": 17,
                        "text": "Organic Bisglycinate",
                        "expanded": false,
                        "items": []
                    }]
                }, {
                    "id": 5,
                    "text": "Pharma",
                    "expanded": false,
                    "items": [{
                        "id": 18,
                        "text": "Pellets",
                        "expanded": false,
                        "items": [{
                            "id": 64,
                            "text": "Nutraceuticals",
                            "expanded": false,
                            "items": []
                        }, {
                            "id": 76,
                            "text": "Neutral",
                            "expanded": false,
                            "items": []
                        }, {
                            "id": 78,
                            "text": "Vitamins",
                            "expanded": false,
                            "items": []
                        }]
                    }, {
                        "id": 19,
                        "text": "D C Grades",
                        "expanded": false,
                        "items": [{
                            "id": 65,
                            "text": "Agglomeration & Granulation For Direct Compression",
                            "expanded": false,
                            "items": []
                        }, {
                            "id": 66,
                            "text": "Iron",
                            "expanded": false,
                            "items": []
                        }, {
                            "id": 67,
                            "text": "Sweetners",
                            "expanded": false,
                            "items": []
                        }, {
                            "id": 68,
                            "text": "Nutraceuticals",
                            "expanded": false,
                            "items": []
                        }]
                    }]
                }, {
                    "id": 6,
                    "text": "Encapsulation",
                    "expanded": false,
                    "items": [{
                        "id": 20,
                        "text": "Acids\/ph Reducers",
                        "expanded": false,
                        "items": []
                    }, {
                        "id": 21,
                        "text": "Vitamins",
                        "expanded": false,
                        "items": []
                    }, {
                        "id": 22,
                        "text": "Amino Acids",
                        "expanded": false,
                        "items": []
                    }, {
                        "id": 23,
                        "text": "Beverages",
                        "expanded": false,
                        "items": []
                    }, {
                        "id": 24,
                        "text": "Encapsulated Iron",
                        "expanded": false,
                        "items": []
                    }, {
                        "id": 25,
                        "text": "Magnesium",
                        "expanded": false,
                        "items": []
                    }, {
                        "id": 26,
                        "text": "Iron",
                        "expanded": false,
                        "items": []
                    }, {
                        "id": 27,
                        "text": "Zinc",
                        "expanded": false,
                        "items": []
                    }, {
                        "id": 28,
                        "text": "Copper",
                        "expanded": false,
                        "items": []
                    }, {
                        "id": 30,
                        "text": "Other Products",
                        "expanded": false,
                        "items": []
                    }, {
                        "id": 31,
                        "text": "Choline",
                        "expanded": false,
                        "items": []
                    }]
                }]
            }, {
                "id": 79,
                "text": "Application",
                "expanded": false,
                "items": [{
                    "id": 80,
                    "text": "Rice",
                    "expanded": false,
                    "items": []
                }, {
                    "id": 81,
                    "text": "Flour",
                    "expanded": false,
                    "items": []
                }, {
                    "id": 82,
                    "text": "Salt",
                    "expanded": false,
                    "items": []
                }, {
                    "id": 83,
                    "text": "Oil",
                    "expanded": false,
                    "items": []
                }, {
                    "id": 84,
                    "text": "Milk",
                    "expanded": false,
                    "items": []
                }, {
                    "id": 85,
                    "text": "Biscuit",
                    "expanded": false,
                    "items": []
                }, {
                    "id": 86,
                    "text": "Confectionery",
                    "expanded": false,
                    "items": []
                }, {
                    "id": 87,
                    "text": "Extruded Foods",
                    "expanded": false,
                    "items": []
                }, {
                    "id": 88,
                    "text": "Bakery",
                    "expanded": false,
                    "items": [{
                        "id": 93,
                        "text": "Acids\/ph Reducers",
                        "expanded": false,
                        "items": []
                    }, {
                        "id": 94,
                        "text": "Bread Premix",
                        "expanded": false,
                        "items": []
                    }, {
                        "id": 95,
                        "text": "Cake Premix",
                        "expanded": false,
                        "items": []
                    }, {
                        "id": 96,
                        "text": "Glitters",
                        "expanded": false,
                        "items": []
                    }, {
                        "id": 97,
                        "text": "Sugar Sphere",
                        "expanded": false,
                        "items": []
                    }, {
                        "id": 98,
                        "text": "Other Ingredients",
                        "expanded": false,
                        "items": []
                    }, {
                        "id": 99,
                        "text": "Micronutrient Premix",
                        "expanded": false,
                        "items": []
                    }]
                }, {
                    "id": 89,
                    "text": "Beverages",
                    "expanded": false,
                    "items": []
                }, {
                    "id": 90,
                    "text": "Sweetners",
                    "expanded": false,
                    "items": []
                }, {
                    "id": 91,
                    "text": "Pharmaceutical Products",
                    "expanded": false,
                    "items": []
                }, {
                    "id": 92,
                    "text": "Cosmetics",
                    "expanded": false,
                    "items": [{
                        "id": 100,
                        "text": "Hair Care",
                        "expanded": false,
                        "items": [{
                            "id": 102,
                            "text": "Anti Dandruff",
                            "expanded": false,
                            "items": []
                        }]
                    }, {
                        "id": 101,
                        "text": "Scalp Treatment",
                        "expanded": false,
                        "items": []
                    }]
                }]
            }]
        });
        */

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

        $("#treeview").on("change", function() {
            getProductCategory()
        });

        var treeView = $("#treeview").data("kendoTreeView");


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

                data: {
                    categories: category_ids
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

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
                                                <li><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#selectedpro"><span class="productCount" ></span> Product Selected</a></li>
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
                                                    data-bs-target="#catcollapse{{$subCat->id}}" aria-expanded="false"
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
                                                                                            id="product-box-{{$prod['id']}}">
                                                                                            <div class="category-font">
                                                                                                <div class="cat_title">
                                                                                                    {{$prod['title']}}
                                                                                                </div>
                                                                                                <input type="checkbox" id="{{$prod['id']}}"
                                                                                                    data-checkbox-id="{{$prod['id']}}"
                                                                                                    name="product" value=""
                                                                                                    class="product-check"
                                                                                                    onclick="getValue(event)"
                                                                                                    data-product-id="{{$prod['id']}}" data-product-title="{{$prod['title']}}" data-cat-title="{{ $mainCat->title .' > '. $subCat->title .' > '.$catWithProd['parentTreeTitle'] }}">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div id="catcollapse{{$subCat->id}}" class="accordion-collapse"
                                                    aria-labelledby="category{{$subCat->id}}" data-bs-parent="#category{{$subCat->id}}">
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
                                                                            data-product-id="{{$prod['id']}}" data-cat-title="{{ $mainCat->title .' > '. $subCat->title }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
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
                            <div class="d-flex align-items-center"><span class="total productCount"></span><a class="removebtn"
                                    href="#"  onclick="removeAll()">Remove All</a></div>
                        </div>
                    </div>
                    <div class="modal_body" id="selectedpro_modal_body">
                        {{--<div class="pronamelist">
                            <div class="pro_breadcrumb">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <ol>
                                            <li>VERTICALS</li>
                                            <li>HUMAN NUTRITION</li>
                                            <li>ENCAPSULATED PRODUCTS</li>
                                            <li>VITAMINS</li>
                                        </ol>
                                    </div>
                                    <div>
                                        <span class="totalprocount">11</span>
                                    </div>
                                </div>
                            </div>
                            <div class="allpronamelist">
                                <ul>
                                    <li>VITAMIN E 50% <div><a href="#" class="removebtn">Remove <svg width="17" height="16"
                                                    viewBox="0 0 17 16" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.7041 4L12.7041 12" stroke="#079620"
                                                        stroke-linecap="round" />
                                                    <path d="M13 4L5 12" stroke="#079620" stroke-linecap="round" />
                                                </svg> </a></div>
                                    </li>
                                    <li>ASCORBIC ACID 50/60/70/75/85/90/95% <div><a href="#" class="removebtn">Remove <svg
                                                    width="17" height="16" viewBox="0 0 17 16"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.7041 4L12.7041 12" stroke="#079620"
                                                        stroke-linecap="round" />
                                                    <path d="M13 4L5 12" stroke="#079620" stroke-linecap="round" />
                                                </svg> </a></div>
                                    </li>
                                    <li>ASCORBIC ACID 50/60/70/75/85/90/95% <div><a href="#" class="removebtn">Remove <svg
                                                    width="17" height="16" viewBox="0 0 17 16"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.7041 4L12.7041 12" stroke="#079620"
                                                        stroke-linecap="round" />
                                                    <path d="M13 4L5 12" stroke="#079620" stroke-linecap="round" />
                                                </svg> </a></div>
                                    </li>
                                    <li>ASCORBIC ACID 50/60/70/75/85/90/95% <div><a href="#" class="removebtn">Remove <svg
                                                    width="17" height="16" viewBox="0 0 17 16"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.7041 4L12.7041 12" stroke="#079620"
                                                        stroke-linecap="round" />
                                                    <path d="M13 4L5 12" stroke="#079620" stroke-linecap="round" />
                                                </svg> </a></div>
                                    </li>
                                    <li>ASCORBIC ACID 50/60/70/75/85/90/95% <div><a href="#" class="removebtn">Remove <svg
                                                    width="17" height="16" viewBox="0 0 17 16"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.7041 4L12.7041 12" stroke="#079620"
                                                        stroke-linecap="round" />
                                                    <path d="M13 4L5 12" stroke="#079620" stroke-linecap="round" />
                                                </svg> </a></div>
                                    </li>
                                    <li>ASCORBIC ACID 50/60/70/75/85/90/95% <div><a href="#" class="removebtn">Remove <svg
                                                    width="17" height="16" viewBox="0 0 17 16"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.7041 4L12.7041 12" stroke="#079620"
                                                        stroke-linecap="round" />
                                                    <path d="M13 4L5 12" stroke="#079620" stroke-linecap="round" />
                                                </svg> </a></div>
                                    </li>
                                    <li>ASCORBIC ACID 50/60/70/75/85/90/95% <div><a href="#" class="removebtn">Remove <svg
                                                    width="17" height="16" viewBox="0 0 17 16"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.7041 4L12.7041 12" stroke="#079620"
                                                        stroke-linecap="round" />
                                                    <path d="M13 4L5 12" stroke="#079620" stroke-linecap="round" />
                                                </svg> </a></div>
                                    </li>
                                    <li>ASCORBIC ACID 50/60/70/75/85/90/95% <div><a href="#" class="removebtn">Remove <svg
                                                    width="17" height="16" viewBox="0 0 17 16"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.7041 4L12.7041 12" stroke="#079620"
                                                        stroke-linecap="round" />
                                                    <path d="M13 4L5 12" stroke="#079620" stroke-linecap="round" />
                                                </svg> </a></div>
                                    </li>
                                    <li>ASCORBIC ACID 50/60/70/75/85/90/95% <div><a href="#" class="removebtn">Remove <svg
                                                    width="17" height="16" viewBox="0 0 17 16"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.7041 4L12.7041 12" stroke="#079620"
                                                        stroke-linecap="round" />
                                                    <path d="M13 4L5 12" stroke="#079620" stroke-linecap="round" />
                                                </svg> </a></div>
                                    </li>
                                    <li>ASCORBIC ACID 50/60/70/75/85/90/95% <div><a href="#" class="removebtn">Remove <svg
                                                    width="17" height="16" viewBox="0 0 17 16"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.7041 4L12.7041 12" stroke="#079620"
                                                        stroke-linecap="round" />
                                                    <path d="M13 4L5 12" stroke="#079620" stroke-linecap="round" />
                                                </svg> </a></div>
                                    </li>
                                    <li>ASCORBIC ACID 50/60/70/75/85/90/95% <div><a href="#" class="removebtn">Remove <svg
                                                    width="17" height="16" viewBox="0 0 17 16"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.7041 4L12.7041 12" stroke="#079620"
                                                        stroke-linecap="round" />
                                                    <path d="M13 4L5 12" stroke="#079620" stroke-linecap="round" />
                                                </svg> </a></div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="pronamelist">
                            <div class="pro_breadcrumb">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <ol>
                                            <li>VERTICALS</li>
                                            <li>Pharma</li>
                                            <li>PELLETS</li>
                                            <li>NUTRACEUTICALS</li>
                                        </ol>
                                    </div>
                                    <div>
                                        <span class="totalprocount">9</span>
                                    </div>
                                </div>
                            </div>
                            <div class="allpronamelist">
                                <ul>
                                    <li>ASCORBIC ACID (VITAMIN C) 60/90% <div><a href="#" class="removebtn">Remove <svg
                                                    width="17" height="16" viewBox="0 0 17 16"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.7041 4L12.7041 12" stroke="#079620"
                                                        stroke-linecap="round" />
                                                    <path d="M13 4L5 12" stroke="#079620" stroke-linecap="round" />
                                                </svg> </a></div>
                                    </li>
                                    <li>FERROUS FUMARATE 60% <div><a href="#" class="removebtn">Remove <svg width="17"
                                                    height="16" viewBox="0 0 17 16" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.7041 4L12.7041 12" stroke="#079620"
                                                        stroke-linecap="round" />
                                                    <path d="M13 4L5 12" stroke="#079620" stroke-linecap="round" />
                                                </svg> </a></div>
                                    </li>
                                    <li>FERROUS SULPHATE 60% <div><a href="#" class="removebtn">Remove <svg width="17"
                                                    height="16" viewBox="0 0 17 16" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.7041 4L12.7041 12" stroke="#079620"
                                                        stroke-linecap="round" />
                                                    <path d="M13 4L5 12" stroke="#079620" stroke-linecap="round" />
                                                </svg> </a></div>
                                    </li>
                                    <li>ASCORBIC ACID (VITAMIN C) 60/90% <div><a href="#" class="removebtn">Remove <svg
                                                    width="17" height="16" viewBox="0 0 17 16"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.7041 4L12.7041 12" stroke="#079620"
                                                        stroke-linecap="round" />
                                                    <path d="M13 4L5 12" stroke="#079620" stroke-linecap="round" />
                                                </svg> </a></div>
                                    </li>
                                    <li>FERROUS FUMARATE 60% <div><a href="#" class="removebtn">Remove <svg width="17"
                                                    height="16" viewBox="0 0 17 16" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.7041 4L12.7041 12" stroke="#079620"
                                                        stroke-linecap="round" />
                                                    <path d="M13 4L5 12" stroke="#079620" stroke-linecap="round" />
                                                </svg> </a></div>
                                    </li>
                                    <li>FERROUS SULPHATE 60% <div><a href="#" class="removebtn">Remove <svg width="17"
                                                    height="16" viewBox="0 0 17 16" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.7041 4L12.7041 12" stroke="#079620"
                                                        stroke-linecap="round" />
                                                    <path d="M13 4L5 12" stroke="#079620" stroke-linecap="round" />
                                                </svg> </a></div>
                                    </li>
                                    <li>ASCORBIC ACID (VITAMIN C) 60/90% <div><a href="#" class="removebtn">Remove <svg
                                                    width="17" height="16" viewBox="0 0 17 16"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.7041 4L12.7041 12" stroke="#079620"
                                                        stroke-linecap="round" />
                                                    <path d="M13 4L5 12" stroke="#079620" stroke-linecap="round" />
                                                </svg> </a></div>
                                    </li>
                                    <li>FERROUS FUMARATE 60% <div><a href="#" class="removebtn">Remove <svg width="17"
                                                    height="16" viewBox="0 0 17 16" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.7041 4L12.7041 12" stroke="#079620"
                                                        stroke-linecap="round" />
                                                    <path d="M13 4L5 12" stroke="#079620" stroke-linecap="round" />
                                                </svg> </a></div>
                                    </li>
                                    <li>FERROUS SULPHATE 60% <div><a href="#" class="removebtn">Remove <svg width="17"
                                                    height="16" viewBox="0 0 17 16" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.7041 4L12.7041 12" stroke="#079620"
                                                        stroke-linecap="round" />
                                                    <path d="M13 4L5 12" stroke="#079620" stroke-linecap="round" />
                                                </svg> </a></div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="pronamelist">
                            <div class="pro_breadcrumb">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <ol>
                                            <li>VERTICALS</li>
                                            <li>Pharma</li>
                                            <li>PELLETS</li>
                                            <li>NUTRACEUTICALS</li>
                                        </ol>
                                    </div>
                                    <div>
                                        <span class="totalprocount">9</span>
                                    </div>
                                </div>
                            </div>
                            <div class="allpronamelist">
                                <ul>
                                    <li>ASCORBIC ACID (VITAMIN C) 60/90% <div><a href="#" class="removebtn">Remove <svg
                                                    width="17" height="16" viewBox="0 0 17 16"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.7041 4L12.7041 12" stroke="#079620"
                                                        stroke-linecap="round" />
                                                    <path d="M13 4L5 12" stroke="#079620" stroke-linecap="round" />
                                                </svg> </a></div>
                                    </li>
                                    <li>FERROUS FUMARATE 60% <div><a href="#" class="removebtn">Remove <svg width="17"
                                                    height="16" viewBox="0 0 17 16" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.7041 4L12.7041 12" stroke="#079620"
                                                        stroke-linecap="round" />
                                                    <path d="M13 4L5 12" stroke="#079620" stroke-linecap="round" />
                                                </svg> </a></div>
                                    </li>
                                    <li>FERROUS SULPHATE 60% <div><a href="#" class="removebtn">Remove <svg width="17"
                                                    height="16" viewBox="0 0 17 16" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.7041 4L12.7041 12" stroke="#079620"
                                                        stroke-linecap="round" />
                                                    <path d="M13 4L5 12" stroke="#079620" stroke-linecap="round" />
                                                </svg> </a></div>
                                    </li>
                                    <li>ASCORBIC ACID (VITAMIN C) 60/90% <div><a href="#" class="removebtn">Remove <svg
                                                    width="17" height="16" viewBox="0 0 17 16"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.7041 4L12.7041 12" stroke="#079620"
                                                        stroke-linecap="round" />
                                                    <path d="M13 4L5 12" stroke="#079620" stroke-linecap="round" />
                                                </svg> </a></div>
                                    </li>
                                    <li>FERROUS FUMARATE 60% <div><a href="#" class="removebtn">Remove <svg width="17"
                                                    height="16" viewBox="0 0 17 16" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.7041 4L12.7041 12" stroke="#079620"
                                                        stroke-linecap="round" />
                                                    <path d="M13 4L5 12" stroke="#079620" stroke-linecap="round" />
                                                </svg> </a></div>
                                    </li>
                                    <li>FERROUS SULPHATE 60% <div><a href="#" class="removebtn">Remove <svg width="17"
                                                    height="16" viewBox="0 0 17 16" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.7041 4L12.7041 12" stroke="#079620"
                                                        stroke-linecap="round" />
                                                    <path d="M13 4L5 12" stroke="#079620" stroke-linecap="round" />
                                                </svg> </a></div>
                                    </li>
                                    <li>ASCORBIC ACID (VITAMIN C) 60/90% <div><a href="#" class="removebtn">Remove <svg
                                                    width="17" height="16" viewBox="0 0 17 16"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.7041 4L12.7041 12" stroke="#079620"
                                                        stroke-linecap="round" />
                                                    <path d="M13 4L5 12" stroke="#079620" stroke-linecap="round" />
                                                </svg> </a></div>
                                    </li>
                                    <li>FERROUS FUMARATE 60% <div><a href="#" class="removebtn">Remove <svg width="17"
                                                    height="16" viewBox="0 0 17 16" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.7041 4L12.7041 12" stroke="#079620"
                                                        stroke-linecap="round" />
                                                    <path d="M13 4L5 12" stroke="#079620" stroke-linecap="round" />
                                                </svg> </a></div>
                                    </li>
                                    <li>FERROUS SULPHATE 60% <div><a href="#" class="removebtn">Remove <svg width="17"
                                                    height="16" viewBox="0 0 17 16" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.7041 4L12.7041 12" stroke="#079620"
                                                        stroke-linecap="round" />
                                                    <path d="M13 4L5 12" stroke="#079620" stroke-linecap="round" />
                                                </svg> </a></div>
                                    </li>
                                </ul>
                            </div>
                        </div>--}}
                    </div>


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

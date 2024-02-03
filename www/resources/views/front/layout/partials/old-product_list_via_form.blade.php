@if (!empty($newArrayOfProduct))
    @foreach ($newArrayOfProduct as $product)
        @php dd($product) @endphp
        <h1>{{ $product['catArray']['0'] . ' > ' . $product['catArray']['1'] }}</h1>
        <div class="col-lg-4 ">
            @foreach ($product['products'] as $item)
                <div class="product-box product_background " id="product-box-{{ $item->id }}">
                    <div class="category-font">

                        <div class="cat_title">
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#id{{ $item->id }}" aria-expanded="true"
                                            aria-controls="panelsStayOpen-collapseOne">
                                            {{ implode(' > ', array_slice($product['catArray'], 2)) }}
                                        </button>
                                    </h2>
                                    <div id="id{{ $item->id }}" class="accordion-collapse collapse show"
                                        aria-labelledby="panelsStayOpen-headingOne">
                                        <div class="accordion-body">
                                            <strong>{{ $item->title }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="checkbox" id="{{ $item->id }}" data-checkbox-id="{{ $item->id }}"
                            name="product" value="" class="product-check" onclick="getValue(event)"
                            data-product-id="{{ $item->id }}">
                    </div>
                    {{-- <div class="product-font">{{ $product->title }}</div> --}}
                </div>
            @endforeach
        </div>
    @endforeach
@endif



{{-- <ul> --}}
{{--    @if (!empty($products)) --}}
{{--        @foreach ($products as $row) --}}
{{--            <li> --}}
{{--                <div class="dropdown"> --}}
{{--                    <button class="dropbtn" id="product{{$row->id}}" data-product-id="{{$row->id}}" onclick="{{$row->attribute_product_links->count() == "products" ?'selectProduct(event)':''}}">{{$row->title}}</button> --}}
{{--                    @if ($row->attribute_product_links->count() != 'products') --}}
{{--                        <div class="dropdown-content"> --}}
{{--                            @foreach ($row->attribute_product_links as $attribute) --}}
{{--                                <div class="form-group"> --}}
{{--                                    <input type="checkbox" id="{{$attribute->id}}" --}}
{{--                                           data-url="{{route('front.product.category')}}" --}}
{{--                                           name="{{$attribute->attributes->attribute_name}}" --}}
{{--                                           value="{{$attribute->attributes->attribute_name}}" data-checkbox-id="{{$attribute->id}}" data-attribute-id="{{$attribute->attribute_id}}" data-product-id="{{$row->id}}" onclick="getValue(event)"> --}}
{{--                                    <label --}}
{{--                                        for="{{$attribute->id}}">{{$attribute->attributes->attribute_name}}</label> --}}
{{--                                </div> --}}
{{--                            @endforeach --}}
{{--                        </div> --}}
{{--                    @endif --}}
{{--                </div> --}}
{{--            </li> --}}
{{--        @endforeach --}}
{{--    @endif --}}
{{-- </ul> --}}

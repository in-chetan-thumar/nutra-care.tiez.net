<ul>
    @if(!empty($products))
        @foreach($products as $row)
            <li>
                <div class="dropdown">
                    <button class="dropbtn" id="product{{$row->id}}" data-product-id="{{$row->id}}" onclick="{{$row->attribute_product_links->count() == 0 ?'selectProduct(event)':''}}">{{$row->title}}</button>
                    @if($row->attribute_product_links->count() != 0)
                        <div class="dropdown-content">
                            @foreach($row->attribute_product_links as $attribute)
                                <div class="form-group">
                                    <input type="checkbox" id="{{$attribute->id}}"
                                           data-url="{{route('front.product.category')}}"
                                           name="{{$attribute->attributes->attribute_name}}"
                                           value="{{$attribute->attributes->attribute_name}}" data-checkbox-id="{{$attribute->id}}" data-attribute-id="{{$attribute->attribute_id}}" data-product-id="{{$row->id}}" onclick="getValue(event)">
                                    <label
                                        for="{{$attribute->id}}">{{$attribute->attributes->attribute_name}}</label>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </li>
        @endforeach
    @endif
</ul>

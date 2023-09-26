@if(!empty($products))
    @foreach($products as $product)

        <div class="col-lg-4 ">
            <div class="product-box product_background active" id="product-box-{{$product->id}}">
                <div class="category-font">
                    {{app('common')->getCategoryProduct($product->id)}}
                    <input type="checkbox"  id="{{$product->id}}" data-checkbox-id="{{$product->id}}" name="product" value="" class="product-check" onclick="getValue(event)" data-product-id="{{$product->id}}" checked>
                </div>
                <div class="product-font" >{{$product->title}}</div>
            </div>
        </div>
    @endforeach
@endif



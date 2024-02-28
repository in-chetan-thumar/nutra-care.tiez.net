<div class="accordion_main">
    <div class="accordion" id="categoryExample">
        @if (count($newArrayOfProduct) > 0)
            @foreach ($newArrayOfProduct as $mainCat)
                @if ($mainCat->subSubCategory->count() > 0)
                    @foreach ($mainCat->subSubCategory as $subCat)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="category{{ $subCat->id }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#catcollapse{{ $subCat->id }}" aria-expanded="false"
                                    aria-controls="catcollapse{{ $subCat->id }}">
                                    <h2>{{ $mainCat->title }} > {{ $subCat->title }}</h2>
                                </button>
                            </h2>
                            @php
                                $catWithProds = [];
                                $is_direct_product = false;
                                if ($subCat->subSubCategory->count() > 0) {
                                    $catWithProds = app('common')->getTitleForAccordion($subCat->subSubCategory, $subCat->id);
                                    // dump($catWithProds);
                                } else {
                                    $catWithProds = app('common')->getDirectProducts($subCat);
                                    $is_direct_product = true;
                                }

                            @endphp
                            @if (!$is_direct_product)
                                @foreach ($catWithProds as $catWithProd)
                                    <?php //dd($catWithProd['id'],$subCat->id);
                                    ?>
                                    <div id="catcollapse{{ $subCat->id }}"
                                        class="accordion-collapse collapse catcollapse{{ $subCat->id }}"
                                        aria-labelledby="category{{ $subCat->id }}"
                                        data-bs-parent="#category{{ $subCat->id }}">
                                        <div class="accordion-body">
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#subSubCat{{ $catWithProd['id'] }}"
                                                            aria-expanded="true"
                                                            aria-controls="subSubCat{{ $catWithProd['id'] }}">
                                                            {{ $catWithProd['parentTreeTitle'] }}
                                                            ({{ count($catWithProd['products']) }}
                                                            Products)
                                                        </button>
                                                    </h2>
                                                    <div id="subSubCat{{ $catWithProd['id'] }}"
                                                        class="accordion-collapse collapse" aria-labelledby="headingOne"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row product-data" id="productDisplayBox">
                                                                <?php //dd($catWithProd['id'],$subCat->id);
                                                                ?>
                                                                @foreach ($catWithProd['products'] as $prod)
                                                                    <div class="col-lg-4 ">
                                                                        <div class="product-box product_background"
                                                                            id="product-box-{{ $prod['id'] }}">
                                                                            <div class="category-font">
                                                                                <div class="cat_title">
                                                                                    {{ $prod['title'] }}
                                                                                </div>
                                                                                <input type="checkbox"
                                                                                    id="{{ $prod['id'] }}"
                                                                                    data-checkbox-id="{{ $prod['id'] }}"
                                                                                    name="product" value=""
                                                                                    class="product-check"
                                                                                    onclick="getValue(event)"
                                                                                    data-product-id="{{ $prod['id'] }}"
                                                                                    data-product-title="{{ $prod['title'] }}"
                                                                                    data-cat-title="{{ $mainCat->title . ' > ' . $subCat->title . ' > ' . $catWithProd['parentTreeTitle'] }}">
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
                                <div id="catcollapse{{ $subCat->id }}"
                                    class="accordion-collapse collapse catcollapse{{ $subCat->id }}"
                                    aria-labelledby="category{{ $subCat->id }}"
                                    data-bs-parent="#category{{ $subCat->id }}">
                                    <div class="row product-data" id="productDisplayBox">
                                        <?php //dd($catWithProd['id'],$subCat->id);
                                        ?>
                                        @foreach ($catWithProds['products'] as $prod)
                                            <div class="col-lg-4 ">
                                                <div class="product-box product_background"
                                                    id="product-box-{{ $prod['id'] }}">
                                                    <div class="category-font">
                                                        <div class="cat_title">
                                                            {{ $prod['title'] }}
                                                        </div>
                                                        <input type="checkbox" id="{{ $prod['id'] }}"
                                                            data-checkbox-id="{{ $prod['id'] }}" name="product"
                                                            value="" class="product-check"
                                                            onclick="getValue(event)"
                                                            data-product-id="{{ $prod['id'] }}"
                                                            data-product-title="{{ $prod['title'] }}"
                                                            data-cat-title="{{ $mainCat->title . ' > ' . $subCat->title }}">
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
        @else
            <div class="card ">
                <div class="card-body ">
                    <div class="row ">
                        <div class="col-lg-12">
                            <h1><b>No application/vertical selected.</b></h1>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

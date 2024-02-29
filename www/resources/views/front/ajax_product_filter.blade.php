<div class="accordion_main">
    <div class="accordion mainAcc" id="categoryExample">
        @if (count($newArrayOfProduct) > 0)
            @foreach ($newArrayOfProduct as $mainCat)
                @if ($mainCat->subSubCategory->count() > 0)
                @foreach ($mainCat->subSubCategory as $subCat)
                        <div class="accordion-item mt-3">
                            <h2 class="accordion-header" id="category{{ $subCat->id }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#catcollapse{{ $subCat->id }}" aria-expanded="false"
                                    aria-controls="catcollapse{{ $subCat->id }}">
                                    <h2>{{ $mainCat->title }} > {{ $subCat->title }}</h2>
                                </button>
                            </h2>
                            @php
                                        $catWithProds = [];
                                        if ($subCat->subSubCategory->count() > 0) {
                                            @endphp
                                            <div id="catcollapse{{ $subCat->id }}"
                                                class="accordion-collapse collapse catcollapse{{ $subCat->id }}"
                                                aria-labelledby="category{{ $subCat->id }}"
                                                data-bs-parent="#category{{ $subCat->id }}">
                                                <div class="accordion-body">
                                                    @php
                                            foreach ($subCat->subSubCategory as $value) {
                                                $catWithProds = app('common')->getTitleForAccordion($value, $subCat->id);
                                    @endphp
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="category{{ $value->id }}">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#catcollapse{{ $value->id }}" aria-expanded="false"
                                                aria-controls="catcollapse{{ $value->id }}">
                                                <h2> {{ $value->title }}</h2>
                                            </button>
                                        </h2>
                                        @foreach ($catWithProds as $catWithProd)
                                            <div id="catcollapse{{ $value->id }}"
                                                class="accordion-collapse collapse catcollapse{{ $value->id }}"
                                                aria-labelledby="category{{ $value->id }}"
                                                data-bs-parent="#category{{ $value->id }}">
                                                <div class="accordion-body">
                                                    <div class="accordion" id="accordionExample">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="headingOne">
                                                                <button class="accordion-button collapsed" type="button"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#subSubCat{{ $catWithProd['id'] }}"
                                                                    aria-expanded="true"
                                                                    aria-controls="subSubCat{{ $catWithProd['id'] }}">
                                                                    {{ $catWithProd['title'] }}
                                                                    ({{ count($catWithProd['products']) }} Products)
                                                                </button>
                                                            </h2>
                                                            <div id="subSubCat{{ $catWithProd['id'] }}"
                                                                class="accordion-collapse collapse"
                                                                aria-labelledby="headingOne"
                                                                data-bs-parent="#accordionExample">
                                                                <div class="accordion-body">
                                                                    <div class="row product-data" id="productDisplayBox">
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
                                    </div>
                                    @php
                                            }
                                        } else {
                                            $catWithProd = app('common')->getDirectProducts($subCat);
                                            @endphp
                                             <div class="accordion-item">
                                                    <div id="catcollapse{{ $subCat->id }}" class="accordion-collapse collapse catcollapse{{ $subCat->id }}" aria-labelledby="category{{ $subCat->id }}" data-bs-parent="#category{{ $subCat->id }}">
                                                        <h2 class="accordion-header" id="heading{{ $subCat->id }}">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#subSubCat{{ $catWithProd['id'] }}" aria-expanded="true" aria-controls="subSubCat{{ $catWithProd['id'] }}">
                                                                {{ $catWithProd['title'] }} ({{ count($catWithProd['products']) }} Products)
                                                            </button>
                                                        </h2>
                                                        <div id="subSubCat{{ $catWithProd['id'] }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $subCat->id }}" data-bs-parent="#catcollapse{{ $subCat->id }}">
                                                            <div class="accordion-body">
                                                                <div class="row product-data" id="productDisplayBox">
                                                                    @foreach ($catWithProd['products'] as $prod)
                                                                        <div class="col-lg-4">
                                                                            <div class="product-box product_background" id="product-box-{{ $prod['id'] }}">
                                                                                <div class="category-font">
                                                                                    <div class="cat_title">
                                                                                        {{ $prod['title'] }}
                                                                                    </div>
                                                                                    <input type="checkbox"
                                                                                        id="{{ $prod['id'] }}"
                                                                                        data-checkbox-id="{{ $prod['id'] }}"
                                                                                        name="product"
                                                                                        value=""
                                                                                        class="product-check"
                                                                                        onclick="getValue(event)"
                                                                                        data-product-id="{{ $prod['id'] }}"
                                                                                        data-product-title="{{ $prod['title'] }}"
                                                                                        data-cat-title="{{ $mainCat->title . ' > ' . $subCat->title . ' > ' . $catWithProd['title'] }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @php
                                        }
                                    @endphp
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endforeach
        @else
            <div class="card ">
                <div class="card-body ">
                    <div class="row ">
                        <div class="col-lg-12">
                            <center>No application/vertical selected.</center>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="dashbordreoirt">
                    <p><i class="m-menu__link-icon fas fa-list"></i>Product</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <form class="form-group row filters">
                <div class="col-md-12 col-lg-12">
                    <div class="search_button d-flex">
                        <div class="search_button d-flex">
                            <div class="search_label">
{{--                                {{Form::select('filters[category]', $categories,null,['class'=>'form-control category','id'=>'filter_category'] )}}--}}
                                <select class="form-control" name="filters[category]" id="filter_category">
                                    <option value="" selected>All</option>
                                    @foreach($categories as $key => $category)
                                        <option value="{{$key}}">{{$category}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="search_label ml-3">
                            <input type="text" name="filters[search]" class="form-control"
                                   placeholder="Search By Name" id="search"
                                   value="{{request('filters.search')}}">
                        </div>
                        <div class="search_iconbtn d-flex">
                            <button type="button" class="btn search-btn ml-3" id="search-btn">
                                <i class="flaticon-search-1"></i>
                            </button>
                        </div>

                        <div class="search_iconbtn d-flex" data-toggle="m-tooltip" data-placement="top"
                             title="Reset Search">
                            <button type="button" class="btn search-btn ml-3" onclick="reset_search();">
                                <i class="flaticon-refresh"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="text-right">
            <a href="javascript:;" class="theme-btn mb-3 add_record"><i class="fas fa-plus mr-2"></i>Add
                Product</a>
        </div>

        <div id="data-list-page">

        </div>
    </div>

    <!--Create Page Model-->
    <div class="modal fade" id="add-product-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ADD PRODUCT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="editModalContent">
                    {{ Form::open(array('url' =>route('products.store'),'name' => 'form-product', 'id'=>'form-product','enctype'=>'multipart/form-data')) }}
                    @csrf
                    <div class="modal-body row">
                        <div class="form-group col-md-12">
                            {{ Form::label('title', 'Title', array('class'=>'form-control-label')) }}
                            {{ Form::text('title','', array('class' => 'form-control', 'id' => 'title')) }}
                        </div>
                        <!--div class="form-group col-md-12">
                            {{ Form::label('description', 'Description', array('class'=>'form-control-label')) }}
                            {{ Form::textarea('description','', array('class' => 'form-control', 'id' => 'description')) }}
                        </div-->
                        <div class="form-group col-md-12">
                            {{ Form::label('photo', 'Photo', array('class'=>'form-control-label')) }}
                            {{ Form::file('photo', array('class' => 'form-control', 'id' => 'photo')) }}
                        </div>
                        <!--div class="form-group col-md-12">
                            {{ Form::label('slug', 'Slug', array('class'=>'form-control-label')) }}
                            {{ Form::text('slug','', array('class' => 'form-control', 'id' => 'slug')) }}
                        </div-->

                        <div class="form-group col-md-12">
                            {{ Form::label('category', 'Category', array('class'=>'form-control-label')) }}
                            {{Form::select('categories[]', $categories,null,['class'=>'form-control category','multiple'=>'multiple'] )}}
                        </div>

{{--                        <div class="form-group col-md-12">--}}
{{--                            {{ Form::label('Attribute', 'Attribute', array('class'=>'form-control-label')) }}--}}
{{--                            {{Form::select('attributes[]', $attributes,null,['class'=>'form-control attribute','multiple'=>'multiple'] )}}--}}
{{--                        </div>--}}
                    </div>
                    <div class="modal-footer">
                        <button class="btn theme-btn">Submit</button>
                        <button type="button" class="btn theme-btn-white" data-dismiss="modal">Close</button>
                    </div>
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
    <!-- Edit user mddal -->
    <div class="modal fade" id="editProductModal"  role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="editProductModalContent">

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
            {!! $validator !!}
            <script>
                var index_url = "{{route('product.index')}}";
            </script>

            <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
            <script src="{{ URL::asset('js/admin/product.js') }}" type="text/javascript"></script>
@endsection

@extends('admin.layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="dashbordreoirt">
                    <p><i class="m-menu__link-icon fas fa-list"></i>Category</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <form class="form-group row" id="filters">
                <div class="col-md-12 col-lg-12">
                    <div class="search_button d-flex">
                        <div class="search_label">
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
                Category</a>
        </div>

        <div id="data-list-page">

        </div>
    </div>

    <!--Create Page Model-->
    <div class="modal fade" id="add-category-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ADD CATEGORY</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="editModalContent">
                    {{ Form::open(array('url' =>route('categories.store'),'name' => 'form-category', 'id'=>'form-category','enctype'=>'multipart/form-data')) }}
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
                            {{ Form::label('parent_category', 'Main Category', array('class'=>'form-control-label')) }}
{{--                            {{Form::select('parent_category', $categories,null,['class'=>'form-control category category-search-select2','placeholder'=>'Select parent category'] )}}--}}
                            <select name="category" class="selectpicker form-control " data-live-search="true" title="Choose one of the following...">
                                @foreach ($categories as $category)
                                    @if($category->parent_category_id == 0)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endif
                                    @if ($category->parent_category_id == 0)
                                        @include('admin.category.sub_category', ['subcategories' => $category->childs, 'parent' => $category->title , 'prefix' => ' - '])
                                    @endif
                                @endforeach

                            </select>



                            {{--                                <select name="parent_category" id="" class="form-control category category-search-select2" >--}}
{{--                                    @foreach ($categories as $category)--}}
{{--                                        @if($category->parent_category_id == 0)--}}
{{--                                        <option value="{{ $category->id }}">{{ $category->title }}</option>--}}
{{--                                        @endif--}}
{{--                                        @if ($category->parent_category_id == 0)--}}
{{--                                            @include('admin.category.sub_category', ['subcategories' => $category->childs, 'parent' => $category->title , 'prefix' => '-'])--}}
{{--                                        @endif--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}


                        </div>

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
    <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="editCategoryModalContent">

                </div>
            </div>
        </div>
    </div>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
@endsection
@section('scripts')
    <script src="{{ URL::asset('/assets/js/select2/select2.min.js') }}"></script>

    {!! $validator !!}
    <script>
        var index_url = "{{route('category.index')}}";
    </script>
    <script>
        $('.selectpicker').selectpicker();

    </script>

    <script src="{{ URL::asset('js/admin/category.js') }}" type="text/javascript"></script>
@endsection

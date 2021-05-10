@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="dashbordreoirt">
                <p><i class="m-menu__link-icon fas fa-newspaper"></i>News Category</p>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">

        <div class="col-md-12">
            <div class="userlist">
                <div class="text-right">
                    <a href="javascript:;" class="theme-btn mb-3 add_record"><i class="fas fa-plus mr-2"></i>Add News Category</a>
                </div>

                <div id="data-list">

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add News Category mddal -->
<div class="modal fade" id="addNewsCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add News Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div>
                {{ Form::open(array('route' => 'newscategory.store', 'id'=>'add-news-category-form')) }}
                <div class="modal-body row">
                    <div class="form-group col-md-12">
                        {{ Form::label('category', 'Enter a news category name', array('class'=>'form-control-label')) }}
                        {{ Form::text('category', '', array('class' => 'form-control', 'id' => 'category')) }}
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

<!-- Edit News Category mddal -->
<div class="modal fade" id="editNewsCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit News Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="editModalContent">

            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
    var index_url = "{{route('newscategory.index')}}";
</script>
<script src="{{ URL::asset('js/admin/news_category.js') }}" type="text/javascript"></script>
{!! JsValidator::formRequest('App\Http\Requests\NewsCategoryRequest','#add-news-category-form') !!}
@endsection

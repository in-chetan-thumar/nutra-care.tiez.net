@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="dashbordreoirt">
                <p><i class="m-menu__link-icon fas fa-newspaper"></i>News</p>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6">
            <form class="form-group row">
                <div class="col-md-12 col-lg-12">
                    <div class="search_button d-flex">
                        <div class="search_button d-flex">
                            <div class="search_label">
                                {{ Form::select('filters[category]', $news_category->prepend('All', ''), request('filters.category') ?? '', array('class' => 'form-control', 'id' => 'filter_category')) }}
                            </div>
                        </div>
                        <div class="search_label ml-2">
                            <input type="text" name="filters[search]" class="form-control"
                                placeholder="Search By news title" id="search"
                                value="{{request('filters.search')}}">
                        </div>
                        <div class="search_iconbtn d-flex">
                            <button type="button" class="btn search-btn ml-3" id="search-btn">
                                <i class="flaticon-search-1"></i>
                            </button>
                        </div>
                        <div class="search_iconbtn d-flex" data-toggle="m-tooltip" data-placement="top" title="Reset Search">
                            <button type="button" class="btn search-btn ml-3" onclick="reset_search();">
                                <i class="flaticon-refresh"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <div class="userlist">
                <div class="text-right">
                    <a href="javascript:;" class="theme-btn mb-3 add_record"><i class="fas fa-plus mr-2"></i>Add News</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Filter form -->
    {{ Form::open(array('route' => 'news.index', 'id'=>'filter-form')) }}
    {{Form::hidden('filters[search]', request('filters.search'))}}
    {{Form::hidden('filters[category]', request('filters.category') ?? '')}}
    {{ Form::close() }}

    <div id="data-list">

    </div>
</div>

<!-- Add user mddal -->
<div class="modal fade" id="addNewsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add News</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div>
                {{ Form::open(array('route' => 'news.store', 'id'=>'add-news-form')) }}
                <div class="modal-body row">
                    <div class="form-group col-md-12">
                        {{ Form::label('category', 'News Category', array('class'=>'form-control-label')) }}
                        {{ Form::select('category', $news_category->prepend('Select Category', ''), null, array('class' => 'form-control', 'id' => 'category')) }}
                    </div>
                    <div class="form-group col-md-12">
                        {{ Form::label('title', 'Title', array('class'=>'form-control-label')) }}
                        {{ Form::text('title', '', array('class' => 'form-control', 'id' => 'title')) }}
                    </div>
                    <div class="form-group col-md-12">
                        {{ Form::label('description', 'Description', array('class'=>'form-control-label')) }}
                        {{ Form::textarea('description', '', array('class' => 'form-control', 'id' => 'description')) }}
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('cover_type', 'Cover Type', array('class'=>'form-control-label')) }}
                        {{ Form::select('cover_type', ['IMAGE' => 'Image', 'YOUTUBE' => 'Youtube Link', 'VIMEO' => 'Vimeo Link'], null, array('class' => 'form-control cover_type', 'id' => 'cover_type')) }}
                    </div>
                    <div class="form-group col-md-6 news_doc_div">
                        {{ Form::label('news_doc', 'Cover Image', array('class'=>'form-control-label')) }}
                        {{ Form::file('news_doc', array('class' => 'form-control', 'id' => 'news_doc')) }}
                    </div>
                    <div class="form-group col-md-6 cover_video_url_div" style="display:none">
                        {{ Form::label('cover_video_url', 'Cover video URL', array('class'=>'form-control-label')) }}
                        {{ Form::text('cover_video_url', null, array('class' => 'form-control', 'id' => 'cover_video_url')) }}
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
<div class="modal fade" id="editNewsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit News</h5>
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
<script src="{{ URL::asset('js/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
<script>
      // Replace the <textarea id="editor1"> with a CKEditor
   // instance, using default configuration.
   CKEDITOR.editorConfig = function (config) {
      config.language = 'es';
      config.uiColor = '#F7B42C';
      config.height = 300;
      config.toolbarCanCollapse = true;
      config.removePlugins = 'toolbar';

   };
   CKEDITOR.replace('description');
</script>
<script>
    var index_url = "{{route('news.index')}}";
</script>
<script src="{{ URL::asset('js/admin/news.js') }}" type="text/javascript"></script>
{!! JsValidator::formRequest('App\Http\Requests\NewsRequest','#add-news-form') !!}
@endsection

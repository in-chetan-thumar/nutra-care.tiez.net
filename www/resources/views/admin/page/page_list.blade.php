@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="dashbordreoirt">
                    <p><i class="m-menu__link-icon fas fa-book"></i>Page</p>
                </div>
            </div>
        </div>
        <div class="text-right">
            <a href="javascript:;" class="theme-btn mb-3 add_record"><i class="fas fa-plus mr-2"></i>Add
                Page</a>
        </div>

        <div id="data-list-page">

        </div>
    </div>

    <!--Create Page Model-->
    <div class="modal fade" id="add-page-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ADD PAGE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="editModalContent">
                    {{ Form::open(array('url' =>route('pages.store'),'name' => 'form-page', 'id'=>'form-page')) }}
                    @csrf
                    <div class="modal-body row">
                        <div class="form-group col-md-12">
                            {{ Form::label('page_title', 'Page Title', array('class'=>'form-control-label')) }}
                            {{ Form::text('page_title','', array('class' => 'form-control', 'id' => 'page_title')) }}
                        </div>
                        <div class="form-group col-md-12">
                            {{ Form::label('page_slug', 'Page Slug', array('class'=>'form-control-label')) }}
                            {{ Form::text('page_slug','', array('class' => 'form-control', 'id' => 'page_slug')) }}
                        </div>
                        <div class="form-group col-md-12">
                            {{ Form::label('meta_tag', 'Meta Tag', array('class'=>'form-control-label')) }}
                            {{ Form::textarea('meta_tag','', array('class' => 'form-control', 'id' => 'meta_tag')) }}
                        </div>
                        <div class="form-group col-md-12">
                            {{ Form::label('meta_description', 'Meta Description', array('class'=>'form-control-label')) }}
                            {{ Form::textarea('meta_description','', array('class' => 'form-control', 'id' => 'meta_description')) }}
                        </div>
                        <div class="form-group col-md-12">
                            {{ Form::label('page_text', 'Page Text', array('class'=>'form-control-label')) }}
                            {{ Form::textarea('page_text','', array('class' => 'form-control', 'id' => 'page_text')) }}
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
    <div class="modal fade" id="editPageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Page</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="editPageModalContent">

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
            {!! $validator !!}
            <script>
                var index_url = "{{route('page.index')}}";
            </script>
            <script src="{{ URL::asset('js/admin/page.js') }}" type="text/javascript"></script>

            <script src='//cdn.gaic.com/cdn/ui-bootstrap/0.58.0/js/lib/ckeditor/ckeditor.js'></script>
            <script>

                // Replace the <textarea id='editor1'> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.editorConfig = function (config) {
                    config.language = 'es';
                    config.uiColor = '#F7B42C';
                    config.height = 300;
                    config.toolbarCanCollapse = true;
                    config.removePlugins = 'toolbar';
                };
                CKEDITOR.replace('page_text');


            </script>
@endsection

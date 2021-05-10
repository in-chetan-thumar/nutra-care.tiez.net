{{ Form::model($record, array('route' => ['pages.update', $record->id],'name' => 'edit-page-form', 'id'=>'edit-page-form')) }}
@method('PATCH')
<div class="modal-body row">
    <div class="modal-body row">
        <div class="form-group col-md-12">
            {{ Form::label('page_title', 'Page Title', array('class'=>'form-control-label')) }}
            {{ Form::text('page_title',$record->page_title, array('class' => 'form-control', 'id' => 'page_title')) }}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('page_slug', 'Page Slug', array('class'=>'form-control-label')) }}
            {{ Form::text('page_slug',$record->page_slug, array('class' => 'form-control', 'id' => 'page_slug')) }}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('meta_tag', 'Meta Tag', array('class'=>'form-control-label')) }}
            {{ Form::textarea('meta_tag',$record->meta_tag, array('class' => 'form-control', 'id' => 'meta_tag')) }}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('meta_description', 'Meta Description', array('class'=>'form-control-label')) }}
            {{ Form::textarea('meta_description',$record->meta_description, array('class' => 'form-control', 'id' => 'meta_description')) }}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('page_text', 'Page Text', array('class'=>'form-control-label')) }}
            {{ Form::textarea('page_text',$record->page_text, array('class' => 'form-control', 'id' => 'page_text_edit')) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn theme-btn">Submit</button>
    <button type="button" class="btn theme-btn-white" data-dismiss="modal">Close</button>
</div>
{{ Form::close() }}
{!! $validator !!}
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
    CKEDITOR.replace('page_text_edit');


</script>

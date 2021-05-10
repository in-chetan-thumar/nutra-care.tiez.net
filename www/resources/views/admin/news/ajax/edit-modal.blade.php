{{ Form::model($record, array('route' => ['news.update', $record->id],'name' => 'edit-news-form', 'id'=>'edit-news-form')) }}
<div class="modal-body row">
    <div class="form-group col-md-12">
        {{ Form::label('category', 'News Category', array('class'=>'form-control-label')) }}
        {{ Form::select('category', $news_category->prepend('Select Category', ''), null, array('class' => 'form-control', 'id' => 'category')) }}
    </div>
    <div class="form-group col-md-12">
        {{ Form::label('title', 'Title', array('class'=>'form-control-label')) }}
        {{ Form::text('title', null, array('class' => 'form-control', 'id' => 'name')) }}
    </div>
    <div class="form-group col-md-12">
        {{ Form::label('description', 'Description', array('class'=>'form-control-label')) }}
        {{ Form::textarea('description_edit', $record->description, array('class' => 'form-control', 'id' => 'description_edit')) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('cover_type', 'Cover Type', array('class'=>'form-control-label')) }}
        {{ Form::select('cover_type', ['IMAGE' => 'Image', 'YOUTUBE' => 'Youtube Link', 'VIMEO' => 'Vimeo Link'], $record->cover_type, array('class' => 'form-control cover_type', 'id' => 'cover_type')) }}
    </div>
    <div class="form-group col-md-6 news_doc_div" style={{ $record->cover_type != 'IMAGE' ? 'display:none' : '' }}>
        {{ Form::label('news_doc', 'Cover Image', array('class'=>'form-control-label')) }}
        {{ Form::file('news_doc', array('class' => 'form-control', 'id' => 'news_doc')) }}
    </div>
    <div class="form-group col-md-6 cover_video_url_div" style={{ $record->cover_type == 'IMAGE' ? 'display:none' : '' }}>
        {{ Form::label('cover_video_url', 'Cover video URL', array('class'=>'form-control-label')) }}
        {{ Form::text('cover_video_url', null, array('class' => 'form-control', 'id' => 'name')) }}
    </div>
</div>
<div class="modal-footer">
    <button class="btn theme-btn">Submit</button>
    <button type="button" class="btn theme-btn-white" data-dismiss="modal">Close</button>
</div>
{{ Form::close() }}
{!! $other_js_code !!}
{!! $validator !!}

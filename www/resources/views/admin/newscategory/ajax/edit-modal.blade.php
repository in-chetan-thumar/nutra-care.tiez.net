{{ Form::model($record, array('route' => ['newscategory.update', $record->id],'name' => 'edit-news-category-form', 'id'=>'edit-news-category-form')) }}
<div class="modal-body row"> 
    <div class="form-group col-md-6">
        {{ Form::label('category', 'Enter a news category name', array('class'=>'form-control-label')) }}
        {{ Form::text('category', null, array('class' => 'form-control', 'id' => 'category')) }}
    </div>
</div>
<div class="modal-footer">
    <button class="btn theme-btn">Submit</button>
    <button type="button" class="btn theme-btn-white" data-dismiss="modal">Close</button>
</div>
{{ Form::close() }}
{!! $validator !!}
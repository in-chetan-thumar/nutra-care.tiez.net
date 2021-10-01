{{ Form::open(array('route' => ['attributes.update', $record->id],'name' => 'edit-attribute-form', 'id'=>'edit-attribute-form')) }}
@method('PATCH')
<div class="modal-body row">
    <div class="modal-body row">
        <div class="form-group col-md-12">
            {{ Form::label('attribute', 'Attribute Name', array('class'=>'form-control-label')) }}
            {{ Form::text('attribute_name',$record->attribute_name, array('class' => 'form-control', 'id' => 'attribute_name')) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn theme-btn">Submit</button>
    <button type="button" class="btn theme-btn-white" data-dismiss="modal">Close</button>
</div>
{{ Form::close() }}
{!! $validator !!}

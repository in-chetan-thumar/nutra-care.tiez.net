{{ Form::open(array('route' => ['products.update', $record->id],'name' => 'edit-product-form', 'id'=>'edit-product-form')) }}
@method('PATCH')
<div class="modal-body row">
    <div class="modal-body row">
        <div class="form-group col-md-12">
            {{ Form::label('title', 'Title', array('class'=>'form-control-label')) }}
            {{ Form::text('title',$record->title, array('class' => 'form-control', 'id' => 'title')) }}
        </div>
        <!--div class="form-group col-md-12">
            {{ Form::label('description', 'Description', array('class'=>'form-control-label')) }}
            {{ Form::textarea('description',$record->description, array('class' => 'form-control', 'id' => 'description')) }}
        </div-->
        <div class="form-group col-md-12">
            {{ Form::label('photo', 'Photo', array('class'=>'form-control-label')) }}
            {{ Form::file('photo', array('class' => 'form-control', 'id' => 'photo')) }}
            {{ Form::hidden('photo_name',$record->photo) }}
        </div>
        <!--div class="form-group col-md-12">
            {{ Form::label('slug', 'Slug', array('class'=>'form-control-label')) }}
            {{ Form::text('slug',$record->slug, array('class' => 'form-control', 'id' => 'slug')) }}
        </div-->
        <div class="form-group col-md-12">
            {{ Form::label('category', 'Category', array('class'=>'form-control-label')) }}
            {{Form::select('categories[]', $categories,$record->category_ids,['class'=>'form-control editcategory','multiple'=>'multiple'] )}}
        </div>

        <div class="form-group col-md-12">
            {{ Form::label('Attribute', 'Attribute', array('class'=>'form-control-label')) }}
            {{Form::select('attributes[]', $attributes,$record->attribute_ids,['class'=>'form-control editattribute','multiple'=>'multiple'] )}}
        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn theme-btn">Submit</button>
    <button type="button" class="btn theme-btn-white" data-dismiss="modal">Close</button>
</div>
{{ Form::close() }}
{!! $validator !!}
<script>
    $('.editcategory').select2({
        width: "resolve",
        dropdownParent: $("#editProductModal .modal-content")
    });
    $('.editattribute').select2({
        width: "resolve",
        dropdownParent: $("#editProductModal .modal-content")
    });
</script>

{{ Form::open(array('route' => ['categories.update', $record->id],'name' => 'edit-category-form', 'id'=>'edit-category-form')) }}
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
            {{ Form::label('parent_category', 'Parent Category', array('class'=>'form-control-label')) }}
{{--            {{Form::select('parent_category', $categories,$record->parent_category_id,['class'=>'form-control category','placeholder'=>'Select parent category'] )}}--}}
            <select name="category" class="selectpicker  form-control  " data-live-search="true" title="Choose one of the following...">
                <option value="{{ $record->id }}" {{isset($record) && !empty($record->id) ? 'selected' : '' }}>{{  isset($record) && !empty($record->id) ? $record->title : $category->title }}</option>
                @foreach ($categories as $category)
                    @if($category->parent_category_id == 0)

                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endif
                    @if ($category->parent_category_id == 0)
                        @include('admin.category.sub_category', ['subcategories' => $category->childs, 'parent' => $category->title , 'prefix' => ' - '])
                    @endif
                @endforeach

            </select>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn theme-btn">Submit</button>
    <button type="button" class="btn theme-btn-white" data-dismiss="modal">Close</button>
</div>
{{ Form::close() }}
{!! $validator !!}
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">


<script>
    $('.selectpicker').selectpicker();
</script>



@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="dashbordreoirt">
                    <p><i class="m-menu__link-icon fas fa-list"></i>Attribute</p>
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
                Attribute</a>
        </div>

        <div id="data-list-page">

        </div>
    </div>

    <!--Create Page Model-->
    <div class="modal fade" id="add-attribute-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ADD Attribute</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="editModalContent">
                    {{ Form::open(array('url' =>route('attributes.store'),'name' => 'form-attribute', 'id'=>'form-attribute','enctype'=>'multipart/form-data')) }}
                    @csrf
                    <div class="modal-body row">
                        <div class="form-group col-md-12">
                            {{ Form::label('attribute', 'Attribute Name', array('class'=>'form-control-label')) }}
                            {{ Form::text('attribute_name','', array('class' => 'form-control', 'id' => 'attribute_name')) }}
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
    </div>

    <!-- Edit user mddal -->
    <div class="modal fade" id="editAttributeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Attribute</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="editAttributeContent">

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
            {!! $validator !!}
            <script>
                var index_url = "{{route('attribute.index')}}";
            </script>
            <script src="{{ URL::asset('js/admin/attribute.js') }}" type="text/javascript"></script>
@endsection

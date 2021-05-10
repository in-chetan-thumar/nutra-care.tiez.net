@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="dashbordreoirt">
                    <p><i class="m-menu__link-icon fas fa-phone"></i>Contact us</p>
                </div>
            </div>
        </div>
        <div id="data-list">

        </div>
    </div>

    <!-- replay contact  mddal -->
    <div class="modal fade" id="replayContactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Contact Replay</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="editModalContent">
                    {{ Form::open(array('url' =>'','name' => 'form-contact', 'id'=>'form-contact')) }}
                    @method('PATCH')
                    <div class="modal-body row">
                        <div class="form-group col-md-12">
                            {{ Form::label('description', 'Description', array('class'=>'form-control-label')) }}
                            {{ Form::textarea('description','', array('class' => 'form-control', 'id' => 'description')) }}
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

        @endsection
        @section('scripts')
            {!! $validator !!}
            <script>
                var index_url = "{{route('contact.index')}}";
            </script>
            <script src="{{ URL::asset('js/admin/contact_us.js') }}" type="text/javascript"></script>
@endsection

@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="dashbordreoirt">
                    <p><i class="m-menu__link-icon fas fa-info"></i>Product Inquiry</p>
                </div>
            </div>
        </div>
        <div id="data-list">

        </div>
    </div>
    <!-- Product Detail Model-->
    <div class="modal fade" id="editInquiryModal" tabindex="-1" >
        <div class="modal-dialog" style="max-width: 80%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Inquiry Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="editInquiryModalContent">

                </div>
            </div>
        </div>
    </div>


        @endsection
        @section('scripts')
            <script>
                var index_url = "{{route('inquiry.index')}}";
            </script>
            <script src="{{ URL::asset('js/admin/inquiry.js') }}" type="text/javascript"></script>
@endsection

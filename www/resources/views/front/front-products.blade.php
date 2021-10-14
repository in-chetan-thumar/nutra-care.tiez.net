@extends('front.layout.mainlayout')
@section('content')

    <section class="contact_us_sec">
        <div class="container">
            <div class="contact_block about_block">
                <div class="contact_left">
                    <div class="contact_bg1 product_bg1">
                        <h1>{{trans('labels.front_product_title')}}</h1>
                        <p>{{trans('labels.front_product_subtitle')}}</p>
                    </div>
                </div>
                <div class="contact_right">
                    <div class="contact_bg2">
                        <div class="contact_bg3 product_bg3"></div>
                    </div>
                    <div class="contact_bg4 product_bg4"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="breadcrumb_sec">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Products</li>
                </ol>
            </nav>
            <div class="product_main">
                <div class="product_left">
                    <form class="form-group row filters">
                        <div class="input-group rounded">
                            <input type="search" class="form-control rounded" name="filters[search]"
                                   placeholder="Search" aria-label="Search"
                                   aria-describedby="search-addon" onkeyup="filterRecoard(event)"/>
                        </div>
                    </form>
                </div>
                <div class="product_right">
                    <div class="dropdown">
                        <button class="dropbtn">Download Product Catalogue</button>
                        <div class="dropdown-content">
                            @foreach(config('constants.DOWNLOAD_PRODUCT_CATALOGUE') as $key => $list)
                                <a href="{{route('front.pdf.download',$key)}}"><i
                                        class="fas fa-file-download"></i>{{$list}}</a>
                            @endforeach
                        </div>
                    </div>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn send_inquiry" data-bs-toggle="modal"
                            data-bs-target="#inquiryModal">
                        <span class="productCount">(0)</span>
                        Send Inquiry
                    </button>

                    <!-- Modal -->
                    <div class="modal fade product_modal" id="inquiryModal" tabindex="-1"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Send Inquiry</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="erroInquiry">

                                </div>
                                <p><span class="productCount">0</span> <span class="productText"></span> Selected</p>
                                {{ Form::open(array('url' =>route('submit.product.inquiry'),'name' => 'form-inquiry', 'id'=>'form-inquiry')) }}
                                @csrf

                                <div class="modal-body">
                                    <div class="contact_form modal-form">
                                        <div class="form-group">
                                            <input type="text" name="name" value="" class="form-control"
                                                   placeholder="Full Name">
                                            @if ($errors->has('name'))
                                                <span
                                                    class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" value="" class="form-control"
                                                   placeholder="Email Address">
                                            @if ($errors->has('email'))
                                                <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input type="tel" name="phone" value="" class="form-control"
                                                   placeholder="Phone Number">
                                            @if ($errors->has('phone'))
                                                <span class="help-block"><strong>{{ $errors->first('phone') }}</strong></span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" placeholder="Message" rows="3"
                                                      name="message"></textarea>
                                            @if ($errors->has('message'))
                                                <span
                                                    class="help-block"><strong>{{ $errors->first('message') }}</strong></span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            {!! app('captcha')->display() !!}

                                            @if ($errors->has('g-recaptcha-response'))
                                                <span
                                                    class="help-block"><strong>{{ $errors->first('g-recaptcha-response') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> data-bs-target="#exampleModal1" -->
                                    <button type="submit" class="btn btn-primary btnInquiry" data-bs-toggle="modal">Send Inquiry
                                    </button>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade product_modal success_modal" id="exampleModal1" tabindex="-1"
                         aria-labelledby="exampleModal1Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModal1Label"><span class="productCount">0</span> Products Inquiry Submitted
                                        Succeefully!</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="assets/images/paper-plane.svg" alt="Paper Plane" title="Paper Plane"/>
                                </div>
                                <!-- <div class="modal-footer">
                                  <button type="button" class="btn btn-primary">Send Inquiry</button>
                                </div> -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="catalogue_main">
                <div class="sidenav">
                    <div class="col-md-12">
                        <h4>Products <span style="margin-left: 96px;font-size: 15px;cursor: pointer;border-bottom:1px solid #000;color: #000" class="clearFilter">Clear all</span></h4>
                    </div>

                    <div class="sidenav_link">
                        @if(!empty($categories))
                            @foreach($categories->where('parent_category_id', 0)->sortBy('id') as $key => $row)
                                <div class="link_main">
                                    <button class="dropdown-btn active" onclick="changeIcon(event)" data-icon="{{$key}}">
                                        <i class="fas fa-chevron-down" id="{{$key}}"></i> {{$row->title}}<span class="badge text-right" style="color: black !important; font-size: 14px;">({{$row->category_products()}})</span></a>
                                    </button>
                                    @if($row->chaild_category->count() != 0)
                                        <div class="dropdown-container" style="height:150px;overflow-y: auto;display: block;">
                                            @foreach($row->chaild_category->sortBy('title') as $subCategory)
                                                <input type="checkbox" id="{{$subCategory->title}}" class="active mt-3" name="categories[]"
                                                       value="{{$subCategory->id}}">
                                                <label for="{{$subCategory->title}}">{{$subCategory->title}}</label>
                                                <span class="badge text-right" style="color: black !important; font-size: 14px; padding:0px;">({{$subCategory->category_product_links->count()}})</span><br/>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="main">
                    <h4>Select Products for Inquiry</h4>
                    <div class="product-list">

                    </div>
                    <!-- <div class="pro_block">
                        <div class="pro_main">
                            <div class="pro_left">
                                <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                            </div>
                            <div class="pro_right">
                                <img src="assets/images/product-logo.png" />
                                <h5>Anti Biotech Free Growth Promoter</h5>
                                <table width="100%">
                                    <tr>
                                        <td>
                                            <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                                            <label for="vehicle1"> I have a bike</label>
                                        </td>
                                        <td>Halquinol</td>
                                        <td>95% (Min)</td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                                            <label for="vehicle1"> I have a bike</label>
                                        </td>
                                        <td>Halquinol</td>
                                        <td>95% (Min)</td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                                            <label for="vehicle1"> I have a bike</label>
                                        </td>
                                        <td>Halquinol</td>
                                        <td>95% (Min)</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="pro_main">
                            <div class="pro_left">
                                <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                            </div>
                            <div class="pro_right">
                                <img src="assets/images/product-logo.png" />
                                <h5>Anti Biotech Free Growth Promoter</h5>
                                <table width="100%">
                                    <tr>
                                        <td>
                                            <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                                            <label for="vehicle1"> I have a bike</label>
                                        </td>
                                        <td>Halquinol</td>
                                        <td>95% (Min)</td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                                            <label for="vehicle1"> I have a bike</label>
                                        </td>
                                        <td>Halquinol</td>
                                        <td>95% (Min)</td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                                            <label for="vehicle1"> I have a bike</label>
                                        </td>
                                        <td>Halquinol</td>
                                        <td>95% (Min)</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </section>

@endsection
@section('script')
    {!! $validator !!}
    <script>
        function changeIcon(e) {
            var hasClass = e.currentTarget.classList.contains('active');
            var id = $(e.currentTarget).data('icon');
            if(hasClass){
               $("#"+id).removeClass('fas fa-chevron-down');
               $("#"+id).addClass('fas fa-chevron-right');
            }else{
                $("#"+id).removeClass('fas fa-chevron-right');
                $("#"+id).addClass('fas fa-chevron-down');
            }
        }

        var index_url = "{{route('front.front.products')}}";
        var product_url = "{{route('front.product.category')}}";
        $('.dropdown-btn').click(function() {
            $(this).toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
        });
    </script>
    <script src="{{ URL::asset('js/admin/fronted_product.js') }}" type="text/javascript"></script>
@endsection


@extends('front.layout.mainlayout')
@section('content')

    <section class="contact_us_sec">
        <div class="container">
            <div class="contact_block">
                <div class="contact_left">
                    <div class="contact_bg1 product_bg1">
                        <p>At Salvi chemical industries limited we believe in</p>
                        <h1>Quality, Quantity & Quick service</h1>
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
                    <li class="breadcrumb-item active" aria-current="page">Library</li>
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
                                <p><span class="productCount">0</span> Products Selected</p>
                                {{ Form::open(array('url' =>route('submit.product.inquiry'),'name' => 'form-inquiry', 'id'=>'form-inquiry')) }}
                                @csrf

                                <div class="modal-body">
                                    <div class="contact_form modal-form">
                                        <div class="form-group">
                                            <input type="text" id="" name="name" value="" class="form-control"
                                                   placeholder="Full Name">
                                            @if ($errors->has('name'))
                                                <span
                                                    class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input type="email" id="" name="email" value="" class="form-control"
                                                   placeholder="Email Address">
                                            @if ($errors->has('email'))
                                                <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input type="tel" id="" name="phone" value="" class="form-control"
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
                    <h4>Products</h4>
                    <div class="sidenav_link">
                        @if(!empty($categories))
                            @foreach($categories as $row)
                                <div class="link_main">
                                    <button class="dropdown-btn">
                                        @if($row->chaild_category->count() == 0)
                                            <a href="javascript;" class="active"
                                               data-url="{{route('front.product.category',$row->id)}}"
                                               onclick="loadProduct(event)">{{$row->title}}<span class="badge text-right" style="color: black !important; font-size: 14px;">({{$row->category_product_links->count()}})</span></a>

                                        @else
                                            <i class="fas fa-chevron-right"></i> {{$row->title}}

                                        @endif
                                    </button>
                                    @if($row->chaild_category->count() != 0)
                                        <div class="dropdown-container">
                                            @foreach($row->chaild_category as $subCategory)
                                                <a href="javascript;" class="active"
                                                   data-url="{{route('front.product.category',$subCategory->id)}}"
                                                   onclick="loadProduct(event)">{{$subCategory->title}} <span class="badge text-right" style="color: black !important; font-size: 14px;">({{$subCategory->category_product_links->count()}})</span></a>

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
                </div>
            </div>
        </div>
    </section>

@endsection
@section('script')
    {!! $validator !!}
    <script>
        var index_url = "{{route('front.front.products')}}";

    </script>
    <script src="{{ asset('js/admin/fronted_product.js')}}" type="text/javascript"></script>
@endsection


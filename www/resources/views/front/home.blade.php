@extends('front.layout.mainlayout')
@section('content')

<div class="lottie-progress">
</div>
<div class="lottie_container">
    <div class="content">

    </div>
    <section class="health_sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-4">
                    <img src="assets/images/health.png" alt="Health" title="Health" />
                </div>
                <div class="col-md-12 col-lg-8 health_col">
                    <div class="health_info">
                        <p>{{trans('labels.banner_title')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="anemia_sec">
        <div class="container">
            <div class="anemia_block">
                <img src="assets/images/anemia_img.png" alt="India Fights Anemia" title="India Fights Anemia" />
            </div>
        </div>
    </section>

    <section class="category_sec">
        <div class="container">
            <h3>{{trans('labels.category_title')}}</h3>
            <div class="category_main">

                @foreach($categories as $category)
                    <div class="row category_box">
                        <div class="col-12">

                    <div class="row category_box_center " >
                        <h5>{{$category->title}}</h5>

                        @foreach($category->childs as $child)
                            <div class="category_size" >
                                <div class="category_block">
                                    <img src="{{ asset("storage/category/$child->photo") }}" alt="{{$child->title}}" title="{{$child->title}}" height="50px"/>
                                    <h4>{{$child->title}}</h4>
                                </div>
                            </div>
                        @endforeach

                        </div>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <section class="vision_sec" style="background: #fff;">
        <div class="container">
            <h3>{{trans('labels.mission_title')}}</h3>
            <div class="row">
                <div class="col-md-12 col-lg-7 vision_center">
                    <div class="vision_para">
                        <p>{{trans('labels.mission_para')}}</p>
                    </div>
                </div>
                <div class="col-md-12 col-lg-5">
                    <img src="assets/images/vision.png" alt="Mission & Vission" title="Mission & Vission" />
                </div>
            </div>
        </div>
    </section>

    <section class="tragedy_sec">
        <div class="container">
            <div class="tragedy_block">
                <h3>{{trans('labels.tragedy_title')}}</h3>
                <p>{{trans('labels.tragedy_para')}}</p>
            </div>
        </div>
    </section>

    <section class="certify_sec">
        <div class="container">
            <h3>{{trans('labels.certification_title')}}</h3>
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <div class="certify_symbol">
                        <img src="assets/images/symbol.png" alt="Nutra Care" title="Nutra Care" />
                    </div>
                    <div class="certify_info">
                        <p>{{trans('labels.certification_para')}}
                            <i class="fas fa-long-arrow-alt-right"></i>
                        </p>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <ul class="certify_list">
                        <li>
                            <img src="assets/images/certification1.jpg" alt="Certification1" title="Certification1" />
                        </li>
                        <li>
                            <img src="assets/images/certification2.jpg" alt="Certification2" title="Certification2" />
                        </li>
                        <li>
                            <img src="assets/images/certification3.jpg" alt="Certification3" title="Certification3" />
                        </li>
                        <li>
                            <img src="assets/images/certification4.jpg" alt="Certification4" title="Certification4" />
                        </li>
                        <li>
                            <img src="assets/images/certification5.jpg" alt="Certification5" title="Certification5" />
                        </li>
                        <li>
                            <img src="assets/images/certification6.jpg" alt="Certification6" title="Certification6" />
                        </li>
                        <li>
                            <img src="assets/images/certification7.jpg" alt="Certification7" title="Certification7" />
                        </li>
                        <li>
                            <img src="assets/images/certification8.jpg" alt="Certification8" title="Certification8" />
                        </li>
                        <li>
                            <img src="assets/images/certification9.jpg" alt="Certification9" title="Certification9" />
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    @include('front.layout.partials.footer')

</div>

@endsection

@extends('front.layout.mainlayout')
@section('content')

<section class="innovation_sec">
  <div class="container">
    <div class="row innovation_main">
      <div class="col-md-12 col-lg-6 innovation_text">
        <div class="innovation_left">
          <h3>{!!trans('labels.research_title1')!!}</h3>
          <p>{{trans('labels.research_description1')}}</p>
        </div>
      </div>
      <div class="col-md-12 col-lg-6 text-center">
        <div class="innovation_right">
          <img src="assets/images/research.jpg" alt="Research" title="Research" />
        </div>
      </div>
    </div>
    <div class="row innovation_main">
      <div class="col-md-12 col-lg-6 text-center div_order">
        <div class="innovation_right">
          <img src="assets/images/quality.jpg" alt="Quality" title="Quality" />
        </div>
      </div>
      <div class="col-md-12 col-lg-6 innovation_text">
        <div class="innovation_left">
          <h3>{{trans('labels.research_title2')}}</h3>
          <p>{{trans('labels.research_description2')}}</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-lg-6 innovation_text">
        <div class="innovation_left no-padding">
          <h3>{{trans('labels.research_title3')}}</h3>
          <p>{{trans('labels.research_description3')}}</p>
        </div>
      </div>
      <div class="col-md-12 col-lg-6 text-center">
        <div class="innovation_right">
          <img src="assets/images/resource.jpg" alt="resource" title="resource" />
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

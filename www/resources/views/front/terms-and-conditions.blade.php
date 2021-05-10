@extends('front.layout.mainlayout')
@section('content')

<section class="contact_us_sec">
  <div class="container">
    <div class="contact_block">
      <div class="contact_left">
        <div class="contact_bg1 privacy_bg1">
          <h1>{{trans('labels.terms_title')}}</h1>
        </div>
      </div>
      <div class="contact_right">
        <div class="contact_bg2">
          <div class="contact_bg3"></div>
        </div>
        <div class="contact_bg4"></div>
      </div>
    </div>
  </div>
</section>

<section class="privacy_main">
  <div class="container">
    <div class="privacy_block terms">
      <div class="privacy_list">
        <h4>{{trans('labels.terms_question')}}</h4>
        <p>{{trans('labels.terms_answer')}}</p>
      </div>
      <div class="privacy_list">
        <h4>{{trans('labels.terms_question')}}</h4>
        <p>{{trans('labels.terms_answer')}}</p>
      </div>
      <div class="privacy_list">
        <h4>{{trans('labels.terms_question')}}</h4>
        <p>{{trans('labels.terms_answer')}}</p>
      </div>
      <div class="privacy_list">
        <h4>{{trans('labels.terms_question')}}</h4>
        <p>{{trans('labels.terms_answer')}}</p>
      </div>
      <div class="privacy_list">
        <h4>{{trans('labels.terms_question')}}</h4>
        <p>{{trans('labels.terms_answer')}}</p>
      </div>
    </div>
    <div class="privacy_address">
      <h5>{{trans('labels.terms_address_title')}}</h5>
      <p>{{trans('labels.terms_address')}}</p>
      <div class="">
        <p><i class="fas fa-newspaper"></i> 91-22-28703656 </p>
        <p><i class="fas fa-at"></i> info@salvichem.com  </p>
        <p class="term_mail">www.salvichem.com</p>
      </div>
    </div>
  </div>
</section>

@endsection

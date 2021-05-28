@extends('front.layout.mainlayout')
@section('content')

<section class="contact_banner">
    <div class="container">
        <h1>{{trans('labels.contact_title')}}</h1>
    </div>
</section>

<section class="contact_address">
  <div class="container">
    <div class="contact_div">
      <div class="contact_form">
        <div class="form-group">
          <input type="text" id="" name="fname" value="" class="form-control" placeholder="Full Name">
        </div>
        <div class="form-group">
          <input type="tel" id="" name="pnumber" value="" class="form-control" placeholder="Phone Number">
        </div>
        <div class="form-group">
          <input type="email" id="" name="email" value="" class="form-control" placeholder="Email Address">
        </div>
        <div class="form-group">
          <select class="form-control">
            <option selected="selected">Select Product Type</option>
            <option>Product1</option>
            <option>Product2</option>
          </select>
        </div>
        <div class="form-group textarea_class">
          <textarea class="form-control" placeholder="Message" rows="3"></textarea>
        </div>
        <div class="contact_btn">
          <button type="submit" class="btn btn-primary">{{trans('labels.submit_req_btn')}}</button>
        </div>
      </div>
    </div>
    <div class="contact_address_block">
        <h3>{{trans('labels.head_office_title')}}</h3>
        <p>{{trans('labels.head_office_address')}}</p>
        <p class="contact_detail"><i class="fas fa-mobile-alt"></i> <a href="tel: +91-22-28065292"> 91-22-28065292 </a> / <a href="tel: +28059274"> 28059274 </a> / <a href="tel: +91-9820315046"> +91-9820315046 </a></p>
        <p class="contact_detail"><i class="fas fa-at"></i> <a href="mailto:info@nutracareintl.com"> info@nutracareintl.com </a> / <a href="mailto:nutracare@yahoo.com"> nutracare@yahoo.com </a> / <a href="mailto:bdm@nutracareintl.com "> bdm@nutracareintl.com </a></p>
    </div>
    <div class="contact_address_block">
        <h3>{{trans('labels.corporate_office_title')}}</h3>
        <p>{!!trans('labels.corporate_office_address')!!}</p>
    </div>
    <div class="contact_address_block">
        <h3>{{trans('labels.factory_title')}}</h3>
        <p>{{trans('labels.factory_address')}}</p>
    </div>
  </div>
</section>

@endsection

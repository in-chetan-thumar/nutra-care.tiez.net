@extends('front.layout.mainlayout')
@section('content')

<section class="contact_banner">
    <div class="container">
        <h1>Contact Us</h1>
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
        <h3>Head Office Address:</h3>
        <p>214, Blue Rose Industrial Estate, W.E. Highway, Borivali(E), Mumbai - 400066, INDIA.</p>
        <p class="contact_detail"><i class="fas fa-mobile-alt"></i> 91-22-28065292 / 28059274 / +91-9820315046</p>
        <p class="contact_detail"><i class="fas fa-at"></i> info@nutracareintl.com / nutracare@yahoo.com / bdm@nutracareintl.com</p>
    </div>
    <div class="contact_address_block">
        <h3>Corporate Address:</h3>
        <p>Plot No.43, Road No.13, SurSEZ, Near Sachin Railway <br/> Station, Sachin - 394230, District: Surat, Gujarat.</p>
    </div>
    <div class="contact_address_block">
        <h3>Factory Address:</h3>
        <p>Plot No.3601, Road No.3, GIDC, Sachin, District: Surat, Gujarat.</p>
    </div>
  </div>
</section>

@endsection

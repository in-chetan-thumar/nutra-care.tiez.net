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
        @if(session('status') === false)
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
      <div class="contact_form">
          {!! Form::open([
             'url' => route('submit.contact.inquiry'),
             'method' => 'POST',
             'id' => 'contact-form',
             'files' => true,
         ]) !!}
          <div class="row">
              <div class="col-6 form-group">
                      <input type="text" id="full_name" name="full_name" value="" class="form-control" placeholder="Full Name">
                      @error('full_name')
                      <span style="color:red">
                        <strong>{{ $message }}</strong>
                    </span>
                      @enderror
              </div>
              <div class="col-6 form-group">
                  {!! Form::number('phone_number', null, [
                  'class' => ' form-control phone_number',
                  'placeholder' => 'Phone Number',
                  'oninput' =>
                      'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);',
                  'maxlength' => '10',
              ]) !!}
                  @error('phone_number')
                  <span style="color:red">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
              </div>
              <div class="col-6 form-group">
                  <input type="email" id="" name="email" value="" class="form-control" placeholder="Email Address">
                  @error('email')
                  <span style="color:red">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror

              </div>
              <div class="col-6 form-group">
                  <select name="product_type" class="form-control">
                      <option value="" selected="selected">Select Product Type</option>
                      <option value="Product1" >Product1</option>
                      <option value="Product2" >Product2</option>
                  </select>
                  @error('product_type')
                  <span style="color:red">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
              </div>
              <div class="col-12 form-group textarea_class">
                  <textarea class="form-control" name="message" placeholder="Message" rows="3"></textarea>
                  @error('message')
                  <span style="color:red">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror

              </div>

              </div>



        <div class="contact_btn">
          <button type="submit" class="btn btn-primary">{{trans('labels.submit_req_btn')}}</button>
        </div>
          {!! Form::close() !!}

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
{{--{!! JsValidator::formRequest('App\Http\Requests\ContactUsRequest', '#contact-form') !!}--}}

@extends('front.layout.mainlayout')
@section('content')

  <section class="banner_block">
      <ul class="banner_list owl-carousel">
          <li>
              <img src="assets/images/banner.jpg" alt="Chemical Industry" title="Chemical Industry" />
              <div class="container">
                <div class="banner_overlay">
                    <div class="banner_title">
                        <h1>{{trans('labels.banner_title')}}</h1>
                    </div>
                </div>
              </div>
          </li>
          <li>
              <img src="assets/images/banner.jpg" alt="Chemical Industry" title="Chemical Industry" />
              <div class="container">
                <div class="banner_overlay">
                    <div class="banner_title">
                      <h1>{{trans('labels.banner_title')}}</h1>
                    </div>
                </div>
              </div>
          </li>
          <li>
              <img src="assets/images/banner.jpg" alt="Chemical Industry" title="Chemical Industry" />
              <div class="container">
                <div class="banner_overlay">
                    <div class="banner_title">
                      <h1>{{trans('labels.banner_title')}}</h1>
                    </div>
                </div>
              </div>
          </li>
      </ul>
  </section>

  <section class="development_block">
    <div class="container">
      <div class="development_main">
        <h2>{{trans('labels.development_title')}}</h2>
        <p>{{trans('labels.development_subtitle')}}</p>
        <div class="row">
          <div class="col-sm-12 col-md-6 col-lg-4 development_grid">
            <div class="devlopment_box">
              <div class="development_title">
                <div class="development_img">
                  <object type="image/svg+xml" data="assets/images/people.svg" class="icon icon-people">
                  </object>
                </div>
                <h3>{{trans('labels.development_block1_title')}}</h3>
              </div>
              <ul class="development_description">
                <li>{{trans('labels.development_block1_listing1')}}</li>
                <li>{{trans('labels.development_block1_listing2')}}</li>
                <li>{{trans('labels.development_block1_listing3')}}</li>
              </ul>
            </div>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-4 development_grid">
            <div class="devlopment_box">
              <div class="development_title">
                <div class="development_img">
                  <object type="image/svg+xml" data="assets/images/planet.svg" class="icon icon-people">
                  </object>
                </div>
                <h3>{{trans('labels.development_block2_title')}}</h3>
              </div>
              <ul class="development_description">
                <li>{{trans('labels.development_block2_listing1')}}</li>
                <li>{{trans('labels.development_block2_listing2')}}</li>
                <li>{{trans('labels.development_block2_listing3')}}</li>
              </ul>
            </div>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-4 development_grid">
            <div class="devlopment_box">
              <div class="development_title">
                <div class="development_img">
                  <object type="image/svg+xml" data="assets/images/profit.svg" class="icon icon-people">
                  </object>
                </div>
                <h3>{{trans('labels.development_block3_title')}}</h3>
              </div>
              <ul class="development_description">
                <li>{{trans('labels.development_block3_listing1')}}</li>
                <li>{{trans('labels.development_block3_listing2')}}</li>
                <li>{{trans('labels.development_block3_listing3')}}</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="industries_sec">
    <div class="container">
      <div class="industries_block">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-4 industry_main">
            <div class="industries_left">
              <h3>{{trans('labels.industry_title')}}</h3>
              <p>{{trans('labels.industry_subtitle')}}</p>
            </div>
          </div>
          <div class="col-sm-12 col-md-12 col-lg-8">
            <div class="industries_right">
              <ul>
                <li>
                  <div class="industry_box">
                    <h5>{{trans('labels.industry_block1_title')}}</h5>
                    <p>{{trans('labels.industry_block1_subtitle')}}</p>
                  </div>
                </li>
                <li>
                  <div class="industry_box">
                    <h5>{{trans('labels.industry_block2_title')}}</h5>
                    <p>{{trans('labels.industry_block2_subtitle')}}</p>
                  </div>
                </li>
                <li>
                  <div class="industry_box">
                    <h5>{{trans('labels.industry_block3_title')}}</h5>
                    <p>{{trans('labels.industry_block3_subtitle')}}</p>
                  </div>
                </li>
                <li>
                  <div class="industry_box">
                    <h5>{{trans('labels.industry_block4_title')}}</h5>
                    <p>{{trans('labels.industry_block4_subtitle')}}</p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="counter_sec">
    <div class="container">
      <ul>
        <li>
          <span class="count">200</span>
          <p>{{trans('labels.counter_title1')}}</p>
        </li>
        <li>
          <span class="count">10</span>
          <p>{{trans('labels.counter_title2')}}</p>
        </li>
        <li>
          <span class="count">500</span>
          <p>{{trans('labels.counter_title3')}}</p>
        </li>
      </ul>
    </div>
  </section>

  <section class="product_sec">
    <div class="container">
      <div class="product_block">
        <h3>{{trans('labels.product_title')}}</h3>
        <div class="row">
          <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="product_box">
              <img src="assets/images/product1.png" alt="Product1" title="Product1" />
            </div>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="product_box">
              <img src="assets/images/product2.png" alt="Product2" title="Product2" />
            </div>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="product_box">
              <img src="assets/images/product3.png" alt="Product3" title="Product3" />
            </div>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="product_box">
              <img src="assets/images/product4.png" alt="Product4" title="Product4" />
            </div>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="product_box">
              <img src="assets/images/product5.png" alt="Product5" title="Product5" />
            </div>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="product_box">
              <img src="assets/images/product6.png" alt="Product6" title="Product6" />
            </div>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="product_box">
              <img src="assets/images/product7.png" alt="Product7" title="Product7" />
            </div>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="product_box">
              <img src="assets/images/product8.png" alt="Product8" title="Product8" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="spotlight_sec">
    <div class="container">
      <div class="spotlight_block">
        <h3>{{trans('labels.spotlight_title')}}</h3>
          <ul class="spotlight_list owl-carousel">
            <li>
                <div class="spotlight_box">
                  <div class="spotlight_date">
                    <span>{{trans('labels.spotlight_block1_date')}}</span>
                  </div>
                  <div class="spotlight_info">
                    <h4>{{trans('labels.spotlight_block1_title')}}</h4>
                    <p>{{trans('labels.spotlight_block1_info')}}</p>
                  </div>
                  <div class="spotlight_icon">
                    <i class="fas fa-long-arrow-alt-right"></i>
                  </div>
                </div>
            </li>
            <li>
                <div class="spotlight_box">
                  <div class="spotlight_date">
                    <span>{{trans('labels.spotlight_block1_date')}}</span>
                  </div>
                  <div class="spotlight_info">
                    <h4>{{trans('labels.spotlight_block1_title')}}</h4>
                    <p>{{trans('labels.spotlight_block1_info')}}</p>
                  </div>
                  <div class="spotlight_icon">
                    <i class="fas fa-long-arrow-alt-right"></i>
                  </div>
                </div>
            </li>
            <li>
                <div class="spotlight_box">
                  <div class="spotlight_date">
                    <span>{{trans('labels.spotlight_block1_date')}}</span>
                  </div>
                  <div class="spotlight_info">
                    <h4>{{trans('labels.spotlight_block1_title')}}</h4>
                    <p>{{trans('labels.spotlight_block1_info')}}</p>
                  </div>
                  <div class="spotlight_icon">
                    <i class="fas fa-long-arrow-alt-right"></i>
                  </div>
                </div>
            </li>
            <li>
                <div class="spotlight_box">
                  <div class="spotlight_date">
                    <span>{{trans('labels.spotlight_block1_date')}}</span>
                  </div>
                  <div class="spotlight_info">
                    <h4>{{trans('labels.spotlight_block1_title')}}</h4>
                    <p>{{trans('labels.spotlight_block1_info')}}</p>
                  </div>
                  <div class="spotlight_icon">
                    <i class="fas fa-long-arrow-alt-right"></i>
                  </div>
                </div>
            </li>
          </ul>
      </div>
    </div>
  </section>

  <section class="spotlight_sec">
    <div class="container">
      <div class="spotlight_block">
        <h3>{{trans('labels.certification_title')}}</h3>
          <ul class="certification_list owl-carousel">
            <li>
                <div class="certification_img">
                  <img src="assets/images/certification1.png" alt="Certification1" title="Certification1"  />
                </div>
            </li>
            <li>
                <div class="certification_img">
                  <img src="assets/images/certification2.png" alt="Certification2" title="Certification2"  />
                </div>
            </li>
            <li>
                <div class="certification_img">
                  <img src="assets/images/certification3.png" alt="Certification3" title="Certification3"  />
                </div>
            </li>
            <li>
                <div class="certification_img">
                  <img src="assets/images/certification4.png" alt="Certification4" title="Certification4"  />
                </div>
            </li>
            <li>
                <div class="certification_img">
                  <img src="assets/images/certification5.png" alt="Certification5" title="Certification5"  />
                </div>
            </li>
            <li>
                <div class="certification_img">
                  <img src="assets/images/certification6.png" alt="Certification6" title="Certification6"  />
                </div>
            </li>
            <li>
                <div class="certification_img">
                  <img src="assets/images/certification7.png" alt="Certification7" title="Certification7"  />
                </div>
            </li>
            <li>
                <div class="certification_img">
                  <img src="assets/images/certification8.png" alt="Certification8" title="Certification8"  />
                </div>
            </li>
            <li>
                <div class="certification_img">
                  <img src="assets/images/certification9.png" alt="Certification9" title="Certification9"  />
                </div>
            </li>
          </ul>
      </div>
    </div>
  </section>

@endsection

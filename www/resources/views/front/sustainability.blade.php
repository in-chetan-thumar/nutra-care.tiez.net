@extends('front.layout.mainlayout')
@section('content')

<section class="contact_us_sec about_us_sec">
  <div class="container">
    <div class="contact_block about_block">
      <div class="contact_left">
        <div class="contact_bg1 sustainability_bg1">
          <h1>{{trans('labels.sustainability_title')}}</h1>
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

<section class="sustainability_sec">
  <div class="container">
    <div class="sustain_block">
      <div class="row">
        <div class="col-md-6 col-lg-6">
          <div class="sustain_left">
            <h3>{{trans('labels.responsibility_title')}}</h3>
            <p>{{trans('labels.responsibility_para1')}}</p>
            <p>{{trans('labels.responsibility_para2')}}</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-6 text-center">
          <div class="sustain_right">
            <img src="assets/images/sustainability.jpg" alt="Sustainability" title="Sustainability" />
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="policy_sec">
  <div class="container">
    <h3>{{trans('labels.policy_title')}}</h3>
    <p>{{trans('labels.policy_para')}}</p>
  </div>
  <div class="policy_list">
    <div class="container">
      <ul>
        <li>
          <div class="policy_main">
            <div class="policy_img">
              <img src="assets/images/polution-control.png" alt="Waste Management and Pollution Control" title="Waste Management and Pollution Control" />
            </div>
            <div class="policy_info">
              <h3>{{trans('labels.policy_listing1_title')}}</h3>
              <p>{{trans('labels.policy_listing1_para')}}</p>
            </div>
          </div>
        </li>
        <li>
          <div class="policy_main">
            <div class="policy_img">
              <img src="assets/images/air-pollution.png" alt="Air pollution" title="Air pollution" />
            </div>
            <div class="policy_info">
              <h3>{{trans('labels.policy_listing2_title')}}</h3>
              <p>{{trans('labels.policy_listing2_para')}}</p>
            </div>
          </div>
        </li>
        <li>
          <div class="policy_main">
            <div class="policy_img">
              <img src="assets/images/water-pollution.png" alt="Water pollution" title="Water pollution" />
            </div>
            <div class="policy_info">
              <h3>{{trans('labels.policy_listing3_title')}}</h3>
              <p>{{trans('labels.policy_listing3_para')}}</p>
            </div>
          </div>
        </li>
        <li>
          <div class="policy_main">
            <div class="policy_img">
              <img src="assets/images/security-safety.png" alt="Security and Safety" title="Security and Safety" />
            </div>
            <div class="policy_info">
              <h3>{{trans('labels.policy_listing4_title')}}</h3>
              <p>{{trans('labels.policy_listing4_para')}}</p>
            </div>
          </div>
        </li>
        <li>
          <div class="policy_main">
            <div class="policy_img">
              <img src="assets/images/code-of-conduct.png" alt="Code of Conduct" title="Code of Conduct" />
            </div>
            <div class="policy_info">
              <h3>{{trans('labels.policy_listing5_title')}}</h3>
              <p>{{trans('labels.policy_listing5_para')}}</p>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</section>

<section class="dimension_block">
  <div class="container">
    <div class="dimension_main">
      <h3>{{trans('labels.dimension_title')}}</h3>
      <div class="demo">
         <div id="horizontalTab">
            <ul class="resp-tabs-list">
               <li><img src="assets/images/people.svg" /><span>{{trans('labels.dimension_tab1_title')}}</span></li>
               <li><img src="assets/images/planet.svg" /><span>{{trans('labels.dimension_tab2_title')}}</span></li>
               <li><img src="assets/images/profit.svg" /><span>{{trans('labels.dimension_tab3_title')}}</span></li>
            </ul>
            <div class="resp-tabs-container">
                <div class="tab_info">
                  <ul>
                    <li>
                      {{trans('labels.dimension_tab1_listing1')}}
                    </li>
                    <li>
                      {{trans('labels.dimension_tab1_listing2')}}
                    </li>
                    <li>
                      {{trans('labels.dimension_tab1_listing3')}}
                    </li>
                    <li>
                      {{trans('labels.dimension_tab1_listing4')}}
                    </li>
                    <li>
                      {{trans('labels.dimension_tab1_listing5')}}
                    </li>
                  </ul>
                </div>
                <div class="tab_info">
                  <ul>
                    <li>
                      {{trans('labels.dimension_tab2_listing1')}}
                    </li>
                    <li>
                      {{trans('labels.dimension_tab2_listing2')}}
                    </li>
                    <li>
                      {{trans('labels.dimension_tab2_listing3')}}
                    </li>
                    <li>
                      {{trans('labels.dimension_tab2_listing4')}}
                    </li>
                    <li>
                      {{trans('labels.dimension_tab2_listing5')}}
                    </li>
                    <li>
                      {{trans('labels.dimension_tab2_listing6')}}
                    </li>
                  </ul>
                </div>
                <div class="tab_info">
                  <ul>
                    <li>
                      {{trans('labels.dimension_tab3_listing1')}}
                    </li>
                    <li>
                      {{trans('labels.dimension_tab3_listing2')}}
                    </li>
                    <li>
                      {{trans('labels.dimension_tab3_listing3')}}
                    </li>
                    <li>
                      {{trans('labels.dimension_tab3_listing4')}}
                    </li>
                    <li>
                      {{trans('labels.dimension_tab3_listing5')}}
                    </li>
                  </ul>
                </div>
            </div>
         </div>
      </div>
    </div>
  </div>
</section>

@endsection

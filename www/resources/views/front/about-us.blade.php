@extends('front.layout.mainlayout')
@section('content')

    <section class="about_history">
        <div class="container">
            <div class="about_description">
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div class="about_left">
                            <h3>Mission & Vision</h3>
                            <p>Our customers need and deserve high performance products, and the finest of raw materials
                                and services. Our visionary goal is to continue to cater to them with honesty,
                                integrity, and transparency, but also do so with commitment to providing quality and
                                cost-effective products. Sustainability is also a core part of our policies as a
                                nutraceutical chemical manufacturer, along with the aim of mastering operational
                                excellence. Our mission and vision convene to curate services that allow our customers
                                to meet the challenges of today and all the tomorrows.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="world_sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-3">
                    <img src="assets/images/world.png" alt="World" title="World"/>
                </div>
                <div class="col-md-12 col-lg-9">
                    <h3>We help the world move forward</h3>
                    <p>The world can become a better place when it is healthier and consumes the goodness the planet has
                        to offer. At Nutracare, we are on a perpetual mission to contribute to a world that is healthy
                        and hence, happy and hearty. By bringing you closer to nutrients, we like to call ourselves the
                        helping hand in churning the wheel of change.</p>
                </div>
            </div>
        </div>

    </section>

    <section class="value_block">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-4">
                    <div class="value_left">
                        <h3>Our Values</h3>
                        <div class="value_img">
                            <img src="assets/images/value.jpg" alt="Value" title="Value" id="img_other"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-8">
                    <div class="value_right">
                        <div class="value_box" data-img-url="assets/images/value.jpg">
                            <h4 class="title">A Chemical Approach <br/> to Health</h4>
                            <p>A core purpose at Nutracare, we believe in the introduction of chemistry to health, and
                                its uplifting results. Our value lies in customer satisfaction and catering to their
                                needs of nutritional elements with the correct healthy chemistry formulation and
                                techniques.</p>
                        </div>
                        <div class="value_box" data-img-url="assets/images/quality.jpg">
                            <h4 class="title">Keeping Up with Your Needs <br/> & Demands</h4>
                            <p>As the days and years pass, our needs and demands keep changing. Today, the world needs
                                personal attention and made-to-order services. We are committed to working hard enough
                                to be able to keep up with the needs and demands of our customers with efficient and
                                cost-effective products and services.</p>
                        </div>
                        <div class="value_box" data-img-url="assets/images/research.jpg">
                            <h4 class="title">Excelling but with Integrity <br/> and Honesty</h4>
                            <p>We believe that we run on a fair dose of integrity, honesty, and perseverance. We not
                                only believe in a sustainable future for the world but also sustainability in our work,
                                as givers to society today. By maintaining transparency through our processes and
                                products, we also hope to send out an inspiring message.</p>
                        </div>
                        <div class="value_box" data-img-url="assets/images/resource.jpg">
                            <h4 class="title">Flexibility and Quality as <br/> the Crux</h4>
                            <p>With our customers guiding our growth, we are constantly motivated to bring innovation
                                into our work. With an open mind to feedback and customer inputs, we trust our
                                flexibility and innovation to keep churning out high-quality products.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('script')

    <script type="text/javascript">

        $(".value_right").scroll(function () {

            if ($(this)[0].scrollTop != 0) {
                var result2 = "";
                $.each($(".value_box"), function (i, e) {
                    console.log(i)
                    if (checkInView($(e), true)) {
                        $("#img_other").attr('src', $(this).data('img-url'));
                        $("#img_other").delay(1000).fadeIn(3000);
                        result2 += " " + checkInView($(e), true);
                    }
                });

            } else {
                $("#img_other").attr('src', "assets/images/value.jpg");
                $("#img_other").delay(1000).fadeIn(3000);
            }

            console.log(result2)
        });

        function checkInView(elem, partial) {
            var container = $(".value_right");
            var contHeight = container.height();
            var contTop = container.scrollTop();
            var contBottom = contTop + contHeight;
            var elemTop = $(elem).offset().top - container.offset().top;
            var elemBottom = elemTop + $(elem).height();
            console.log("TOP",elemTop)
            console.log("elemBottom",elemBottom)
            console.log("container",container.height())
            var isPart = ((elemTop < 0 && elemBottom > 0) || (elemTop > 0 && elemTop <= container.height())) && partial;

            return isPart;
        }

    </script>

@endsection

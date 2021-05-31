@extends('front.layout.mainlayout')
@section('content')
<style>
    #sticky {
        padding: 0.5ex;
        font-size: 2em;
        border-radius: 0.5ex;
        float: left;
        position: sticky;
        width: 450px;
    }

    #sticky.stick {
        position: sticky;
        top: 125px;
        z-index: 10;
        border-radius: 0 0 0.5em 0.5em;
        max-width: 450px;
    }

    .content-holder {
        /* margin-left: 225px; */
    }

    .content-holder .value_right {
        height: auto;
    }
        </style>
    <section class="about_history">
        <div class="container">
            <div class="about_description">
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div class="about_left">
                            <h3>Mission & Vision</h3>
                            <p>Our customers need and deserve high performance products, and the finest of raw materials and
                                services. Our visionary goal is to continue to cater to them with honesty, integrity, and
                                transparency, but also do so with commitment
                                to providing quality and cost-effective products. Sustainability is also a core part of our
                                policies as a nutraceutical chemical manufacturer, along with the aim of mastering
                                operational excellence. Our mission and vision
                                convene to curate services that allow our customers to meet the challenges of today and all
                                the tomorrows.</p>
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
                    <img src="assets/images/world.png" alt="World" title="World" />
                </div>
                <div class="col-md-12 col-lg-9">
                    <h3>We help the world move forward</h3>
                    <p>The world can become a better place when it is healthier and consumes the goodness the planet has to
                        offer. At Nutracare, we are on a perpetual mission to contribute to a world that is healthy and
                        hence, happy and hearty. By bringing
                        you closer to nutrients, we like to call ourselves the helping hand in churning the wheel of change.
                    </p>
                </div>
            </div>
        </div>

    </section>

    <section class="value_block">
        <div class="container">
            <div id="sticky-anchor"></div>
            <div class="row">
                <div class="col-md-12 col-lg-5">
                    <div class="value_left" id="sticky">
                        <h3>Our Values</h3>
                        <div class="value_img">
                            <img src="assets/images/value.jpg" alt="Value" title="Value" id="img_other" />
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-7">
                    <div class="content-holder">
                        <div class="value_right">
                            <div class="value_box" data-id="vision-1" id="vision-1" data-img-url="assets/images/value.jpg">
                                <h4 class="title">Vision</h4>
                                <p>We are farmers that live in apartments. We see green fields where others see gray. We
                                    fuel blooming communities where others fear urban decay. And we grow the freshest
                                    produce on earth. Most of all we know that the crunch
                                    of fresh, local, sustainably-grown food sets off a chain reaction of good things in the
                                    world. We are Gotham Greens and we grow the most extraordinarily fresh food in
                                    extraordinarily fresh places.</p>
                            </div>
                            <div class="value_box" data-id="vision-2" id="vision-2" data-img-url="assets/images/quality.jpg">
                                <h4 class="title">Sustainability</h4>
                                <p>Sustainability isn’t just about being smarter. It means changing the way we think.
                                    Working indoors means we can grow more produce (per square foot per year) than is
                                    possible with conventional farming. Plus, a unique hydroponic
                                    greenhouse technology means using less land, less water and less energy, while producing
                                    less pollution and less waste.</p>
                            </div>
                            <div class="value_box" data-id="vision-3" id="vision-3" data-img-url="assets/images/resource.jpg">
                                <h4 class="title">Technology</h4>
                                <p>Our latest greenhouses are advanced, data-driven, climate-controlled facilities — the
                                    most efficient production systems available today. These greenhouses are some of the
                                    highest-yielding farms around and use less energy,
                                    less land and less water than other farming techniques. Plus, advancements in machine
                                    learning and data analysis allow us to monitor our crop’s health and progress, so we can
                                    deliver a fresher, more delicious product.
                                    Happy greens make happy people.</p>
                            </div>
                            <div class="value_box" data-id="vision-4" id="vision-4" data-img-url="assets/images/resource.jpg">
                                <h4 class="title">Community</h4>
                                <p>We’re committed to creating jobs for local residents from our communities. In addition to
                                    healthy and enjoyable year-round work, we’re also dedicated to urban renewal and
                                    becoming permanent fixtures in our home cities.
                                    By partnering with local schools, community leaders and non-profits, Gotham Greens helps
                                    to put better food on the table through environmental, educational and community
                                    initiatives. <br> <br>These programs are rooted
                                    in the communities surrounding Gotham Greens' facilities, but the impact extends beyond
                                    the borders of its neighborhoods.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('script')
    <script src="js/sticky.js"></script>
    <script type="text/javascript">


    </script>

@endsection

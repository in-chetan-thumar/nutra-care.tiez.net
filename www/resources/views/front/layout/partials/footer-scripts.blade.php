<!-- Bootstrap core JavaScript
================================================= -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/js/all.min.js')}}"></script>
<script src="{{asset('assets/js/easy-responsive-tabs.js')}}"></script>
<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ URL::asset('assets/vendor/jsvalidation/jsvalidation.js')}}"></script>
<script>
    $('.banner_list.owl-carousel').owlCarousel({
        loop: true,
        margin: 0,
        dots: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            600: {
                items: 1,
                nav: false
            },
            1000: {
                items: 1,
                nav: false,
                loop: false
            }
        }
    })
</script>

<script>
    (function ($) {
        $(function () {

            //  open and close nav
            $('#navbar-toggle').click(function () {
                $('nav ul').slideToggle();
            });


            // Hamburger toggle
            $('#navbar-toggle').on('click', function () {
                this.classList.toggle('active');
            });


            // If a link has a dropdown, add sub menu toggle.
            $('nav ul li a:not(:only-child)').click(function (e) {
                $(this).siblings('.navbar-dropdown').slideToggle("slow");

                // Close dropdown when select another dropdown
                $('.navbar-dropdown').not($(this).siblings()).hide("slow");
                e.stopPropagation();
            });


            // Click outside the dropdown will remove the dropdown class
            $('html').click(function () {
                $('.navbar-dropdown').hide();
            });
        });
    })(jQuery);
</script>

<script>

    function language(e) {
        location.href = e.currentTarget.getAttribute('data-value');
    }

    document.querySelector('.custom-select-wrapper').addEventListener('click', function () {
        this.querySelector('.custom-select').classList.toggle('open');
    })

    for (const option of document.querySelectorAll(".custom-option")) {
        option.addEventListener('click', function () {
            if (!this.classList.contains('selected')) {
                this.parentNode.querySelector('.custom-option.selected').classList.remove('selected');
                this.classList.add('selected');
                this.closest('.custom-select').querySelector('.custom-select__trigger span').textContent = this.textContent;
            }
        })
    }
</script>

<script>
    $('.count').each(function () {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: 5000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
</script>

<script>
    $('.spotlight_list.owl-carousel').owlCarousel({
        loop: true,
        margin: 15,
        dots: false,
        nav: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 1,
                nav: true
            },
            767: {
                items: 1,
                nav: true
            },
            1000: {
                items: 3,
                nav: true,
                loop: false
            }
        }
    })
</script>

<script>
    $('.certification_list.owl-carousel').owlCarousel({
        loop: true,
        margin: 0,
        dots: false,
        nav: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 4,
                nav: true
            },
            600: {
                items: 4,
                nav: true
            },
            767: {
                items: 4,
                nav: true
            },
            1000: {
                items: 7,
                nav: true,
                loop: false
            }
        }
    })
</script>

<script>
    $('.map_list.owl-carousel').owlCarousel({
        loop: true,
        margin: 15,
        dots: false,
        nav: false,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            600: {
                items: 2,
                nav: false
            },
            1000: {
                items: 4,
                nav: false,
                loop: false
            }
        }
    })
</script>

<script>
    /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }
</script>

<script>

    function get_action(form) {
        var v = grecaptcha.getResponse();
        if (v.length == 0) {
            document.getElementById('captcha').innerHTML = "You can't leave Captcha Code empty";
            return false;
        } else {
            document.getElementById('captcha').innerHTML = "Captcha completed";
            return true;
        }
    }

</script>

<script>
    $('.journey_list.owl-carousel').owlCarousel({
        loop: true,
        margin: 40,
        dots: false,
        nav: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 2,
                nav: true
            },
            1000: {
                items: 4,
                nav: true,
                loop: false
            }
        }
    });
</script>

<script>
    $(document).ready(function () {
        $('#horizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true,   // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#tabInfo');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });
        $('#verticalTab').easyResponsiveTabs({
            type: 'vertical',
            width: 'auto',
            fit: true
        });
    });
</script>

<script type="text/javascript">
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 400) {
            $(".header").addClass("sticky");
        } else {
            $(".header").removeClass("sticky");
        }
    });
</script>

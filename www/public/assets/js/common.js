function language(e) {
    location.href = e.currentTarget.getAttribute("data-value")
}

function get_action(e) {
    return 0 == grecaptcha.getResponse().length ? (document.getElementById("captcha").innerHTML = "You can't leave Captcha Code empty", !1) : (document.getElementById("captcha").innerHTML = "Captcha completed", !0)
}

$(document).ready(function () {
    var e, t = document.getElementsByClassName("dropdown-btn");
    for (e = 0; e < t.length; e++) t[e].addEventListener("click", function () {
        this.classList.toggle("active");
        var e = this.nextElementSibling;
        "block" === e.style.display ? e.style.display = "none" : e.style.display = "block"
    });
    document.querySelector(".custom-select-wrapper").addEventListener("click", function () {
        this.querySelector(".custom-select").classList.toggle("open")
    });
    for (const e of document.querySelectorAll(".custom-option")) e.addEventListener("click", function () {
        this.classList.contains("selected") || (this.parentNode.querySelector(".custom-option.selected").classList.remove("selected"), this.classList.add("selected"), this.closest(".custom-select").querySelector(".custom-select__trigger span").textContent = this.textContent)
    });
    $("#horizontalTab").easyResponsiveTabs({
        type: "default",
        width: "auto",
        fit: !0,
        closed: "accordion",
        activate: function (e) {
            var t = $(this), s = $("#tabInfo");
            $("span", s).text(t.text()), s.show()
        }
    }), $("#verticalTab").easyResponsiveTabs({type: "vertical", width: "auto", fit: !0}), $(window).scroll(function () {
        $(window).scrollTop() >= 400 ? $(".header").addClass("sticky") : $(".header").removeClass("sticky")
    })
}), $(".banner_list.owl-carousel").owlCarousel({
    loop: !0,
    margin: 0,
    dots: !0,
    responsiveClass: !0,
    responsive: {0: {items: 1, nav: !1}, 600: {items: 1, nav: !1}, 1000: {items: 1, nav: !1, loop: !1}}
}), function (e) {
    e(function () {
        e("#navbar-toggle").click(function () {
            e("nav ul").slideToggle()
        }), e("#navbar-toggle").on("click", function () {
            this.classList.toggle("active")
        }), e("nav ul li a:not(:only-child)").click(function (t) {
            e(this).siblings(".navbar-dropdown").slideToggle("slow"), e(".navbar-dropdown").not(e(this).siblings()).hide("slow"), t.stopPropagation()
        }), e("html").click(function () {
            e(".navbar-dropdown").hide()
        })
    })
}(jQuery), $(".count").each(function () {
    $(this).prop("Counter", 0).animate({Counter: $(this).text()}, {
        duration: 5e3, easing: "swing", step: function (e) {
            $(this).text(Math.ceil(e))
        }
    })
}), $(".spotlight_list.owl-carousel").owlCarousel({
    loop: !0,
    margin: 15,
    dots: !1,
    nav: !0,
    responsiveClass: !0,
    responsive: {
        0: {items: 1, nav: !0},
        600: {items: 1, nav: !0},
        767: {items: 1, nav: !0},
        1000: {items: 3, nav: !0, loop: !1}
    }
}), $(".certification_list.owl-carousel").owlCarousel({
    loop: !0,
    margin: 0,
    dots: !1,
    nav: !0,
    responsiveClass: !0,
    responsive: {
        0: {items: 4, nav: !0},
        600: {items: 4, nav: !0},
        767: {items: 4, nav: !0},
        1000: {items: 7, nav: !0, loop: !1}
    }
}), $(".map_list.owl-carousel").owlCarousel({
    loop: !0,
    margin: 15,
    dots: !1,
    nav: !1,
    responsiveClass: !0,
    responsive: {0: {items: 1, nav: !1}, 600: {items: 2, nav: !1}, 1000: {items: 4, nav: !1, loop: !1}}
}), $(".journey_list.owl-carousel").owlCarousel({
    loop: !0,
    margin: 40,
    dots: !1,
    nav: !0,
    responsiveClass: !0,
    responsive: {0: {items: 1, nav: !0}, 600: {items: 2, nav: !0}, 1000: {items: 4, nav: !0, loop: !1}}
}), $(document).ready(function () {
    $(this).scrollTop(0)
});

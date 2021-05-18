/*

Lottie by: Jeffrey Christopher

https://lottiefiles.com/zeffchris

*/

const scrollbar = Scrollbar.init(document.querySelector(".lottie_container"), {
    renderByPixels: false
});

let lottieProgress = lottie.loadAnimation({
    container: document.querySelector(".lottie-progress"),
    renderer: "svg",
    loop: false,
    autoplay: false,
    path: window.origin+"/assets/js/nutrafinal.json"
});

scrollbar.addListener(() => {
    let totalHeight = scrollbar.limit.y;
    let scrollFromTop = scrollbar.scrollTop;
    let scrollPercentage = (scrollFromTop * 100) / totalHeight;
    let scrollPercentRounded = Math.round(scrollPercentage); // Just in case
    lottieProgress.goToAndStop(
        (scrollPercentage * lottieProgress.totalFrames) / 100,
        true
    );
});

scrollbar.scrollTo(0, 700, 10000);

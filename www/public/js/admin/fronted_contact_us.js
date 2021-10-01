function chnageLocation(e) {
    var hasClass = e.currentTarget.classList.contains('active');
    $(document).find('.active_map_box').removeClass('active_map_box');
    var link = e.currentTarget.getAttribute('data-map-link');

    if (hasClass) {
        $("#" + e.currentTarget.getAttribute('id')).removeClass("active_map_box");
    }else{
        $("#" + e.currentTarget.getAttribute('id')).addClass("active_map_box");
    }

    $("#map").attr('src',link);
}

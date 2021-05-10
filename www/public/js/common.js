$('document').ready(function() {

    //Update profile modal
    $(document).on('click', '.update_profile', function (e) {
        mApp.blockPage({
            overlayColor: "#000000",
            type: "loader",
            state: "success",
            message: please_wait
        });

        var url = $(this).data('url');
        $.ajax({
            headers: {
                'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
            },
            type: "get",
            url: url,
            success: function (result) {
                $('#updateProfileModalContent').html(result);
                mApp.unblockPage();
                $('#updateProfileModal').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mApp.unblockPage();
            }
        });
    });

    $(document).on('submit', '#update-profile-form', function (e) {
        if ($(this).valid()) {
            mApp.block("#updateProfileModal .modal-content", {
                overlayColor: "#000000",
                type: "loader",
                state: "success",
                message: please_wait
            });
        }
    });

    //Change password modal
    $(document).on('click', '.change_password', function (e) {
        mApp.blockPage({
            overlayColor: "#000000",
            type: "loader",
            state: "success",
            message: please_wait
        });
        $('#changePasswordModal').modal('show');
        mApp.unblockPage();
    });

    $(document).on('submit', '#change-password-form', function (e) {
        if ($(this).valid()) {
            mApp.block("#changePasswordModal .modal-content", {
                overlayColor: "#000000",
                type: "loader",
                state: "success",
                message: please_wait
            });
        }
    });

    $(document).on('blur', '.googleGu-source', function (e) {
        var ele = $(this);
        var ele_id = $(this).attr('id');
        var target_ele = $('.googleGu-target[source=' + ele_id + ']');

        $.ajax({
            headers: {
                'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
            },
            type: "get",
            url: '/google-translate/'+ele.val(),
            success: function (result) {
                target_ele.val(result.data);
                target_ele.attr('extra_text', result.data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
            }
        });
    });

    $(document).on('blur', '.googleGu-target, .googleGu', function (e) {
        var ele = $(this);
        $.ajax({
            headers: {
                'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
            },
            type: "get",
            url: '/google-translate/'+ele.val(),
            success: function (result) {
                ele.val(result.data);
                ele.attr('extra_text', result.data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
            }
        });
    });

    $(document).on('keyup', '.googleGu-target, .googleGu', function (e) {
        var ele = $(this);
        var extra_text = ele.attr('extra_text');

        if (event.keyCode == 32 && extra_text.trim() != ele.val().trim()) {
            $.ajax({
                headers: {
                    'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                },
                type: "get",
                url: '/google-translate/' + ele.val(),
                success: function (result) {
                    ele.val(result.data);
                    ele.attr('extra_text', result.data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                }
            });
        }
    });

    $(".select2").select2({
        language: {
            noResults: function (params) {
                return select2_no_record;
            }
        },
        containerCssClass: class_select2,
        dropdownCssClass: class_select2
    });

    $(".withoutsearch-select2").select2({
        language: {
            noResults: function (params) {
                return select2_no_record;
            }
        },
        containerCssClass: class_select2,
        dropdownCssClass: class_select2,
        minimumResultsForSearch: Infinity
    });

    $(".digit-select2").select2({
        language: {
            noResults: function (params) {
                return select2_no_record;
            }
        },
        containerCssClass: "digit_nilkanth",
        dropdownCssClass: "digit_nilkanth",
        minimumResultsForSearch: Infinity
    });
});
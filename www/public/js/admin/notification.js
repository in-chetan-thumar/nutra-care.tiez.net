$(document).ready(function () {

    //Load list
    fetch_list($('#filter-form').serialize());

    //Add modal
    $('.add_record').click(function (e) {
        $('#addNotificationModal').find('form').trigger('reset');
        $('#addNotificationModal').modal('show');
    });

    $('#add-notification-form').on('submit', function (e) {
        if ($(this).valid()) {
            e.preventDefault();

            mApp.block("#addNotificationModal .modal-content", {
                overlayColor: "#000000",
                type: "loader",
                state: "success",
                message: "Please wait..."
            });

            var url = $(this).attr('action');
            var formData = new FormData(this);

            $.ajax({
                headers: {
                    'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                },
                url: url,
                type: "post",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                enctype: 'multipart/form-data',
                success: function (result) {
                    mApp.unblock("#addNotificationModal .modal-content");
                    $('#addNotificationModal').modal('hide');
                    if (result.status == 'success') {
                        toastr.success(result.message);
                    } else {
                        toastr.error(result.message);
                    }
					
                    fetch_list();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    mApp.unblock("#addNotificationModal .modal-content");
                }
            });
        }
    });

    //Pagination
    $(document).on('click', '.pagination li a', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        fetch_list($('#filter-form').serialize(), url);
    });    


});

function fetch_list(data = {}, url = index_url) {
    mApp.blockPage({
        overlayColor: "#000000",
        type: "loader",
        state: "success",
        message: "Please wait..."
    });

    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
        },
        type: "get",
        url: url,
        data: data,
        success: function (result) {
            $('#data-list').html(result);
            mApp.unblockPage();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            mApp.unblockPage();
        }
    });
}

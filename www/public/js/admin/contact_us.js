$(document).ready(function () {

    //Load list
    fetch_list($('#filter-form').serialize());

});

//Edit Contact modal
$(document).on('click', '.replay_model', function (e) {
    $("#form-contact").attr('action',$(this).data('url'));
    $('#replayContactModal').modal('show');
});

$(document).on('submit', '#form-contact', function (e) {
    if ($(this).valid()) {
        e.preventDefault();

        mApp.block("#replayContactModal .modal-content", {
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
                mApp.unblock("#replayContactModal .modal-content");
                $('#replayContactModal').modal('hide');
                if (result.status == 'success') {
                    toastr.success(result.message);
                } else {
                    toastr.error(result.message);
                }
                $("#description").val('');
                fetch_list($('#filter-form').serialize());
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mApp.unblock("#replayContactModal .modal-content");
            }
        });
    }
});

//Delete user
$(document).on('click', '.delete_record', function (e) {
    var url = $(this).data('url');
    swal({
        title: "Are you sure you want to delete this contact.?",
        text: "It will delete and you won't be able to revert this!",
        type: "warning",
        showCancelButton: !0,
        confirmButtonText: "Yes",
        cancelButtonText: "No",
    }).then(function (e) {
        if (e.value) {
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
                type: "delete",
                url: url,
                success: function (result) {
                    mApp.unblockPage();
                    if (result.status == 'success') {
                        toastr.success(result.message);
                    } else {
                        toastr.error(result.message);
                    }
                  fetch_list()
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    mApp.unblockPage();
                }
            });
        }
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



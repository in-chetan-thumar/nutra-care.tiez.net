$(document).ready(function () {

    //Load list
    fetch_list($('#filter-form').serialize());

    //Add modal
    $('.add_record').click(function (e) {
        $('#addNewsModal').find('form').trigger('reset');
        $('#addNewsModal').modal('show');
    });

    $('#add-news-form').on('submit', function (e) {
        if ($(this).valid()) {
            e.preventDefault();

            mApp.block("#addNewsModal .modal-content", {
                overlayColor: "#000000",
                type: "loader",
                state: "success",
                message: "Please wait..."
            });
			updateAllMessageForms();

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
                    mApp.unblock("#addNewsModal .modal-content");
                    $('#addNewsModal').modal('hide');
                    if (result.status == 'success') {
                        toastr.success(result.message);
                    } else {
                        toastr.error(result.message);
                    }
                    $('form.filters').trigger('reset');
                    $('form.filters').find('select[name="filters[category]"]').val('');
                    $('#filter-form').find('input[name="filters[category]"]').val('');
                    fetch_list();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    mApp.unblock("#addNewsModal .modal-content");
                }
            });
        }
    });

    //Edit News modal
    $(document).on('click', '.edit_record', function (e) {
        mApp.blockPage({
            overlayColor: "#000000",
            type: "loader",
            state: "success",
            message: "Please wait..."
        });

        var url = $(this).data('url');
        $.ajax({
            headers: {
                'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
            },
            type: "get",
            url: url,
            success: function (result) {
                $('#editModalContent').html(result);
                mApp.unblockPage();
                $('#editNewsModal').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mApp.unblockPage();
            }
        });
    });

    $(document).on('submit', '#edit-news-form', function (e) {
        if ($(this).valid()) {
            e.preventDefault();

            mApp.block("#editNewsModal .modal-content", {
                overlayColor: "#000000",
                type: "loader",
                state: "success",
                message: "Please wait..."
            });
			updateAllMessageForms();
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
                    mApp.unblock("#editNewsModal .modal-content");
                    $('#editNewsModal').modal('hide');
                    if (result.status == 'success') {
                        toastr.success(result.message);
                    } else {
                        toastr.error(result.message);
                    }
                    fetch_list($('#filter-form').serialize());
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    mApp.unblock("#editNewsModal .modal-content");
                }
            });
        }
    });

    //Delete news
    $(document).on('click', '.delete_record', function (e) {
        var url = $(this).data('url');
        swal({
            title: "Are you sure you want to delete this?",
            text: "You won't be able to revert this!",
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
                        fetch_list($('#filter-form').serialize());
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        mApp.unblockPage();
                    }
                });
            }
        });
    });

    //Filters
    $(document).on('change', '#filter_category', function (e) {
        $('#filter-form').find('input[name="filters[category]"]').val($(this).val());
        fetch_list($('#filter-form').serialize());
    });

    //Search
    $(document).on('click', '#search-btn', function (e) {
        $('#filter-form').find('input[name="filters[search]"]').val($('#search').val());
        fetch_list($('#filter-form').serialize());
    });

    //Pagination
    $(document).on('click', '.pagination li a', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        fetch_list($('#filter-form').serialize(), url);
    });

    //Filters
    $(document).on('change', '.cover_type', function (e) {
        var covr_type = $(this).val();
        if(covr_type == 'IMAGE'){
            $('.news_doc_div').show();
            $('.cover_video_url_div').hide();
        } else {
            $('.news_doc_div').hide();
            $('.cover_video_url_div').show();
        }
    });
});

function updateAllMessageForms(){
	 for (instance in CKEDITOR.instances) {
		 CKEDITOR.instances[instance].updateElement();
	 }
}
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

function reset_search() {
    $('form.filters').find('input[name="filters[search]"]').val('');
    $('#filter-form').find('input[name="filters[search]"]').val('');
    fetch_list($('#filter-form').serialize());
}

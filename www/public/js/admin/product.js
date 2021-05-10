$(document).ready(function () {

    //Load list
    fetch_list($('.filters').serialize());
    $('.category').select2({
        width: "resolve"
    });
});

//add page modal
$(document).on('click', '.add_record', function (e) {
    $('#add-product-model').modal('show');
});

$(document).on('submit', '#form-product', function (e) {
    if ($(this).valid()) {
        e.preventDefault();

        mApp.block("#add-product-model .modal-content", {
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
                mApp.unblock("#add-product-model .modal-content");
                if (result.status == 'success') {
                    toastr.success(result.message);
                } else {
                    toastr.error(result.message);
                }
                $("#title").val('');
                $("#description").val('');
                $("#photo").val('');
                $("#slug").val('');
                $('#add-product-model').modal('hide');
                fetch_list($('.filters').serialize());
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mApp.unblock("#add-product-mode .modal-content");
            }
        });
    }
});


//Edit user modal
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
            $('#editProductModalContent').html(result);
            mApp.unblockPage();
            $('#editProductModal').modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            mApp.unblockPage();
        }
    });
});

$(document).on('submit', '#edit-product-form', function (e) {
    if ($(this).valid()) {
        e.preventDefault();

        mApp.block("#editProductModal .modal-content", {
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
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            data: formData,
            success: function (result) {
                mApp.unblock("#editProductModal .modal-content");
                $('#editProductModal').modal('hide');
                if (result.status == 'success') {
                    toastr.success(result.message);
                } else {
                    toastr.error(result.message);
                }
                fetch_list($('.filter-form').serialize());
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mApp.unblock("#editProductModal .modal-content");
            }
        });
    }
});



//Delete user
$(document).on('click', '.delete_record', function (e) {
    var url = $(this).data('url');
    swal({
        title: "Are you sure you want to delete this Product.?",
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

//Filters
$(document).on('change', '#filter_category', function (e) {
    $('.filters').find('input[name="filters[category]"]').val($(this).val());
    fetch_list($('.filters').serialize());
});

//Search
$(document).on('click', '#search-btn', function (e) {
    $('.filters').find('input[name="filters[search]"]').val($('#search').val());
    fetch_list($('.filters').serialize());
});

//Pagination
$(document).on('click', '.pagination li a', function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    fetch_list($('.filters').serialize(), url);
});

function reset_search() {
    $('.filters').find('input[name="filters[search]"]').val('');
    fetch_list($('.filters').serialize());
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
            $('#data-list-page').html(result);
            mApp.unblockPage();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            mApp.unblockPage();
        }
    });
}



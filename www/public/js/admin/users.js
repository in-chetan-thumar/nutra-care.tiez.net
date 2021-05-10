$(document).ready(function () {

    //Load list
    fetch_list($('#filter-form').serialize());

    //Add modal
    $('.add_record').click(function (e) {
        $('#addUserModal').find('form').trigger('reset');
        $('#addUserModal').modal('show');
    });

    $('#add-user-form').on('submit', function (e) {
        if ($(this).valid()) {
            e.preventDefault();

            mApp.block("#addUserModal .modal-content", {
                overlayColor: "#000000",
                type: "loader",
                state: "success",
                message: "Please wait..."
            });

            var url = $(this).attr('action');
            $.ajax({
                headers: {
                    'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                },
                url: url,
                type: "post",
                data: $(this).serialize(),
                success: function (result) {
                    mApp.unblock("#addUserModal .modal-content");
                    $('#addUserModal').modal('hide');
                    if (result.status == 'success') {
                        toastr.success(result.message);
                    } else {
                        toastr.error(result.message);
                    }
                    $('form.filters').trigger('reset');
                    $('form.filters').find('select[name="filters[role]"]').val('');
                    $('#filter-form').find('input[name="filters[role]"]').val('');
                    fetch_list();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    mApp.unblock("#addUserModal .modal-content");
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
                $('#editModalContent').html(result);
                mApp.unblockPage();
                $('#editUserModal').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mApp.unblockPage();
            }
        });
    });

    $(document).on('submit', '#edit-user-form', function (e) {
        if ($(this).valid()) {
            e.preventDefault();

            mApp.block("#editUserModal .modal-content", {
                overlayColor: "#000000",
                type: "loader",
                state: "success",
                message: "Please wait..."
            });

            var url = $(this).attr('action');
            $.ajax({
                headers: {
                    'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                },
                url: url,
                type: "post",
                data: $(this).serialize(),
                success: function (result) {
                    mApp.unblock("#editUserModal .modal-content");
                    $('#editUserModal').modal('hide');
                    if (result.status == 'success') {
                        toastr.success(result.message);
                    } else {
                        toastr.error(result.message);
                    }
                    fetch_list($('#filter-form').serialize());
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    mApp.unblock("#editUserModal .modal-content");
                }
            });
        }
    });

    //Delete user
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
    $(document).on('change', '#filter_role', function (e) {
        $('#filter-form').find('input[name="filters[role]"]').val($(this).val());
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

function reset_search() {
    $('form.filters').find('input[name="filters[search]"]').val('');
    $('#filter-form').find('input[name="filters[search]"]').val('');
    fetch_list($('#filter-form').serialize());
}

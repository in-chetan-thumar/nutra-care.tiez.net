$(document).ready(function () {

    //Load list
    fetch_list($('.filters').serialize());

    disableInquiryBtn();
    changeProductText();
    $(".productCount").text(countProduct())

})

var count = 0;

function selectProduct(e) {

    var id = e.currentTarget.getAttribute('id');
    var product_id = e.currentTarget.getAttribute('data-product-id');
    var hasClass = document.getElementById(`product-box-${product_id}`).classList.contains('active');

    if (hasClass) {
        $("#product-box-" + id).removeClass("active");
        removeLocalStorage(product_id)
        $(".productCount").text(countProduct())
    } else {
        $("#product-box-" + id).addClass("active");
        const arr_attribute_id = [];
        const arr_checkbox_id = [];
        const product_attribute = {
            'attribute_id': arr_attribute_id,
            'product_id': product_id,
            'checkbox_id':arr_checkbox_id,
        }
        saveLocalStorage(product_id, JSON.stringify(product_attribute))
        $(".productCount").text(countProduct())
    }
}

function reset_search() {
    $('.filters').find('input[name="filters[search]"]').val('');
    fetch_list($('.filters').serialize());
}

function loadProduct(e) {
    e.preventDefault()
    fetch_list('', e.currentTarget.getAttribute('data-url'));
}

function filterRecoard() {
    filter_list($('.filters').serialize());
}
function filter_list(data = {}) {

   var url = window.origin+"/search-product";
    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
        },
        type: "get",
        url: url,
        data: data,
        success: function (products) {
                $("#productDisplayBox").html('');
                $("#productDisplayBox").html(products);
                readLoacalstorage()

        },
        error: function (jqXHR, textStatus, errorThrown) {
        }
    });
}
// function fetch_list(data = {}, url = index_url) {
//     $.ajax({
//         headers: {
//             'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
//         },
//         type: "get",
//         url: url,
//         data: data,
//         success: function (result) {
//             $('.product-list').html(result);
//             readLoacalstorage()
//         },
//         error: function (jqXHR, textStatus, errorThrown) {
//         }
//     });
// }

$(document).on('submit', '#form-inquiry', function (e) {
        e.preventDefault();
            $('.btnInquiry').attr("disabled", true);
            var url = $(this).attr('action');
            var productList = readLoacalstorage();
            var formData = new FormData(this);
            formData.append('product_list', JSON.stringify(productList))

            $.ajax({
                headers: {
                    'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                },
                url: url,
                type: "post",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                enctype: 'multipart/form-data',

                success: function (result) {
                    $('.btnInquiry').attr("disabled", false);
                    $('#inquiryModal').modal('hide');
                    disableInquiryBtn();
                    changeProductText();
                    $(".productCount").text(countProduct())
                    $('.success_modal').modal('show');
                    localStorage.clear();
                },
                error: function (reject) {
                    $('.btnInquiry').attr("disabled", true);
                    var errors = $.parseJSON(reject.responseText);
                    $(".erroInquiry").html(errors)
                }
            });

});

function getValue(e) {
    const arr_checkbox_id = [];
    var product_id = e.currentTarget.getAttribute('data-product-id')
    var checkbox_id = e.currentTarget.getAttribute('data-checkbox-id')
    var category = e.currentTarget.getAttribute('data-category')
    var product_attribute = null;

    // selectProduct(event)

    if (localStorage.getItem(product_id) != null) {

        var data = JSON.parse(localStorage.getItem(product_id));

        if (e.target.checked) {

            $("#product-box-" + product_id).addClass("active");
            $.each(data['checkbox_id'], function (index, value) {
                arr_checkbox_id.push(value);
            })
            arr_checkbox_id.push(checkbox_id);

        } else {

            $.each(data['checkbox_id'], function (index, value) {
                if (value != checkbox_id){
                    arr_checkbox_id.push(value);
                }
            })
        }
        if( arr_checkbox_id.length == 0){
            $("#product-box-" + product_id).removeClass("active");
            removeLocalStorage(product_id)
            disableInquiryBtn();
            changeProductText();
            $(".productCount").text(countProduct())
        }else{
            product_attribute = {
                'product_id': product_id,
                'checkbox_id':arr_checkbox_id,
            }
            saveLocalStorage(product_id, JSON.stringify(product_attribute))
            disableInquiryBtn();
            changeProductText();
            $(".productCount").text(countProduct())
        }


    } else {

        $("#product-box-" + product_id).addClass("active");

        arr_checkbox_id.push(checkbox_id);

        product_attribute = {
            'product_id': product_id,
            'checkbox_id':arr_checkbox_id,
        }
        saveLocalStorage(product_id, JSON.stringify(product_attribute))
        disableInquiryBtn();
        changeProductText();
        $(".productCount").text(countProduct())
    }

}

function saveLocalStorage(key, value) {
    if (localStorage.getItem(key) != null) {
        localStorage.setItem(key, value)
    } else {
        localStorage.setItem(key, value)
    }
}

function removeLocalStorage(key) {
    if (localStorage.getItem(key) != null) {
        localStorage.removeItem(key)
    }
}

function readLoacalstorage() {
    var values = [], keys = Object.keys(localStorage)

    for (let i = 0; i < keys.length; i++) {
        // if (keys[i] != "_grecaptcha") {

            $("#product-box-" + keys[i]).addClass("active");
            var data  = JSON.parse(localStorage.getItem(keys[i]))

            $.each(data['checkbox_id'], function (index, value) {
                $("#"+value).prop("checked", true );;
            })

            values.push({"name": keys[i], "value": JSON.parse(localStorage.getItem(keys[i]))});
       // }
    }
    return values.sort((a, b) => (a.step > b.step) ? 1 : -1);
}

function countProduct() {
    var values = [], keys = Object.keys(localStorage)

    for (let i = 0; i < keys.length; i++) {
        if (keys[i] != "_grecaptcha") {
            values.push({"name": keys[i], "value": JSON.parse(localStorage.getItem(keys[i]))});
        }
    }
    return values.length
}

$(document).on('hide.bs.modal', '#exampleModal1', function () {
    disableInquiryBtn();
    changeProductText();
    $(".productCount").text(countProduct())
    location.reload()
});

function isValidCaptcha() {
    error = false;
    if (localStorage.getItem('_grecaptcha')) {
        error = true
    }
    if (countProduct() == 0) {
        error = true
    }
    return error
}

$(document).on('show.bs.modal', '#inquiryModal', function () {
    if (localStorage.getItem('_grecaptcha')) {
        localStorage.removeItem('_grecaptcha')
    }
});
function getProduct(categories,url) {
    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
        },
        type: "post",
        url: url,
        data:{id:categories},
        success: function (result) {
            $('.product-list').html(result);
            readLoacalstorage()
        },
        error: function (jqXHR, textStatus, errorThrown) {
        }
    });
}

$(document).ready(function () {

    var categories = [];

    $('#treeview').on('change', function (e) {
        e.preventDefault();
        filterProduct()
    });

    $(".clearFilter").on('click',function () {
        var treeView = $("#treeview").data("kendoTreeView");
        // Refresh the TreeView
        treeView.dataSource.read(); // This reloads the data from the data source
        treeView.refresh();
        // $('input[name="categories[]"]').prop('checked',false);
        // localStorage.clear()
        // disableInquiryBtn();
        // changeProductText();
        // $(".productCount").text(countProduct())
        // filterProduct();
    })

});
function deselectAll() {
    if(countProduct() !== 0) {

        // $('input[name="categories[]"]').prop('checked',false);
        localStorage.clear()
        disableInquiryBtn();
        // changeProductText();
        // $(".productCount").text(countProduct())
        filterProduct();
        $("#productDisplayBox").load(window.location + "#productDisplayBox");
    }
    else {
            alert('Product is not selected.')
        }
}
function onlySelectShow() {
    if(countProduct() !== 0) {

        // var treeView = $("#treeview").data("kendoTreeView");
        // treeView.dataSource.read(); // This reloads the data from the data source

        var url = window.origin + "/select-all";
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "post", // Replace with the appropriate HTTP method
            url: url, // Replace with your Laravel route
            data: {products: Object.keys(localStorage)},
            success: function (products) {
                // Update the product display box with the retrieved products
                if (products !== '') {
                    $("#productDisplayBox").html('');
                    $("#productDisplayBox").html(products);
                    // $("#product-box-" + Object.keys(localStorage)).addClass("active");
                    $("#deselect-all").hide();
                    $("#show-only-selected").hide();
                    var button = document.getElementById("show-all-selected");
                    var shouldShowButton = true; // Replace this with your condition
                    if (shouldShowButton) {
                        button.removeAttribute("hidden");
                    }
                }
            }
        });
    }
    else {
        alert('please select product.')
    }

}
function showAllProducts() {

    var checkedNodes = [],
        treeView = $("#treeview").data("kendoTreeView"),
        message;
    checkedNodeIds(treeView.dataSource.view(), checkedNodes);

    if (checkedNodes.length > 0) {
        message =  checkedNodes.join(",");
    }
    // Fetch and display products associated with selected categories via AJAX
     var url = window.origin+"/products";
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: "post", // Replace with the appropriate HTTP method
        url: url, // Replace with your Laravel route

        data: { categories: message },

        success: function (products) {
            // Update the product display box with the retrieved products
            if(products !== ''){
                $("#productDisplayBox").html('');
                $("#productDisplayBox").html(products);
                readLoacalstorage()

            }
            else{
    readLoacalstorage()
    $("#productDisplayBox").load(url + "#productDisplayBox");

            }

        }
    });
}
function filterProduct() {
    categories = [];
    $('input[name="categories[]"]:checked').each(function()
    {
        categories.push($(this).val());
    });

    if(categories.length == 0){
        fetch_list($('.filters').serialize());
    }else{
        getProduct(categories,product_url);

    }
}

function changeProductText() {
    if(countProduct() > 1){
        $(".productText").text('Products');
    }else{
        $(".productText").text('Product');
    }
}

function disableInquiryBtn() {
    if(countProduct() == 0){
        $(".send_inquiry").attr('disabled','disabled');
    }else{
        $(".send_inquiry").removeAttr('disabled');
    }
}


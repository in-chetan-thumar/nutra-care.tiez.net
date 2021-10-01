$(document).ready(function () {

    //Load list
    fetch_list($('.filters').serialize());

    disableInquiryBtn();
    changeProductText();
    $(".productCount").text(countProduct())

})

var count = 0;

// function selectProduct(e) {
//     var hasClass = e.currentTarget.classList.contains('active');
//     var id = e.currentTarget.getAttribute('id');
//     var product_id = e.currentTarget.getAttribute('data-product-id');
//
//     if (hasClass) {
//         $("#" + id).removeClass("active");
//         removeLocalStorage(product_id)
//         $(".productCount").text(countProduct())
//     } else {
//         $("#" + id).addClass("active");
//         const arr_attribute_id = [];
//         const arr_checkbox_id = [];
//         const product_attribute = {
//             'attribute_id': arr_attribute_id,
//             'product_id': product_id,
//             'checkbox_id':arr_checkbox_id,
//         }
//         saveLocalStorage(product_id, JSON.stringify(product_attribute))
//         $(".productCount").text(countProduct())
//     }
// }

function reset_search() {
    $('.filters').find('input[name="filters[search]"]').val('');
    fetch_list($('.filters').serialize());
}

function loadProduct(e) {
    e.preventDefault()
    fetch_list('', e.currentTarget.getAttribute('data-url'));
}

function filterRecoard() {
    fetch_list($('.filters').serialize());
}

function fetch_list(data = {}, url = index_url) {
    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
        },
        type: "get",
        url: url,
        data: data,
        success: function (result) {
            $('.product-list').html(result);
            readLoacalstorage()
        },
        error: function (jqXHR, textStatus, errorThrown) {
        }
    });
}

$(document).on('submit', '#form-inquiry', function (e) {
    if ($(this).valid()) {
        e.preventDefault();
        if (isValidCaptcha()) {

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
        } else {
            alert('The recaptcha OR You Have Not Select Any Product.!')
        }
    }
});

function getValue(e) {

    const arr_attribute_id = [];
    const arr_checkbox_id = [];
    var product_id = e.currentTarget.getAttribute('data-product-id')
    var checkbox_id = e.currentTarget.getAttribute('data-checkbox-id')
    var attribute_id = e.currentTarget.getAttribute('data-attribute-id')
    var product_attribute = null;

    if (localStorage.getItem(product_id) != null) {

        var data = JSON.parse(localStorage.getItem(product_id));

        if (e.target.checked) {
            $("#product" + product_id).addClass("active");
            $.each(data['checkbox_id'], function (index, value) {
                arr_checkbox_id.push(value);
            })

            $.each(data['attribute_id'], function (index, value) {
                arr_attribute_id.push(value);
            })

            arr_attribute_id.push(attribute_id);
            arr_checkbox_id.push(checkbox_id);

        } else {
            $.each(data['attribute_id'], function (index, value) {
                if (value != attribute_id){
                    arr_attribute_id.push(value);
                }

            })
            $.each(data['checkbox_id'], function (index, value) {
                if (value != checkbox_id){
                    arr_checkbox_id.push(value);
                }
            })
        }
        if(arr_attribute_id.length == 0 || arr_checkbox_id.length == 0){
            $("#product" + product_id).removeClass("active");
            removeLocalStorage(product_id)
            disableInquiryBtn();
            changeProductText();
            $(".productCount").text(countProduct())
        }else{
            product_attribute = {
                'attribute_id': arr_attribute_id,
                'product_id': product_id,
                'checkbox_id':arr_checkbox_id,
            }
            saveLocalStorage(product_id, JSON.stringify(product_attribute))
            disableInquiryBtn();
            changeProductText();
            $(".productCount").text(countProduct())
        }


    } else {

        $("#product" + product_id).addClass("active");

        arr_attribute_id.push(attribute_id);
        arr_checkbox_id.push(checkbox_id);

        product_attribute = {
            'attribute_id': arr_attribute_id,
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
        if (keys[i] != "_grecaptcha") {

            $("#product" + keys[i]).addClass("active");
            var data  = JSON.parse(localStorage.getItem(keys[i]))

            $.each(data['checkbox_id'], function (index, value) {
                $("#"+value).prop("checked", true );;
            })

            values.push({"name": keys[i], "value": JSON.parse(localStorage.getItem(keys[i]))});
        }
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

    $('input[name="categories[]"]').on('change', function (e) {
        e.preventDefault();
        filterProduct()
    });

    $(".clearFilter").on('click',function () {
        $('input[name="categories[]"]').prop('checked',false);
        localStorage.clear()
        disableInquiryBtn();
        changeProductText();
        $(".productCount").text(countProduct())
        filterProduct();
    })

});

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

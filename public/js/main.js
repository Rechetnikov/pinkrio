$(document).ready(function()
{
    $("#closer").on("click", function() {
        $('#product_prise').val("");
        $('#product_id').val("");
    });

    $("#closer_retry").on("click", function() {
        $('#select_filial_retry').val(0);
        $('#product_id').val('');
    });

    $("#retry_product_btn").on("click", function() {
        const $id = $('#product_id').val();
        const $filial = $('#select_filial_retry').val();
        const $token = $("#token").val();
        if($id > 0 && $filial > 0){
            retry_product_one($id, $filial, $token);
        }
        $('#select_filial_retry').val(0);
        $('#product_id').val('');
    });

    $("#filial_product").on("click", ".retry_product_filials", function() {
        $('#product_id').val($(this).attr('id')); 
    });

    $("#filial_product").on("click", "#retry_products_all", function() {
        const $checkedProduct = getCheckedProduct();
        const $filial  = $("#select_redirect").val();
        const $token = $("#token").val();
        if(JSON.parse($checkedProduct).length > 0 && $filial > 0 && $token.length != ''){
            retry_products($checkedProduct, $filial, $token);
        }
    });

    $("#delete_product").on("click", function() {
        const $checkedProduct = getCheckedProduct()
        const $token = $("#token").val();

        if(JSON.parse($checkedProduct).length > 0){
            sales_products($checkedProduct, $token, 'delete');
        }
    });
    
    $("#salest_product_btn").on("click",  function() {
        const $product = $('#product_id').val();
        const $prise = $('#product_prise').val();
        const $token = $("#token").val();
        if($product > 0 && $prise > 0){
            sales_product_one($product,  $prise, $token, 'sales');
        }
        $('#product_prise').val("");
        $('#product_id').val("");
    });

    $("#filial_product").on("click", "#sales_product", function() {
        const $checkedProduct = getCheckedProduct()
        const $token = $("#token").val();
        if(JSON.parse($checkedProduct).length > 0){
            sales_products($checkedProduct, $token, 'sales');
        }
    });
    
    $("#filial_product").on("click", ".sales_product_prise", function() {
        $('#product_prise').val($(this).attr('prise'));
        $('#product_id').val($(this).attr('id'));       
    });

    $("#filial_product").on("click", "#redirect_filial", function() {
        const $checkedProduct = getCheckedProduct()
        const $filial  = $("#select_redirect").val();
        const $token = $("#token").val();
        if(JSON.parse($checkedProduct).length > 0 && $filial > 0 && $token.length != ''){
            redirect_products($checkedProduct, $filial, $token);
        }
    });

    function getCheckedProduct(){
        let $checked = [];
        $('#filial_product .checkboxSuccess:checked').each(function(){
            $checked.push($(this).val())
        });
        return JSON.stringify($checked)
    }

    function sales_products($products, $token, $method) {
        $.ajax({
            type: "POST",
            dataType: "text",
            url: "/filial/update/"+$method,
            data:{
                products: $products,
                '_token': $token
            },
            success: function(data){
                location.reload();
            }
        });
    }

    function sales_product_one($id, $prise, $token, $method) {
        $.ajax({
            type: "POST",
            dataType: "text",
            url: "/filial/update/"+$method+"_one",
            data:{
                id: $id,
                prise: $prise,
                '_token': $token
            },
            success: function(data){
                location.reload();
            }
        });
    }

    function redirect_products($products, $filial, $token) {
        $.ajax({
            type: "POST",
            dataType: "text",
            url: "/filial/update/redirect",
            data:{
                products: $products,
                filial: $filial,
                '_token': $token
            },
            success: function(data){
                location.reload();
            }
        });
    }
    
    function retry_products($products, $filial, $token) {
        $.ajax({
            type: "POST",
            dataType: "text",
            url: "/status/update/retry",
            data:{
                products: $products,
                filial: $filial,
                '_token': $token
            },
            success: function(data){
                // location.reload();
            }
        });
    }

    function retry_product_one($id, $filial, $token) {
        $.ajax({
            type: "POST",
            dataType: "text",
            url: "/status/update/retry_one",
            data:{
                id: $id,
                filial: $filial,
                '_token': $token
            },
            success: function(data){
                location.reload();
            }
        });
    }
});


$(document).ready(function()
{   
    // Очистка полей в окне продаж
    $("#closer").on("click", function() {
        $('#product_prise').val("");
        $('#product_id').val("");
    });

    // Очистка полей в окне взрата одного товара
    $("#closer_retry").on("click", function() {
        $('#select_filial_retry').val(0);
        $('#product_id').val('');
    });

    // Возврат товара
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

    // Вызов окна возврата
    $("#filial_product").on("click", ".retry_product_filials", function() {
        $('#product_id').val($(this).attr('id')); 
    });

    // Возврат выбранных товаров
    $("#filial_product").on("click", "#retry_products_all", function() {
        const $checkedProduct = getCheckedProduct();
        const $filial  = $("#select_redirect").val();
        const $token = $("#token").val();
        if(JSON.parse($checkedProduct).length > 0 && $filial > 0 && $token.length != ''){
            retry_products($checkedProduct, $filial, $token);
        }
    });

    // Удаления товара из базы
    $("#delete_product").on("click", function() {
        const $checkedProduct = getCheckedProduct()
        const $token = $("#token").val();

        if(JSON.parse($checkedProduct).length > 0){
            sales_products($checkedProduct, $token, 'delete');
        }
    });
    
    // Продажа товара по выбранной цене
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

    // Продажа выбранных товаров
    $("#filial_product").on("click", "#sales_product", function() {
        const $checkedProduct = getCheckedProduct()
        const $token = $("#token").val();
        if(JSON.parse($checkedProduct).length > 0){
            sales_products($checkedProduct, $token, 'sales');
        }
    });
    
    // Вызов окна продажы товаров
    $("#filial_product").on("click", ".sales_product_prise", function() {
        $('#product_prise').val($(this).attr('prise'));
        $('#product_id').val($(this).attr('id'));       
    });

    // Перемещеие товара по филиалам
    $("#filial_product").on("click", "#redirect_filial", function() {
        const $checkedProduct = getCheckedProduct()
        const $filial  = $("#select_redirect").val();
        const $token = $("#token").val();
        if(JSON.parse($checkedProduct).length > 0 && $filial > 0 && $token.length != ''){
            redirect_products($checkedProduct, $filial, $token);
        }
    });


    // Возврат списка выбранных товаров
    function getCheckedProduct(){
        let $checked = [];
        $('#filial_product .checkboxSuccess:checked').each(function(){
            $checked.push($(this).val())
        });
        return JSON.stringify($checked)
    }

    // Продажа ajax списка товаров
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

    // Продажа ajax одного товара по выбранной цене
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

    // Перемещения ajax товаров между филиалами
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
    
    // Возврат ajax списка товаров
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
                location.reload();
            }
        });
    }

    // Возврат ajax одного товара
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


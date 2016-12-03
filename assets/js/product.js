$(document).ready(function () {
    var validate = function () {};
    validate.prototype.required = function (value) {
        return value.length != 0;
    };
    validate.prototype.isFloat = function (value) {
        return !isNaN(value) && value.toString().indexOf('.') != -1;
    };
    validate.prototype.isNumber = function (value) {
        return !isNaN(value) && value.toString().indexOf('.') == -1;
    };

    var filter = function () {};
    filter.prototype.currencyToFloat = function (value) {
        return value.replace(/\./g,'').replace(',','.');
    };
    filter.prototype.firstCapitalLetter = function (value) {
        return value.toUpperCase();
    };

    var products = function (){};
    products.prototype.total = -1;
    products.prototype.currency_config = function () {
        $('.currency').maskMoney({
            thousands: '.',
            decimal: ','
        });
    };
    products.prototype.validate_name = function (i) {
        var success = true;
        var error = document.getElementById('error['+i+'][product_name]');
        var input = document.getElementsByName('products['+i+'][product_name]')[0];

        if (!validate.prototype.required(input.value)){
            error.innerHTML = 'Campo obrigatório!';
            success = false;
        } else {
            error.innerHTML = '';
        }

        return success;
    };
    products.prototype.validate_price = function (i) {
        var success = true;
        var error = document.getElementById('error['+i+'][product_price]');
        var input = document.getElementsByName('products['+i+'][product_price]')[0];

        if (!validate.prototype.required(input.value)) {
            error.innerHTML = 'Campo obrigatório!';
            success = false;
        } else if (!validate.prototype.isFloat(filter.prototype.currencyToFloat(input.value))) {
            error.innerHTML = 'Informe em formato de moeda!';
            success = false;
        } else {
            error.innerHTML = '';
        }

        return success;
    };
    products.prototype.validate_stock_quantity = function (i) {
        var success = true;
        var error = document.getElementById('error['+i+'][product_stock_quantity]');
        var input = document.getElementsByName('products['+i+'][product_stock_quantity]')[0];

        if (!validate.prototype.required(input.value)) {
            error.innerHTML = 'Campo obrigatório!';
            success = false;
        } else if (!validate.prototype.isNumber(input.value)) {
            error.innerHTML = 'Informe apenas números inteiros!';
            success = false;
        } else if (input.value <= 0) {
            error.innerHTML = 'Deve ser maior que 0!';
            success = false;
        } else {
            error.innerHTML = '';
        }

        return success;
    };
    products.prototype.removeFieldset = function (id) {
        products.prototype.total -= 1;
        return $(id).remove();
    };

    products.prototype.currency_config();

    $("#add").click(function () {
        products.prototype.total += 1;
        var template = $("#inputs-product");
        var campos = template.html().replace(/\/__index__\//g, products.prototype.total);
        $("#form-product").append(campos);
        products.prototype.currency_config();
        $('#remove_fieldset_'+products.prototype.total).click(function () {
            products.prototype.removeFieldset('#fieldset_'+products.prototype.total);
        });
    });

    $("#form-product").submit(function (event) {
        event.preventDefault();
        var success = true;
        var i;

        for (i = 0; i <= products.prototype.total; i++) {
            if (!products.prototype.validate_name(i)) success = false;
            if (!products.prototype.validate_price(i)) success = false;
            if (!products.prototype.validate_stock_quantity(i)) success = false;
        }

        if (success === true){
            for (i = 0; i <= products.prototype.total; i++) {
                var input = document.getElementsByName('products[' + i + '][product_price]')[0];
                input.value = filter.prototype.currencyToFloat(input.value);

                input = document.getElementsByName('products[' + i + '][product_name]')[0];
                input.value = filter.prototype.firstCapitalLetter(input.value);
            }

            var post = $.post('?', $('#form-product').serialize());
            post.done(function( data ) {
                $("#form-product input").val('');
                $("#alert").addClass('alert alert-success').append('Produto cadastrado com sucesso!')
                    .hide(5000);
            });
        }
    });
});
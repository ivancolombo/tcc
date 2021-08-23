var maskCelular = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
    celular = {
        onKeyPress: function (val, e, field, options) {
            field.mask(maskCelular.apply({}, arguments), options);
        }
    };

$('.celular').mask(maskCelular, celular);
$('.crm').mask('00000 SS');

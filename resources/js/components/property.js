var validate = require('jquery-validation');
import 'jquery-validation/dist/localization/messages_es';

$(document).ready(function () {
    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });

    var form = $("#frm-property");

   form.validate({
       
       submitHandler: function (form) {
           alert('aqui');
       },
        lang: 'es', 
        errorClass: "text-danger",
        errorLabelContainer: "legend",
        rules: {
            cp: {
                required: true,
                number: true,
                maxlength: 5,
                minlength: 4
            },
            /* email: {
                email: true,
            },
            celular: {
                number: true,
            },
            celular2: {
                number: true,
            },
            telefono: {
                number: true,
            },
            habitacion: {
                number: true,
            },
            banios: {
                number: true,
            } */
        },
       
       
    }); 

    /* $("#property_save").click(function () {
        console.log(form.valid());
        if (form.valid() == true){
            document.getElementById("frm-property").submit();
        }
    }); */

});
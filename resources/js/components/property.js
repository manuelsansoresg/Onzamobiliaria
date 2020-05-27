/* var validate = require('jquery-validation');
import 'jquery-validation/dist/localization/messages_es'; */
const axios = require('axios')
var Swal = require('sweetalert2');

window.userModal = function (property_id) {
    $('#userModal').modal('show');
    $('#property_id').val(property_id);
}

window.addUser = function (user_id) {
    var property_id = $('#property_id').val();

    axios.get
        ('/admin/property/addUser/' + property_id + '/' + user_id)
        .then(function (response) {
           
            location.reload(); 
         })
        .catch(function (error) {

            var result = error.response.data;

            /* $('.spinner-contacto').hide(); */



        })

}

window.changeClient = function(){
    var n_client = ($('#n_client').is(':checked')) ? 1 : 0;
    if(n_client == 0){ 
        $('#d_datos-cliente').show();
        $('#d_inputs-cliente').hide();

        $("#cliente_nombre").attr("required", false);
        $("#cliente_telefono").attr("required", false);

    }else{
        $('#d_inputs-cliente').show();
        $('#d_datos-cliente').hide();

        $("#cliente_nombre").attr("required", true);
        $("#cliente_telefono").attr("required", true);

        $('#cliente_nombre').val('');
        $('#cliente_correo').val('');
        $('#cliente_telefono').val('');
    }
}
 
window.addClient = function(user_id, nombre, correo, telefono){

    if ($("#d_datos-cliente").length > 0) {
        $('#d_datos-cliente').show();
        $('#d_inputs-cliente').hide();
        $("#n_client").prop("checked", false);
        $('.input-edit').val('');
    }

    $('#cve_int_cliente').val(user_id);
    $('#client_name').val(nombre);
    $('#client_email').val(correo);
    $('#client_telefono').val(telefono);
    $('#clientModal').modal('hide');

    $("#cliente_nombre").attr("required", false);
    $("#cliente_telefono").attr("required", false);

}

if ($("#frm_propiedad").length > 0) {
   
    $('#form_pay_id').multiselect({
        templates: {
            li: '<li><a href="javascript:void(0);"><label class="pl-2"></label></a></li>'
        },
        nonSelectedText: 'Choose...',
        selectedClass: 'bg-light',
        onInitialized: function (select, container) {
            // hide checkboxes
            container.find('input').addClass('d-none');
        }
    });
}

$(document).ready(function () {
    window.changeAvaluo = function () {
        var is_avaluo = 0;
        if ($('#is_avaluo').prop('checked')) {
            $('#Avaluo').prop("disabled", false); // Element(s) are now enabled.
        } else {
            $('#Avaluo').prop("disabled", true); // Element(s) are now enabled.
        }
    }
});



$("#frm_propiedad").submit(function (event) { 
    var formpago = $('#form_pay_id').val();
    var error = false;
    /* var check = $('input:checkbox[name=colorfavorito]:checked').val();
    
    event.preventDefault();  */
    
    console.log('test');

    /* if ($('#n_client').is(':checked')){
        if ($('#client_name').val().length == 0){
            $('#error_cliente').show();
            error = true;
        }else{
            $('#error_cliente').hide();
        }
    }else{
        console.log('nocheck');
    } */

    if(formpago.length==0){
        $('#error_formapago').show();
    }else{
        $('#error_formapago').hide();
    }

    if(error == false){
        $("#frm_propiedad").submit();
    }
});
$("#cuota_mantenimiento").on({
    "focus": function(event) {
      $(event.target).select();
    },
    "keyup": function(event) {
      $(event.target).val(function(index, value) {
        return value.replace(/\D/g, "")
          .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
      });
    }
  });
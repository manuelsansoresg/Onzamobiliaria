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

// formatea un numero según una mascara dada ej: "-$###,###,##0.00"
//
// elm   = elemento html <input> donde colocar el resultado
// n     = numero a formatear
// mask  = mascara ej: "-$###,###,##0.00"
// force = formatea el numero aun si n es igual a 0
//
// La función devuelve el numero formateado
/*
function FORMATMASK(form, n, mask, format) {
    if (format == "undefined") format = false;
    if (format || NUM(n)) {
      dec = 0, point = 0;
      x = mask.indexOf(".")+1;
      if (x) { dec = mask.length - x; }
  
      if (dec) {
        n = NUM(n, dec)+"";
        x = n.indexOf(".")+1;
        if (x) { point = n.length - x; } else { n += "."; }
      } else {
        n = NUM(n, 0)+"";
      } 
      for (var x = point; x < dec ; x++) {
        n += "0";
      }
      x = n.length, y = mask.length, XMASK = "";
      while ( x || y ) {
        if ( x ) {
          while ( y && "#0.".indexOf(mask.charAt(y-1)) == -1 ) {
            if ( n.charAt(x-1) != "-")
              XMASK = mask.charAt(y-1) + XMASK;
            y--;
          }
          XMASK = n.charAt(x-1) + XMASK, x--;
        } else if ( y && "$0".indexOf(mask.charAt(y-1))+1 ) {
          XMASK = mask.charAt(y-1) + XMASK;
        }
        if ( y ) { y-- }
      }
    } else {
       XMASK="";
    }
    if (form) { 
      form.value = XMASK;
      if (NUM(n)<0) {
        form.style.color="#FF0000";
      } else {
        form.style.color="#000000";
      }
    }
    return XMASK;
  }
  
  // Convierte una cadena alfanumérica a numérica (incluyendo formulas aritméticas)
  //
  // s   = cadena a ser convertida a numérica
  // dec = numero de decimales a redondear
  //
  // La función devuelve el numero redondeado
  
  function NUM(s, dec) {
    for (var s = s+"", num = "", x = 0 ; x < s.length ; x++) {
      c = s.charAt(x);
      if (".-+/*".indexOf(c)+1 || c != " " && !isNaN(c)) { num+=c; }
    }
    if (isNaN(num)) { num = eval(num); }
    if (num == "")  { num=0; } else { num = parseFloat(num); }
    if (dec != undefined) {
      r=.5; if (num<0) r=-r;
      e=Math.pow(10, (dec>0) ? dec : 0 );
      return parseInt(num*e+r) / e;
    } else {
      return num;
    }
  }

*/




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



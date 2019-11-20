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
 
window.addClient = function(cve){
    $('#cve_int_cliente').val(cve);
    $('#clientModal').modal('hide');
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





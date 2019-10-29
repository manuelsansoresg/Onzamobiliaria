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
            Swal.fire({
                title: 'OK',
                text: 'Usiario asignado',
                type: 'success',
            });
         })
        .catch(function (error) {

            var result = error.response.data;

            /* $('.spinner-contacto').hide(); */



        })

}
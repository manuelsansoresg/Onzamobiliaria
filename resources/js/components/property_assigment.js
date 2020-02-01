const axios = require('axios')
var Swal = require('sweetalert2');
var table;
var ref;

$(document).ready(function () {



    /*table       = $('#property_assigment').DataTable({
        paging: false,
        "ajax": '/admin/property/getAll?filtro=' + filtro + '&campo=' + campo,


    });

    table.destroy();*/
    /*getProperties();*/
    /*setTimeout(function () {
        $('#body_assigment').html();
        setInterval(getProperties, 100000);
    }, 300);*/

    /*setTimeout(getProperties(), 300);*/

    var table = $('#table_property_assigment').DataTable( {
        "ajax":'/admin/property/getAll',
        "order": [[ 0, 'desc' ]]
    } );

    setInterval( function () {
        try {
            table.ajax.reload();
        }
        catch(error) {
            console.error(error);
        }


    }, 100000);

});

window.viewMore = function(property_assignment_id){
    $('#moreSection').modal('show');
    $('#body_more').html('');
    axios.get
    ('/admin/property_assignment/view_more/' + property_assignment_id)
        .then(function (response) {
            var result = response.data;
            $('#body_more').html(result);
        })
        .catch(function (error) {



        })
}

window.searchEasyBroker = function(){
    var easy_broker = $('#easy_broker').val();

    $('#error_easy').html('');

    if(easy_broker == ''){
        $('#error_easy').html('El campo easy broker esta vacio');
    }else{
        axios.get
            ('/admin/propiedad/search/easybroker/' + easy_broker)
            .then(function (response) {
                var result = response.data.property;
                var total = response.data.total;

                if (total  > 0) {
                    $('#val_propiedad').html(result.tipo);
                    $('#val_operacion').html(result.operacion);
                    $('#val_colonia').html(result.colonia);
                    $('#val_asesor').html(result.asesor);
                    $('#val_precio').html(result.price);
                }else{
                    $('#error_easy').html('El campo easy broker seleccionado no existe.');
                }


            })
            .catch(function (error) {



            })
    }
}

function getProperties() {
    var filtro  = $('#filtro').val();
    var campo   = $('#campo').val();
    /*table.ajax.reload();*/
    axios.get
    ('/admin/property/getAll?filtro=' + filtro + '&campo=' + campo)
        .then(function (response) {
            var result = response.data;




        })
        .catch(function (error) {

        })

}

const axios = require('axios')
var Swal = require('sweetalert2');
var table;
var ref;

$(document).ready(function () {
   
    var filtro  = $('#filtro').val();
    var campo   = $('#campo').val();
    table       = $('#property_assigment').DataTable({ 
        
        "ajax": '/admin/property/getAll?filtro=' + filtro + '&campo=' + campo,
        
        
    });

    table.destroy();
    
    setTimeout(function () { 
        $('#body_assigment').html(),
        setInterval(getProperties, 100000); 
    }, 3000); 

   

});

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
                    $('#val_precio').html(result.precio);
                }else{
                    $('#error_easy').html('El campo easy broker seleccionado no existe.');
                }


            })
            .catch(function (error) {



            })
    }
}

function getProperties() {
    
    table.ajax.reload();
   
}
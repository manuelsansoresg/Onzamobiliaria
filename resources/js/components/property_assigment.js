const axios = require('axios')
var Swal = require('sweetalert2');
var table;
var ref;

$(document).ready(function () {
   /*  window.paceOptions = {
        ajax: false,
        restartOnRequestAfter: false,
    }; */
    table = $('#property_assigment').DataTable({ 
      
       
     /*    searching: false, */
        
        "ajax": '/admin/property/getAll',
        "bJQueryUI": true,
        "bSort": false,
        "bPaginate": true, // Pagination True 
        "sPaginationType": "full_numbers", // And its type.
        "iDisplayLength": 10
        
        
    });
    table.destroy();
    
    setTimeout(function () { 
        setInterval(getProperties, 100000); 
    }, 3000); 

    /* getProperties(false, false);


     setInterval(function () {
        table.ajax.reload(null, false);
    }, 30000); */

   /*  miPrimeraPromise.then((successMessage) => {
        setInterval(reloadTable(), 2000);
    }); */

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
    /* $('#table-assigment').html(''); */
   /*  axios.get
        ('/admin/property/getAll')
        .then(function (response) {
            $('#table-assigment').html('');
            var rtable = response.data.table;
            var head = response.data.table_head;
            $('#table-assigment').html(rtable);


        })
        .catch(function (error) {



        }) */
}

/* window.reloadTable = function() {


    let miPrimeraPromise = new Promise((resolve, reject) => {

        getProperties(true, false);


    });

    miPrimeraPromise.then((successMessage) => {
        table.destroy();
        getProperties(false, false);
    });

} */

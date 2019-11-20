const axios = require('axios')
var Swal = require('sweetalert2');
var table;

$(document).ready(function () {
    window.paceOptions = {
        ajax: false,
        restartOnRequestAfter: false,
    };
   
    /* getProperties(false, false);
    setInterval(reloadTable, 9000); */
   
    /*  setInterval(function () {
        table.ajax.reload(null, false); 
    }, 30000); */
    /* miPrimeraPromise.then((successMessage) => { 
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
                    $('#val_propiedad').html(result.propiedad);
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

function getProperties(resolve, async) {

    axios.get
        ('/admin/property/getAll')
        .then(function (response) {
            console.log(response);
            var rtable = response.data.table;
            var head = response.data.table_head;
            table = $('#property_assigment').DataTable({
                    deferRender: true,
                    destroy: true,
                    data: rtable,
                    columns: head
                });
            if (async == true){
                resolve('do');
            }
          

        })
        .catch(function (error) {

            

        })
}

window.reloadTable = function() {
   
    
    let miPrimeraPromise = new Promise((resolve, reject) => {
        
        getProperties(true, false);

        
    });
    
    miPrimeraPromise.then((successMessage) => {
        table.destroy();
        getProperties(false, false);
    }); 

}
const axios = require('axios')
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
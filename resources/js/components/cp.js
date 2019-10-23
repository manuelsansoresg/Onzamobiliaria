var Swal = require('sweetalert2');

window.searchPostal = function(){

    var cp = $('#cp').val();
    if(cp == ''){
        Swal.fire({
            title: 'Error',
            text: 'Introduce un cp valido',
            type: 'error',
        });
    }else{
        $('#colonia').empty()
        axios.get
            ('/admin/postal/' + cp)
            .then(function (response) {
                
                if (response.data.total > 0) {
                    
                    var result = response.data.data;
                    $('#colonia').removeAttr("disabled");

                    result.forEach(row => {
                        $('#colonia').append(new Option(row.colonia, row.id ))
                    });

                   

                } else {
                    
                    Swal.fire({
                        title: 'Error',
                        text: 'No se encontraron resultados',
                        type: 'error',
                    });
                   
                    $('#colonia').addAttr("disabled");
                }

                //$('.spinner-contacto').hide();

            })
            .catch(function (error) {

                var result = error.response.data;

                /* $('.spinner-contacto').hide(); */



            })
    }
    
        
} 

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

        "order": [[ 0, 'desc' ]],
        dom: 'Bfrtip',
        buttons: [{
            extend: 'pdf',
            orientation: 'landscape',
            text: 'PDF',
            className: 'btn-danger',
            title: 'LISTADO DE PROPIEDADES',
            fontSize: '6',
            //messageTop: '', AGREGAR TITULO
            pageSize: 'letter', //A3 , A4,A5 , A6 , legal , letter
            pageMargins: [0, 0, 0, 0], // try #1 setting margins
            margin: [0, 0, 0, 0], // try #2 setting margins                    
            customize: function (doc) {
                doc.styles.title = {
                    color: 'black',
                    fontSize: '10',
                    alignment: 'left'
                }
                doc.styles['td:nth-child(2)'] = {
                    width: '100px',
                    'max-width': '100px'
                }
                doc.styles.tableHeader = {
                    fillColor: '#525659',
                    color: '#FFF',
                    fontSize: '8',
                    alignment: 'left',
                    bold: true
                }
                doc.defaultStyle.fontSize = 9;
                doc.pageMargins = [50, 50, 30, 30];
                doc.content[1].margin = [5, 0, 0, 5]
            }
        },
        {
            extend: 'excel',
            text: 'EXCEL',
        },
        {
            extend: 'print',
            text: 'IMPRIMIR',
        }
        ],
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        console.log('res'+$(this).val());
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }

    } );

   function search(){
       $("#table_property_assigment tfoot th").each( function ( i ) {
           var select = $('<select><option value=""></option></select>')
               .appendTo( $(this).empty() )
               .on( 'change', function () {
                   table.column( i )
                       .search( $(this).val() )
                       .draw();
               } );

           table.column( i ).data().unique().sort().each( function ( d, j ) {
               select.append( '<option value="'+d+'">'+d+'</option>' )
           } );
       } );
   }

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

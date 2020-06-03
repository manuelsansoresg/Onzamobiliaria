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

    $('#table_property_assigment thead tr').clone(true).appendTo( '#example thead' );
    $('#table_property_assigment thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );

    var table = $('#table_property_assigment').DataTable( {
        //"ajax":'/admin/property/getAll',
        'ajax': {
            'url':'/admin/property/getAll',
            error: function(jqXHR, ajaxOptions, thrownError) {
          alert(thrownError + "\r\n" + jqXHR.statusText + "\r\n" + jqXHR.responseText + "\r\n" + ajaxOptions.responseText);
        }
        },

        "order": [[ 1, 'desc' ]],
        "columnDefs": [
            {
                "targets": [ 6 ],
                "visible": false,
                "searchable": false
            }
        ],
        scrollY: "400px",
        scrollX: true,
        scrollCollapse: true,
        bAutoWidth: false,
        lengthMenu: [100],
        orderCellsTop: true,
        fixedHeader: true,
        dom: 'Bfrtip',
        buttons: [{
            extend: 'pdf',
            orientation: 'landscape',
            text: '<i class="far fa-file-pdf"> PDF</i>',
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
            text: '<i class="fas fa-file-excel"> EXCEL </i>',
            className: 'btn btn-success',
        },
        {
            extend: 'print',
            text:'<i class="fas fa-print"> IMPRIMIR</i>',
            className: 'btn btn-light',
        }
        ]/*,
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
        }*/

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
        $('#error_easy').html('FAVOR DE CAPTURAR LA CLAVE EASYBROKER');
    }else{
        axios.get
            ('/admin/propiedad/search/easybroker/' + easy_broker)
            .then(function (response) {
                var result = response.data.property;
                var total = response.data.total;

                if (total  > 0) {
                    /*$('#val_propiedad').html(result.tipo);
                    $('#val_operacion').html(result.operacion);
                    $('#val_colonia').html(result.colonia);
                    $('#val_asesor').html(result.asesor);
                    $('#val_precio').html(result.price);*/
                    $("#valnombre").val(result.tipo);
                    $('#valoperacion').val(result.operacion);
                    $('#valcolonia').val(result.colonia);
                    $('#valasesor').val(result.asesor);
                    $('#valprecio').val(result.price);
                }else{
                    $('#error_easy').html('LA CLAVE NO EXISTE, FAVOR DE VERIFICAR.');
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

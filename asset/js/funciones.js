$(document).ready( function () {
    //$('#myTable').DataTable();
    $('#myTable').DataTable({
        //cambiamos el lenguaje a español
        "language":{
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraon resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros  del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar",
            "oPaginate": {
                "sFirst": "|<",
                "sLast": ">|",
                "sNext": ">",
                "sPrevious": "<"
            },
            "sProcessing": "Procesando ...",
        },
        lengthMenu: [
            [5, 10, 20, -1],
            ['5', '10', '20', 'Todos']
        ],
    });
} );
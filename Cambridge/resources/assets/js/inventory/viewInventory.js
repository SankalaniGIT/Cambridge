$(document).ready(function() {
    $('#viewInventory').DataTable( {

        "scrollY": "300px",
        "scrollCollapse": true,
        "paging": false,
        "scrollx": false,

        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    } );
} );
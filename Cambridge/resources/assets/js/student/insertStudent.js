$(document).ready(function() {
    $('#viewStudents').DataTable( {

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
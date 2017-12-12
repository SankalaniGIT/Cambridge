$(document).ready(function () {
    var t =  $('#viewFeeHistory').DataTable({

        "scrollY": "300px",
        "scrollCollapse": true,
        "paging": false,
        "scrollx": false,

        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    });//add print button


    $('#subBtn').on('click', function () {
        t.rows().remove().draw();//remove data rows
        $.ajax({
            type: 'get',
            url: 'fillTFHistory',
            data: {adNo: $('#AdNo').val()},
            success: function (data) {

                $.each(data, function (index, value) {
                    t.row.add([
                        value.admmision_no,
                        value.stname ,
                        value.class_category,
                        value.term_invoice_date ,
                        value.term_cat,
                        value.payment_method,
                        value.amount,
                        value.yrs
                    ]).draw(false);


                });
            }//add rows
        });
    });

    // Automatically add a first row of data
    $('#subBtn').click();


});


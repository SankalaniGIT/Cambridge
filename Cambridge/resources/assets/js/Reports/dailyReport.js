$(document).ready(function () {
    $('#subBtn').click(function () {
        $.ajax({
            type: 'get',
            url: 'fillDailyReport',
            data: {date: $('#date').val()},
            success: function (data) {
                //($cashInHand , $bcTotTF , $ncTotTF , $bcTotEF , $ncTotEF , $bcTotExtF , $ncTotExtF , $stationary , $refund
                // , $admission , $courseFee ,$otherIncome, $discountExp,$expense,$totalIcome,$totalExpenses,$totCashInHand);

                $('#CIH').text(data[0]);
                $('#bcTF').text(data[1]);
                $('#ncTF').text(data[2]);
                $('#bcEF').text(data[3]);
                $('#ncEF').text(data[4]);
                $('#bcExtF').text(data[5]);
                $('#ncExtF').text(data[6]);
                $('#sta').text(data[7]);
                $('#ref').text(data[8]);
                $('#admi').text(data[9]);
                $('#cos').text(data[10]);


               $.map(data[11],function (val, index) {
                   var x= '<tr>' +
                        '<td>' + val.type + '</td>' +
                        '<td></td>' +
                        '<td>' + val.totOincome + '</td>' +
                        '</tr>';

                   $('#addOincome').closest('tr').after(x);
                });

               $('#dis').text(data[12]);

                $.map(data[13],function (val, index) {
                    var x= '<tr>' +
                        '<td>' + val.expense_type + '</td>' +
                        '<td>' + val.totExp + '</td>' +
                        '<td></td>' +
                        '</tr>';

                    $('#addExp').closest('tr').after(x);
                });

                $('#totIncm').text(data[14]);
                $('#totExp').text(data[15]);
                $('#totCIH').text(data[16]);
                $('#hd').text(' Day Sheet as at ' + $('#date').val());

            }
        });
    });
});
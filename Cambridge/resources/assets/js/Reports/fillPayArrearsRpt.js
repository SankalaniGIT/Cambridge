$(document).ready(function () {
    $('#subBtn').click(function () {
        $('#tblbody').find("tr:gt(0)").remove();
        $.ajax({
            type: 'get',
            url: 'fillPayArrearsRpt',
            data: {year: $('#year').val()},
            success: function (data) {
                var cls = 'c';
                $.each(data, function (index, value) {
                    if (value.class_category != cls) {
                        cls = value.class_category;
                        var x = '<tr>' +
                            '<td style="font-weight: 600" colspan="4">' + value.class_category + '</td>' +
                            '</tr>';

                        $('#tblbody tr:last').after(x);
                    }//add class category raw

                    var y = '<tr>' +
                        '<td>' + value.admmision_no + '</td>' +
                        '<td>'+ value.NAME +'</td>' +
                        '<td>' + value.class_category + '</td>' +
                        '<td>'+ value.amount +'</td>' +
                        '<td>' + value.totYrfee + '</td>' +
                        '<td>' + ( value.totYrfee - value.amount ) + '</td>' +
                        '<td>' + value.yrs + '</td>' +
                        '</tr>';

                    $('#tblbody tr:last').after(y);//add other raws
                });

                $('#hd').text(' Student Payment Arrears for '+$('#year').val());
                $('#printDiv').removeClass('hidden');
                $('#btn').removeClass('hidden');
            }
        });
    });
});
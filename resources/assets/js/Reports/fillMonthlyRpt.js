$(document).ready(function () {
    $('#subBtn').click(function () {
        $('#tblbody').find("tr:gt(0)").remove();
        $.ajax({
            type: 'get',
            url: 'getMonthlyRpt',
            data: {Fdate: $('#Fdate').val(), Tdate: $('#Tdate').val()},
            success: function (data) {
//$ncMTF,$bcMTF,$ncMEF,$bcMEF,$ncMExtF,$bcMExtF,$AdDis,$stationary,$course,$otherIncome,$expenses

                var grosprofit = (data[0] + data[1] + data[2] + data[3] + data[4] + data[5] + (data[6][0] - data[6][1])
                + data[7] + parseInt(data[8]) + data[9]).toFixed(2);
                var y = '<tr>' +
                    '<td colspan="4" style="text-decoration: underline;text-decoration-style: double;font-weight: 600">INCOME</td>' +
                    '</tr>' +

                    '<tr>' +
                    '<td>Admission</td>' +
                    '<td></td>' +
                    '<td>' + (data[6][0]).toFixed(2) + '</td>' +
                    '<td></td>' +
                    '</tr>' +

                    '<tr>' +
                    '<td>Admission Discounts 10%</td>' +
                    '<td></td>' +
                    '<td>' + (data[6][1]).toFixed(2) + '</td>' +
                    '<td></td>' +
                    '</tr>' +

                    '<tr>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td style="font-weight: 600">' + (data[6][0] - data[6][1]).toFixed(2) + '</td>' +
                    '</tr>' +

                    '<tr>' +
                    '<td>Fees-NC</td>' +
                    '<td>' + (data[0]).toFixed(2) + '</td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '</tr>' +

                    '<tr>' +
                    '<td>Fees-BC</td>' +
                    '<td>' + (data[1]).toFixed(2) + '</td>' +
                    '<td>' + (data[0] + data[1]).toFixed(2) + '</td>' +
                    '<td></td>' +
                    '</tr>' +

                    '<tr>' +
                    '<td>Exam fees-NC</td>' +
                    '<td>' + (data[2]).toFixed(2) + '</td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '</tr>' +

                    '<tr>' +
                    '<td>Exam fees-BC</td>' +
                    '<td>' + (data[3]).toFixed(2) + '</td>' +
                    '<td>' + (data[2] + data[3]).toFixed(2) + '</td>' +
                    '<td></td>' +
                    '</tr>' +

                    '<tr>' +
                    '<td>Extra fees-NC</td>' +
                    '<td>' + (data[4]).toFixed(2) + '</td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '</tr>' +

                    '<tr>' +
                    '<td>Extra fees-BC</td>' +
                    '<td>' + (data[5]).toFixed(2) + '</td>' +
                    '<td>' + (data[4] + data[5]).toFixed(2) + '</td>' +
                    '<td style="font-weight: 600">' + (data[0] + data[1] + data[2] + data[3] + data[4] + data[5]).toFixed(2) + '</td>' +
                    '</tr>' +

                    '<tr>' +
                    '<td  colspan="4">  </td>' +
                    '</tr>' +

                    '<tr>' +
                    '<td colspan="4" style="text-decoration: underline;text-decoration-style: double;font-weight: 600">OTHER INCOME</td>' +
                    '</tr>' +

                    '<tr>' +
                    '<td>Stationary</td>' +
                    '<td></td>' +
                    '<td>' + (data[7]).toFixed(2) + '</td>' +
                    '<td></td>' +
                    '</tr>' +

                    '<tr>' +
                    '<td>Course fee</td>' +
                    '<td></td>' +
                    '<td>' + (parseInt(data[8])).toFixed(2) + '</td>' +
                    '<td>' + (data[7] + parseInt(data[8])).toFixed(2) + '</td>' +
                    '</tr>' +

                    '<tr>' +
                    '<td  colspan="4">  </td>' +
                    '</tr>' +

                    '<tr>' +
                    '<td colspan="4">OTHER INCOME</td>' +
                    '</tr>' +

                    '<tr>' +
                    '<td>Others</td>' +
                    '<td></td>' +
                    '<td>' + (data[9]).toFixed(2) + '</td>' +
                    '<td>' + (data[9]).toFixed(2) + '</td>' +
                    '</tr>' +

                    '<tr style="font-weight: 600">' +
                    '<td colspan="3">Gross Profit</td>' +
                    '<td>' + grosprofit + '</td>' +
                    '</tr>' +

                    '<tr>' +
                    '<td  colspan="4">  </td>' +
                    '</tr>' +

                    '<tr>' +
                    '<td colspan="4" style="text-decoration: underline;text-decoration-style: double;font-weight: 600">EXPENSES</td>' +
                    '</tr>'
                ;

                $('#tblbody tr:last').after(y);//add income rows

                var totexp = 0;
                $.each(data[10], function (index, value) {
                    var x = '<tr>' +
                        '<td>' + value.expense_type + '</td>' +
                        '<td></td>' +
                        '<td>' + (value.Tamt).toFixed(2) + '</td>' +
                        '<td style="font-weight: 600"></td>' +
                        '</tr>';
                    $('#tblbody tr:last').after(x);//add expense rows

                    totexp = totexp + value.Tamt;
                });
                if (totexp != 0)
                    $('#tblbody td:last').text(totexp);//add total expense to last raw

                var z = '<tr>' +
                    '<td colspan="3" style="font-weight: 600">Net Profit</td>' +
                    '<td style="text-decoration: underline;text-decoration-style: double;font-weight: 600">' + (grosprofit - totexp).toFixed(2) + '</td>' +
                    '</tr>';
                $('#tblbody tr:last').after(z);//add net profit

                var Fdate = new Date($('#Fdate').val()),
                    month = Fdate.getMonth() < 10 ? Fdate.getMonth() : Fdate.getMonth(),
                    Fmonth = month;

                var Tdate = new Date($('#Tdate').val()),
                    month = Tdate.getMonth() < 10 ? Tdate.getMonth() : Tdate.getMonth(),
                    Tmonth = month;

                var monthNames = ["January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                ];


                $('#hd').text(' Profitability statement for the ' + monthNames[Fmonth] + '-' + monthNames[Tmonth] + ' ' + (new Date()).getFullYear());
                $('#printDiv').removeClass('hidden');
                $('#btn').removeClass('hidden');

            }
        });


    });
});
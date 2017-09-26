$(document).ready(function () {
    $globleVal = 0;
    $('#btnAdd').click(function () {
        if ($('#adNo').val() == 0 || $('#quantity').val() == 0) {
        }
        else {
            $.ajax({
                type: 'get',
                url: 'getStationaryData',
                data: {id: $('#adNo').val(), item: $('#item').val(), Qty: $('#quantity').val()},
                success: function (data) {
                    var array = data.split('--');
                    $globleVal++;
                    var htmlcode = '<tr id="' + $globleVal + '">' +
                        '<td width="35%">' +
                        '<input type="text" name="item[]" value="' + array[0] + '" class="form-control" readonly>' +
                        '</td>' +
                        '<td width="15%">' +
                        '<input type="text" name="qty[]" value="' + array[1] + '" class="form-control" readonly>' +
                        '</td>' +
                        '<td width="15%">' +
                        '<input type="text" name="UPrice[]" value="' + array[2] + '" class="form-control" readonly>' +
                        '</td>' +
                        '<td width="15%">' +
                        '<input type="text" name="tot[]" value="' + array[3] + '" class="form-control" readonly>' +
                        '</td>' +
                        '<td width="7%">' +
                        '<input type="button" name="remove[]" value="Remove" onclick="removebtn($(this))" class="btn remove btn-info form-control">' +
                        '</td>' +
                        '</tr>';

                    $('#tblbody').append(htmlcode);
                    $('#name').val($('#adNo').val());

                    if(array[4]==0){
                        document.getElementById('mHeader').innerHTML = 'Stationary';
                        document.getElementById('mtxt').innerHTML = 'Stock is not enough!';
                        click();
                    }
                }

            });

            $('form').removeClass('hidden');
        }

    });


});


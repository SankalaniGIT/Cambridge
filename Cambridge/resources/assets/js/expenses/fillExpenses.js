$(document).ready(function () {
    $globleVal = 0;
    $('#btnPayAdd').click(function () {
        if ($('#SenderName').val() == 0 || $('#ReceiverName').val()==0 || $('#description').val() == 0 || $('#amount').val() == 0) {
        }
        else {
            $globleVal++;
            var htmlcode = '<tr id="' + $globleVal + '">' +
                '<td width="10%">' +
                '<input type="text" name="id[]" value="' + $('#ExType').val() + '" class="form-control" readonly>' +
                '</td>' +
                '<td width="25%">' +
                '<input type="text" name="type[]" value="' + $('#ExType option:selected').text() + '" class="form-control" readonly>' +
                '</td>' +
                '<td width="40%">' +
                '<input type="text" name="desc[]" value="' + $('#description').val() + '" class="form-control" readonly>' +
                '</td>' +
                '<td width="15%">' +
                '<input type="text" name="amount[]" value="' + $('#amount').val() + '" class="form-control" readonly>' +
                '</td>' +
                '<td width="7%">' +
                '<input type="button" name="remove[]" value="Remove" onclick="removebtn($(this))" class="btn remove btn-info form-control">' +
                '</td>' +
                '</tr>';

            $('#tblbody').append(htmlcode);


            $('form').removeClass('hidden');
            $('#Sname').val($('#SenderName').val());
            $('#Rname').val($('#ReceiverName').val());
        }

    });


});


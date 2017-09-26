$(document).ready(function () {

    $('#adclick').click(function () {
        //*********************      fill Course student details according to admission no        */

        if ($('#adNo').val() == '') {
        } else {
            $.ajax({
                type: 'get',
                url: 'getsearchCosAdno',
                data: {id: $('#adNo').val()},
                success: function (data) {
                    if (data[0] == 1) {
                        $('#state').prop('checked', true);
                        $('#state').val(data[0]);
                    }
                    else {
                        $('#state').prop('checked', false);
                        $('#state').val(data[0]);
                    }

                    $('#date').val(data[1]);
                    $('#First_name').val(data[2]);
                    $('#Last_name').val(data[3]);
                    $('#gender').val(data[5]);
                    $('#nic').val(data[10]);
                    $('#DOB').val(data[4]);
                    $('#school').val(data[8]);
                    $('#grade').val(data[9]);
                    $('#address').val(data[6]);
                    $('#tel').val(data[7]);


                }
            });
        }
    });


});
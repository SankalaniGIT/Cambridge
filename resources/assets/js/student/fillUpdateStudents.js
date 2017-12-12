$(document).ready(function () {

    $('#adclick').click(function () {
        //*********************      fill student details according to admission no        */

        if ($('#adNo').val() == '') {
        } else {
            $.ajax({
                type: 'get',
                url: 'getsearchAdno',
                data: {id: $('#adNo').val()},
                success: function (data) {
                    if (data[3] == 'nc') {
                        $('#curriculum').val(data[3]);
                    }
                    else if (data[3] == 'bc') {
                        $('#curriculum').val(data[3]);
                    }

                    $('#curriculum').change();
                    setTimeout(fillUpdateStudentData, 400, data);
                }
            });
        }
    });

    function fillUpdateStudentData(data) {

        jQuery(data[0]).each(function (i, item) {
            $('#date').val(item.date_admission);
            $('#adNo').val(item.admission_no);
            $('#First_name').val(item.std_fname);
            $('#Last_name').val(item.std_lname);
            $('#gender').val(item.std_gender);
            $('#DOB').val(item.std_dob);
            $('#Father_First_name').val(item.std_f_fname);
            $('#Father_Last_name').val(item.std_f_lname);
            $('#Father_tell').val(item.std_f_mobile);
            $('#Mother_First_name').val(item.std_m_fname);
            $('#mLname').val(item.std_m_lname);
            $('#Mother_tell').val(item.std_m_moblie);
            $('#Tell').val(item.std_tel_no);
            $('#Address').val(item.std_address);
            $('#state').val(item.state);
            if (item.state=='true'){
                $('#state').prop('checked', true);
            }
            else {
                $('#state').prop('checked', false);
            }
        });

        $('#grade').val(data[2]);
        $('#class').val(data[1]);
    }


});
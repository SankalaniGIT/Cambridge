$(document).ready(function () {
    $('#adclick').click(function () {
        $('.err3').addClass('hidden');
        $('#st').removeClass('hidden');
        if ($('#cosAdNo2').val() == '') {
        } else {
            $.ajax({
                type: 'get',
                url: 'fillUpdateCos',
                data: {id: $('#cosAdNo2').val(), cos: $('#course2').val()},
                success: function (data) {
                    if (data == 1) {
                        $('#state2').prop('checked', true);
                        $('#state2').val(data);
                    }
                    else if (data == 0) {
                        $('#state2').prop('checked', false);
                        $('#state2').val(data);
                    }
                    else {
                        $('.err3').removeClass('hidden');
                        $('#border2').css('border', 'double');
                        $('#st').addClass('hidden');
                    }
                }
            });
        }
    });


});

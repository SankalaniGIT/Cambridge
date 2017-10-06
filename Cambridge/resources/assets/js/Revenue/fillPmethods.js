$(document).ready(function () {
    $('#term').change(function () {
        $('#P_method').find('option:not(:first)').remove().end();

        $.ajax({
            type: 'get',
            url: 'fillPmethods',
            data: {id: $('#adNo').val(), yr: $('#year').val(), trm: $('#term').val()},
            success: function (data) {
                if(data==1) {
                    $('#P_method').append($("<option class='p1'></option>").attr("value", '1').text('1st Payment'));
                    $('#P_method').append($("<option class='p4'></option>").attr("value", '4').text('Full Payment'));
                }else if (data==2){
                    $('#P_method').append($("<option class='p2'></option>").attr("value", '2').text('2nd Payment'));
                }else if (data==3){
                    $('#P_method').append($("<option class='p3'></option>").attr("value", '3').text('3rd Payment'));
                }else if (data==4){
                    $('#P_method').append($("<option class='p4'></option>").attr("value", '4').text('Full Payment'));
                }
            }
        });
    });
});
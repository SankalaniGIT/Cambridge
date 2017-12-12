$(document).ready(function () {
    $('#adclick').click(function () {
        $('input:checkbox').prop("checked",false);
        $('#term').find('option:not(:first)').remove().end();
        if ($('#adNo').val() == 0 || $('#year').val() == 0) {
        }
        else {
            $.ajax({
                type: 'get',
                url: 'fillpayfee',
                data: {id: $('#adNo').val(), yr: $('#year').val()},
                success: function (data) {
//($_1T1P, $_1T2P, $_1T3P, $_2T1P, $_2T2P, $_2T3P, $_3T1P, $_3T2P, $_3T3P, $OutStand, $name, $class[0], $terms,$T1,$T2,$T3);

                    $('#T1-p1').val(data[0]);
                    $('#T1-p2').val(data[1]);
                    $('#T1-p3').val(data[2]);
                    $('#T2-p1').val(data[3]);
                    $('#T2-p2').val(data[4]);
                    $('#T2-p3').val(data[5]);
                    $('#T3-p1').val(data[6]);
                    $('#T3-p2').val(data[7]);
                    $('#T3-p3').val(data[8]);
                    $('#OutStandingAmt').val(data[9]);
                    $('#name').val(data[10]);
                    $('#class').val(data[11]);
                    $('input:checkbox').each(function(){
                        if($(this).val() == 1){
                            $(this).prop("checked",true);
                        }
                    });

                    $('#term').append($("<option class='T1'></option>").attr("value", 'T1').text(data[12][0]));
                    $('#term').append($("<option class='T2'></option>").attr("value", 'T2').text(data[12][1]));
                    $('#term').append($("<option class='T3'></option>").attr("value", 'T3').text(data[12][2]));

                    if(data[13]==1){
                        $('.T1').addClass('hidden');
                    } if(data[14]==1){
                        $('.T2').addClass('hidden');
                    } if(data[15]==1){
                        $('.T3').addClass('hidden');
                    }
                }
            });
        }

    });
});
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
$(document).ready(function () {
    $('#P_method').change(function () {


        $.ajax({
            type: 'get',
            url: 'fillfees',
            data: {id: $('#adNo').val(), pm: $('#P_method').val()},
            success: function (data) {
                //$term_fee,$exam_fee,$extra_cur_fee,$Tinv,$Einv,$Extinv

                $('#Tfee').val(data[0]);
                $('#Efee').val(data[1]);
                $('#ExCfee').val(data[2]);
                $('#TfeeInv').val(data[3]);
                $('#EfeeInv').val(data[4]);
                $('#ExCfeeInv').val(data[5]);
                $('#totPayment').val(parseInt(data[0])+parseInt(data[1])+parseInt(data[2]));
            }
        });
    });
});
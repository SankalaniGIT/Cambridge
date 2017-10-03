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
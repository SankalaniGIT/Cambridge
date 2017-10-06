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
            }
        });
    });
});
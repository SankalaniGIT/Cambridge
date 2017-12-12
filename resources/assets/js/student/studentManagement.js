$(document).ready(function () {


    $('#curriculum').change(function () {

        var id = $('#curriculum').find(":selected").val();

        //*********************      Get grade options to select box in Insert Student Details        */


        $.ajax({
            type: 'get',
            url: 'studentGrade',
            data: {id: id},
            success: function (data) {
                $('#grade').find('option').remove().end();
                for (var i = 0; i < data.length; i++) {
                    for (var grade in data[i]) {
                        $('#grade').append($("<option></option>").attr("value", data[i][grade]).text(data[i][grade]));
                    }
                }
            }
        });


        //  /*********************      Get class options to select box in Insert Student Details       */


        $.ajax({
            type: 'get',
            url: 'studentClass',
            data: {id: id},
            success: function (data) {
                $('#class').find('option').remove().end();
                for (var i = 0; i < data.length; i++) {
                    for (var classes in data[i]) {
                        $('#class').append($("<option></option>").attr("value", data[i][classes]).text(data[i][classes]));
                    }
                }
            }
        });

        //  /*********************      Get Admission No according to curriculum in Insert Student Details       */


        $.ajax({
            type: 'get',
            url: 'studentAddNo',
            data: {id: id},
            success: function (data) {
                for (var i = 0; i < data.length; i++) {
                    for (var classes in data[i]) {
                        var value = data[i][classes];
                        var no = parseInt(value.substr(2));
                        var lno = no + 1;

                        if (value.match("^nc")) {
                            adNo = 'nc' + lno;
                        }
                        else if (value.match("^bc")) {
                            adNo = 'bc' + lno;
                        }
                        $('#adNoid').val(adNo);
                    }
                }
            }
        });


    });

    $('#curriculum').change();





    $('#state').change(function () {
        cb = $(this);
        cb.val(cb.prop('checked'));
    });//change state checkbox value



});
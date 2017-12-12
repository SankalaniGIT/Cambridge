$(document).ready(function () {

    $('#curriculum').change(function () {

        var id = $('#curriculum').find(":selected").val();

        //  /*********************      Get class options to select box in Upgrade Student Details       */


        $.ajax({
            type: 'get',
            url: 'studentClass',
            data: {id: id},
            success: function (data) {
                $('#class').find('option').remove().end();
                $('#Uclass').find('option').remove().end();
                for (var i = 0; i < data.length; i++) {
                    for (var classes in data[i]) {
                        $('#class').append($("<option></option>").attr("value", data[i][classes]).text(data[i][classes]));
                        $('#Uclass').append($("<option></option>").attr("value", data[i][classes]).text(data[i][classes]));
                    }
                }
            }
        });
    });

    $('#curriculum').change();
});
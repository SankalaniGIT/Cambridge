$(document).ready(function () {
    $('#item2').change(function () {
        $.ajax({
            type: 'get',
            url: 'fillInventory',
            data: {id: $('#item2').val()},
            success: function (data) {
                $('#Sprice2').val(data[0]);
                $('#qty2').val(data[1]);
                $('#Pprice2').val(data[2]);
            }
        });
    });
});

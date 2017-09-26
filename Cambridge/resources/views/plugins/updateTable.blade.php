<script>
    /*   Update Charges Model appear when checked the Update button   */

    // Get the modal
    var modal = document.getElementById('myModal');

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    function click() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }


    /*   Update Charges details when checked   */


    function boxAppear(id) {
        if ($('input.ckbox').is(':checked')) {
            if ($(id).find('.ck').attr('disabled')) {
                $(id).find('.ck').attr('disabled', false);
            }
            else {
                $(id).find('.ck').attr('disabled', true);
            }
        }
        else {
            $(id).find('.ck').attr('disabled', true);
        }
    }

    function updating(id) {
        var data = $("#" + id + " :input").serialize();
        $.ajax({
            url: 'saveCharges',
            data: $("#" + id + " :input").serialize() + "&main_class_id=" + id,
            type: 'get',
            success: function (data) {
                if (data == 1) {
                    document.getElementById('mHeader').innerHTML = 'Update Charges';
                    document.getElementById('mtxt').innerHTML = 'Charges Updated Successfully!';
//                   document.getElementById('msgbtn').innerHTML='Close';
                    click();
                }
                else if (data == 0) {
                    document.getElementById('mHeader').innerHTML = 'Update Charges';
                    document.getElementById('mtxt').innerHTML = 'This Record Already Exists!';
//                   document.getElementById('msgbtn').innerHTML='Close';
                    click();
                }
                else {
                    alert('An Internal Error occur!');
                }
            }
        });
    }


</script>
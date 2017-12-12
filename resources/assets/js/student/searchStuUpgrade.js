$(document).ready(function () {

    $('#searchBtn').click(function () {
$('#tblbody').empty();
        var id = $('#curriculum').find(":selected").val();
        var classs = $('#class').find(":selected").val();

        //  /*********************      fill table in Upgrade Student Details       */


        $.ajax({
            type: 'get',
            url: 'searchStuUpgrade',
            data: {id: id, classs: classs},
            success: function (data) {

                var admission_no = 0;
                var std_fname = 0;
                var std_lname = 0;
                var class_category = 0;
                for (var i = 0; i < data.length; i++) {
                    var p = 0;
var sub=data[i];
                    for (var key in sub) {
                        switch (key) {
                            case 'admission_no':
                                admission_no = sub[key];
                                break;
                            case 'std_fname':
                                std_fname = sub[key];
                                break;
                            case 'std_lname':
                                std_lname = sub[key];
                                break;
                            case 'class_category':
                                class_category = sub[key];
                                break;
                        }
                        p++;
                    }
                    if (p = 4) {
                        // alert(admission_no + std_fname + std_lname + class_category);
                        var tblraw = '<tr id="' + i + '" class="tblraw ' + admission_no + '">' +
                            '<td><input type="checkbox" name="ckBox[' + i + ']" id="' + admission_no + '" class="ckbox" onclick="$(this).val(this.checked ? 1 : 0);box(this.id)" checked value="1"></td>' +
                            '<td><input type="text" name="admission_no[]" value="' + admission_no + '"readonly></td>' +
                            '<td><input class="ck" type="text" name="std_fname[]" value="' + std_fname + '"readonly></td>' +
                            '<td><input class="ck" type="text" name="std_lname[]" value="' + std_lname + '"readonly></td>' +
                            '<td><input class="ck" type="text" name="class_category[]" value="' + class_category + '"readonly></td>' + +
                            '</tr>';

                        $('#tblbody').append(tblraw);
                        p = 0;
                    }

                }

            }
        });

    });

    setTimeout(clickSearchBtn, 300);



});

function clickSearchBtn() {
    $('#searchBtn').click();
}


function box(id) {
      if ($('#'+id).is(':checked')){
          $('.'+id).css("backgroundColor","");
      }
      else if($('#'+id).is(":not(:checked)")){
          $('.'+id).css("background-color","lightpink");
      }
}
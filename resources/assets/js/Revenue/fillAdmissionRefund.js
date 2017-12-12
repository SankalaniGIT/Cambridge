$(document).ready(function () {

    $('#adclick').click(function () {
        //*********************      fill Admission & Refundable data according to admission no        */
        $('#refundErr').addClass("hidden");
        $('#admissionErr').addClass("hidden");
        $('#admission1stPartErr').addClass("hidden");
        $('#border').css("border", "");
        $('#partRow').addClass("hidden");

        $('#discount').val('');
        $('#1stPart').val('');
        $('#2ndPart').val('');
        if ($('#adNo').val() == '') {
        } else {
            $.ajax({
                type: 'get',
                url: 'getAdRef',
                data: {id: $('#adNo').val(), ptype: $('#Payment_Type').val(), category: $('#category').val()},
                success: function (data) {
                    // return [$name, $class, $ammount, $discount, $paid,$count];

                    $('#name').val(data[0]);
                    $('#class').val(data[1]);
                    $('#amount').val(data[2]);

                    changeDiscountColor(data[3]);
                    if ($('#category').val() == 'Admission Fee') {

                        $('#discount').attr('readonly', false);
                        $('#partPaymentid').removeClass("hidden");

                        if (data[5] > 0) {

                            $('#discount').val(data[3]);

                            if (data[5] == 1 && data[4] == data[2]) {
                                $('#admissionErr').removeClass("hidden");
                                $('#border').css("border", "double");
                            }//check discount and paid amount is equal to amount (mean full payment)
                            else if (data[5] == 1 && data[4] < data[2]) {
                                $('#Payment_Type').val('Part');
                                $('#admission1stPartErr').removeClass("hidden");
                                $('#border').css("border", "double");
                                $('#1stPart').val(data[4]);
                                $('#1stPart').attr('readonly', true);
                                $('#partRow').removeClass("hidden");

                            }//check discount and paid amount is less than to amount (mean part payment)
                            if (data[5] == 2) {
                                $('#admissionErr').removeClass("hidden");
                                $('#border').css("border", "double");
                            }//paid admission fee all parts (mean full payment)

                        }//check admission fee is exist this payment

                    }
                    else if ($('#category').val() == 'Refundable Deposit') {

                        $('#partRow').addClass("hidden");
                        $('#partPaymentid').addClass("hidden");
                        $('#discount').attr('readonly', true);

                        if (data[5] > 0) {
                            $('#refundErr').removeClass("hidden");
                            $('#border').css("border", "double");
                        }//check Refundable Deposit is exist this payment

                    }

                }
            });
        }
    });

    $('#category').change(function () {
       $('#name').val('');
       $('#class').val('');
       $('#amount').val('');
       $('#discount').val('');
       $('#1stPart').val('');
       $('#2ndPart').val('');
    });


    $('#Payment_Type').change(function () {
        if ($(this).val() === 'Part') {
            $('#partRow').removeClass("hidden");
        }
        else {
            $('#partRow').addClass("hidden");
        }
    });//hide part payment and paid amount according to payment type

    function changeDiscountColor($val) {

        if($val==0){
            $('#discount').css("border-color","#ccc");

        }
        else if($val!=0)
        {
             $('#discount').css("border-color","red");
        }


    }//change discount border color when not empty

});
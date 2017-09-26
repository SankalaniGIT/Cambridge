{{--**********************      Student Details Insert Messages      ***************************--}}

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


</script>

{{--Errors--}}
@if(!empty(Session::get('error_code')) && Session::get('error_code')==111)
    <script>

        document.getElementById('mHeader').innerHTML = 'Error';
        document.getElementById('mtxt').innerHTML = 'An Internal Error occur!';
        click();

    </script>

@endif
@if(!empty(Session::get('error_code')) && Session::get('error_code') == 0)
    <script>

        document.getElementById('mHeader').innerHTML = 'New Student Registration';
        document.getElementById('mtxt').innerHTML = 'An Internal Error occur!';
        click();

    </script>

@elseif(!empty(Session::get('error_code')) && Session::get('error_code')==1)
    <script>

        document.getElementById('mHeader').innerHTML = 'New Student Registration';
        document.getElementById('mtxt').innerHTML = '"NC" Student Details Saved Successfully!';
        click();

    </script>

@elseif(!empty(Session::get('error_code')) && Session::get('error_code')==2)
    <script>

        document.getElementById('mHeader').innerHTML = 'New Student Registration';
        document.getElementById('mtxt').innerHTML = '"BC" Student Details Saved Successfully!';
        click();

    </script>
@endif

@if(!empty(Session::get('error_code')) && Session::get('error_code') == 3)
    <script>

        document.getElementById('mHeader').innerHTML = 'Update Student Registration';
        document.getElementById('mtxt').innerHTML = 'An Internal Error occur!';
        click();

    </script>

@elseif(!empty(Session::get('error_code')) && Session::get('error_code')==4)
    <script>

        document.getElementById('mHeader').innerHTML = 'Update Student Registration';
        document.getElementById('mtxt').innerHTML = '"NC" Student Details Updated Successfully!';
        click();

    </script>

@elseif(!empty(Session::get('error_code')) && Session::get('error_code')==5)
    <script>

        document.getElementById('mHeader').innerHTML = 'Update Student Registration';
        document.getElementById('mtxt').innerHTML = '"BC" Student Details Updated Successfully!';
        click();

    </script>
@endif

{{--//Admission And Refundable--}}
@if(!empty(Session::get('error_code')) && Session::get('error_code')==6)
    <script>

        document.getElementById('mHeader').innerHTML = 'Pay Admission & Refund';
        document.getElementById('mtxt').innerHTML = 'Admission Fee 1<sup>st</sup> Part Already Paid!';
        click();

    </script>


@elseif(!empty(Session::get('error_code')) && Session::get('error_code')==7)
    <script>

        document.getElementById('mHeader').innerHTML = 'Pay Admission & Refund';
        document.getElementById('mtxt').innerHTML = 'Admission Fee Already Paid!';
        click();

    </script>


@elseif(!empty(Session::get('error_code')) && Session::get('error_code')==8)
    <script>

        document.getElementById('mHeader').innerHTML = 'Pay Admission & Refund';
        document.getElementById('mtxt').innerHTML = 'Refundable Deposit Already Paid!';
        click();

    </script>

@elseif(!empty(Session::get('error_code')) && Session::get('error_code')==9)
    <script>

        document.getElementById('mHeader').innerHTML = 'Pay Admission & Refund';
        document.getElementById('mtxt').innerHTML = 'Sum of 1st and 2nd installments not equal to Amount!';
        click();

    </script>

@endif

{{--Other Incomes--}}
@if(!empty(Session::get('error_code')) && Session::get('error_code')==10)
    <script>

        document.getElementById('mHeader').innerHTML = 'Other Incomes';
        document.getElementById('mtxt').innerHTML = 'Other Incomes Saved Successfully!';
        click();

    </script>

@endif

{{--Student Classes Upgrade--}}
@if(!empty(Session::get('error_code')) && Session::get('error_code')==11)
    <script>

        document.getElementById('mHeader').innerHTML = 'Upgrade Students';
        document.getElementById('mtxt').innerHTML = 'Upgrade Classes Saved Successfully!';
        click();

    </script>

@endif

{{--Courses--}}
@if(!empty(Session::get('error_code')) && Session::get('error_code')==12)
    <script>

        document.getElementById('mHeader').innerHTML = 'Course Students Registration';
        document.getElementById('mtxt').innerHTML = 'Course Students Details Saved Successfully!';
        click();

    </script>

@elseif(!empty(Session::get('error_code')) && Session::get('error_code')==13)
    <script>

        document.getElementById('mHeader').innerHTML = 'Register School Students in Courses';
        document.getElementById('mtxt').innerHTML = 'School Students Registered in Courses Successfully!';
        click();

    </script>
@elseif(!empty(Session::get('error_code')) && Session::get('error_code')==14)
    <script>

        document.getElementById('mHeader').innerHTML = 'Register School Students in Courses';
        document.getElementById('mtxt').innerHTML = 'This Student already registered in courses!';
        click();

    </script>
@elseif(!empty(Session::get('error_code')) && Session::get('error_code')==15)
    <script>

        document.getElementById('mHeader').innerHTML = 'Add & Update Courses of a Student';
        document.getElementById('mtxt').innerHTML = 'This Student already added for this course!';
        click();

    </script>
@elseif(!empty(Session::get('error_code')) && Session::get('error_code')==16)
    <script>

        document.getElementById('mHeader').innerHTML = 'Add & Update Courses of a Student';
        document.getElementById('mtxt').innerHTML = 'A Course added successfully!';
        click();

    </script>
@elseif(!empty(Session::get('error_code')) && Session::get('error_code')==17)
    <script>

        document.getElementById('mHeader').innerHTML = 'Add & Update Courses of a Student';
        document.getElementById('mtxt').innerHTML = 'This Student already left from courses!';
        click();

    </script>
@elseif(!empty(Session::get('error_code')) && Session::get('error_code')==18)
    <script>

        document.getElementById('mHeader').innerHTML = 'Update Course Students';
        document.getElementById('mtxt').innerHTML = 'Course Students Details Updated Successfully!';
        click();

    </script>
@elseif(!empty(Session::get('error_code')) && Session::get('error_code')==19)
    <script>

        document.getElementById('mHeader').innerHTML = 'Add & Update Courses of a Student';
        document.getElementById('mtxt').innerHTML = 'A Course Status Updated Successfully!';
        click();

    </script>
@elseif(!empty(Session::get('error_code')) && Session::get('error_code')==20)
    <script>

        document.getElementById('mHeader').innerHTML = 'Add & Update Courses of a Student';
        document.getElementById('mtxt').innerHTML = 'This Student not added to this course!';
        click();

    </script>
@elseif(!empty(Session::get('error_code')) && Session::get('error_code')==21)
    <script>

        document.getElementById('mHeader').innerHTML = 'Bill A Course';
        document.getElementById('mtxt').innerHTML = 'This Student not added to this course!';
        click();

    </script>
@elseif(!empty(Session::get('error_code')) && Session::get('error_code')==22)
    <script>

        document.getElementById('mHeader').innerHTML = 'Bill A Course';
        document.getElementById('mtxt').innerHTML = 'This Student currently not doing this course!';
        click();

    </script>
@endif


{{--Inventories--}}
@if(!empty(Session::get('error_code')) && Session::get('error_code')==23)
    <script>

        document.getElementById('mHeader').innerHTML = 'Inventories';
        document.getElementById('mtxt').innerHTML = 'New Inventory Added Successfully!';
        click();

    </script>
@elseif(!empty(Session::get('error_code')) && Session::get('error_code')==24)
    <script>

        document.getElementById('mHeader').innerHTML = 'Inventories';
        document.getElementById('mtxt').innerHTML = 'Updated Inventory Successfully!';
        click();

    </script>
@elseif(!empty(Session::get('error_code')) && Session::get('error_code')==25)
    <script>

        document.getElementById('mHeader').innerHTML = 'Inventories';
        document.getElementById('mtxt').innerHTML = 'Please Select One Option in Add & Remove!';
        click();

    </script>
@endif
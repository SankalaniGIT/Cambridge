<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
    <span class="hamb-top"></span>
    <span class="hamb-middle"></span>
    <span class="hamb-bottom"></span>
</button>

<div class="container">
    <h2>Students Details</h2>
    <table id="viewStudents" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Admission No</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Admission Date</th>
            <th>Class Category</th>
            <th>Cur</th>
            <th>Curriculum category</th>
            <th>Contact Number</th>
            <th>Status</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Admission No</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Admission Date</th>
            <th>Class Category</th>
            <th>Cur</th>
            <th>Curriculum category</th>
            <th>Contact Number</th>
            <th>Status</th>
        </tr>
        </tfoot>
        <tbody>

        @foreach($Student as $stu)
            <tr>
                <td>{{$stu->admission_no}}</td>
                <td>{{$stu->std_fname}}</td>
                <td>{{$stu->std_lname}}</td>
                <td>{{$stu->date_admission}}</td>
                <td>{{$stu->class_category}}</td>
                <td>{{$stu->c_category}}</td>
                <td>{{$stu->main_class_id}}</td>
                <td>{{$stu->std_tel_no}}</td>
                <td>{{$stu->state}}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>

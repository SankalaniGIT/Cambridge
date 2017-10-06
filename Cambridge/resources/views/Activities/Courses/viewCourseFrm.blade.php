<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
    <span class="hamb-top"></span>
    <span class="hamb-middle"></span>
    <span class="hamb-bottom"></span>
</button>

<div class="container">
    <h2>Course Student Details</h2>
    <table id="viewCosStudent" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>Course</th>
            <th>Month</th>
            <th>Fee Amount</th>
            <th>Course State</th>
            <th>Date</th>
            <th>Invoice No</th>
            <th></th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>Course</th>
            <th>Month</th>
            <th>Fee Amount</th>
            <th>Course State</th>
            <th>Date</th>
            <th>Invoice No</th>
            <th></th>
        </tr>
        </tfoot>
        <tbody>

        @foreach($courses as $cos)
            <tr>
                <td>{{$cos->student_id}}</td>
                <td>{{$cos->name}}</td>
                <td>{{$cos->course_name}}</td>
                <td>{{$cos->month}}</td>
                <td>{{$cos->fee_amount}}</td>
                <td>{{$cos->course_state}}</td>
                <td>{{$cos->date}}</td>
                <td>{{$cos->st_c_fee_invNo}}</td>
                <td><a href=" {!! route('CosInv',['course'=>$cos->course_name,'id'=>$cos->student_id,'invNo'=>$cos->st_c_fee_invNo,'date'=>$cos->date,'name'=>$cos->name,'paid'=>$cos->fee_amount,'month'=>$cos->month,'term'=>'--']) !!}">Print</a></td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>

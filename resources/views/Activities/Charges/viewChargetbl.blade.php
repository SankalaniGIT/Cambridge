<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
    <span class="hamb-top"></span>
    <span class="hamb-middle"></span>
    <span class="hamb-bottom"></span>
</button>

<div class="container">
    <h2>School Fees</h2>
    <table id="viewCharges" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Class Name</th>
            <th>Admission Fee</th>
            <th>Refundable Deposit</th>
            <th>Term Fee</th>
            <th>Exam Fee</th>
            <th>Extra Curriculum</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>ID</th>
            <th>Class Name</th>
            <th>Admission Fee</th>
            <th>Refundable Deposit</th>
            <th>Term Fee</th>
            <th>Exam Fee</th>
            <th>Extra Curriculum</th>
        </tr>
        </tfoot>
        <tbody>

            @foreach($charges as $charge)
                <tr>
                <td>{{$charge->main_class_id}}</td>
                <td>{{$charge->cls_name}}</td>
                <td>{{$charge->adm_fee}}</td>
                <td>{{$charge->ref_deposit}}</td>
                <td>{{$charge->term_fee}}</td>
                <td>{{$charge->exam_fee}}</td>
                <td>{{$charge->extra_cur_fee}}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>

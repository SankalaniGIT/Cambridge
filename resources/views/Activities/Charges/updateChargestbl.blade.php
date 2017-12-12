<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
    <span class="hamb-top"></span>
    <span class="hamb-middle"></span>
    <span class="hamb-bottom"></span>
</button>

<div class="container">
    <h2>Update School Fees Details</h2>
    <div class="panel panel-default dataTables_wrapper dt-jqueryui">
        <div class="panel-heading fg-toolbar ui-toolbar ui-widget-header ui-helper-clearfix ui-corner-tl ui-corner-tr">School fees of the year</div>
        <div class="panel-body">
            <div class="table-responsive">

                <table id="updateCharges" role="grid" class="table table-bordered table-striped display dataTable" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Class Name</th>
                        <th>Admission Fee</th>
                        <th>Refundable Deposit</th>
                        <th>Term Fee</th>
                        <th>Exam Fee</th>
                        <th>Extra Curriculum</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Class Name</th>
                        <th>Admission Fee</th>
                        <th>Refundable Deposit</th>
                        <th>Term Fee</th>
                        <th>Exam Fee</th>
                        <th>Extra Curriculum</th>
                        <th></th>
                    </tr>
                    </tfoot>
                    <tbody>

                    @foreach($updateCharges as $updateCharge)
                        <tr id="{{$updateCharge->main_class_id}}">
                            <td><input type="checkbox" class="ckbox"
                                       onclick="boxAppear({{$updateCharge->main_class_id}})" value=""></td>
                            <td><input type="text" name="class_id" value="{{$updateCharge->main_class_id}}"
                                       disabled></td>
                            <td><input class="ck" type="text" name="cls_name" value="{{$updateCharge->cls_name}}"
                                       disabled></td>
                            <td><input class="ck" type="text" name="adm_fee" value="{{$updateCharge->adm_fee}}"
                                       disabled></td>
                            <td><input class="ck" type="text" name="ref_deposit" value="{{$updateCharge->ref_deposit}}"
                                       disabled></td>
                            <td><input class="ck" type="text" name="term_fee" value="{{$updateCharge->term_fee}}"
                                       disabled></td>
                            <td><input class="ck" type="text" name="exam_fee" value="{{$updateCharge->exam_fee}}"
                                       disabled></td>
                            <td><input class="ck" type="text" name="extra_cur_fee"
                                       value="{{$updateCharge->extra_cur_fee}}" disabled></td>
                            <td><input type="submit" class="ck" value="Update" name="btn"
                                       id="{{$updateCharge->main_class_id}}"
                                       onclick="updating('{{$updateCharge->main_class_id}}')" disabled></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
        <div class="panel-footer fg-toolbar ui-toolbar ui-widget-header ui-helper-clearfix ui-corner-bl ui-corner-br"></div>
    </div>


</div>

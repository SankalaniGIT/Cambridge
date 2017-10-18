<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
    <span class="hamb-top"></span>
    <span class="hamb-middle"></span>
    <span class="hamb-bottom"></span>
</button>

<div class="container">
    <h2>Monthly Report</h2>
    <div class="panel panel-default dataTables_wrapper dt-jqueryui">
        <div class="panel-heading fg-toolbar ui-toolbar ui-widget-header ui-helper-clearfix ui-corner-tl ui-corner-tr">
            Monthly Income & Expenses
        </div>
        <div class="panel-body">
            <div class="row">
                <div class=" col-md-4 col-sm-12 col-xs-12 ">
                    <div class="form-group{{ $errors->has('Fdate') ? ' has-error' : '' }}">
                        <label for="Fdate" class="col-md-4 control-label">From Date</label>

                        <div class="col-md-8">
                            <input id="Fdate" type="date" class="form-control" name="Fdate"
                                   value="2017-10-01" required>
                        </div>
                    </div>
                </div>
                <div class=" col-md-4 col-sm-12 col-xs-12 ">
                    <div class="form-group{{ $errors->has('Tdate') ? ' has-error' : '' }}">
                        <label for="Tdate" class="col-md-4 control-label">To Date</label>

                        <div class="col-md-8">
                            <input id="Tdate" type="date" class="form-control" name="Tdate"
                                   value="2017-10-31" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 form-group">
                    <div class="col-md-4">
                        <button type="submit" id="subBtn" class="btn btn-primary">
                            Generate Report
                        </button>
                    </div>
                </div>
            </div>
            <hr>
            <div class="table-responsive hidden" id="printDiv">
                <div class="header center-block" style=" border: double;padding: 10px;font-weight: 600;font-size: 22px">
                    CAMBRIDGE INTERNATIONAL SCHOOL
                </div>
                <br>
                <div id="hd" style="font-size: 17px" class="center-block">{{-- add sub header --}}</div>
                <br>
                <table id="updateCharges" role="grid" class="table  table-bordered table-striped display dataTable"
                       cellspacing="0"
                       width="100%">
                    {{--<thead>--}}
                    {{--<tr style="font-weight: 900">--}}
                    {{--<th>Admission No</th>--}}
                    {{--<th>Name</th>--}}
                    {{--<th>Class</th>--}}
                    {{--<th>Total Paid</th>--}}
                    {{--<th>Total Fee</th>--}}
                    {{--<th>Outstanding</th>--}}
                    {{--<th>Year</th>--}}
                    {{--</tr>--}}
                    {{--</thead>--}}
                    <tbody id="tblbody">
                    <tr hidden></tr>
                    </tbody>
                </table>

            </div>
            <div class="row hidden" id="btn">
                <div class="col-sm-12 form-group">
                    <input type="button" class="form-control print_inv btn btn-primary" onclick="printDiv('printDiv')"
                           value="Print"/></div>

            </div>
        </div>
        <div class="panel-footer fg-toolbar ui-toolbar ui-widget-header ui-helper-clearfix ui-corner-bl ui-corner-br"></div>
    </div>


</div>

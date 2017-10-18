<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
    <span class="hamb-top"></span>
    <span class="hamb-middle"></span>
    <span class="hamb-bottom"></span>
</button>

<div class="container">
    <h2>Daily Report</h2>
    <div class="panel panel-default dataTables_wrapper dt-jqueryui">
        <div class="panel-heading fg-toolbar ui-toolbar ui-widget-header ui-helper-clearfix ui-corner-tl ui-corner-tr">
            Daily Income & Expenses
        </div>
        <div class="panel-body">
            <div class="row" style="width: 50%; margin: auto">
                <div class=" col-md-9 col-sm-12 col-xs-12 ">
                    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                        <label for="date" class="col-md-2 control-label">Date</label>

                        <div class="col-md-8">
                            <input id="date" type="date" class="form-control" name="date"
                                   value="" required autofocus>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 form-group">
                    <div class="col-md-12">
                        <button type="submit" id="subBtn" class="btn btn-primary">
                            Generate Report
                        </button>
                    </div>
                </div>
            </div>
            <hr>
            <div class="table-responsive" id="printDiv">
                <div class="header center-block" style=" border: double;padding: 10px;font-weight: 600;font-size: 22px" >
                    CAMBRIDGE INTERNATIONAL SCHOOL
                </div><br>
                <div id="hd" style="font-size: 17px" class="center-block">{{-- add sub header --}}</div>
                <br>
                <table id="updateCharges" role="grid" class="table  table-bordered table-striped display dataTable"
                       cellspacing="0"
                       width="100%">
                    <thead>
                    <tr style="font-weight: 900">
                        <th>Details</th>
                        <th>Amount</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody id="tblbody">
                    <tr style="font-weight: 600">
                        <td>CASH IN HAND B/F</td>
                        <td></td>
                        <td id="CIH"></td>
                    </tr>
                    <tr>
                        <td>Term Fees-BC</td>
                        <td></td>
                        <td id="bcTF"></td>
                    </tr>
                    <tr>
                        <td>Term Fees-NC</td>
                        <td></td>
                        <td id="ncTF"></td>
                    </tr>
                    <tr>
                        <td>Exam Fee-BC</td>
                        <td></td>
                        <td id="bcEF"></td>
                    </tr>
                    <tr>
                        <td>Exam Fee-NC</td>
                        <td></td>
                        <td id="ncEF"></td>
                    </tr>
                    <tr>
                        <td>Extra Curricular-BC</td>
                        <td></td>
                        <td id="bcExtF"></td>
                    </tr>
                    <tr>
                        <td>Extra Curricular-NC</td>
                        <td></td>
                        <td id="ncExtF"></td>
                    </tr>
                    <tr>
                        <td>Stationary</td>
                        <td></td>
                        <td id="sta"></td>
                    </tr>
                    <tr>
                        <td>Refundable Deposit received</td>
                        <td></td>
                        <td id="ref"></td>
                    </tr>
                    <tr>
                        <td>Admission</td>
                        <td></td>
                        <td id="admi"></td>
                    </tr>
                    <tr>
                        <td id="addOincome">CGS Total Fee</td>
                        <td></td>
                        <td id="cos"></td>
                    </tr>
                    {{--append other income and Expenses--}}
                    <tr>
                        <td id="addExp">Admission Discount Expenses</td>
                        <td id="dis"></td>
                        <td></td>
                    </tr>
                    <tr style="font-weight: 600">
                        <td>TOTAL INCOME</td>
                        <td>-</td>
                        <td id="totIncm"></td>
                    </tr>
                    <tr style="font-weight: 600">
                        <td>TOTAL EXPENSE</td>
                        <td id="totExp"></td>
                        <td>-</td>
                    </tr>
                    <tr style="font-weight: 600">
                        <td>CASH IN HAND</td>
                        <td>-</td>
                        <td id="totCIH"></td>
                    </tr>
                    </tbody>
                </table>

            </div>
            <div class="row">
                <div class="col-sm-12 form-group">
                    <input type="button" class="form-control print_inv btn btn-primary" onclick="printDiv('printDiv')"
                           value="Print"/></div>

            </div>
        </div>
        <div class="panel-footer fg-toolbar ui-toolbar ui-widget-header ui-helper-clearfix ui-corner-bl ui-corner-br"></div>
    </div>


</div>

<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
    <span class="hamb-top"></span>
    <span class="hamb-middle"></span>
    <span class="hamb-bottom"></span>
</button>

<div class="container">
    <h2>Payment Arrear List</h2>
    <div class="panel panel-default dataTables_wrapper dt-jqueryui">
        <div class="panel-heading fg-toolbar ui-toolbar ui-widget-header ui-helper-clearfix ui-corner-tl ui-corner-tr">
            Arrear List for Term Payment for A Year
        </div>
        <div class="panel-body">
            <div class="row" style="width: 80%; margin: auto">
                <div class=" col-md-5 col-sm-12 col-xs-12 ">
                    <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                        <label for="year" class="col-md-4 control-label">Year</label>

                        <div class="col-md-8">
                            <input id="year" type="number" class="form-control" name="year"
                                   value="{{old('year')}}" required autofocus>
                        </div>
                    </div>
                </div>
                <div class=" col-md-5 col-sm-12 col-xs-12 ">
                    <div class="form-group{{ $errors->has('term') ? ' has-error' : '' }}">
                        <label for="term" class="col-md-4 control-label">Term</label>

                        <div class="col-md-8">
                            <select id="term" type="number" class="form-control" name="term"
                                   value="{{old('term')}}" required autofocus>
                                <option value="JAN-APR">JAN-APR</option>
                                <option value="MAY-AUG">MAY-AUG</option>
                                <option value="SEP-DEC">SEP-DEC</option>
                            </select>
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
                    <thead>
                    <tr style="font-weight: 900">
                        <th>Admission No</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Total Paid</th>
                        <th>Total Fee</th>
                        <th>Outstanding</th>
                        <th>Year</th>
                    </tr>
                    </thead>
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

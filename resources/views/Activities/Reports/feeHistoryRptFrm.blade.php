<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
    <span class="hamb-top"></span>
    <span class="hamb-middle"></span>
    <span class="hamb-bottom"></span>
</button>

<div class="container">
    <h2>Fees History Details</h2>
    <br>
    <br>
    <div class="row ">
        <div class=" col-md-6 col-sm-12 col-xs-12 ">
            <div class="form-group{{ $errors->has('AdNo') ? ' has-error' : '' }}">
                <label for="AdNo" class="col-md-5 control-label">Student Admission No</label>

                <div class="col-md-6">
                    <input id="AdNo" type="text" class="form-control" name="AdNo"
                           value="" required autofocus>
                </div>
            </div>
        </div>
        <div class="col-md-5 form-group">
            <div class="col-md-4">
                <button type="submit" id="subBtn" class="btn btn-primary">
                    Search
                </button>
            </div>
        </div>
    </div>
    <div class="container">
    <table id="viewFeeHistory" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Admission No</th>
            <th>Student Name</th>
            <th>Class Category</th>
            <th>Date</th>
            <th>Term</th>
            <th>Payment Method</th>
            <th>Amount</th>
            <th>Year</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Admission No</th>
            <th>Student Name</th>
            <th>Class Category</th>
            <th>Date</th>
            <th>Term</th>
            <th>Payment Method</th>
            <th>Amount</th>
            <th>Year</th>
        </tr>
        </tfoot>

    </table>
    </div>
</div>

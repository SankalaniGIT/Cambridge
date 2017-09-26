<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
    <span class="hamb-top"></span>
    <span class="hamb-middle"></span>
    <span class="hamb-bottom"></span>
</button>
<div class="container">
    <div id="page-wrap">
        <textarea id="header">{{$form}}</textarea>
        <div id="identity">
            <label id="address">CAMBRIDGE INTERNATIONAL SCHOOL
                N0:148,Aluthmawatha Road,Colombo 15.
                Tel:0114618705 </label>

            <div id="logo">
                <img src="{{asset('assets/image/home/cislogo3.png')}}">
            </div>
        </div>
        <div style="clear:both">
            <label id="installments">{{$part}}</label><br>
        </div>

        <div id="customer">

            <label id="customer-title">{{$Curriculum}}</label>
            <table id="meta">
                <tr>
                    <td class="meta-head">Invoice</td>
                    <td><label>{{$invNo}}</label></td>
                </tr>
                <tr>

                    <td class="meta-head">Date</td>
                    <td><label>{{$date}}</label></td>
                </tr>


            </table>

        </div>
        <table border="1" id="items">

            <tr>
                <th>Admission No</th>
                <th colspan="2">Name</th>
                <th>Class</th>
                <th>Amount</th>
                <th>Paid Amount</th>
            </tr>

            <tr class="item-row">
                <td class="item-name">{{$AdNo}}</td>
                <td class="item">{{$name}}</td>
                <td class="description"></td>
                <td>{{$class}}</td>
                <td>{{$amount}}</td>
                <td align="right">{{$paid}}</td>
            </tr>
            <tr id="hiderow">
                <td colspan="6"></td>
            <tr>
                <td colspan="3" class="blank"></td>
                <td colspan="2" class="total-line">Total Paid Amount</td>
                <td align="right" class="total-value">{{$totPaid}}</td>
            </tr>


        </table>

        <div id="terms">
            <h5>{{$bottom}}</h5>
            <textarea>Fees once paid will not be refund </textarea>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col-sm-6 form-group">
            <input type="button" class="form-control back_inv btn btn-primary" value="Back" onclick="window.location='{{route('admission&Ref')}}'"/>
        </div>
        <div class="col-sm-6 form-group">
            <input type="button" class="form-control print_inv btn btn-primary" onclick="printDiv('page-wrap')" value="Print"/></div>

    </div>
</div>
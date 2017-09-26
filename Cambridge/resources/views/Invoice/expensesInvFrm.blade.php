<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
    <span class="hamb-top"></span>
    <span class="hamb-middle"></span>
    <span class="hamb-bottom"></span>
</button>
<div class="container">
    <div id="page-wrap">
        <textarea id="header">CASH/CHEQUE PAYMENT VOUCHER</textarea>
        <div id="identity">
            <label id="address">CAMBRIDGE INTERNATIONAL SCHOOL
                N0:148,Aluthmawatha Road,Colombo 15.
                Tel:0114618705 </label>

            <div id="logo">
                <img src="{{asset('assets/image/home/cislogo3.png')}}">
            </div>
        </div>
        <div style="clear:both">

        </div>

        <div id="customer">

            <label id="customer-title"></label>
            <table id="meta">
                <tr>
                    <td class="meta-head">Receipt No:</td>
                    <td><label>{{$invNo}}</label></td>
                </tr>
                <tr>
                    <td class="meta-head">Date</td>
                    <td><label>{{$date}}</label></td>
                </tr>
                <tr>
                    <td class="meta-head">Sender Name</td>
                    <td><label>{{$Sname}}</label></td>
                </tr>
                <tr>
                    <td class="meta-head">Receiver Name</td>
                    <td><label>{{$Rname}}</label></td>
                </tr>

            </table>

        </div>
        <table border="1" id="items">

            <tr>
                <th colspan="2">Expense Type</th>
                <th colspan="2">Description</th>
                <th colspan="2">Amount</th>
            </tr>
            @for($i=0;$i<$count;$i++)
                <tr class="item-row">
                    <td class="item-name">{{$type[$i]}}</td>
                    <td></td>
                    <td class="description">{{$description[$i]}}</td>
                    <td></td>
                    <td></td>
                    <td align="right">{{$amount[$i]}}</td>
                </tr>
            @endfor
            <tr id="hiderow">
                <td colspan="6"></td>
            <tr>
                <td colspan="3" class="blank"></td>
                <td colspan="2" class="total-line">Total Fee</td>
                <td align="right" class="total-value">{{$total}}</td>
            </tr>


        </table>

        <div id="terms">
            <h5>TERMS</h5>
            <textarea>Fees once paid will not be refund </textarea>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-6 form-group">
            <input type="button" class="form-control back_inv btn btn-primary" value="Back"
                   onclick="window.location='{{route('viewPayExpenses')}}'"/>
        </div>
        <div class="col-sm-6 form-group">
            <input type="button" class="form-control print_inv btn btn-primary" onclick="printDiv('page-wrap')"
                   value="Print"/></div>

    </div>
</div>
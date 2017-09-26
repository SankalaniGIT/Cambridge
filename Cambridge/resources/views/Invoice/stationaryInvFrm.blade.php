<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
    <span class="hamb-top"></span>
    <span class="hamb-middle"></span>
    <span class="hamb-bottom"></span>
</button>
<div class="inv">
    <div class="row  col-sm-12 ">
        <div class=" cleardata" style="text-align:left;">
            <div class="col-xs-6">
                <h4>Cambridge International Institute (pvt) Ltd</h4>
                <h5>N0:150,Aluthmawatha Road,Colombo 15</h5>
                <h5>Tel:0114618705/0114618705 </h5>
            </div>
            <div class="col-xs-6">
                <img src="{{asset('assets/image/home/cislogo3.png')}}" align="right">
            </div>
        </div>
    </div>

    <div class="row col-xs-12" style=" height:110px; ">
        <div class="col-xs-4">
            <table class="table">
                <tbody>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td>Stationary Invoice</td>
                </tr>
                <tr>
                    <td>{{$AdNo}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-xs-4"><h5 style="text-align:center;" class="cleardata">Invoice</h5></div>
        <div class="col-xs-4">
            <table class="table" style="text-align:center;">
                <tbody>
                <tr align="right">
                    <td class="cleardata">Invoice No:</td>
                    <td>{{$invNo}}</td>
                </tr>
                <tr align="right">
                    <td class="cleardata">Date:</td>
                    <td>{{$date}}</td>
                </tr>
                <tr align="right">
                    <td class="cleardata">Term:</td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row col-xs-12" style="margin:auto; ">
        <table class="table" style=" font-size:12px;">
            <tbody>
            <tr class="cleardata">
                <th>Stationary Item</th>
                <th></th>
                <th>Quantity</th>
                <th></th>
                <th style="text-align:right;">Amount</th>
            </tr>

            @for($i = 0; $i < $count; $i++)
                <tr align="center">
                    <td>{{$item[$i]}}</td>
                    <td></td>
                    <td>{{$qty[$i]}}</td>
                    <td>------</td>
                    <td style="text-align:right;">{{$tot[$i]}}</td>
                </tr>
            @endfor
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class="cleardata">Total Amount</td>
                <td style=" text-align:right;"><?php echo number_format($total);?></td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="row col-xs-12" style="margin: auto;">
        <table class="table" style="width: 90%; font-size: xx-small;">
            <tr>
                <td class="cleardata">Amount in words:</td>
                <td colspan="2"
                    style="text-align:center;"> <?php echo strtoupper(convert_number_to_words($total)); ?></td>
            </tr>
            <tr>
                <td colspan="3" style="text-align:center;" class="cleardata">Fees once paid will not be refunded</td>
            </tr>
        </table>
    </div>


</div>



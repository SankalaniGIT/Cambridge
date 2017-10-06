<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
    <span class="hamb-top"></span>
    <span class="hamb-middle"></span>
    <span class="hamb-bottom"></span>
</button>

<div class="container">
    <h2>Term Payment Details</h2>
    <table id="viewPayFee" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Invoice No</th>
            <th>Student ID</th>
            <th>Name</th>
            <th>Class</th>
            <th>Fees Type</th>
            <th>Term</th>
            <th>Amount</th>
            <th>Date</th>
            <th></th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Invoice No</th>
            <th>Student ID</th>
            <th>Name</th>
            <th>Class</th>
            <th>Fees Type</th>
            <th>Term</th>
            <th>Amount</th>
            <th>Date</th>
            <th></th>
        </tr>
        </tfoot>
        <tbody>

        @foreach($termFees as $TF)

            <tr>
                <td>{{$TF['invNo']}}</td>
                <td>{{$TF['adNo']}}</td>
                <td>{{$TF['name']}}</td>
                <td>{{$TF['cls']}}</td>
                <td>{{$TF['Ftype']}}</td>
                <td>{{$TF['month']}}</td>
                <td>{{$TF['amt']}}</td>
                <td>{{$TF['date']}}</td>
                <td>
                    <a href=" {!! route('CosInv',['course'=>$TF['Ftype'],'id'=>$TF['adNo'],'invNo'=>$TF['invNo'],'date'=>$TF['date'],'name'=>$TF['name'],'paid'=>$TF['amt'],'month'=>$TF['month'],'term'=>$TF['term']]) !!}">Print</a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>

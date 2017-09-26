<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
    <span class="hamb-top"></span>
    <span class="hamb-middle"></span>
    <span class="hamb-bottom"></span>
</button>

<div class="container">
    <h2>Expense Details</h2>
    <table id="viewExpenses" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Date</th>
            <th>Expense Type</th>
            <th>Description</th>
            <th>Accountant</th>
            <th>Payee</th>
            <th>Amount</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Date</th>
            <th>Expense Type</th>
            <th>Description</th>
            <th>Accountant</th>
            <th>Payee</th>
            <th>Amount</th>
        </tr>
        </tfoot>
        <tbody>

        @foreach($expenses as $exp)
            <tr>
                <td>{{$exp->date}}</td>
                <td>{{$exp->expense_type}}</td>
                <td>{{$exp->description}}</td>
                <td>{{$exp->sender_name}}</td>
                <td>{{$exp->receiver_name}}</td>
                <td>{{$exp->amount}}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>

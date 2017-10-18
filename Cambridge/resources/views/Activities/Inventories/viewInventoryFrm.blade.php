<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
    <span class="hamb-top"></span>
    <span class="hamb-middle"></span>
    <span class="hamb-bottom"></span>
</button>

<div class="container">
    <h2>Inventory Details</h2>
    <table id="viewInventory" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Id</th>
            <th>Item Name</th>
            <th>Purchase Price</th>
            <th>Selling Price</th>
            <th>Quantity</th>
            <th>Total Remaining Purchase Price</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Id</th>
            <th>Item Name</th>
            <th>Purchase Price</th>
            <th>Selling Price</th>
            <th>Quantity</th>
            <th>Total Remaining Purchase Price</th>
        </tr>
        </tfoot>
        <tbody>

        @foreach($inventory as $key=>$inven)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$inven->st_type}}</td>
                <td>{{$inven->purchase_price}}</td>
                <td>{{$inven->price}}</td>
                <td>{{$inven->quantity}}</td>
                <td>{{$inven->quantity*$inven->purchase_price}}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>

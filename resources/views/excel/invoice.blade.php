<table>
    <thead>
        <tr>
            <th>Cart Total</th>
            <th>Discount Total</th>
            <th>Sub Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($invoices as $invoice)
            <tr>
                <td>{{ $invoice->cart_total }}</td>
                <td>{{ $invoice->discount_total }}</td>
                <td>{{ $invoice->sub_total }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

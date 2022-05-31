<table class="table">
    <thead>
        <tr>
            <th class="border-top-0">#</th>
            <th class="text-right">{{ __('messages.product_name') }}</th>
            <th class="border-top-0">{{ __('messages.quantity') }}</th>
            <th class="text-right">{{ __('messages.unit_price') }}</th>
            <th class="text-right">{{ __('messages.item_cost') }}</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($customer_invoice_details as $customer_invoice_detail)
            <tr>
                <td class="text-truncate"> {{ $customer_invoice_detail->id }}</td>
                <td class="text-truncate">{{ $customer_invoice_detail->stock->$product_name }} </td>
                <td class="text-truncate"> {{ $customer_invoice_detail->purchase_quantity }}</td>
                <td class="text-truncate"> {{ $customer_invoice_detail->purchase_unit_price }}</td>
                <td class="text-truncate">
                    {{ $customer_invoice_detail->purchase_unit_price * $customer_invoice_detail->purchase_quantity }}
                </td>
            </tr>
        @endforeach

    </tbody>
</table>

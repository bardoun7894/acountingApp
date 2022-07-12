<table id="datatableBootstrap" class=" table  table-striped table-bordered">
    <thead>
        <tr>
            <th class="border-top-0"> {{ __('messages.supplierName') }} </th>
            <th class="border-top-0"> {{ __('messages.phoneNumber') }} </th>
            <th class="border-top-0">{{ __('messages.invoice_number') }}</th>

            <th class="border-top-0"> {{ __('messages.invoice_date') }} </th>
            <th class="border-top-0">{{ __('messages.total_amount') }}</th>
            <th class="border-top-0">{{ __('messages.paid_amount') }}</th>
            <th class="border-top-0">{{ __('messages.remaining_payment') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($purchasePaymentHistories as $purchasePaymentHistory)
            <tr>
                <td class="text-truncate"> {{ $purchasePaymentHistory->$supplier_name }} </td>
                <td class="text-truncate"> {{ $purchasePaymentHistory->phone }} </td>
                <td class="text-truncate"> {{ $purchasePaymentHistory->invoice_no }} </td>
                <td class="text-truncate"> {{ $purchasePaymentHistory->invoice_date }} </td>
                <td class="text-truncate"> {{ $purchasePaymentHistory->total_amount }} </td>
                <td class="text-truncate"> {{ $purchasePaymentHistory->payment_amount }} </td>
                <td class="text-truncate"> {{ $purchasePaymentHistory->remaining_balance }} </td>
            </tr>
        @endforeach

    </tbody>

</table>

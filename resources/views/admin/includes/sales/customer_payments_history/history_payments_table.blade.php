<table id="datatableBootstrap" class=" table  table-striped table-bordered">
    <thead>
        <tr>
            <th class="border-top-0"> {{ __('messages.customerName') }} </th>
            <th class="border-top-0"> {{ __('messages.phoneNumber') }} </th>
            <th class="border-top-0">{{ __('messages.invoice_number') }}</th>

            <th class="border-top-0"> {{ __('messages.invoice_date') }} </th>
            <th class="border-top-0">{{ __('messages.total_amount') }}</th>
            <th class="border-top-0">{{ __('messages.paid_amount') }}</th>
            <th class="border-top-0">{{ __('messages.remaining_payment') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($salePaymentHistories as $salePaymentHistory)
            <tr>
                <td class="text-truncate"> {{ $salePaymentHistory->$customer_name }} </td>
                <td class="text-truncate"> {{ $salePaymentHistory->contact_number }} </td>
                <td class="text-truncate"> {{ $salePaymentHistory->invoice_number }} </td>
                <td class="text-truncate"> {{ $salePaymentHistory->invoice_date }} </td>
                <td class="text-truncate"> {{ $salePaymentHistory->total_amount }} </td>
                <td class="text-truncate"> {{ $salePaymentHistory->payment_amount }} </td>
                <td class="text-truncate"> {{ $salePaymentHistory->remaining_balance }} </td>
            </tr>
        @endforeach

    </tbody>

</table>

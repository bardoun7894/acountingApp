<table id="datatableBootstrap" class=" table  table-striped table-bordered">
    <thead>
        <tr>
            <th class="border-top-0"> {{ __('messages.supplierName') }} </th>
            <th class="border-top-0"> {{ __('messages.phoneNumber') }} </th>
            <th class="border-top-0">{{ __('messages.invoice_number') }}</th>

            <th class="border-top-0"> {{ __('messages.invoice_date') }} </th>
            <th class="border-top-0"> {{ __('messages.branch_name') }} </th>
            <th class="border-top-0">{{ __('messages.total_amount') }}</th>
            <th class="border-top-0">{{ __('messages.paid_amount') }}</th>
            <th class="border-top-0">{{ __('messages.remaining_payment') }}</th>
            <th class="border-top-0"> </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($purchasePaymentPendings as $purchasePaymentPending)
            <tr>

                <td class="text-truncate">
                    {{ $purchasePaymentPending->$supplier_name }} </td>
                <td class="text-truncate">
                    {{ $purchasePaymentPending->phone }} </td>

                <td class="text-truncate"> {{ $purchasePaymentPending->invoice_no }} </td>
                <td class="text-truncate"> {{ $purchasePaymentPending->invoice_date }} </td>
                <td class="text-truncate">
                    {{ $purchasePaymentPending->$branch_name }} </td>
                <td class="text-truncate"> {{ $purchasePaymentPending->total_amount }} </td>
                <td class="text-truncate"> {{ $purchasePaymentPending->payment }} </td>
                <td class="text-truncate"> {{ $purchasePaymentPending->remaining_payment }} </td>
                <td>
                    <div class=" btn-group">
                        @if ($purchasePaymentPending->total_amount - 1 > $purchasePaymentPending->payment)
                            <a href="{{ url('paid_supplier_amount/' . $purchasePaymentPending->id) }}"
                                class="btn-info p-1">
                                {{ __('messages.pay_amount') }} <i class="la la-money"></i></a>
                        @endif
                        @if ($purchasePaymentPending->payment > 0)
                            <a href="{{ url('purchase_payment_history/' . $purchasePaymentPending->id) }}"
                                class="btn-secondary p-1"> {{ __('messages.payment_history') }} <i
                                    class="la la-history"></i></a>
                        @endif

                    </div>
                </td>

            </tr>
        @endforeach

    </tbody>

</table>

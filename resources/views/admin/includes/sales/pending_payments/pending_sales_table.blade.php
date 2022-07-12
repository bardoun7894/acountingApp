<table id="datatableBootstrap" class=" table  table-striped table-bordered">
    <thead>
        <tr>
            <th class="border-top-0"> {{ __('messages.customerName') }} </th>
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
        @foreach ($salePaymentPendings as $salePaymentPending)
            <tr>

                <td class="text-truncate">
                    {{ $salePaymentPending->$customer_name }} </td>
                <td class="text-truncate">
                    {{ $salePaymentPending->contact_number }} </td>

                <td class="text-truncate"> {{ $salePaymentPending->invoice_number }} </td>
                <td class="text-truncate"> {{ $salePaymentPending->invoice_date }} </td>
                <td class="text-truncate"> {{ $salePaymentPending->$branch_name }} </td>
                <td class="text-truncate"> {{ $salePaymentPending->total_amount }} </td>
                <td class="text-truncate"> {{ $salePaymentPending->payment }} </td>
                <td class="text-truncate"> {{ $salePaymentPending->remaining_payment }} </td>
                <td>
                    <div class=" btn-group">
                        @if ($salePaymentPending->total_amount - 1 > $salePaymentPending->payment)
                            <a href="{{ url('paid_customer_amount/' . $salePaymentPending->id) }}"
                                class="btn-info p-1">
                                {{ __('messages.pay_amount') }} <i class="la la-money"></i></a>
                        @endif
                        @if ($salePaymentPending->payment > 0)
                            <a href="{{ url('sale_payment_history/' . $salePaymentPending->id) }}"
                                class="btn-secondary p-1"> {{ __('messages.payment_history') }} <i
                                    class="la la-history"></i></a>
                        @endif

                    </div>
                </td>

            </tr>
        @endforeach

    </tbody>

</table>

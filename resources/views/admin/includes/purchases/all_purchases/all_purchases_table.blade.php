<table id="datatableBootstrap" class="table table-striped table-bordered table-sm">
    <thead>
        <tr>
            <th class="border-top-0">{{ __('messages.invoice_number') }}</th>
            <th class="border-top-0">{{ __('messages.invoice_date') }}</th>
            <th class="border-top-0">{{ __('messages.supplierName') }}</th>
            <th class="border-top-0">{{ __('messages.sub_total') }}</th>
            <th class="border-top-0">{{ __('messages.tax') }}</th>
            <th class="border-top-0">{{ __('messages.order_total') }}</th>
            <th class="border-top-0">{{ __('messages.paid_amount') }}</th>
            <th class="border-top-0">{{ __('messages.status') }}</th>
            <th class="border-top-0">{{ __('messages.view') }}</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($supplierInvoices as $supplierInvoice)
            @foreach ($supplierInvoice->supplier_payments as $payment)
                <h1 hidden>
                    {{ $paidAmount = $payment->where('supplier_invoice_id', $supplierInvoice->id)->sum('payment_amount') }}
                </h1>
            @endforeach
            <tr>
                <td class="text-truncate">{{ $supplierInvoice->invoice_no }}</td>
                <td class="text-truncate">{{ $supplierInvoice->invoice_date }}</td>
                <td class="text-truncate">
                    {{ $supplierInvoice->supplier->$supplier_name }}
                </td>
                <td class="text-truncate">
                    {{ $supplierInvoice->sub_total_amount }}
                </td>
                <td class="text-truncate">{{ $supplierInvoice->tax }}</td>
                <td class="text-truncate">{{ $supplierInvoice->total_amount }}</td>
                <td class="text-truncate">{{ $paidAmount }}</td>

                <td class="align-middle">
                    @if ($paidAmount == $supplierInvoice->total_amount)
                        <div class="ac-status badge badge-success badge-pill badge-sm">
                            {{ __('messages.paid') }}
                        </div>
                    @elseif($paidAmount == 0)
                        <div class="ac-status badge badge-danger badge-pill badge-sm">
                            {{ __('messages.due') }}
                        </div>
                    @elseif($paidAmount < $supplierInvoice->total_amount)
                        <div class="ac-status badge badge-danger badge-pill badge-sm">
                            {{ __('messages.partial_payment') }}
                        </div>
                    @endif
                </td>

                <td class="text-truncate">
                    <a href="{{ url('purchase_invoice/' . $supplierInvoice->id) }}"> <i class="la la-search info"
                            aria-hidden="true"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

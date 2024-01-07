<table id="datatableBootstrap" class="table table-striped table-bordered table-sm ">
    <thead>
        <tr>
            <th class="border-top-0"> {{ __('messages.customerName') }} </th>
            <th class="border-top-0"> {{ __('messages.phoneNumber') }} </th>
            <th class="border-top-0"> {{ __('messages.invoice_number') }} </th>
            <th class="border-top-0">{{ __('messages.invoice_date') }} </th>
            <th class="border-top-0">{{ __('messages.order_total') }} </th>
            <th class="border-top-0">{{ __('messages.paid_amount') }} </th>
            <th class="border-top-0">{{ __('messages.remaining_balance') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customerInvoices as $customerInvoice)
        
            <tr>
                <td class="text-truncate"> {{ $customerInvoice->invoice_number }} </td>
                <td class="text-truncate"> {{ $customerInvoice->invoice_date }} </td>
                <td class="text-truncate"> {{ $customerInvoice->customer->customer_name_en }} </td>
                <td class="text-truncate"> {{ $customerInvoice->sub_total_amount }} </td>
                <td class="text-truncate"> {{ $customerInvoice->tax }} </td>
                <td class="text-truncate"> {{ $customerInvoice->total_amount }} </td>
                <td class="text-truncate"> {{ $paidAmount }} </td>

                <td class="align-middle">
                    @if ($paidAmount == $customerInvoice->total_amount)
                        <div class="ac-status badge badge-success badge-pill badge-sm"> clear
                        </div>
                    @elseif($paidAmount == 0)
                        <div class="ac-status badge badge-danger badge-pill badge-sm"> payment Pending
                        </div>
                    @elseif($paidAmount < $customerInvoice->total_amount)
                        <div class="ac-status badge badge-danger badge-pill badge-sm"> in Progress
                        </div>
                    @endif

                </td>
                {{-- <td class="text-truncate"> {{$sale->$description}}</td> --}}
                {{-- <td class="text-truncate">no</td> --}}
                <td class="text-truncate"> <a href="{{ url('sale_invoice/' . $customerInvoice->id) }}"> <i
                            class="la la-search info"></i></a>
                         </td>
            </tr>
        @endforeach

    </tbody>

</table>

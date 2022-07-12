<table id="datatableBootstrap" class="table table-striped table-bordered table-sm ">
    <thead>
        <tr>
            <th class="border-top-0"> {{ __('messages.supplierName') }} </th>
            <th class="border-top-0"> {{ __('messages.invoice_number') }} </th>
            <th class="border-top-0"> {{ __('messages.total_amount') }} </th>
            <th class="border-top-0">{{ __('messages.paid_amount') }} </th>
            <th class="border-top-0">{{ __('messages.remaining_payment') }}</th>
            <th class="border-top-0">{{ __('messages.invoice_date') }} </th>
            <th class="border-top-0">{{ __('messages.user_name') }} </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($purchase_payment_details as $purchase_payment_detail)
            <tr>
                <td class="text-truncate"> {{ $supplier->supplier_name_en }} </td>
                <td class="text-truncate"> {{ $purchase_payment_detail->invoice_no }} </td>
                <td class="text-truncate"> {{ $purchase_payment_detail->total_amount }} </td>
                <td class="text-truncate"> {{ $purchase_payment_detail->payment_amount }} </td>
                <td class="text-truncate"> {{ $purchase_payment_detail->remaining_balance }} </td>

                <td class="text-truncate"> {{ $purchase_payment_detail->invoice_date }} </td>
                <td class="text-truncate"> {{ $user->$full_name }} </td>

                {{-- <td class="text-truncate"> {{$purchase->$description}}</td> --}}
                {{-- <td class="text-truncate">no</td> --}}
                <td class="text-truncate"> <a href="{{ url('purchase_invoice/' . $purchase_payment_detail->id) }}"> <i
                            class="la la-search info"></i></a> </td>

            </tr>
        @endforeach

    </tbody>

</table>

<table id="datatableBootstrap" class="table table-striped table-bordered table-sm ">
    <thead>
        <tr>
            <th class="border-top-0"> {{ __('messages.customerName') }} </th>
            <th class="border-top-0"> {{ __('messages.invoice_number') }} </th>
            <th class="border-top-0"> {{ __('messages.total_amount') }} </th>
            <th class="border-top-0">{{ __('messages.paid_amount') }} </th>
            <th class="border-top-0">{{ __('messages.remaining_payment') }}</th>
            <th class="border-top-0">{{ __('messages.invoice_date') }} </th>
            <th class="border-top-0">{{ __('messages.user_name') }} </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sale_payment_details as $sale_payment_detail)
            <tr>
                <td class="text-truncate"> {{ $customer->customer_name_en }} </td>
                <td class="text-truncate"> {{ $sale_payment_detail->invoice_number }} </td>
                <td class="text-truncate"> {{ $sale_payment_detail->total_amount }} </td>
                <td class="text-truncate"> {{ $sale_payment_detail->payment_amount }} </td>
                <td class="text-truncate"> {{ $sale_payment_detail->remaining_balance }} </td>

                <td class="text-truncate"> {{ $sale_payment_detail->invoice_date }} </td>
                <td class="text-truncate"> {{ $user->$full_name }} </td>

                {{-- <td class="text-truncate"> {{$sale->$description}}</td> --}}
                {{-- <td class="text-truncate">no</td> --}}
                <td class="text-truncate"> <a href="{{ url('sale_invoice/' . $sale_payment_detail->id) }}">
                        <i class="la la-search info"></i></a> </td>

            </tr>
        @endforeach

    </tbody>

</table>

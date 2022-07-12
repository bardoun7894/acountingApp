<table id="dtd" class="table table-striped table-bordered table-sm ">
    <thead>
        <tr>
            <th class="border-top-0">{{ __('messages.product_name') }}</th>
            <th class="border-top-0"> {{ __('messages.quantity') }} </th>
            <th class="border-top-0"> {{ __('messages.sale_price') }} </th>
            <th class="border-top-0">{{ __('messages.item_cost') }}</th>
            <th class="border-top-0">{{ __('messages.edit') }}</th>
            <th class="border-top-0">{{ __('messages.delete') }}</th>
        </tr>
    </thead>
    <tbody id="sales-dynamicRow">
        @foreach ($sales as $sale)
            <tr>
                <td class="text-truncate"> {{ $sale->stock->$product_name }}</td>
                {{-- <td class="text-truncate"> {{$sale->user->full_name_en}}</td> --}}
                <td class="text-truncate"> {{ $sale->sale_qty }}</td>
                <td class="text-truncate"> {{ $sale->sale_unit_price }}</td>
                <td class="text-truncate"> {{ $sale->sale_unit_price * $sale->sale_qty }}</td>
                {{-- <td class="text-truncate"> {{$sale->$description}}</td> --}}
                {{-- <td class="text-truncate">no</td> --}}


            </tr>
        @endforeach
    </tbody>

</table>

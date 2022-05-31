<table id="datatableBootstrap" class="table table-striped table-bordered table-sm ">
    {{-- style="  display: block;   width:80%;  overflow: scroll;  " --}}
    <caption>Stocks Table</caption>

    <thead>
        <tr>
            <th class="border-top-0">{{ __('messages.barcode') }}</th>
            <th class="border-top-0">{{ __('messages.product_name') }}</th>
            <th class="border-top-0">{{ __('messages.category_name') }}</th>
            <th class="border-top-0"> {{ __('messages.fullName') }} </th>
            <th class="border-top-0"> {{ __('messages.quantity') }} </th>
            <th class="border-top-0"> {{ __('messages.purchase_price') }} </th>
            <th class="border-top-0"> {{ __('messages.sale_price') }} </th>
            <th class="border-top-0">{{ __('messages.expire_date') }}</th>
            <th class="border-top-0">{{ __('messages.description') }}</th>
            <th class="border-top-0">{{ __('messages.edit') }}</th>
            <th class="border-top-0">{{ __('messages.delete') }}</th>
        </tr>
    </thead>
    {{-- @foreach ($categories as $category) --}}
    <tbody id="stocks-dynamicRow">

        @foreach ($stocks as $stock)
            <tr>


                <td class="text-truncate"> {{ $stock->barcode }}</td>
                <td class="text-truncate"> {{ $stock->$product_name }}</td>
                <td class="text-truncate"> {{ $stock->category->category_name_en }}</td>
                <td class="text-truncate"> {{ $stock->user->full_name_en }}</td>
                <td class="text-truncate"> {{ $stock->quantity }}</td>
                <td class="text-truncate"> {{ $stock->current_purchase_unit_price }}</td>
                <td class="text-truncate"> {{ $stock->current_sale_unit_price }}</td>
                <td class="text-truncate"> {{ $stock->expiry_date }}</td>
                <td class="text-truncate"> {{ $stock->$description }}</td>
                <td class="text-truncate"> <a href="{{ url('stocks/' . $stock->id . '/edit') }}"> <i
                            class="la la-edit" style="color: green;font-size: 25px"></i></a> </td>
                <td>
                    <a class="confirmDelete" record="Stock" recordId="{{ $stock->id }}"> <i class="la la-trash"
                            style="color: red;font-size: 25px"></i>
                    </a>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>

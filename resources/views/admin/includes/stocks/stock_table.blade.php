<table id="datatableBootstrap" class="table table-striped table-bordered table-sm ">
    <caption>{{ __('messages.stocks') }}</caption>

    <thead>
        <tr>
            <th class="border-top-0">{{ __('messages.barcode') }}</th>
            <th class="border-top-0">{{ __('messages.image') }}</th>
            <th class="border-top-0">{{ __('messages.product_name') }}</th>
            <th class="border-top-0">{{ __('messages.category_name') }}</th>
            <th class="border-top-0"> {{ __('messages.fullName') }} </th>
            <th class="border-top-0"> {{ __('messages.quantity') }} </th>
            <th class="border-top-0"> {{ __('messages.purchase_price') }} </th>
            <th class="border-top-0"> {{ __('messages.sale_price') }} </th>
            <th class="border-top-0">{{ __('messages.description') }}</th>
            <th class="border-top-0">{{ __('messages.edit') }}</th>
            <th class="border-top-0">{{ __('messages.delete') }}</th>
        </tr>
    </thead>
    <tbody id="stocks-dynamicRow">

        @foreach ($stocks as $stock)
            <tr>


                <td class="text-truncate"> {{ $stock->barcode }}</td>
                <td class="text-truncate">

                    <img @if (!empty($stock['image'])) src="{{ asset('admin/app-assets/images/products/' . $stock->image) }}"
                @else
                    src="{{ asset('admin/app-assets/images/no-image.png') }}" @endif
                        alt="{{ $stock->product_name }}" width="50" height="50">
                </td>
                <td class="text-truncate"> {{ $stock->$product_name }}</td>
                <td class="text-truncate"> {{ $stock->category->category_name_en }}</td>
                <td class="text-truncate"> {{ $stock->user->full_name_en }}</td>
                <td class="text-truncate"> {{ $stock->quantity }}</td>
                <td class="text-truncate"> {{ $stock->current_purchase_unit_price }}</td>
                <td class="text-truncate"> {{ $stock->current_sale_unit_price }}</td>
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

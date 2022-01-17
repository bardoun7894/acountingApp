

    <table   class="table table-striped table-bordered scroll-vertical  " >
{{--    <table   class="table table-bordered" >--}}

        <thead  >
        <tr>
            <th class="border-top-0">product</th>
            {{--                                <th class="border-top-0">Stock Name</th>--}}
            {{--                                            <th class="border-top-0">Category</th>--}}
            {{--                                            <th class="border-top-0"><p>created by</p></th>--}}
            <th class="border-top-0"><p>Qty</p></th>
            <th class="border-top-0"> <p>Purchase</p><p>Unit</p>Price</th>
            <th class="border-top-0"><p>Sale</p><p>Unit</p>Price</th>
            <th class="border-top-0"><p>Expire</p> Date</th>
            <th class="border-top-0"><p>manufacture</p> Date</th>
            {{--                                Stock  Hold Qty--}}
            <th class="border-top-0"><p>Stock</p><p>Trash</p>Qty</th>
            <th class="border-top-0"><p>Item</p><p>Cost</p></th>
            {{--                                <th class="border-top-0"><p>description</p></th>--}}
            <th class="border-top-0"><p>View</p></th>
            <th class="border-top-0"><p>Edit</p></th>
            <th class="border-top-0"><p>delete</p></th>
        </tr>
        </thead>
        {{--                            @foreach($categories as $category)--}}
        <tbody id="purchases-dynamicRow">
        @foreach($purchases as $purchase)

            <td class="text-truncate"> {{$purchase->stock->$product_name}}</td>
            {{--                                            <td class="text-truncate"> {{$purchase->category->category_name_en}}</td>--}}
            {{--                                            <td class="text-truncate"> {{$purchase->user->full_name_en}}</td>--}}
            <td class="text-truncate"> {{$purchase->purchase_qty}}</td>
            <td class="text-truncate"> {{$purchase->purchase_unit_price}}</td>
            <td class="text-truncate"> {{$purchase->sale_unit_price}}</td>
            <td class="text-truncate"> {{$purchase->expiry_date}}</td>
            <td class="text-truncate"> {{$purchase->manufacture_date}}</td>
            <td class="text-truncate"> {{$purchase->stock_trash_hold_qty}}</td>
            <td class="text-truncate"> {{ $purchase->purchase_unit_price* $purchase->purchase_qty}}</td>
            {{--                                    <td class="text-truncate"> {{$purchase->$description}}</td>--}}
            {{--                                    <td class="text-truncate">no</td>--}}
            <td class="text-truncate">   <a href="{{url('purchases/'.$purchase->id)}}">  <i class="la la-file-o" style="color: blue;font-size: 25px"></i></a> </td>
            <td class="text-truncate">   <a href="{{url('purchases/'.$purchase->id.'/edit')}}">  <i class="la la-edit" style="color: green;font-size: 25px"></i></a> </td>
            <td>
                <a  class="confirmDelete"  record="Purchase"  recordId="{{$purchase->id}}">  <i class="la la-trash" style="color: red;font-size: 25px"></i>
                </a>
            </td>

        </tbody>
        @endforeach
    </table>


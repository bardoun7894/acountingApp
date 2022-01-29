
<table id="datatableBootstrap" class="table table-striped table-bordered table-sm"  >
        <thead  >
        <tr>
            <th class="border-top-0">{{__("messages.product_name")}}</th>
            {{--    <th class="border-top-0">Stock Name</th>--}}
            {{--     <th class="border-top-0"><p>created by</p></th>--}}
            <th class="border-top-0"> {{__("messages.quantity")}} </th>
            <th class="border-top-0">  {{__("messages.purchase_price")}}  </th>
            <th class="border-top-0"> {{__("messages.sale_price")}} </th>
            <th class="border-top-0">{{__("messages.expire_date")}}</th>
            <th class="border-top-0">{{__("messages.item_cost")}}</th>
            <th class="border-top-0">{{__("messages.edit")}}</th>
            <th class="border-top-0">{{__("messages.delete")}}</th>
        </tr>
        </thead>
        <tbody id="purchases-dynamicRow">
        @foreach($purchases as $purchase)
        <tr>
            <td class="text-truncate"> {{$purchase->stock->$product_name}}</td>
            {{--       <td class="text-truncate"> {{$purchase->user->full_name_en}}</td>--}}
            <td class="text-truncate"> {{$purchase->purchase_qty}}</td>
            <td class="text-truncate"> {{$purchase->purchase_unit_price}}</td>
            <td class="text-truncate"> {{$purchase->sale_unit_price}}</td>
            <td class="text-truncate"> {{$purchase->expiry_date}}</td>
            <td class="text-truncate"> {{ $purchase->purchase_unit_price* $purchase->purchase_qty}}</td>
            {{--                                    <td class="text-truncate"> {{$purchase->$description}}</td>--}}
            {{--                                    <td class="text-truncate">no</td>--}}
           <td class="text-truncate">   <a href="{{url('purchases/'.$purchase->id.'/edit')}}"> <i class="la la-edit" style="color: green;font-size: 25px"></i></a> </td>
            <td>
                <a  class="confirmDelete"  record="Purchase"  recordId="{{$purchase->id}}">  <i class="la la-trash" style="color: red;font-size: 25px"></i>
                </a>
            </td>
        </tr>
        @endforeach
        </tbody>

    </table>


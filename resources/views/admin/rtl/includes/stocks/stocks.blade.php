@extends('admin.ltr.dashboard')
@section('content')

<div class="row" style="display: flex;justify-content: center; margin: 10px ;"  >
    <div id="recent-transactions"  >
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Stocks</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a class="btn btn-sm btn-blue box-shadow-2 round btn-min-width pull-right" href="{{url('stocks/create')}}" target="_blank">Add Stock</a></li>
                    </ul>
                </div>
            </div>

            @if(session()->has('message'))
               @switch(session()->get('message'))
                  @case('Stock Deleted Successfully')
                  <div class="alert alert-danger">
                    {{ session()->get('message') }}
                </div>
                    @break
                @case('Stock Updated Successfully')

                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                    @break
                @case('Stock added Successfully')

                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                        @break
                @default

            @endswitch

            @endif
            <div >
                <div class="card-content" >
                    <div class="table-responsive-sm"  >
                        <table  class="table table-hover table-xs mb-0">

                            <thead>
                            <tr>
                                <th class="border-top-0"><p>product</p>name</th>
{{--                                <th class="border-top-0">Stock Name</th>--}}
{{--                                <th class="border-top-0">User Name</th>--}}
                                <th class="border-top-0"><p>Quantity</p></th>
                                <th class="border-top-0"><p>Sale</p> Unit Price</th>
{{--                                <th class="border-top-0">Purchase Unit Price</th>--}}
                                <th class="border-top-0"><p>Expire</p> Date</th>
                                <th class="border-top-0"><p>manufacture</p> Date</th>
{{--                                Stock  Hold Qty--}}
                                <th class="border-top-0"><p>Stock </p>Trash Qty</th>
                                <th class="border-top-0">description</th>
{{--                                <th class="border-top-0">is Deleted</th>--}}

                                <th class="border-top-0">View</th>
                                <th class="border-top-0">Edit</th>
                                <th class="border-top-0">delete</th>
                            </tr>
                            </thead>
                            @foreach($categories as $category)
                                <tbody>
                                @foreach($category->stocks as $stock)


{{--                                    <td class="text-truncate"> {{$category->category_name}}</td>--}}
{{--                                    <td class="text-truncate">{{ $stock->user_id}}  </td>--}}
                                    <td class="text-truncate"> {{$stock->product_name}}</td>
                                    <td class="text-truncate"> {{$stock->quantity}}</td>
                                    <td class="text-truncate"> {{$stock->sale_unit_price}}</td>
{{--                                    <td class="text-truncate"> {{$stock->current_purchase_unit_price}}</td>--}}
                                    <td class="text-truncate"> {{$stock->expiry_date}}</td>
                                    <td class="text-truncate"> {{$stock->manufacture_date}}</td>
                                    <td class="text-truncate"> {{$stock->stock_trash_hold_qty}}</td>
                                    <td class="text-truncate"> {{$stock->description}}</td>
{{--                                    <td class="text-truncate">no</td>--}}
                                    <td class="text-truncate">   <a href="{{url('stocks/'.$stock->id)}}">  <i class="la la-file-o" style="color: blue;font-size: 25px"></i></a> </td>
                                    <td class="text-truncate">   <a href="{{url('stocks/'.$stock->id.'/edit')}}">  <i class="la la-edit" style="color: green;font-size: 25px"></i></a> </td>
                                    <form action="{{url('stocks/'.$stock->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <td class="text-truncate"> <button type="submit" style="background: transparent;border: none;"><i class="la la-trash" style="color: red;font-size: 25px"></i></button> </td>
                                    </form>

                                </tbody>
                            @endforeach
                            @endforeach
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

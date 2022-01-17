@extends('admin.dashboard')
@section('content')
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{__("messages.stocks")}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/redirect')}}">{{__("messages.home")}}</a>
                            </li>
                            <li class="breadcrumb-item active"><a >{{__("messages.stocks")}}</a>
                            </li>

                        </ol>
                    </div>
                </div>
            </div>
            {{--            setting of page--}}
            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                    <button class="btn btn-info round dropdown-toggle dropdown-menu-right box-shadow-2 px-2 mb-1" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ft-settings icon-left"></i> Settings</button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="{{url('/getStockInvoice')}}">Stock Invoice</a>
                        {{--                        <a class="dropdown-item" href="component-buttons-extended.html">Buttons</a>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">

    <div class="row"    >
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
             {{--                                     style="  display: block;   width:80%;  overflow: scroll;  "  --}}

                            <thead>
                            <tr>
                                <th class="border-top-0">product</th>
{{--                                <th class="border-top-0">Stock Name</th>--}}
                                <th class="border-top-0">Category</th>
                                <th class="border-top-0"><p>created by</p></th>
                                <th class="border-top-0"><p>Qty</p></th>
                                <th class="border-top-0"><p>Sale</p><p>Unit</p>Price</th>
{{--                                <th class="border-top-0">Purchase Unit Price</th>--}}
                                <th class="border-top-0"><p>Expire</p> Date</th>
{{--                                <th class="border-top-0"><p>manufacture</p> Date</th>--}}
{{--                                Stock  Hold Qty--}}
                                <th class="border-top-0"><p>Stock </p><p>Trash</p> Qty</th>
{{--                                <th class="border-top-0"><p>description</p></th>--}}
                                <th class="border-top-0">View</th>
                                <th class="border-top-0">Edit</th>
                                <th class="border-top-0">delete</th>
                            </tr>
                            </thead>
{{--                            @foreach($categories as $category)--}}
                                <tbody>
                                @foreach($stocks as $stock)

                                    <td class="text-truncate"> {{$stock->$product_name}}</td>
                                    <td class="text-truncate"> {{$stock->category->category_name_en}}</td>
                                    <td class="text-truncate"> {{$stock->user->full_name_en}}</td>
                                    <td class="text-truncate"> {{$stock->quantity}}</td>
                                    <td class="text-truncate"> {{$stock->sale_unit_price}}</td>
{{--                                    <td class="text-truncate"> {{$stock->current_purchase_unit_price}}</td>--}}
                                    <td class="text-truncate"> {{$stock->expiry_date}}</td>
{{--                                    <td class="text-truncate"> {{$stock->manufacture_date}}</td>--}}
                                    <td class="text-truncate"> {{$stock->stock_trash_hold_qty}}</td>
{{--                                    <td class="text-truncate"> {{$stock->$description}}</td>--}}
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
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

        </div>
    </div>
@endsection

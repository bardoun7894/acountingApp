@extends('admin.dashboard')
@section('content')


    <div class="content-wrapper">
        <div class="content-header row">

            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{__("messages.purchases")}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/redirect')}}">{{__("messages.home")}}</a>
                            </li>
                            <li class="breadcrumb-item active"><a >{{__("messages.purchases")}}</a>
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
                        <a class="dropdown-item" href="{{url('/getPurchaseInvoice')}}">Purchase Invoice</a>
                        {{--                        <a class="dropdown-item" href="component-buttons-extended.html">Buttons</a>--}}
                    </div>
                </div>
            </div>
        </div>

       <div class="content-body">

           <div class="row">

                <div id="recent-transactions"  >
                    <div class="card">
                        <div class="card-header mb-3">
                            <h4 class="card-title">Order Supplier</h4>
                        </div>
                        <div class="card-content">
                            <ul class="list-group">

{{--                                <li class="list-group-item d-flex justify-content-between">--}}
{{--                                    <span class="product-name"><strong>Contact Number</strong></span>--}}
{{--                                    <span class="product-price"><strong id="supplier_phone">+{{$supplier->phone}}</strong></span>--}}
{{--                                --}}
{{--                                </li>--}}

                                <div class="row m-1" >
                                        <div class="col-md-4">
                                            <label for="eventRegInput2">Supplier Name</label>
                                            <select name="supplier_id"  id="supplier_id" class="select2 form-control"  >
                                                <optgroup label="Supplier name">
                                                    @foreach($suppliers as $supplier)
                                                        <option   value="{{$supplier->id}} " > {{$supplier->$supplier_name}} </option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="form-group col-12 mb-2">
                                                    <label for="eventRegInput2">{{__("messages.phoneNumber")}}</label>
                                                    <input type="text" id="supplier_phone" class="form-control" value="+{{$supplier->phone}}" placeholder="{{__("messages.phoneNumber")}}" name="supplier_phone"  readonly="readonly">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="form-group col-12 mb-2">
                                                    <label for="eventRegInput2">{{__("messages.address")}}</label>
                                                    <input type="text" id="supplier_address" class="form-control" placeholder="Quantity" name="supplier_address" value="{{$supplier->address_en}}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>


                                </div>

                            </ul>

                        </div>
                    </div>

                    <div class="card" >

                        <div class="card-header">
                            <h4 class="card-title">Purchases</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a class="btn btn-sm btn-blue box-shadow-2 round btn-min-width pull-right" href="{{url('purchases/create')}}" target="_blank">Add Purchase</a></li>
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

                            <div id="purchase_table" >
                        @include('admin.includes.purchases.purchases_table')
                            </div>
                        <div class="card-content">
                            <ul class="list-group mb-3">
                                <li class="list-group-item d-flex justify-content-end ">
                                    <div class="row justify-content-between" >
                                         <p class="mt-1">Cart Subtotal</p>
                                         <input  type="text"  class="form-control col-6" placeholder="sub total" name="sub_total" id="sub_total" value="0" readonly="readonly">
                                    </div>
                                </li>
{{--                                <li class="list-group-item d-flex justify-content-end ">--}}
{{--                                    <div class="row justify-content-between" >--}}
{{--                                         <p class="mt-1">Shipping</p>--}}
{{--                                         <input  type="text"  class="form-control col-6" placeholder="sub total" name="sub_total" value="$2800" readonly="readonly">--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                                <li class="list-group-item d-flex justify-content-end ">--}}
{{--                                    <div class="row justify-content-between" >--}}
{{--                                         <p class="mt-1">TAX / VAT</p>--}}
{{--                                         <input  type="text"  class="form-control col-6" placeholder="sub total" name="sub_total" value="$2800" readonly="readonly">--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                                <li class="list-group-item d-flex justify-content-end ">--}}
{{--                                    <div class="row justify-content-between" >--}}
{{--                                         <p class="mt-1">Order Total</p>--}}
{{--                                         <input  type="text"  class="form-control col-6" placeholder="sub total" name="sub_total" value="$2800" readonly="readonly">--}}
{{--                                    </div>--}}
{{--                                </li>--}}
                                <li class="list-group-item d-flex justify-content-between">
                                    <span class="product-name">Shipping &amp; Handling</span>
                                    <span class="product-price">$100</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span class="product-name">TAX / VAT</span>
                                    <span class="product-price">$0</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span class="product-name success">Order Total</span>
                                    <span class="product-price">$2700</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

        </div>



    </div>






@endsection

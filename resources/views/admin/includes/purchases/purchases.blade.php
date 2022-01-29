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
                        <a class="dropdown-item" href="{{url('/getPurchaseInvoice')}}">{{__("messages.purchase_invoice")}}</a>
                        {{--                        <a class="dropdown-item" href="component-buttons-extended.html">Buttons</a>--}}
                    </div>
                </div>
            </div>
        </div>

       <div class="content-body">

           @if ($errors->any())
               <div class="alert alert-danger">
                   <ul>
                       @foreach ($errors->all() as $error)
                           <li>{{ $error }}</li>
                       @endforeach
                   </ul>
               </div>
           @endif

           <form method="POST"  action="{{route("purchases.addSupplierInvoice")}}">
               @csrf

               <div class="row">
                   @include('admin.includes.purchases.info_supplier_section')


        <div class="card" >

        <div class="card-header">
            <h4 class="card-title">{{__("messages.purchases")}}</h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a class="btn btn-sm btn-blue box-shadow-2 round btn-min-width pull-right" href="{{url('purchases/create')}}" target="_self">{{__("messages.add_purchase")}}</a></li>
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
        <div id="purchase_table" class="card-content d-flex p-2">

            @include('admin.includes.purchases.purchases_table')
        </div>
        <div class="card-content">
            <ul class="list-group mb-3">
                <div>
                    <li class="list-group-item d-flex justify-content-end ">
                        <div class="row justify-content-between" >
                            <p class="mt-1">{{__("messages.sub_total")}}</p>
                            <input  type="text"  class="form-control col-6 border-0 blue"  name="sub_total_amount" id="sub_total"  >
                        </div>
                    </li>

                </div>

                <li class="list-group-item d-flex justify-content-between">
                    <span class="discount">{{__("messages.discount")}}</span>
                    {{--                                    <span class="discount">$100</span>--}}
                    <div class="justify-content-end">
                        <input type="number" id="discountId" value="0" class="form-control" min="0"   name="discount"   >
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span class="tax">{{__("messages.tax")}}</span>
                    <div class="justify-content-end">
                        <input type="number" id="taxId" class="form-control"  value="0" min="0"  name="tax"   >
                    </div>

                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span class="order_total">{{__("messages.order_total")}}</span>
                    <input class="border-0" id="order_total" name="total_amount" >
                </li>
<div class="row justify-content-around  m-2">

    @include('admin.includes.payment_types.select_payment_type')

    @include('admin.includes.sell_types.select_sell_type')
</div>

            </ul>
        </div>
        <button class="btn btn-info btn-lg btn-block" type="submit"> {{__("messages.continue_to_checkout")}}</button>
    </div>


       </div>
           </form>

        </div>



    </div>






@endsection

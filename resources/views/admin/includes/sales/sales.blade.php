@extends('admin.dashboard')
@section('content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{ __('messages.sales') }}</h3>
                <x-breadcrumb>
            <li class="breadcrumb-item"><a href="{{ url('/redirect') }}">{{ __('messages.home') }}</a></li>
            <li class="breadcrumb-item active"><a>{{ __('messages.sales') }}</a></li>

        </x-breadcrumb>

            </div>
            {{-- setting of page --}}
            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                    <button class="btn btn-info round dropdown-toggle dropdown-menu-right box-shadow-2 px-2 mb-1"
                        id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="ft-settings icon-left"></i>
                        {{ __('messages.settings') }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item"  href="{{ url('/getSaleInvoice') }}">{{ __('messages.sale_invoice') }}</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            <x-alert type="danger" :errors="$errors" />
            <form method="POST" action="{{ route('sales.addCustomerInvoice') }}">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('messages.sales') }}</h4>
                    </div>
                    @if (session()->has('message'))
                        @switch(session()->get('message'))
                            @case(__('messages.data_removed'))
                                <div class="alert alert-danger">
                                    {{ session()->get('message') }}
                                </div>
                            @break

                            @case(__('messages.data_updated'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @break

                            @case (__('messages.data_added'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @break

                            @default
                        @endswitch
                    @endif
                    @include('admin.includes.sales.info_customer_section')
                    <div class="row m-1">
                        <div class="col-md-9 mt-3">
                            <label>{{ __('messages.select_product') }}</label>
                            <select  name="stock_id" id="stock_id"
                                class=" searchproductSelect2 js-example-placeholder js-states form-control" ></select>
                            </div>

                    </div>
                    <div id="sale_table" class="table-responsive d-flex p-2">
                        @include('admin.includes.sales.sales_table')
                    </div>
                    <div class="card-content">
                        <ul class="list-group mb-3">
                            <div>
                                <li class="list-group-item d-flex justify-content-between">
                                    <p class="mt-1">{{ __('messages.sub_total') }}</p>
                                    <fieldset>
                                        <div class="input-group justify-content-end">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"  id="basic-addon3">
                                                {{ $currency->currency_symbol }}
                                            </span>
                                        </div>
                                            <input type="text" class="form-control" readonly="readonly"
                                                name="sub_total_amount" id="sub_total" aria-describedby="basic-addon3">
                                        </div>
                                    </fieldset>
                                </li>
                            </div>

                            <li class="list-group-item d-flex justify-content-between">
                                <span class="discount">{{ __('messages.discount') }}</span>
                                <fieldset>
                                    <div class="input-group justify-content-end">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">%</span>
                                        </div>
                                        <input type="number" id="discountId" value="0" class="form-control" min="0"
                                            max="100" name="discount">
                                    </div>
                                </fieldset>

                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="tax">{{__('messages.tax') }}</span>
                                <fieldset>
                                    <div class="input-group justify-content-end">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">%</span>
                                        </div>
                                        <input type="number" id="taxId" class="form-control" value="0" min="0" max="100"
                                            name="tax" aria-describedby="basic-addon3">
                                    </div>
                                </fieldset>

                            </li>

                            <li class="list-group-item d-flex justify-content-between">
                                <span class="order_total">{{ __('messages.order_total') }}</span>
                                {{-- <input class="border-0" id="order_total" name="total_amount" > --}}
                                <fieldset>
                                    <div class="input-group justify-content-end">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"
                                                id="basic-addon3">{{ $currency->currency_symbol }}</span>
                                        </div>
                                        <input type="text" id="order_total" class="form-control" readonly="readonly"
                                            name="total_amount" aria-describedby="basic-addon3">
                                    </div>
                                </fieldset>
                            </li>

                            <div class="row justify-content-around  m-2">

                                @include('admin.includes.payment_types.select_payment_type')

                                @include('admin.includes.sell_types.select_sell_type')
                            </div>

                        </ul>
                    </div>
                    <button class="btn btn-info btn-lg btn-block" type="submit">
                        {{ __('messages.continue_to_checkout') }}</button>
                </div>


        </div>
        </form>

    </div>



    </div>






@endsection

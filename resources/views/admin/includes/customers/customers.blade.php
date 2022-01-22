
@extends('admin.dashboard')
@section('content')
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{__("messages.customers")}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">{{__("messages.home")}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{__("messages.customers")}}
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
                        <a class="dropdown-item" href="{{url('/getCustomerInvoice')}}">Customer Invoice</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
{{--<div class="row" style="display: flex;justify-content: center; margin: 10px ;"  >--}}

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{__('messages.customers_report')}} </h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a class="btn btn-sm btn-blue box-shadow-2 round btn-min-width pull-right" href="{{url('customers/create')}}" target="_self">{{__('messages.add_customer')}}</a></li>
                        </ul>
                    </div>
                </div>

                @if(session()->has('message'))
                   @switch(session()->get('message'))
                      @case('User Deleted Successfully')
                      <div class="alert alert-danger">
                        {{ session()->get('message') }}
                    </div>
                        @break
                    @case('User Updated Successfully')

                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                        @break
                    @case('User added Successfully')

                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                     @break
                        @case('add customer account to Account Sub Control')
                        <div class="alert alert-danger">
                            {{ session()->get('message') }}
                        </div>
                        @break
                    @default
                @endswitch
                @endif

                    @include('admin.includes.customers.customer_table')

            </div>

            </div>

    </div>

@endsection

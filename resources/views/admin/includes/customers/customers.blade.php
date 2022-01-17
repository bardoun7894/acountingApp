
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
{{--                        <a class="dropdown-item" href="component-buttons-extended.html">Buttons</a>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
{{--<div class="row" style="display: flex;justify-content: center; margin: 10px ;"  >--}}
        <div id="recent-transactions"  >
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{__('messages.customers_report')}} </h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a class="btn btn-sm btn-blue box-shadow-2 round btn-min-width pull-right" href="{{url('customers/create')}}" target="_blank">{{__('messages.add_customer')}}</a></li>
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
                <div class="input-group d-inline-flex p-4" >
                    <input type="search" id="search-customer" class="form-control rounded" placeholder="Search" aria-label="Search" name="search_text"
                           aria-describedby="search-addon" />
                    <button type="submit" class="btn btn-outline-primary">{{__('messages.search')}}</button>
                </div>
                <div class="card-content">
                    <div class="table-responsive">
                        <table id="dataex-select-initialisation" class=" table table-hover table-l mb-0">
                            <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">{{__('messages.customerName')}}</th>
                                <th class="border-top-0">{{__('messages.phoneNumber')}}</th>
                                <th class="border-top-0">{{__('messages.address')}}</th>
                                <th class="border-top-0">{{__('messages.description')}}</th>
                                <th class="border-top-0">{{__('messages.area')}}</th>
                                <th class="border-top-0">{{__('messages.edit')}}</th>
                                <th class="border-top-0">{{__('messages.delete')}}</th>
                            </tr>
                            </thead>
                               <tbody id="customers-dynamicRow">
                               @foreach($customers as $customer)
                                   <tr>
                                <td class="text-truncate"> {{$customer->id }}</td>
                               <td class="text-truncate">{{$customer->$customer_name}}   </td>
                                <td class="text-truncate"> {{$customer->contact_number}}</td>
                                       <td class="text-truncate"> {{$customer->$address}}</td>
                                       <td class="text-truncate"> {{$customer->$description}}</td>
                                       <td class="text-truncate"> {{$customer->area}}</td>
                                       <td class="text-truncate">   <a href="{{url('customers/'.$customer->id.'/edit')}}"><i class="la la-edit" style="color: green;font-size: 25px"></i></a> </td>
                                <td>
                                    <a  class="confirmDelete"  record="Customer"  recordId="{{$customer->id}}">  <i class="la la-trash" style="color: red;font-size: 25px"></i>
                                    </a>
                                </td>
                               </tr>
                               @endforeach
                               </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
            </div>

    </div>

@endsection


<?php
$full_name='full_name_'.\App\Models\Translation::getLang();
?>
@extends('admin.dashboard')
@section('content')
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{__("messages.suppliers")}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">{{__("messages.home")}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{__("messages.suppliers")}}
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
                        <a class="dropdown-item" href="{{url('/getSupplierInvoice')}}">Supplier Invoice</a>
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
                    <h4 class="card-title">{{__('messages.suppliers')}} </h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a class="btn btn-sm btn-blue box-shadow-2 round btn-min-width pull-right" href="{{url('suppliers/create')}}" target="_self">{{__('messages.add_suplier')}}</a></li>
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
                    @case('add supplier account to Account Sub Control')
                        <div class="alert alert-danger">
                            {{ session()->get('message') }}
                        </div>
                     @break
                    @default

                @endswitch

                @endif
                <div class="card-content d-flex p-2">
                        <table  id="datatableBootstrap"  class=" table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">{{__('messages.supplierName')}}</th>
                                <th class="border-top-0">{{__('messages.email')}}</th>
                                <th class="border-top-0">{{__('messages.phoneNumber')}}</th>
                                <th class="border-top-0">{{__('messages.address')}}</th>
                                <th class="border-top-0">{{__('messages.description')}}</th>
                                <th class="border-top-0">{{__('messages.edit')}}</th>
                                <th class="border-top-0">{{__('messages.delete')}}</th>
                            </tr>
                            </thead>
                               <tbody id="suppliers-dynamicRow">
                               @foreach($suppliers as $supplier)
                                   <tr>
                                <td class="text-truncate"> {{$supplier->id }}</td>
                               <td class="text-truncate">{{$supplier->$supplier_name}}   </td>
                                <td class="text-truncate"> {{$supplier->email}}</td>
                                <td class="text-truncate"> {{$supplier->phone}}</td>
                                <td class="text-truncate"> {{$supplier->$address}}</td>
                                <td class="text-truncate"> {{$supplier->$description}}</td>
                                <td class="text-truncate">   <a href="{{url('suppliers/'.$supplier->id.'/edit')}}"><i class="la la-edit" style="color: green;font-size: 25px"></i></a> </td>
                                <td>
                                    <a  class="confirmDelete"  record="Supplier"  recordId="{{$supplier->id}}">  <i class="la la-trash" style="color: red;font-size: 25px"></i>
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

@endsection

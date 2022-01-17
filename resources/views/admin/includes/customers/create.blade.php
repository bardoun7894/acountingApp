@extends('admin.dashboard')
@section('content')
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{__("messages.create_customer")}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/redirect')}}">{{__("messages.home")}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{url('/customers')}}">{{__("messages.customers")}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{__("messages.add_customer")}}
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
                {{--         this is content card--}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="card-content collpase show">
                            <div class="card-body">

                                <form class="form" method="POST" action="{{url('customers')}}">
                                    @csrf
                                    <div class="form-actions top clearfix">
                                        {{__('messages.add_customer')}}
                                    </div>

{{--                                     <input name="accountSubControlCustomers" hidden value="{{$accountSubControl!=null?$accountSubControl->id:null}}">--}}

                                    <div class="row justify-content-md-center">
                                        <div class="col-md-6">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="form-group col-12 mb-2">
                                                        <label for="eventRegInput1">  {{__('messages.customerName')}}</label>
                                                        <input type="text" id="eventRegInput1" class="form-control" placeholder="{{__('messages.customerName')}}" name="{{$customer_name}}">
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="form-group col-12 mb-2">
                                                        <label for="eventRegInput5">{{__('messages.phoneNumber')}}</label>
                                                        <input type="tel" id="eventRegInput5" class="form-control" name="contact_number" placeholder="{{__('messages.phoneNumber')}}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-12 mb-2">
                                                        <label for="eventRegInput1">{{__("messages.address")}}</label>
                                                        <textarea type="text"  class="form-control" placeholder="{{__("messages.address")}}" name="{{$address}}" ></textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-12 mb-2">
                                                        <label for="eventRegInput1">{{__("messages.description")}}</label>
                                                        <textarea type="text"  class="form-control" placeholder="{{__("messages.description")}}" name="{{$description}}"></textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-12 mb-2">
                                                        <label for="eventRegInput4">{{__('messages.area')}}</label>
                                                        <input type="text" id="eventRegInput4" class="form-control" placeholder="{{__('messages.area')}}" name="area">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions clearfix">
                                        <div class="buttons-group float-right mb-1">
                                            <button type="submit"  class="btn btn-primary mr-1">
                                                <i class="la la-check-square-o"></i> {{__('messages.save')}}
                                            </button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
                {{--..--}}
        </div>
@endsection

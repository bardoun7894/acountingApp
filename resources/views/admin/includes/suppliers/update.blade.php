@extends('admin.dashboard')
@section('content')
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{__("messages.edit_supplier")}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/redirect')}}">{{__("messages.home")}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ url('/suppliers') }}">{{__("messages.suppliers")}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{__("messages.update_supplier")}}
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
                    <form class="form" method="POST" action="{{url('suppliers/'.$supplier->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-actions top clearfix">
                             Update User
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="form-group col-12 mb-2">
                                            <label for="eventRegInput1">{{__("messages.supplierName")}}</label>
                                            <input type="text"  class="form-control" placeholder="{{__("messages.supplierName")}}" name="{{$supplier_name}}" value="{{ $supplier->$supplier_name }}" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12 mb-2">
                                            <label for="eventRegInput1">{{__("messages.email")}}</label>
                                            <input type="text"  class="form-control" placeholder="email" name="email" value="{{ $supplier->email }}" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12 mb-2">
                                            <label for="eventRegInput1">{{__("messages.phoneNumber")}}</label>
                                            <input type="text"  class="form-control" placeholder="{{__("messages.phone")}}" name="phone" value="{{ $supplier->phone }}" >
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-12 mb-2">
                                            <label for="eventRegInput1">{{__("messages.address")}}</label>
                                                <textarea type="text"  class="form-control" placeholder="{{__("messages.address")}}" name="{{$address}}"  >{{ $supplier->$address }}</textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-12 mb-2">
                                            <label for="eventRegInput1">{{__("messages.description")}}</label>
                                            <textarea type="text"  class="form-control" placeholder="{{__("messages.description")}}" name="{{$description}}"  >{{ $supplier->$description }}</textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-actions clearfix">
                            <div class="buttons-group float-right mb-1">
                                <button type="submit"  class="btn btn-primary mr-1">
                                    <i class="la la-check-square-o"></i> Update
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
        </div>
        </div>
@endsection

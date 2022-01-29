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
                            <li class="breadcrumb-item"><a href="{{url('/stocks')}}">{{__("messages.stocks")}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{__("messages.add_stock")}}
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

                    <form class="form" method="POST" action="{{url('/'.$lang.'/stocks')}}">
                        @csrf
                        <div class="form-actions top clearfix">
                             Add New Stock
                        </div>
                        <div class="row justify-content-md-center form-group">
                            <div class="col-md-6">
                                <label for="eventRegInput2">Category Name</label>

                                <select name="category_id" class="select2 form-control"  >
                                    <optgroup label="Category name">
                                        @foreach($categories as $category)
                                        <option   value="{{$category->id}} " > {{$category->$category_name}} </option>
                                        @endforeach
                                    </optgroup>
                               </select>
                            </div>
                        </div>
                        <div class="row justify-content-md-center form-group">
                            <div class="col-md-6">
                                <label for="eventRegInput2">{{__("messages.unit_name")}}</label>

                                <select name="unit_id" class="select2 form-control"  >
                                    <optgroup label="Unit name">
                                        @foreach($units as $unit)
                                        <option   value="{{$unit->id}} " > {{$unit->$unit_name}} </option>
                                        @endforeach
                                    </optgroup>
                               </select>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                                    <div class="row">
                                        <div class="form-group col-12 mb-2">
                                            <input type="text" id="eventRegInput2" class="form-control" placeholder="Product name" name="{{$product_name}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <div class="row justify-content-md-center">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="form-group col-12 mb-2">
                                            <input type="number" id="eventRegInput2" class="form-control" placeholder="Quantity" name="quantity" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="row justify-content-md-center">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="form-group col-12 mb-2">
                                            <input type="number" id="eventRegInput2" class="form-control" placeholder="Sale Unit Price" name="sale_unit_price">
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group col-12 mb-2">
                                        <input type="number" id="eventRegInput2" class="form-control" placeholder="Purchase Unit Price" name=" current_purchase_unit_price">
                                    </div>
                                </div>
                            </div>
                          </div>

                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group col-12 mb-2">
                                        <input type="date" id="eventRegInput2" class="form-control" placeholder="Expiry Date" name="expiry_date">
                                    </div>
                                </div>
                            </div>
                          </div>

                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group col-12 mb-2">
                                        <input type="text" id="eventRegInput2" class="form-control" placeholder="Description" name="{{$description}}">
                                    </div>
                                </div>
                            </div>
                          </div>

                        <div class="form-actions clearfix">
                            <div class="buttons-group float-right mb-1">
                                <button type="submit"  class="btn btn-primary mr-1">
                                    <i class="la la-check-square-o"></i> {{__('save')}}
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

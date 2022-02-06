@extends('admin.dashboard')
@section('content')

    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{__("messages.sales")}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/redirect')}}">{{__("messages.home")}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{url('/sales')}}">{{__("messages.sales")}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{__("messages.add_sale")}}
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
                        <a class="dropdown-item" href="{{url('/getStockInvoice')}}">Purchase Invoice</a>
                        {{--                        <a class="dropdown-item" href="component-buttons-extended.html">Buttons</a>--}}
                    </div>
                </div>
            </div>
        </div>
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

        <div class="row">
    <div class="col-md-12">
            <div class="card-content collpase show">
                <div class="card-body">

                    <form class="form" method="POST" action="{{url('sales')}}">
                        @csrf
                        <div class="form-actions top clearfix">
                             Add New Sale
                        </div>
                        @include('admin.includes.branches.select_branch')

                        <div class="row">


                            <div class="col-md-6">



                                <div id="appendSaleCategoryLevel">
                                    @include("admin.includes.sales.append_sale_category_level")
                                </div>

                                <div id="appendSaleProductLevel">
                                    @include("admin.includes.sales.append_sale_product_level")
                                </div>

                                <div class="row justify-content-md-center form-group">
                                    <div class="col-md-6">
                                        <label for="eventRegInput2">Unit Name</label>
                                        <select name="unit_id" class="select2 form-control"  >
                                            <optgroup label="Unit name">
                                                @foreach($units as $unit)
                                                    <option   value="{{$unit->id}} " > {{$unit->$unit_name}} </option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="row justify-content-md-center">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="form-group col-12 mb-2">
                                                <label for="sale_quantity">{{__("messages.quantity")}}</label>
                                                <input type="number" id="sale_quantity" class="form-control" placeholder="Quantity" name="quantity" @error('quantity') is-invalid @enderror">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-md-center">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="form-group col-12 mb-2">
                                                <label for="eventRegInput2">{{__("messages.purchase_unit_price")}}</label>

                                                <input type="number" id="purchaseUnitPrice" class="form-control"   readonly="readonly">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-md-center">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="form-group col-12 mb-2">
                                                <label for="eventRegInput2">{{__("messages.sale_unit_price")}}</label>
                                                <input type="number" id="saleUnitPrice" class="form-control" placeholder="Sale Unit Price" @error('sale_unit_price') is-invalid @enderror name="sale_unit_price">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>

                        <div class="row justify-content-md-center">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="form-group col-12 mb-2">
                                        <label for="eventRegInput2">{{__("messages.description")}}</label>
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

@extends('admin.dashboard')
@section('content')

    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{ __('messages.stocks') }}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/redirect') }}">{{ __('messages.home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ url('/stocks') }}">{{ __('messages.stocks') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('messages.add_stock') }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            {{-- setting of page --}}
            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                    <button class="btn btn-info round dropdown-toggle dropdown-menu-right box-shadow-2 px-2 mb-1"
                        id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"><i class="ft-settings icon-left"></i> Settings</button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="{{ url('/getStockInvoice') }}">Stock Invoice</a>
                        {{-- <a class="dropdown-item" href="component-buttons-extended.html">Buttons</a> --}}
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

                            <form class="form" method="POST" action="{{ url('/' . $lang . '/stocks') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-actions top clearfix">
                                    {{ __('messages.add_product') }}

                                </div>
                                <div class="row justify-content-md-center form-group">
                                    <div class="col-md-6">
                                        <label for="eventRegInput2">Category Name</label>

                                        <select name="category_id" class="select2 form-control">
                                            <optgroup label="Category name">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }} ">
                                                        {{ $category->$category_name }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="row justify-content-md-center form-group">
                                    <div class="col-md-6">
                                        <label for="eventRegInput2">{{ __('messages.unit_name') }}</label>

                                        <select name="unit_id" class="select2 form-control">
                                            <optgroup label="Unit name">
                                                @foreach ($units as $unit)
                                                    <option value="{{ $unit->id }} "> {{ $unit->$unit_name }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="row justify-content-md-center">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="form-group col-12 mb-2">
                                                <input type="text" id="eventRegInput2" class="form-control"
                                                    placeholder="Product name" name="{{ $product_name }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-md-center">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="form-group col-12 mb-2">
                                                <input type="text" id="eventRegInput2" class="form-control"
                                                    placeholder={{ 'messages.barcode' }} name="barcode">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-md-center">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="form-group col-12 mb-2">
                                                <input type="number" id="eventRegInput2" class="form-control"
                                                    placeholder="Quantity" name="quantity">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-md-center">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="form-group col-12 mb-2">
                                                <input type="number" id="eventRegInput2" class="form-control"
                                                    placeholder="Sale Unit Price" name="current_sale_unit_price">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-md-center">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="form-group col-12 mb-2">
                                                <input type="number" id="eventRegInput2" class="form-control"
                                                    placeholder="Purchase Unit Price" name=" current_purchase_unit_price">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-md-center">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="form-group col-12 mb-2">
                                                <input type="text" id="eventRegInput2" class="form-control"
                                                    placeholder="Description" name="{{ $description }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row justify-content-md-center">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group mb-3 ">
                                                <input type="file" name="product_image" id="product_image">
                                                <label for="product_image"
                                                    class="custom_choose_file_btn">{{ __('messages.choose_image') }}
                                                </label>
                                            </div>
                                            <div class="image_preview" id="image_preview"
                                                style="width: 300px; height: 400px; border: 2px; ">
                                                <span class="image_preview_default_text" style="display: none">
                                                    {{ __('messages.image_preview') }}
                                                </span>
                                                <div style=" height:80px;">
                                                    <img style="width: 150px;"
                                                        class="image_preview_image justify-content-md-center">

                                                    {{-- @if (!empty($productData['main_image']))
                                                    <a href="javascript:void(0)" class="confirmDeleteImage" record="image"
                                                        recordName="product" recordid="{{ $productData['id'] }}"
                                                        style="color: red">Delete image</a>
                                                    endif --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <h5>
                                    <input name="is_batch" type="checkbox" id="is-batch" value="1">
                                    &nbsp; {{ __('messages.this_product_has_expiry_date') }}
                                </h5>
                                <div class="row justify-content-md-center">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="form-group col-12 mb-2">
                                                <input type="date" style="display:none" class="form-control"
                                                    placeholder="Expiry Date" name="expiry_date" id="expiry-date">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h5>
                                    <input name="allowtax" type="checkbox" id="allowtax" value="1">
                                    &nbsp; {{ __('messages.has_tax') }}
                                </h5>

                                <div class="form-actions clearfix">
                                    <div class="buttons-group float-right mb-1">
                                        <button type="submit" class="btn btn-primary mr-1">
                                            <i class="la la-check-square-o"></i> {{ __('save') }}
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

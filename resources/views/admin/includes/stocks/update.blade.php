@extends('admin.dashboard')
@section('content')
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{ __('messages.edit_stock') }}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/redirect') }}">{{ __('messages.home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ url('/stocks') }}">{{ __('messages.stocks') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('messages.update_stock') }}
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
                        <a class="dropdown-item" href="{{ url('/getstockInvoice') }}">stock Invoice</a>
                        {{-- <a class="dropdown-item" href="component-buttons-extended.html">Buttons</a> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            {{-- this is content card --}}
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
                                <form class="form" method="POST"
                                    action="{{ url('/' . $lang . '/stocks/' . $stock->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-actions top clearfix">
                                        {{ __('messages.edit_stock') }}
                                    </div>
                                    <div class="row justify-content-md-center form-group">
                                        <div class="col-md-6">
                                            <label for="eventRegInput2">{{ __('messages.category_name') }}</label>

                                            <select name="category_id" class="select2 form-control">
                                                <optgroup label="Category name">
                                                    @foreach ($categories as $category)
                                                        <option
                                                            @if ($category->id == $stock->category_id) value="{{ $stock->category_id }}"  selected @else value="{{ $category->id }}" @endif>
                                                            {{ $category->$category_name }} </option>
                                                        {{-- <option    @if ($branch->branch_name == $branche->branch_name) value="{{$branche->id}}"  selected @else value="{{$branch->id}}" @endif> {{$branch->branch_name}} </option> --}}
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
                                                        placeholder="Product name" name="{{ $product_name }}"
                                                        value="{{ $stock->$product_name }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="form-group col-12 mb-2">
                                                    <input type="text" id="eventRegInput2" class="form-control"
                                                        placeholder={{ 'messages.barcode' }} name="barcode"
                                                        value="{{ $stock->barcode }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row justify-content-md-center">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="form-group col-12 mb-2">
                                                    <input type="number" id="eventRegInput2" class="form-control"
                                                        placeholder="Quantity" name="quantity"
                                                        value="{{ $stock->quantity }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="form-group col-12 mb-2">
                                                    <input type="number" id="eventRegInput2" class="form-control"
                                                        placeholder="Sale Unit Price" name="current_sale_unit_price"
                                                        value="{{ $stock->current_sale_unit_price }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="form-group col-12 mb-2">
                                                    <input type="number" id="eventRegInput2" class="form-control"
                                                        placeholder="Purchase Unit Price"
                                                        name=" current_purchase_unit_price"
                                                        value="{{ $stock->current_purchase_unit_price }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row justify-content-md-center">

                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="form-group col-12 mb-2">
                                                    <input type="text" id="eventRegInput2" class="form-control"
                                                        placeholder="Description" name="{{ $description }}"
                                                        value="{{ $stock->$description }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-md-center">
                                        <div class="input-group mb-3 justify-content-md-center">
                                            <input type="file" name="product_image" id="product_image"
                                                @if (!empty($stock['image'])) value = "{{ $stock['image'] }}"          
                                               @else  value = "{{ old('image') }}" @endif>

                                            <label for="product_image"
                                                class="custom_choose_file_btn">{{ __('messages.choose_image') }}
                                            </label>
                                        </div>

                                        <div class="image_preview" id="image_preview"
                                            style="width: 400px; height: 400px; border: 2px;margin-left:250px ">
                                            <span class="image_preview_default_text" style="display: none">
                                                {{ __('messages.image_preview') }}
                                            </span>
                                            <div style=" height:80px;">
                                                <img style="width: 150px;" class="image_preview_image "
                                                    @if (!empty($stock['image'])) src="{{ asset('admin/app-assets/images/products/' . $stock['image']) }}"
                                                   @else  src="{{ asset('admin/app-assets/images/no-image.png') }}" @endif>

                                                {{-- @if (!empty($productData['main_image']))
                                            <a href="javascript:void(0)" class="confirmDeleteImage" record="image"
                                                recordName="product" recordid="{{ $productData['id'] }}"
                                                style="color: red">Delete image</a>
                                            endif --}}
                                            </div>
                                        </div>
                                    </div>

                                    {{-- @if (!empty($productData['main_image']))
                                                <a href="javascript:void(0)" class="confirmDeleteImage" record="image"
                                                    recordName="product" recordid="{{ $productData['id'] }}"
                                                    style="color: red">Delete image</a>
                                            @endif --}}



                                    <h5>
                                        <input name="is_batch" type="checkbox" id="is-batch" value="1"
                                            @if ($stock->allowexpire == 1) checked @endif>
                                        &nbsp; {{ __('messages.this_product_has_expiry_date') }}
                                    </h5>
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="form-group col-12 mb-2">
                                                    <input type="date"
                                                        @if ($stock->allowexpire == 1) value="{{ $stock->expiry_date }}"@else  style="display:none" @endif
                                                        class="form-control" placeholder="Expiry Date" name="expiry_date"
                                                        id="expiry-date">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h5>
                                        <input name="allowtax" type="checkbox" id="allowtax" value="1"
                                            @if ($stock->allowtax == 1) checked @endif>
                                        &nbsp; {{ __('messages.has_tax') }}
                                    </h5>



                                    <div class="form-actions clearfix">
                                        <div class="buttons-group float-right mb-1">
                                            <button type="submit" class="btn btn-primary mr-1">
                                                <i class="la la-check-square-o"></i>{{ __('messages.update') }}
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

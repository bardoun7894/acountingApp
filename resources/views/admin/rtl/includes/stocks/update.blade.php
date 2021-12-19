@extends('admin.ltr.dashboard')
@section('content')
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
                    <form class="form" method="POST" action="{{url('stocks/'.$stock->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-actions top clearfix">
                            Add New Stock
                        </div>
                        <div class="row justify-content-md-center form-group">
                            <div class="col-md-6">
                                <label for="eventRegInput2">Category Name</label>

                                <select name="category_id" class="select2 form-control"  >
                                    <optgroup label="Category name">
                                        @foreach($categories as $category)
          <option  @if($category->id==$stock->category_id) value="{{$stock->category_id}}"  selected @else value="{{$category->id}}" @endif> {{$category->category_name}} </option>
{{--           <option    @if($branch->branch_name==$branche->branch_name) value="{{$branche->id}}"  selected @else value="{{$branch->id}}" @endif> {{$branch->branch_name}} </option>--}}

                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group col-12 mb-2">
                                        <input type="text" id="eventRegInput2" class="form-control" placeholder="Product name" name="product_name" value="{{$stock->product_name}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group col-12 mb-2">
                                        <input type="number" id="eventRegInput2" class="form-control" placeholder="Quantity" name="quantity"  value="{{$stock->quantity}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group col-12 mb-2">
                                        <input type="number" id="eventRegInput2" class="form-control" placeholder="Sale Unit Price" name="sale_unit_price" value="{{$stock->sale_unit_price}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group col-12 mb-2">
                                        <input type="number" id="eventRegInput2" class="form-control" placeholder="Purchase Unit Price" name=" current_purchase_unit_price" value="{{$stock->current_purchase_unit_price}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group col-12 mb-2">
                                        <input type="number" id="eventRegInput2" class="form-control" placeholder="Stock Trash Hold Qty" name="stock_trash_hold_qty" value="{{$stock->stock_trash_hold_qty}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group col-12 mb-2">
                                        <input type="date" id="eventRegInput2" class="form-control" placeholder="Expiry Date" name="expiry_date" value="{{$stock->expiry_date}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group col-12 mb-2">
                                        <input type="date" id="eventRegInput2" class="form-control" placeholder="Manufacture Date" name="manufacture_date" value="{{$stock->manufacture_date}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group col-12 mb-2">
                                        <input type="text" id="eventRegInput2" class="form-control" placeholder="Description" name="description"   value="{{$stock->description}}">
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
@endsection

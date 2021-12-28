@extends('admin.dashboard')
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

                    <form class="form" method="POST" action="{{url('stocks')}}">
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
                                        <option   value="{{$category->id}} " > {{$category->category_name}} </option>
                                        @endforeach
                                    </optgroup>
                               </select>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                                    <div class="row">
                                        <div class="form-group col-12 mb-2">
                                            <input type="text" id="eventRegInput2" class="form-control" placeholder="Product name" name="product_name">
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
                                        <input type="number" id="eventRegInput2" class="form-control" placeholder="Stock Trash Hold Qty" name="stock_trash_hold_qty">
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
                                        <input type="date" id="eventRegInput2" class="form-control" placeholder="Manufacture Date" name="manufacture_date">
                                    </div>
                                </div>
                            </div>
                          </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group col-12 mb-2">
                                        <input type="text" id="eventRegInput2" class="form-control" placeholder="Description" name="description">
                                    </div>
                                </div>
                            </div>
                          </div>

                        <div class="form-actions clearfix">
                            <div class="buttons-group float-right mb-1">
                                <button type="submit"  class="btn btn-primary mr-1">
                                    <i class="la la-check-square-o"></i> Save
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

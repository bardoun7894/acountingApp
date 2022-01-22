<div class="card">
    <div class="card-header">
        <h4 class="card-title">{{__("messages.supplier")}}</h4>
    </div>
    <div class="card-content">
        <ul class="list-group">
{{--if user is admin--}}
            @if(\Illuminate\Support\Facades\Auth::user()->user_type_id==1)
            <div class="row m-1">
                {{--                               get     branches--}}
                <div  class="col-md-6">
                    @include('admin.includes.branches.select_branch')
                </div>

                {{--                              get  stores--}}

                <div id="appendStoreLevel">
                    @include('admin.includes.stores.select_store')
                </div>

            </div>
                @endif

            <div class="row m-1" >

                <div id="appendSupplierLevel">
                    @include('admin.includes.suppliers.select_supplier')
                </div>

                <div class="col-md-3">
                    <div class="row">
                        <div class="form-group col-12 mb-2">
                            <label for="eventRegInput2">{{__("messages.phoneNumber")}}</label>
                            <input type="text" id="supplier_phone" class="form-control"    placeholder="{{__("messages.phoneNumber")}}" name="supplier_phone"  readonly="readonly">
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="row">
                        <div class="form-group col-12 mb-2">
                            <label for="eventRegInput2">{{__("messages.address")}}</label>
                            <input type="text" id="supplier_address" class="form-control" placeholder="Quantity" name="supplier_address"  readonly="readonly">
                        </div>
                    </div>
                </div>


            </div>

        </ul>

    </div>


</div>

<div class="card">

    <div class="card-content">
        <ul class="list-group">


            <div class="row m-1">
                <div id="appendStoreLevel" class="col-md-4">

                    @include('admin.includes.stores.select_store')
                </div>


                <div id=" appendSupplierLevel" class="col-md-4">
                    @include('admin.includes.suppliers.select_supplier')
                </div>

                <div class="  col-md-4">

                    <div class="form-group col-12 mb-2">
                        <label for="eventRegInput2">{{ __('messages.phoneNumber') }}</label>
                        <input type="text" id="supplier_phone" class="form-control"
                            placeholder="{{ __('messages.phoneNumber') }}" name="supplier_phone" readonly="readonly">
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="row">
                        <div class="form-group col-12 mb-2">
                            <label for="eventRegInput2">{{ __('messages.address') }}</label>
                            <input type="text" id="supplier_address" class="form-control" placeholder="Quantity"
                                name="supplier_address" readonly="readonly">
                        </div>
                    </div>
                </div>



            </div>

        </ul>

    </div>


</div>

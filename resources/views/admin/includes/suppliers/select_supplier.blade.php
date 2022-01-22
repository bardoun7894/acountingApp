<div class="col-md-12">
    <label for="eventRegInput2">{{__("messages.supplierName")}}</label>
    <select name="supplier_id"  id="supplier_id" class="select2 form-control"  >
        <optgroup label="Supplier name">
            <option value="null"></option>
            @foreach($suppliers as $supplier)
                <option   value="{{$supplier->id}} " > {{$supplier->$supplier_name}} </option>
            @endforeach
        </optgroup>
    </select>
</div>

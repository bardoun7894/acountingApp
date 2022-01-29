<div class="col-md-12">
    <label for="eventRegInput2">{{__("messages.supplierName")}}</label>
    <select name="supplier_id"  id="supplier_id" class="select2 form-control @error('supplier_id') is-invalid @enderror"  >
        <optgroup label="Supplier name">
            <option value=""></option>
            @foreach($suppliers as $supplier)
                <option   value="{{$supplier->id}} " > {{$supplier->$supplier_name}} </option>
            @endforeach
        </optgroup>
    </select>
</div>

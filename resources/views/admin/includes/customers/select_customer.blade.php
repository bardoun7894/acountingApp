<div class="col-md-12">
    <label for="eventRegInput2">{{__("messages.customerName")}}</label>
    <select name="customer_id"  id="customer_id" class="select2 form-control @error('customer_id') is-invalid @enderror"  >
        <optgroup label="Customer name">
            <option value=""></option>
            @foreach($customers as $customer)
                <option   value="{{$customer->id}} " > {{$customer->$customer_name}} </option>
            @endforeach
        </optgroup>
    </select>
</div>


<div class="row justify-content-md-center form-group">
    <div class="col-md-12">
        <label for="eventRegInput2">{{__("messages.store_name")}}</label>
        <select name="store_id"  id="store_id" class="select2 form-control"  >
            <optgroup label="Store name">
                <option value="null"></option>
                @foreach($stores as $store)
                    <option   value="{{$store->id}} " > {{$store->$store_name}} </option>
                @endforeach
            </optgroup>
        </select>
    </div>
</div>

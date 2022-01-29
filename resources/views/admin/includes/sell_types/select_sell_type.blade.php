

<label for="sell_type_id">{{__("messages.sell_type_name")}}</label>
<select name="sell_type_id"  id="sell_type_id" class="select2 form-control col-md-3 @error('sell_type_id') is-invalid @enderror"  >
    <optgroup label="{{__("messages.sell_type_name")}}">
        <option value=""></option>
        @foreach($sell_types as $sell_type)
            <option   value="{{$sell_type->id}} " > {{$sell_type->$sell_type_name}} </option>
        @endforeach
    </optgroup>
</select>

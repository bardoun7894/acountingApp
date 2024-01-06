 <label for="eventRegInput2">{{ __('messages.store_name') }}</label>
 <select  name="store_id" id="store_id" class="select2 form-control @error('store_id') is-invalid @enderror" required>
     <optgroup label="Store name">
         <option value=""></option>
         @foreach ($stores as $store)
             <option value="{{ $store->id }} "> {{ $store->$store_name }} </option>
         @endforeach
     </optgroup>
 </select>

 <label for="eventRegInput2">{{ __('messages.supplierName') }}</label>
 <select name="supplier_id" id="supplier_id"
     class="supplierselect2 js-example-placeholder js-states form-control"></select>
 {{-- <input type="text" name="supplier_id" id="supplier_id"
     class="supplierselect2 form-control 
     @error('supplier_id') is-invalid @enderror"> --}}

 {{-- <option disabled selected value=""></option> --}}
 {{-- @foreach ($suppliers as $supplier)
         <option value="{{ $supplier->id }} "> {{ $supplier->$supplier_name }} </option>
     @endforeach --}}

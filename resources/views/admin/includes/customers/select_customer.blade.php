<label for="eventRegInput2">{{ __('messages.customerName') }}</label>
<select name="customer_id" id="customer_id"
    class="customerselect2 js-example-placeholder js-states form-control" required></select>
{{-- <input type="text" name="customer_id" id="customer_id"
    class="customerselect2 form-control
    @error('customer_id') is-invalid @enderror"> --}}

{{-- <option disabled selected value=""></option> --}}
{{-- @foreach ($customers as $customer)
        <option value="{{ $customer->id }} "> {{ $customer->$customer_name }} </option>
    @endforeach --}}

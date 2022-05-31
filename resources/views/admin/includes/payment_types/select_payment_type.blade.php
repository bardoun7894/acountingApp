<label for="payment_type_id">{{ __('messages.payment_type_name') }}</label>
<select name="payment_type_id" id="payment_type_id"
    class="select2 form-control col-md-3 @error('payment_type_id') is-invalid @enderror">
    <optgroup label="{{ __('messages.payment_type_name') }}">
        <option value=""></option>
        @foreach ($payment_types as $payment_type)
            <option value="{{ $payment_type->id }} "> {{ $payment_type->$payment_type_name }} </option>
        @endforeach
    </optgroup>
</select>

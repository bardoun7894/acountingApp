<fieldset>
    <div class="form-card">
        <h2 class="fs-title">{{ 'messages.personal_information' }}</h2>

        {{-- <input type="text" name="fname" placeholder="First Name"/> --}}
        <div class="form-group position-relative    ">

            <input id="{{ $full_name }}" type="text"
                class="form-control @error($full_name) is-invalid @enderror"
                name="{{ $full_name }}"
                placeholder="{{ __('messages.fullName') }}"
                value="{{ old($full_name) }}" required
                autocomplete="{{ $full_name }}" autofocus>
            @error($full_name)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group position-relative ">
            <input id="contact_number" type="text"
                class="form-control @error('contact_number') is-invalid @enderror"
                placeholder="{{ __('messages.phoneNumber') }}" name="contact_number"
                value="{{ old('contact_number') }}" required
                autocomplete="ContactNumber" autofocus>
            @error('contact_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <div class="form-group position-relative">
            <input id="{{ $address }}" type="text"
                class="form-control @error($address) is-invalid @enderror"
                name="{{ $address }}"
                placeholder="{{ __('messages.address') }}"
                value="{{ old($address) }}" required
                autocomplete="{{ $address }}" autofocus>
            @error($address)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

         {{-- admin or user hide  --}}
        {{-- <div class="row"> --}}

            {{-- <div class="form-group col-12 mb-2">
                <label>{{ __('messages.user_type') }}</label>
                <div class="input-group">
                    <div class="d-inline-block custom-control custom-radio mr-1">
                        <input type="radio" name="user_type_id"
                            class="custom-control-input" id="1" value="1">
                        <label class="custom-control-label"
                            for="1">{{ __('messages.admin') }}</label>
                    </div>
                    <div class="d-inline-block custom-control custom-radio mr-1">
                        <input type="radio" name="user_type_id"
                            class="custom-control-input" id="2" value="2">
                        <label class="custom-control-label"
                            for="2">{{ __('messages.user') }}</label>
                    </div>
                </div>
            </div> --}}
        {{-- </div> --}}
    </div>
    <input type="button" name="previous" class="previous action-button-previous"
        value="Previous" />

    <input type="button" name="next" class="next  action-button"
        value="{{ 'messages.next_step' }}">
    >
</fieldset>

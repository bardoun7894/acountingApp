
<fieldset>
    <div class="form-card">
        <h2 class="fs-title">{{ 'messages.company_information' }}</h2>
        {{-- <input type="text" name="fname" placeholder="First Name"/> --}}
        <div class="form-group position-relative">
            <input id="{{ $company_name }}" type="text"
                class="form-control @error($company_name) is-invalid @enderror"
                name="{{ $company_name }}"
                placeholder="{{ __('messages.company_name') }}"
                value="{{ old($company_name) }}" required
                autocomplete="{{ $company_name }}" autofocus>
            @error($company_name)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $company_name }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group position-relative">
            <input id="{{ $branch_name }}" type="text"
                class="form-control @error($branch_name) is-invalid @enderror"
                name="{{ $branch_name }}"
                placeholder="{{ __('messages.branch_name') }}"
                value="{{ old($branch_name) }}" required
                autocomplete="{{ $branch_name }}" autofocus>
            @error($branch_name)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $branch_name }}</strong>
                </span>
            @enderror
        </div>
          <!-- Store Name Field -->
          <div class="form-group position-relative">
            <input id="{{$store_name}}" type="text"
                   class="form-control @error($store_name) is-invalid @enderror"
                   name="{{$store_name}}"
                   placeholder="{{ __('messages.store_name') }}"
                   value="{{ old($store_name) }}" required
                   autocomplete="{{$store_name}}" autofocus>
            @error($store_name)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $store_name }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group position-relative">
            <input id="branch_address" type="text"
                class="form-control @error('branch_address') is-invalid @enderror"
                name="branch_address" placeholder="{{ __('messages.address') }}"
                required autofocus>
            @error('branch_address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        {{-- <div class="form-group position-relative">

            <input id="company_logo" type="file" class="form-control "
                name="company_logo" value="{{ old($company_name) }}" required>
        </div> --}}
    </div>
    <input type="button" name="previous" class="previous action-button-previous"
        value="{{ 'messages.previous_step' }}" />


    <button type="submit" name="next"
        class="submit next  action-button">{{ 'messages.next_step' }}</button>
    </button>
</fieldset>


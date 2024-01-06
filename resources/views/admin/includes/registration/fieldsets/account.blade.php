<fieldset>
    <legend>{{ __('messages.account_information') }}</legend>

    <div class="form-card">
        {{-- <h2 class="fs-title">Account Information</h2> --}}
        <div class="form-group position-relative ">
            <input id="email" type="email"
                class="form-control @error('email') is-invalid @enderror" name="email"
                placeholder="{{ __('messages.email') }}" value="{{ old('email') }}"
                required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <input id="username" type="text"
            class="form-control @error('username') is-invalid @enderror" name="username"
            placeholder="{{ __('messages.userName') }}"
            value="{{ old('username') }}" required autocomplete="username">

        @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <input id="password" type="password"
            class="form-control @error('password') is-invalid @enderror" name="password"
            placeholder="{{ __('messages.password') }}" required
            autocomplete="new-password">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <div class="form-group position-relative ">
            <input id="password-confirm" type="password" class="form-control"
                name="password_confirmation"
                placeholder="{{ __('messages.confirm_password') }}" required
                autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>



    </div>
    <input type="button" name="next" class="next action-button"
        value="{{ __('messages.next_step') }}" />
</fieldset>

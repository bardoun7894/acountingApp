@include('admin.includes.head')
<?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
$lang = LaravelLocalization::getCurrentLocale();
$full_name = 'full_name_' . $lang;
$branch_name = 'branch_name_' . $lang;
$company_name = 'company_name_' . $lang;
$address = 'address_' . $lang;

?>

<body class="horizontal-layout horizontal-menu material-horizontal-layout material-layout 1-column  " data-open="hover"
    data-menu="horizontal-menu" data-col="1-column"
    @if ($lang == 'ar') style="direction: rtl" @else style="direction: ltr" @endif>
    <!-- BEGIN: Content-->

    <section class="container-fluid" id="grad1">



        <!-- MultiStep Form -->

        <div class="row justify-content-center mt-0">
            <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
                <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                    <h2><strong>{{ __('messages.sign_up_for_a_new_account') }}</strong></h2>

                    <p>{{ __('messages.fill_all_form_field_to_go_to_next_step') }}</p>

                    <div class="row">
                        <div class="col-md-12 mx-0">
                            <form id="msform" method="POST" action="{{ route('register') }}">
                                @csrf
                                <!-- progressbar -->
                                <ul id="progressbar">
                                    <li class="active"
                                        style="@if ($lang == 'en') float: left;  @else   float: right; @endif"
                                        id="account"><strong>{{ __('messages.account') }}</strong></li>

                                    <li id="personal"
                                        style="@if ($lang == 'en') float: left;  @else   float: right; @endif">
                                        <strong>{{ __('messages.personal') }}</strong>
                                    </li>
                                    <li id="personal"
                                        style="@if ($lang == 'en') float: left;  @else   float: right; @endif">
                                        <strong>{{ __('messages.company') }} </strong>
                                    </li>
                                    <li id="confirm"
                                        style="@if ($lang == 'en') float: left;  @else   float: right; @endif">
                                        <strong>{{ __('messages.finish') }}</strong>

                                    </li>
                                </ul>
                                <!-- fieldsets -->
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
                                        <div class="row">
                                            <div class="form-group col-12 mb-2">
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
                                            </div>
                                        </div>
                                    </div>
                                    <input type="button" name="previous" class="previous action-button-previous"
                                        value="Previous" />

                                    <input type="button" name="next" class="next  action-button"
                                        value="{{ 'messages.next_step' }}">
                                    >
                                </fieldset>

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



                            </form>
                            <div class="card-body">
                                <a href="login" class="btn btn-outline-danger btn-block"><i
                                        class="ft-unlock"></i>{{ __('messages.login') }}</a>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        </div>
    </section>

    </div>
    <!-- END: Content-->

    <!-- BEGIN: Vendor JS-->
    <script src="{{ url('admin/app-assets/vendors/js/material-vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ url('admin/app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
    <script src="{{ url('admin/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
    <script src="{{ url('admin/app-assets/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ url('admin/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ url('admin/app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ url('admin/app-assets/js/scripts/pages/material-app.js') }}"></script>
    <script src="{{ url('admin/app-assets/js/scripts/forms/form-login-register.js') }}"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

@include('admin.includes.scripts_js')

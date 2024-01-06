@include('admin.includes.head')
<?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

$lang = LaravelLocalization::getCurrentLocale();
$full_name = 'full_name_' . $lang;
$branch_name = 'branch_name_' . $lang;
$store_name = 'store_name_' . $lang;
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
                                @include('admin.includes.registration.fieldsets.progressbar', ['lang' => $lang])

                                @include('admin.includes.registration.fieldsets.account', ['lang' => $lang])
                                @include('admin.includes.registration.fieldsets.personal', ['lang' => $lang])
                                @include('admin.includes.registration.fieldsets.company', ['lang' => $lang])



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

@include('admin.ltr.includes.head')
<?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
$lang = LaravelLocalization::getCurrentLocale();
  $full_name ="full_name_".$lang;

?>
<body class="horizontal-layout horizontal-menu material-horizontal-layout material-layout 1-column  bg-full-screen-image blank-page" data-open="hover" data-menu="horizontal-menu" data-col="1-column" @if($lang=='ar')style="direction: rtl" @else style="direction: ltr" @endif>
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-header row">
    </div>
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <section class="row flexbox-container">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                        <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                            <div class="card-header border-0 pb-0">
                                <div class="card-title text-center">
                                    <img src="{{url('admin/app-assets/images/logo/logo-dark.png')}}" alt="branding logo">
                                </div>
                                 </div>
                            <div class="card-content">

                                <div class="card-body"  >
                               <form class="form-horizontal"  method="POST" action="{{ route('register') }}" novalidate>
                                  @csrf
                                        <fieldset class="form-group position-relative @if($lang=='ar')has-icon-right @else has-icon-left @endif   " >

                                            <input id="{{$full_name}}"  type="text" class="form-control @error($full_name) is-invalid @enderror" name="{{$full_name}}" placeholder="{{__('messages.fullName')}}" value="{{old($full_name)}}" required autocomplete="{{$full_name}}"autofocus>
                                            <div class="form-control-position">
                                                <i class="la la-user-circle"></i>
                                            </div>

                                            @error($full_name)
                                               <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                               </span>
                                            @enderror
                                        </fieldset>

                                      <fieldset class="form-group position-relative @if($lang=='ar')has-icon-right @else has-icon-left @endif">
                                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="{{__('messages.userName')}}" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                                <div class="form-control-position">
                                                <i class="la la-user"></i>
                                                </div>
                                                @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                        </fieldset>
                                      <fieldset class="form-group position-relative @if($lang=='ar')has-icon-right @else has-icon-left @endif">
                                                <input id="contact_number" type="text" class="form-control @error('contact_number') is-invalid @enderror" placeholder="{{__('messages.phoneNumber')}}" name="contact_number" value="{{ old('contact_number') }}" required autocomplete="ContactNumber" autofocus>
                                                <div class="form-control-position">
                                                    <i class="la la-phone"></i>
                                                </div>

                                                @error('contact_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                        </fieldset>

                                     <fieldset class="form-group position-relative @if($lang=='ar')has-icon-right @else has-icon-left @endif">
                                          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{__('messages.email')}}" value="{{ old('email') }}" required autocomplete="email">
                                                <div class="form-control-position">
                                                     <i class="la la-envelope"></i>
                                                </div>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                        </fieldset>

                                     <fieldset class="form-group position-relative @if($lang=='ar')has-icon-right @else has-icon-left @endif">
                                         <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{__('messages.password')}}" required autocomplete="new-password">
                                                <div class="form-control-position">
                                                    <i class="la la-key"></i>
                                                </div>
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                        </fieldset>


                                     <fieldset class="form-group position-relative @if($lang=='ar')has-icon-right @else has-icon-left @endif">
                                         <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{__('messages.confirm_password')}}" required autocomplete="new-password">

                                         <div class="form-control-position">

                                             <i class="la la-key"></i>
                                                </div>
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                        </fieldset>


                                        <div class="form-group row">
                                            <div class="col-sm-6 col-12 text-center text-sm-left pr-0">
                                                <fieldset>
                                                    <input type="checkbox" id="remember-me" class="chk-remember">
                                                    <label for="remember-me"> Remember Me</label>
                                                </fieldset>
                                            </div>
                                            <div class="col-sm-6 col-12 float-sm-left text-center text-sm-right"><a href="recover-password.html" class="card-link">Forgot Password?</a></div>
                                        </div>
                                        <button type="submit" class="btn btn-outline-info btn-block"><i class="la la-user"></i> Register</button>
                                    </form>
                                </div>
                                <div class="card-body">
                                    <a href="login-with-bg-image.html" class="btn btn-outline-danger btn-block"><i class="ft-unlock"></i>
                                        Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>
<!-- END: Content-->


<!-- BEGIN: Vendor JS-->
<script src="{{url('admin/app-assets/vendors/js/material-vendors.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{url('admin/app-assets/vendors/js/ui/jquery.sticky.js')}}"></script>
<script src="{{url('admin/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
<script src="{{url('admin/app-assets/vendors/js/forms/icheck/icheck.min.js')}}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{url('admin/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{url('admin/app-assets/js/core/app.js')}}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{url('admin/app-assets/js/scripts/pages/material-app.js')}}"></script>
<script src="{{url('admin/app-assets/js/scripts/forms/form-login-register.js')}}"></script>
<!-- END: Page JS-->

</body>
<!-- END: Body-->

@include('admin.ltr.includes.scripts_js')

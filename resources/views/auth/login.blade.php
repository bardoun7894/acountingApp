 @include('admin.includes.head')
 <!-- BEGIN: Body-->

 <body
     class="horizontal-layout horizontal-menu material-horizontal-layout material-layout 1-column  bg-full-screen-image blank-page"
     data-open="hover" data-menu="horizontal-menu" data-col="1-column">
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
                                 <div class="card-content">
                                     <div class="card-body">
                                         <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                             @csrf
                                             <fieldset class="form-group position-relative has-icon-left">
                                                 <input id="email" type="email"
                                                     class="form-control @error('email') is-invalid @enderror"
                                                     name="email" value="{{ old('email') }}" required
                                                     autocomplete="email" autofocus>

                                                 @error('email')
                                                     <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong>
                                                     </span>
                                                 @enderror
                                                 <div class="form-control-position">
                                                     <i class="la la-user"></i>
                                                 </div>
                                             </fieldset>
                                             <fieldset class="form-group position-relative has-icon-left">
                                                 <input id="password" type="password"
                                                     class="form-control @error('password') is-invalid @enderror"
                                                     name="password" required autocomplete="current-password">

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
                                                         <input class="form-check-input" type="checkbox" name="remember"
                                                             id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                         <label class="form-check-label" for="remember">
                                                             {{ __('Remember Me') }}
                                                         </label>
                                                     </fieldset>
                                                 </div>
                                                 <div class="col-sm-6 col-12 float-sm-left text-center text-sm-right"><a
                                                         href="recover-password.html" class="card-link">Forgot
                                                         Password?</a></div>
                                             </div>
                                             <button type="submit" class="btn btn-outline-info btn-block"><i
                                                     class="ft-unlock"></i> Login</button>
                                         </form>
                                     </div>
                                     <p
                                         class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">
                                         <span>New to Accounting System
                                             ?</span></p>
                                     <div class="card-body">
                                         <a href="register" class="btn btn-outline-danger btn-block"><i
                                                 class="la la-user"></i>
                                             Register</a>

                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </section>

             </div>
         </div>
     </div>

 </body>
 <!-- END: Body-->

 @extends('admin.includes.scripts_js')

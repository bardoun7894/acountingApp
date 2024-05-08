<?php
use App\Models\User;
$lang=\App\Models\Translation::getLang();
$full_name ="full_name_".$lang;
$local_full_name= User::getFullName($lang);

?>
<!DOCTYPE html>
<!-- BEGIN: Head-->
@if( $lang=="ar")
@include('admin.includes.head_ar')
@else
@include('admin.includes.head')
@endif
<!-- END: Head-->
<!-- BEGIN: Body-->
@stack('scripts')
<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

<!-- BEGIN: Header-->
@include('admin.includes.header')
<!-- END: Header-->


<!-- BEGIN: Main Menu-->
@include('admin.includes.sidebar')
<!-- END: Main Menu-->

<!-- BEGIN: Content-->
<div class="app-content content">

    @yield('content')

</div>

<!-- END: Content-->
<div class="sidenav-overlay"></div>
<div class="drag-target"></div>
<!-- BEGIN: Footer-->
@include('admin.includes.footer')
<!-- END: Footer-->
@include('admin.includes.scripts_js')
</body>
<!-- END: Body-->


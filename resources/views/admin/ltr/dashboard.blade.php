<?php
use App\Models\User;
$lang=\App\Models\Translation::getLang();
$full_name ="full_name_".$lang;
$local_full_name= User::getFullName($lang);
?>
<!DOCTYPE html>
<!-- BEGIN: Head-->
@if( $lang=="ar")
@include('admin.ltr.includes.head_ar')
@else
@include('admin.ltr.includes.head')
@endif
<!-- END: Head-->
<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

<!-- BEGIN: Header-->
@include('admin.ltr.includes.header')
<!-- END: Header-->

<!-- BEGIN: Main Menu-->
@include('admin.ltr.includes.sidebar')
<!-- END: Main Menu-->

<!-- BEGIN: Content-->
<div class="app-content content">

    @yield('content');

</div>

<!-- END: Content-->
<div class="sidenav-overlay"></div>
<div class="drag-target"></div>
<!-- BEGIN: Footer-->
@include('admin.ltr.includes.footer');
<!-- END: Footer-->
@include('admin.ltr.includes.scripts_js')
</body>
<!-- END: Body-->


<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
@include('admin.ltr.includes.head')
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

</html>

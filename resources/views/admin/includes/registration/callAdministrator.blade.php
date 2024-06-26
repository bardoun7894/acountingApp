<head>
    <meta http-equiv="refresh" content="0; url={{ url('callAdministrator') }}">
</head>

<body>
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h5 class="content-header-title float-left pr-1 mb-0">{{__("messages.call_administrator")}}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">

                        @yield('content')

                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- END: Content-->

    @include('admin.includes.scripts_js')
    @include('admin.includes.scripts_css')

</body>
<script>
    window.location.href = "{{ url('callAdministrator') }}";
</script>

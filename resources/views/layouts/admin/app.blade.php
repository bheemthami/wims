<!DOCTYPE html>
<html style="height: auto; min-height: 100%;">
@include('layouts.admin.head')
@include('layouts.admin.header_scripts')

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('layouts.admin.header')
        @include('layouts.admin.sidebar')
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>
    @include('include.deleteModal')
    @include('include.customLoader')
    @include('layouts.admin.footer_scripts')
</body>

</html>

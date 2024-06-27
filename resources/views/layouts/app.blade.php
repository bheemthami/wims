<!DOCTYPE html>
<html style="height: auto; min-height: 100%;">
@include('layouts.admin.head')
<link rel="stylesheet" type="text/css" href="{{ asset('css/welcome.css') }}">
@include('layouts.admin.header_scripts')
<body>
    <div class="row">
        @yield('content')
    </div>
</section>
@include('layouts.admin.footer_scripts')
</body>
</html>
<!doctype html>
<html class="no-js" lang="zxx">
@include('layouts.frontend.head')
<body>
  @include('layouts.frontend.header')

  @yield('content')

  @include('layouts.frontend.footer')

  @include('layouts.frontend.footer_scripts')
</body>
</html>
